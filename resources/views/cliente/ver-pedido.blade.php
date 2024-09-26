<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle del Pedido</title>
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
        </div>
    </header>

    <main class="container mx-auto p-6">
        <section id="client-detail" class="py-12 text-center">
            <h2 class="text-4xl font-bold mb-6">Detalle del Cliente</h2>
            <p>Nombre: {{ $cliente->nombre }}</p>
            <p>CI: {{ $cliente->ci }}</p>
            <p>Dirección: {{ $cliente->direccion }}</p>
            <p>Teléfono: {{ $cliente->telefono }}</p>
            <p>Email: {{ $cliente->email }}</p>
        </section>

        <section id="pedido-detail" class="py-12">
            <h2 class="text-3xl font-bold mb-6">Pedidos del Cliente</h2>

            <!-- Barra de Estados -->
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-4">Estados de los Pedidos</h3>
                <div class="flex">
                    @foreach($estadoCounts as $estado => $count)
                        <div class="mr-4">
                            <p>{{ $estado }}: {{ $count }}</p>
                            <div class="bg-blue-500 text-white px-4 py-2 rounded-full">{{ $count }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Lista de Pedidos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($pedidos as $pedido)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-2">Pedido #{{ $pedido->id }}</h3>
                        <p>Fecha: {{ $pedido->fecha }}</p>
                        <p>Estado: {{ $pedido->estado }}</p>
                        <p>Total: Bs. {{ $pedido->precioTotal }}</p>
                        <p>Saldo: Bs. {{ $pedido->saldo }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            &copy; 2024 Ketal Mesobol.
        </div>
    </footer>
</body>

</html>
