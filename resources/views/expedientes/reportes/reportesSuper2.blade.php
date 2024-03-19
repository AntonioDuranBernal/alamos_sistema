<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
  
  <style>
    /* Estilo para el contenedor del scroll */
    .custom-scroll {
      max-height: 400px; /* Ajusta la altura máxima del scroll según tus necesidades */
      overflow-y: auto;
      border: 1px solid #e2e8f0; /* Color del borde del scroll */
      border-radius: 0.375rem; /* Borde redondeado */
      background-color: #f7fafc; /* Color de fondo del scroll */
      scrollbar-width: thin; /* Ancho del scrollbar en navegadores Firefox */
      scrollbar-color: #4299e1 #f7fafc; /* Color del scrollbar en navegadores Firefox */
    }

    /* Estilo para las barras de desplazamiento en navegadores Chrome */
    .custom-scroll::-webkit-scrollbar {
      width: 6px; /* Ancho del scrollbar en navegadores Chrome */
    }

    /* Estilo para el pulgar del scrollbar en navegadores Chrome */
    .custom-scroll::-webkit-scrollbar-thumb {
      background-color: #4299e1; /* Color del pulgar del scrollbar en navegadores Chrome */
      border-radius: 3px; /* Borde redondeado del pulgar */
    }
  </style>
</head>
<body>

<div class="w-full flex justify-center">

    <div class="w-full sm:w-4/5 md:w-4/5 lg:w-7/8 p-4 mb-1">

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-2 flex-grow flex-shrink p-6">
                <a href="{{ route('homeAdminExpedientes') }}">
                    <button class="w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium rounded-lg text-sm py-4">Volver</button>
                </a>
            </div>

            <div class="col-span-10 h-[100px] p-3">
                <!-- Quita la clase bg-gray-200 y aplica una altura fija -->
                <br>
                <h1 class="text-2xl font-bold mb-4 text-center">REPORTE POR TOMO</h1>
            </div>
        </div>

        <form id="expedienteForm" action="{{ route('ejecutarExpedienteDocumentoSU') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="elementos" value="{{ json_encode($elementos) }}">

            
            <div class="flex justify-center">

    <div class="w-2/3 pr-4 relative">
        <label for="expedienteList" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expediente</label>
        <div class="flex">
            <div class="w-full mr-2">
                <select id="expedienteList" name="id_consecutivo" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($listaClientes as $cliente)
                        @if ($cliente->id_consecutivo !== null && $cliente->id_consecutivo !== 0)
                            <option value="{{ $cliente->id_consecutivo }}">{{ $cliente->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="mt-1  w-full bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-sm py-2 px-4" onclick="seleccionarExpediente()">Seleccionar</button>
            </div>
        </div>
    </div>

    <!-- Agrega un espacio entre el bloque anterior y este -->
    <div class="mt-4"></div>

    <div class="w-1/3">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="id_expediente">
            Tomos
        </label>
        <select id="id_expediente" name="id_expediente" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Tomo</option>
            @foreach ($listaDocumentos as $documento)
                <option value="{{ $documento->id_expediente }}">{{ $documento->descripcion}}</option>
            @endforeach
        </select>
    </div>



    <div class="flex justify-center gap-4">
    
            <!-- Agrega un espacio entre el bloque anterior y este -->
            <div class="mt-4"></div>
            
    <button type="submit" class="w-2/3 mt-7 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg text-sm py-2 px-4" onclick="updateFormAction()">Ejecutar</button>

        @if(count($elementos) > 0)
        <a href="{{ route('exportarExpedientesR2', ['elementos' => $elementos]) }}" class="w-2/3 mt-7 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-sm py-2 px-4">Exportar</a>
        @else
        <a class="w-2/3 mt-7 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-sm py-2 px-4">Exportar</a>
        @endif
    </div>
    
</div>



            <br>

            @if(count($elementos) > 0)
            <div class="custom-scroll">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 1000px;">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre Expediente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tomo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Usuario que realiza
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Movimiento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Solicitud
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha a Devolver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Entrega
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Disponibilidad
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($elementos as $elemento)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                          {{$elemento->OtroDato}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                          {{$elemento->tomo}}
                      </td>
                      
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                         {{$elemento->id_usuario_realiza}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                          {{$elemento->Movimiento}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                        @if ($elemento->fecha_solicitud)
                            {{ $elemento->fecha_solicitud }}
                        @else
                            ---
                        @endif
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                        @if ($elemento->fecha_devolucion)
                            {{ $elemento->fecha_devolucion }}
                        @else
                            ---
                        @endif
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                        @if ($elemento->fecha_entrega)
                            {{ $elemento->fecha_entrega }}
                        @else
                            ---
                        @endif
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                          {{$elemento->estado}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
            @else
            <img src="imagenes/los_alamos_sinfondo.png" alt="Sin registros" class="mx-auto mt-8">
            @endif
        </form>

    </div>
</div>

<script>
    function seleccionarExpediente() {
        var expedienteList = document.getElementById('expedienteList');
        var selectedId = expedienteList.options[expedienteList.selectedIndex].value;
        // Aquí puedes realizar la lógica adicional con el ID seleccionado
        console.log("ID Seleccionado:", selectedId);
        // Agrega la lógica para redirigir o hacer lo que necesites con el ID seleccionado
    }
</script>

</body>
</html>
