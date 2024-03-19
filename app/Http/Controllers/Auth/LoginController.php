<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class LoginController extends Controller
{

    
    public function __construct(){
        $this->middleware('auth',['except'=>['showLoginForm', 'attemptLogin']]);
    }
    

    public function showLoginForm()
    {
        return view('login');
    }

    public function logout(Request $request){

    // Actualiza el campo "area" del usuario a 0
    DB::table('users')
    ->where('idUsuarioSistema', auth()->id())
    ->update(['area' => 0]);

    Auth::logout(); // Cierra la sesión del usuario
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return view('welcome');
   }

    protected function attemptLogin(Request $request)
    {

        //Inicio Sesion con huella
        if($request->id != '' && $request->password2 != ''){
            $userFinded = User::
            where(
                [
                    ['idUsuarioSistema', $request->id],
                    ['password', $request->password2 ]
                ]
            )
            ->first();

            if(!$userFinded){
                $mensaje = 'Credenciales no válidas.';
                return view('welcome', compact('mensaje'));    
            }

            Auth::login($userFinded);

            $permisos = DB::table('users')
                ->select('registrarExpediente', 'consultarExpediente', 'editarExpediente', 'eliminarExpediente', 'reportesExpediente',
                    'registrarGuardavalores', 'retirarGuardavalores', 'editarGuardavalores', 'consultarGuardavalores', 'reportesGuardavalores')
                ->where('idUsuarioSistema', $userFinded->idUsuarioSistema)
                ->first();
            
            // Verificar si el usuario tiene permisos sobre expedientes o guardavalores
            if ($permisos) {
                $tienePermisosExpediente = $permisos->registrarExpediente || $permisos->consultarExpediente || $permisos->editarExpediente || $permisos->eliminarExpediente || $permisos->reportesExpediente;
                $tienePermisosGuardavalores = $permisos->registrarGuardavalores || $permisos->retirarGuardavalores || $permisos->editarGuardavalores || $permisos->consultarGuardavalores || $permisos->reportesGuardavalores;
            
                // Guardar los permisos en un array
                $permisos = [
                    'expediente' => $tienePermisosExpediente,
                    'guardavalores' => $tienePermisosGuardavalores,
                ];
            
                if (!$tienePermisosExpediente && !$tienePermisosGuardavalores) {
                    $mensaje = 'No se tienen permisos asignados.';
                    return view('welcome', compact('mensaje'));
                }
            }
            

            echo "USUARIO LOGEADOO: ".$userFinded->idUsuarioSistema. " NOMBRE LOGIN CONTROLLERR: ".$userFinded->nombre;

            return view('opcionesArea', ['permisos' => $permisos, 'idUsuarioSistema' => $userFinded->idUsuarioSistema]);
        }else {
            $credentials = $request->validate([
                'email' => ['required'], 
                'password' => ['required'],
            ]);
        
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                // Autenticación exitosa
                $idUsuarioSistema = $request->email;
                $password = $request->password;
        
                $sql = DB::table('users')->select('idUsuarioSistema')->where('idUsuarioSistema', $idUsuarioSistema)->first();
        
                $permisos = DB::table('users')
                    ->select('registrarExpediente', 'consultarExpediente', 'editarExpediente', 'eliminarExpediente', 'reportesExpediente',
                        'registrarGuardavalores', 'retirarGuardavalores', 'editarGuardavalores', 'consultarGuardavalores', 'reportesGuardavalores')
                    ->where('idUsuarioSistema', $idUsuarioSistema)
                    ->first();
                
                // Verificar si el usuario tiene permisos sobre expedientes o guardavalores
                if ($permisos) {
                    $tienePermisosExpediente = $permisos->registrarExpediente || $permisos->consultarExpediente || $permisos->editarExpediente || $permisos->eliminarExpediente || $permisos->reportesExpediente;
                    $tienePermisosGuardavalores = $permisos->registrarGuardavalores || $permisos->retirarGuardavalores || $permisos->editarGuardavalores || $permisos->consultarGuardavalores || $permisos->reportesGuardavalores;
                
                    // Guardar los permisos en un array
                    $permisos = [
                        'expediente' => $tienePermisosExpediente,
                        'guardavalores' => $tienePermisosGuardavalores,
                    ];
                
                    if (!$tienePermisosExpediente && !$tienePermisosGuardavalores) {
                        $mensaje = 'No se tienen permisos asignados.';
                        return view('welcome', compact('mensaje'));
                    }
                }
                
                $usuario = Auth::user();
                $idUsuarioSistema = $usuario->idUsuarioSistema;
                $nombre = $usuario->nombre;
        
                echo "USUARIO LOGEADOO: ".$idUsuarioSistema. " NOMBRE LOGIN CONTROLLERR: ".$nombre;
        
                return view('opcionesArea', ['permisos' => $permisos, 'idUsuarioSistema' => $idUsuarioSistema]);
        
                
            }else {
                     // Autenticación fallida
                $mensaje = 'Credenciales no válidas.';
                return view('welcome', compact('mensaje'));
            }
        }
    }


}