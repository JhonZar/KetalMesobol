<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seguimiento por CI</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-red-500">Ketal Mesobol</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-red-500 transition-colors">Inicio</a>
                <a href="#gallery" class="text-gray-700 hover:text-red-500 transition-colors">Productos</a>
                <a href="#contact" class="text-gray-700 hover:text-red-500 transition-colors">Contacto</a>
                <a href="{{ route('seguimiento.ci') }}" class="text-gray-700 hover:text-red-500 transition-colors">Ver mis pedidos</a>
            </nav>
            <div class="md:hidden">
                <button id="menu-button" class="text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            @if (Route::has('login'))
                <div class="hidden md:flex space-x-4">
                    @auth
                        <a href="{{ url()->previous() }}" class="hover:underline">Volver</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <main class="container mx-auto p-6">
        <section id="client-search" class="py-12 text-center">
            <h2 class="text-4xl font-bold mb-6">Buscar Cliente por CI</h2>
            <form method="GET" action="{{ route('ver-pedido') }}" class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <label for="ci" class="block text-lg font-medium text-gray-700">Ingrese su CI</label>
                    <input type="text" id="ci" name="ci"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">Buscar</button>
            </form>

        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            &copy; 2024 Ketal Mesobol.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.querySelector('#menu-button');
            const menu = document.querySelector('#menu');
            menuButton.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
