<!DOCTYPE html>
<html>
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



    {{-- Esta es la fila con 3 elementos --}}
<div class="grid grid-cols-12 gap-4">
  
<div class="col-span-2 flex-grow flex-shrink p-6">
    <a href="{{ route('expedientesBasico',$id_usuario) }}">
        <button class="w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium rounded-lg text-sm py-4">Volver</button>
    </a>
</div>


    {{-- Muestra el formulario de búsqueda en lugar de "Elemento 2" --}}
    <div class="col-span-10 h-[100px] p-3"> <!-- Quita la clase bg-gray-200 y aplica una altura fija -->
        <form class="rounded mb-4 bg-transparent" action="{{route('expedientes.search')}}" method="POST"> <!-- Agrega una clase personalizada para quitar el fondo de color -->
            @csrf
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-6 pl-10 text-bg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Número de expediente" autofocus="autofocus" required type="text" name="id_expediente" id="id_expediente">
                <button id="id_expediente" type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Buscar</button>
            </div>
        </form>
    </div>

</div>
<h1 class="text-2xl font-bold mb-4 text-center">TOMOS REGISTRADOS</h1>


@if(count($elementos) > 0)
            <div class="text-left">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-6 py-3" style="width: 20%;">Número de Tomo</th>
        <th scope="col" class="px-6 py-3" style="width: 40%;">Nombre de Expediente</th>
        <th scope="col" class="px-6 py-3" style="width: 24%;">Disponibilidad</th>
        <th scope="col" class="px-6 py-3" style="width: 10%;"></th>
    </tr>
</thead>
    </table>
            </div>
                    
                    
    <div class="custom-scroll">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <tbody>

    @foreach($elementos as $elemento)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{$elemento->nombre}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{$elemento->descripcion}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{$elemento->estado}}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{route('detallesExpedienteBasicoUser', [$elemento->id_expediente,$id_usuario ] )}}">Detalles</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        
        <img src="imagenes/los_alamos_sinfondo.png" alt="Sin registros" class="mx-auto mt-8">
          
        @endif
    </div>
</div>

</body>
</html>