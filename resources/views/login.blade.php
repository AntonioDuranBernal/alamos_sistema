<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">

</head>
<body>

<div id="alert-fingerprint" class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 hidden" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
    <p>Coloque el dedo en el lector.</p>
</div>
<div class="bg-white-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Iniciar Sesión</h2>
        <form id="formFinger" method="POST" action="{{ route('autenticar') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Nùmero de Usuario</label>
                <input
                    id="email"
                    type="text"
                    class="shadow appearance-none border rounded form-input w-full @error('email') border-red-500 @enderror"
                    name="email"
                    required
                    autofocus
                />
                @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    class="shadow appearance-none border rounded form-input w-full @error('registroHuellaDigital') border-red-500 @enderror"
                    name="password"
                    required
                />
                @error('registroHuellaDigital')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <input
                id="id"
                type="hidden"
                name="id"
            />
            <input
                id="password2"
                type="hidden"
                name="password2"
            />
            

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ingresar</button>
            </div>

            <div class="text-center">
                <button id="digital-authentication" type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ingresar Con Huella</button>
            </div>
        </form>
    </div>
</div>

<script src="js/es6-shim.js"></script>
<script src="js/websdk.client.bundle.min.js"></script>
<script src="js/fingerprint.sdk.min.js"></script>
<script src="js/index.js"></script>

</body>
</html>