<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title') |
        @endif {{ config('app.name', 'KetalMesobol') }}
    </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">

    <style>
        .nunito {
            font-family: 'Nunito', sans-serif;
        }

        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-l-1 {
            border-left-width: 1px;
        }

        hover\:border-none:hover {
            border-style: none;
        }

        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }

        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }

        #sidebar:hover {
            width: 150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        #sidebar:hover span {
            opacity: 1;
        }

        body {
            background-color: #1a202c;
            color: #cbd5e0;
            overflow-x: hidden;
            /* Ocultar el desbordamiento horizontal */
        }

        .sidebar {
            background-color: #2d3748;
        }

        .sidebar a {
            color: #a0aec0;
        }

        .sidebar a:hover {
            color: #ffffff;
            background-color: #4a5568;
        }

        .header {
            background-color: #2d3748;
            color: #ffffff;
        }

        .nav-link {
            color: #a0aec0;
        }

        .nav-link:hover {
            color: #ffd700;
        }

        .dropdown-menu {
            background-color: #2d3748;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu a {
            color: #a0aec0;
        }

        .dropdown-menu a:hover {
            background-color: #4a5568;
            color: #ffd700;
        }

        .main-content-bg {
            background-color: #2d3748;
        }

        .content-bg {
            background-color: #1a202c;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-900 font-sans nunito">
    <!-- Side bar -->
    <div id="sidebar"
        class="h-screen w-16 bg-gray-800 text-white flex flex-col items-start fixed shadow-lg transition-all duration-300 justify-center">
        <ul class="list-none w-full">
            <li class="my-4 relative group">
                <a href="{{ route('asignar.pedidos') }}"
                    class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fas fa-home fa-fw"></i><span class="hidden md:inline-block text-sm">Home</span>
                </a>
            </li>
            <li class="my-4 relative group">
                <a href="{{ route('trabajos.pendientes') }}"
                    class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fas fa-tasks fa-fw"></i><span class="hidden md:inline-block text-sm">Tareas</span>
                </a>
            </li>
            <li class="my-4 relative group">
                <a href="{{ route('clientes.index') }}"
                    class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fa fa-envelope fa-fw"></i><span class="hidden md:inline-block text-sm">Clientes</span>
                </a>
            </li>
            <li class="my-4 relative group">
                <a href="#" class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fas fa-chart-area fa-fw"></i><span class="hidden md:inline-block text-sm">Pedidos</span>
                </a>
                <ul
                    class="list-none pl-4 hidden group-hover:block transition-all duration-300 absolute bg-gray-900 w-48 left-full top-0">
                    <li><a href="{{ route('pedidos.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Ver Pedidos</a></li>
                    <li><a href="{{ route('pedidos.create') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Crear Pedido</a></li>
                </ul>
            </li>
            <li class="my-4 relative group">
                <a href="{{ route('productos.index') }}"
                    class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fa fa-box fa-fw"></i><span class="hidden md:inline-block text-sm">Productos</span>
                </a>
                <ul
                    class="list-none pl-4 hidden group-hover:block transition-all duration-300 absolute bg-gray-900 w-48 left-full top-0">
                    <li><a href="{{ route('galeria.pedidos') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Galeria</a></li>
                    <li><a href="{{ route('productos.create') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Crear Producto</a></li>

                </ul>
            </li>

            <li class="my-4 relative group">
                <a href="{{ route('productos.index') }}"
                    class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fa fa-box fa-fw"></i><span class="hidden md:inline-block text-sm">Detalles</span>
                </a>
                <ul
                    class="list-none pl-4 hidden group-hover:block transition-all duration-300 absolute bg-gray-900 w-48 left-full top-0">
                    <li><a href="{{ route('modelos.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Modelos</a></li>
                    <li><a href="{{ route('colores.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Colores</a></li>
                    <li><a href="{{ route('tallas.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Tallas</a></li>
                    <li><a href="{{ route('categorias.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Categorias</a></li>
                    <li><a href="{{ route('materiales.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Materiales</a></li>
                </ul>
            </li>

            <li class="my-4 relative group">
                <a href="#" class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fa fa-wallet fa-fw"></i><span class="hidden md:inline-block text-sm">Ventas</span>
                </a>
                <ul
                    class="list-none pl-4 hidden group-hover:block transition-all duration-300 absolute bg-gray-900 w-48 left-full top-0">
                    <li><a href="{{ route('pedidos.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Ver Ventas</a></li>
                    <li><a href="{{ route('pedidos.create') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Crear Venta</a></li>
                </ul>
            </li>
            <li class="my-4 relative group">
                <a href="#" class="block py-3 pl-4 align-middle text-left no-underline hover:text-yellow-500">
                    <i class="fa fa-cogs fa-fw"></i><span class="hidden md:inline-block text-sm">Administración</span>
                </a>
                <ul
                    class="list-none pl-4 hidden group-hover:block transition-all duration-300 absolute bg-gray-900 w-48 left-full top-0">
                    <li><a href="{{ route('usuarios.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Usuarios</a></li>
                    <li><a href="{{ route('roles.index') }}"
                            class="block py-2 pl-2 no-underline hover:text-yellow-500">Roles</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">
        <div class="h-40 lg:h-20 w-full flex flex-wrap">
            <!-- Navbar -->
            <nav id="header1" class="w-full flex-1 border-b-1 border-gray-300 order-1 lg:order-2 header">
                <div class="flex h-full justify-between items-center">
                    <div class="text-lg font-semibold text-white pl-4">
                        <a href="{{ route('asignar.pedidos') }}"> KETALMESOBOL</a>
                    </div>
                    <!-- Search -->
                    <div class="relative w-full max-w-3xl px-6 flex justify-center">
                        <div class="absolute h-10 mt-1 left-0 top-0 flex items-center pl-10">
                            <svg class="h-4 w-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                </path>
                            </svg>
                        </div>
                        <input id="search-toggle" type="search" placeholder="search"
                            class="block w-full bg-gray-700 focus:outline-none focus:bg-gray-600 focus:shadow-md text-gray-200 font-bold rounded-full pl-12 pr-4 py-3"
                            onkeyup="updateSearchResults(this.value);" />
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4 pr-6">
                        <!-- Notification Icon -->
                        <div class="relative">
                            <button id="notificationButton" class="nav-link focus:outline-none">
                                <svg class="w-6 h-6 text-gray-400 hover:text-yellow-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 0 18 14.158V11a6.002 6.002 0 0 0-4-5.659V4a2 2 0 1 0-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 1 1-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                            </button>
                            <!-- Notification Badge -->
                            <span
                                class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 rounded-full bg-red-500 text-white px-1 py-0.5 text-xs font-bold"
                                id="notification-count">5</span>
                            <!-- Notification Dropdown -->
                            <div id="notificationsMenu"
                                class="bg-gray-800 nunito rounded shadow-md mt-2 absolute right-0 min-w-max overflow-auto z-30 hidden">
                                <ul class="list-reset" id="notification-list">
                                    <!-- Notificaciones cargadas dinámicamente -->
                                </ul>
                            </div>
                        </div>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}"
                            class="relative nav-link flex items-center focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path
                                    d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                            </svg>
                            Carrito
                            @if (session('cart'))
                                @php
                                    $totalItems = 0;
                                    foreach (session('cart') as $item) {
                                        $totalItems += $item['quantity'];
                                    }
                                @endphp
                                <span
                                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 rounded-full bg-yellow-500 text-white px-2 py-1 text-xs font-bold">{{ $totalItems }}</span>
                            @endif
                        </a>

                        <!-- User Icon -->
                        <div class="relative text-sm">
                            <button id="userButton"
                                class="flex items-center focus:outline-none p-2 text-white rounded-lg transition duration-200">
                                <i class="fas fa-user w-6 h-6"></i>
                                <span class="hidden md:inline-block ml-2">Hola, {{ session('nombreusu') }}</span>
                                <svg class="ml-2 w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="userMenu"
                                class="bg-gray-800 nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 hidden">
                                <ul class="list-reset">
                                    <li>
                                        <a href="#" class="px-4 py-2 block no-underline">My account</a>
                                    </li>
                                    <li>
                                        <hr class="border-t mx-2 border-gray-400" />
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 block no-underline w-full text-left">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- / User Menu -->
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="main-content-bg w-full flex-1 p-8">
            <main class="mt-4 bg-gray-700 p-8 rounded-lg shadow-lg h-full w-full max-w-full">
                <div class="content-bg p-6 rounded-lg shadow-lg h-full w-full max-w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

    <script>
        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");
        var notificationsMenu = document.getElementById("notificationsMenu");
        var notificationButton = document.getElementById("notificationButton");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            // User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("hidden")) {
                        userMenuDiv.classList.remove("hidden");
                    } else {
                        userMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("hidden");
                }
            }

            // Notifications Menu
            if (!checkParent(target, notificationsMenu)) {
                // click NOT on the menu
                if (checkParent(target, notificationButton)) {
                    // click on the link
                    if (notificationsMenu.classList.contains("hidden")) {
                        notificationsMenu.classList.remove("hidden");
                    } else {
                        notificationsMenu.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    notificationsMenu.classList.add("hidden");
                }
            }
        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }

        function toggleSubmenu(submenuId) {
            var submenu = document.getElementById(submenuId);
            submenu.classList.toggle('hidden');
        }

        function fetchNotifications() {
            fetch('/notifications/low-stock')
                .then(response => response.json())
                .then(data => {
                    let notificationList = document.getElementById('notification-list');
                    notificationList.innerHTML = ''; // Limpiar lista actual
                    data.forEach(producto => {
                        let listItem = document.createElement('li');
                        listItem.className = 'px-4 py-2 text-gray-300';
                        listItem.textContent = `Quedan menos de 5 unidades de ${producto.nombre}.`;
                        notificationList.appendChild(listItem);
                    });

                    // Actualizar el contador de notificaciones
                    document.getElementById('notification-count').textContent = data.length;
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            fetchNotifications(); // Cargar notificaciones al cargar la página
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.x.x/alpine.min.js" defer></script>
    @if (session()->has('print_pedido_id'))
        <script>
            window.addEventListener('load', function() {
                console.log("Script de impresión cargado");
                var pedidoId = "{{ session('print_pedido_id') }}";
                console.log("ID del pedido para imprimir:", pedidoId);
                var url = "{{ route('pedidos.print', ['id' => ':id']) }}".replace(':id', pedidoId);
                console.log("URL de impresión:", url);
                window.open(url, '_blank');
            });
        </script>
        @php
            session()->forget('print_pedido_id');
        @endphp
    @endif
</body>

</html>
