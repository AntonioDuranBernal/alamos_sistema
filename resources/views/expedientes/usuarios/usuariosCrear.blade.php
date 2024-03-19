

<!-- Resto de tu contenido actual -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Usuario</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">

  <script src="core/modules/WebSdk/index.js"></script>
  <script src="{{ asset('js/funciones.js') }}"></script>

</head>
<body>
<div id="alert-fingerprint" class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 hidden" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
    <p>Coloque el dedo en el lector.</p>
</div>
<div class="container mx-auto p-4 relative">


    <div id="miCard" class="hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <!-- Contenido del card 

    <a href="#" onclick="cerrarCard()" class="flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Confirmar
        </a>

    -->
    <a href="#" class="flex justify-center items-center">
        <img class="rounded-t-lg" src="{{ asset('imagenes/huella.png') }}" alt="" />
    </a>
    <div class="p-5">
        <a href="#" class="p-5 flex justify-center items-center">
            <h5 class="flex justify-center items-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Colocar dedo índice en lector.</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>
        
    </div>
    </div>




    <h1 class="text-2xl font-bold mb-4 text-center">Registrar Usuario</h1>
    <form class="bg-white border border-gray-300 shadow-lg rounded-md mx-auto px-8 pt-6 pb-8 mb-4" action="{{ route('usuario.store') }}" method="POST">
    @csrf <!-- Agregar el token CSRF aquí -->
    <input type="hidden" name="huella" id="huella">

    <!-- Primera fila -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                Nombre(s)
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" name="nombre" placeholder="Nombre(s)" required>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="apellidos">
                Apellidos
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellidos" type="text" name="apellidos" placeholder="Apellidos" required>
        </div>
    </div>

    <!-- Segunda fila -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="otros_datos">
                Observaciones
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="otros_datos" type="text" name="otros_datos" placeholder="Observaciones" required>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="rol">
                Rol
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rol" name="rol" required>
                <option value="1">Usuario</option>
                <option value="2">Administrador</option>
                <!--<option value="3">Super Administrador</option>-->
            </select>
        </div>
    </div>

    <!-- Tercera fila - Expedientes -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Expedientes
        </label>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="expediente_registrar" id="expediente_registrar">
                <label for="expediente_registrar">Registrar Expedientes</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="expediente_consultar" id="expediente_consultar">
                <label for="expediente_consultar">Consultar Expedientes</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="expediente_editar" id="expediente_editar">
                <label for="expediente_editar">Editar Expedientes</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="expediente_eliminar" id="expediente_eliminar">
                <label for="expediente_eliminar">Eliminar Expedientes</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="expediente_reportes" id="expediente_reportes">
                <label for="expediente_reportes">Reportes Expedientes</label>
            </div>
        </div>
    </div>

    <!-- Cuarta fila - Guardavalores -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Guardavalores
        </label>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="guardavalor_registrar" id="guardavalor_registrar">
                <label for="guardavalor_registrar">Registrar Guardavalores</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="guardavalor_retirar" id="guardavalor_retirar">
                <label for="guardavalor_retirar">Retirar Guardavalores</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="guardavalor_editar" id="guardavalor_editar">
                <label for="guardavalor_editar">Editar Guardavalores</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="guardavalor_consultar" id="guardavalor_consultar">
                <label for="guardavalor_consultar">Consultar Guardavalores</label>
            </div>
            <div>
                <input class="checkbox-custom" type="checkbox" name="permisos[]" value="guardavalor_reportes" id="guardavalor_reportes">
                <label for="guardavalor_reportes">Reportes Guardavalores</label>
            </div>
        </div>
    </div>

    
    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="digital-enrollment">Capturar Huella</button>
   
    <div class="flex items-center justify-center mt-4" id="container-img">
        
    </div>


    <!-- Sexta fila - Botones -->
    <div class="flex items-center justify-center mt-4">
    
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4" type="submit">
            Guardar
        </button>
        <a href="{{ route('homeUsuarios') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancelar</a>
    </div>

</form>

</div>

<!-- Estilo personalizado para los checkbox 

    /* Añade cualquier estilo adicional que desees */
        .checkbox-custom {
        appearance: none;
        border: 2px solid #000;
        width: 1.2rem;
        height: 1.2rem;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        margin-right: 0.5rem;
    }

-->
<style>    

    .checkbox-custom:checked {
        background-color: #0055a4; /* Cambia el color de fondo al seleccionar */
    }

    .checkbox-custom:checked::before {
        content: '\2713'; /* Símbolo de marca de verificación Unicode */
        color: #fff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
    }

#miCard {
        max-width: 30rem; /* Ancho máximo del card */
        background-color: white; /* Color de fondo del card */
        opacity: 1; /* Ajusta la opacidad del card */
        visibility: visible; /* Asegura que el card sea visible por defecto */
        transition: opacity 0.3s ease; /* Agrega transición suave para la opacidad */
    }

    /* Estilo adicional para el card cuando está oculto */
    #miCard.hidden {
        opacity: 0; /* Establece la opacidad en 0 cuando está oculto */
        visibility: hidden; /* Oculta el card cuando está oculto */
    }



</style>

    <script src="js/es6-shim.js"></script>
    <script src="js/websdk.client.bundle.min.js"></script>
    <script src="js/fingerprint.sdk.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>
