<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .dark-glass {
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .bg-cover {
            background-image: url('{{ asset('imagenes/bgLogin.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        .error-message {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .error-message svg {
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-cover flex items-center justify-center min-h-screen">

<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
    <div class="dark-glass p-10 rounded-lg shadow-xl max-w-lg w-full">
        <h2 class="text-2xl font-bold text-gray-200 mb-4 text-center">Seleccione su sucursal</h2>
        @if ($errors->any())
            <div class="error-message mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <select id="sucursal" name="sucursal" class="form-select bg-transparent text-white border border-gray-500 rounded-lg block w-full p-4">
            @foreach ($sucursales as $sucursal)
                <option class="bg-black" value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
        <button onclick="selectSucursal()" class="mt-6 bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 text-white rounded-lg w-full px-5 py-3">
            Confirmar
        </button>
    </div>
</div>

<div id="loginForm" class="hidden dark-glass p-12 rounded-lg shadow-lg max-w-lg w-full">
    <h2 class="text-2xl font-bold text-gray-200 mb-8 text-center">Bienvenido</h2>
    @if ($errors->any())
        <div class="error-message mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
            </svg>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="sucursal_id" id="sucursal_id">
        <div>
            <label for="nombre" class="block mb-2 text-lg font-medium text-gray-200">Usuario</label>
            <input id="nombre" name="nombre" type="text" required class="form-input bg-transparent w-full px-4 py-4 border rounded-lg text-gray-200 focus:outline-none focus:border-green-500">
        </div>
        <div>
            <label for="contra" class="block mb-2 text-lg font-medium text-gray-200">Contraseña</label>
            <input id="contra" name="contra" type="password" required class="form-input bg-transparent w-full px-4 py-4 border rounded-lg text-gray-200 focus:outline-none focus:border-green-500">
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 text-white rounded-lg w-full px-5 py-3">
            Iniciar sesión
        </button>
    </form>
</div>

<script>
    window.onload = function() {
        document.getElementById('modal').classList.remove('hidden');
    };

    function selectSucursal() {
        const sucursal = document.getElementById('sucursal').value;
        document.getElementById('sucursal_id').value = sucursal;
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('loginForm').classList.remove('hidden');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.js"></script>
</body>

</html>
