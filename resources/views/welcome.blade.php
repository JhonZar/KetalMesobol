<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sombrerería</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-red-500">Ketal Mesobol</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-red-500 transition-colors">Inicio</a>
                <a href="#gallery" class="text-gray-700 hover:text-red-500 transition-colors">Productos</a>
                <a href="#contact" class="text-gray-700 hover:text-red-500 transition-colors">Contacto</a>
                <a href="{{ route('seguimiento.ci') }}" class="text-gray-700 hover:text-red-500 transition-colors">Ver
                    mis pedidos</a>

            </nav>
            <div class="md:hidden">
                <button id="menu-button" class="text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7">
                        </path>
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

    <nav id="menu" class="hidden md:hidden bg-white shadow-md">
        <ul class="flex flex-col space-y-4 p-4">
            <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-red-500 transition-colors">Inicio</a></li>
            <li><a href="#gallery" class="text-gray-700 hover:text-red-500 transition-colors">Productos</a></li>
            <li><a href="#contact" class="text-gray-700 hover:text-red-500 transition-colors">Contacto</a></li>
            <li><a href="{{ route('seguimiento.ci') }}" class="text-gray-700 hover:text-red-500 transition-colors">Ver mis pedidos</a></li>
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/home') }}" class="hover:underline">Home</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:underline">Log in</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    @endif
                @endauth
            @endif
        </ul>
    </nav>

    <section class="relative bg-cover bg-center h-screen" style="background-image: url('../images/PORTADA2.jpg');"
        data-aos="fade-in">
        <div class="absolute inset-0 bg-black opacity-50 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">Ketal Mesobol</h1>
                <h2 class="text-3xl md:text-4xl mb-8">Tu estilo, una moda...</h2>
                <a href="#gallery" class="bg-red-500 hover:bg-red-600 text-lg px-6 py-3 rounded transition-colors">Ver
                    nuestra galería</a>
            </div>
        </div>
    </section>

    <main class="container mx-auto p-6">
        <section id="about" class="py-12 text-center" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-6">Sobre Nosotros</h2>
            <p class="text-lg mb-4">En Ketal Mesobol, nos dedicamos a ofrecer sombreros de alta calidad para todas las
                ocasiones. Nuestro equipo se esfuerza por brindar el mejor servicio al cliente y garantizar que cada uno
                de nuestros productos cumpla con los estándares más altos de calidad.</p>
            <p class="text-lg">Nuestra misión es no solo vender sombreros, sino también crear una experiencia única para
                nuestros clientes, haciendo que cada compra sea memorable. Gracias por elegirnos y ser parte de nuestra
                familia.</p>
        </section>

        <section class="text-center my-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-6">Bienvenido a nuestra Sombrerería</h2>
            <p class="text-lg mb-4">Encuentra los mejores sombreros para todas las ocasiones.</p>
            <a href="{{ url('/productos') }}"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">Ver Productos</a>
        </section>

        <section id="gallery" class="my-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-6 text-center">Galería de Productos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($productos as $producto)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md transform transition duration-300 hover:scale-105"
                        data-aos="zoom-in">
                        <div class="overflow-hidden rounded-t-lg">
                            @if ($producto->modelo->imagenModelos->isNotEmpty())
                                <img src="{{ $producto->modelo->imagenModelos->first()->url }}"
                                    alt="{{ $producto->nombre }}"
                                    class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                            @else
                                <img src="https://via.placeholder.com/150" alt="{{ $producto->nombre }}"
                                    class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">{{ $producto->nombre }}</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $producto->descripcion }}</p>
                            <span class="text-red-500 font-bold text-2xl">Bs. {{ $producto->precio_estimado }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="testimonials" class="my-12 py-12 bg-gray-200 text-gray-900" data-aos="fade-up">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Testimonios</h2>
                <div class="flex flex-col md:flex-row md:space-x-4">
                    <div class="bg-white p-6 rounded-lg shadow-md mb-4 md:mb-0" data-aos="fade-right">
                        <p class="text-lg italic">"Los sombreros de Ketal Mesobol son de una calidad excepcional. ¡Me
                            encanta mi compra!"</p>
                        <p class="mt-4 font-bold">- Cliente Satisfecho</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md mb-4 md:mb-0" data-aos="fade-right">
                        <p class="text-lg italic">"El servicio al cliente es increíble. Definitivamente recomendaré
                            esta tienda a mis amigos."</p>
                        <p class="mt-4 font-bold">- Cliente Feliz</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-right">
                        <p class="text-lg italic">"La mejor experiencia de compra que he tenido. Los sombreros son
                            hermosos y de alta calidad."</p>
                        <p class="mt-4 font-bold">- Cliente Fiel</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="my-12 py-12" data-aos="fade-up">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Contacto</h2>
                <form class="bg-white p-6 rounded-lg shadow-md">
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-gray-700">Correo
                            Electrónico</label>
                        <input type="email" id="email"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-lg font-medium text-gray-700">Mensaje</label>
                        <textarea id="message" rows="4"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">Enviar
                        Mensaje</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            &copy; 2024 Ketal Mesobol.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
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
