<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<div id="alert-fingerprint" class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 hidden" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
    <p>Coloque el dedo en el lector.</p>
</div>
<div class="container mx-auto p-4 grid gap-4">
    <div class="md:col-span-1 md:flex md:flex-col md:justify-center md:items-center">
  
    <h1 class="text-2xl font-bold mb-4 text-center md:text-left">Reingreso para {{$expediente->nombre}}</h1>

        <form id="formFinger" class="bg-white border border-gray-300 shadow-lg rounded-md mx-auto max-w-screen-md px-8 pt-8 pb-8 mb-8" action="{{route('reingresoActividad')}}" method="POST">
          @csrf <!-- Agrega el token CSRF para proteger el formulario -->
          
          <input type="hidden" name="tipo_gv" value="{{ $expediente->tipo_gv  }}">
          <input type="hidden" name="id_documento" value="{{ $expediente->id_documento}}">
          
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nombreCliente">
              Acreditado: {{$expediente->id_cliente}}
            </label>
          </div>

          <!--@if(!empty($expediente->tipo_gv))
          <div class="mb-4 flex">
           <label class="block text-gray-700 text-sm font-bold mb-2" for="nombreCliente">
              Tipo de documento: {{$expediente->tipo_gv}}
            </label>
          </div>
          @endif-->
          
          @if(!empty($expediente->numero_contrato))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="nombreCliente">
        Número de Contrato:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->numero_contrato}}
    </span>
</div>
@endif

@if(!empty($expediente->fecha_acta))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="fechaActa">
        Fecha de Acta:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->fecha_acta}}
    </span>
</div>
@endif

@if(!empty($expediente->numero_pagare))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="nombreCliente">
        Número de Pagare:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->numero_pagare}}
    </span>
</div>
@endif

@if(!empty($expediente->tipo_credito))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="nombreCliente">
        Tipo Crédito:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->tipo_credito}}
    </span>
</div>
@endif

@if(!empty($expediente->monto))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="monto">
        Monto:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->monto}}
    </span>
</div>
@endif

@if(!empty($expediente->usuario_posee))
<div class="mb-4 grid grid-cols-2">
    <label class="text-gray-700 text-sm font-bold" for="nombreCliente">
        Usuario poseedor:
    </label>
    <span class="text-gray-700 text-sm">
        {{$expediente->usuario_posee}}
    </span>
</div>
@endif
    
        <div class="mb-4">
         <label class="block text-gray-700 text-sm font-bold mb-2" for="motivo">
          Observaciones:
          </label>
          <textarea id="motivo" name="motivo" placeholder="Observaciones que se realizaron" class="w-96 p-2 border border-gray-300 rounded" required maxlength="250"></textarea>
        </div>

        <div class="flex justify-center items-center space-x-4 mt-6">
               <a href="{{ route('homeGV') }}" class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Volver</a>

            <button id="digital-authentication" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Confirmar con huella</button>
          </div>

          <!-- HUELLA -->
        <input id="id" type="hidden" name="id"/>
        <input id="password2" type="hidden" name="password2"/>
        </form>
    </div>
</div>

<script src="../js/es6-shim.js"></script>
<script src="../js/websdk.client.bundle.min.js"></script>
<script src="../js/fingerprint.sdk.min.js"></script>
<script src="../js/index.js"></script>


</body>
</html>

