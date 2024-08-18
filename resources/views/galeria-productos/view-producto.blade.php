@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="md:flex md:items-start">
            <!-- Product Image -->
            <div class="flex-initial w-full md:w-1/2 lg:w-1/3 xl:w-1/4 mb-4">
                <div class="main-image mb-4">
                    <img id="mainImage" src="{{ asset($producto->modelo->imagenModelos->first()->url ?? '') }}"
                        alt="Main Model Image" class="rounded-lg shadow-xl ring-1 ring-gray-200">
                </div>
                <div class="grid grid-cols-3 gap-2 mt-2">
                    @foreach ($producto->modelo->imagenModelos as $image)
                        <img onclick="updateMainImage(this)" src="{{ asset($image->url) }}" alt="Model Thumbnail"
                            class="rounded-lg shadow-sm cursor-pointer w-full h-full object-cover hover:scale-110 transition-transform duration-200 ease-in-out">
                    @endforeach
                    @if ($producto->detalleMateriales->isNotEmpty())
                        @foreach ($producto->detalleMateriales as $detalle)
                            @foreach ($detalle->materiale->imagenMateriales as $imagen)
                                <img onclick="updateMainImage(this)" src="{{ asset($imagen->url) }}"
                                    alt="Material Thumbnail"
                                    class="rounded-lg shadow-sm cursor-pointer w-full h-full object-cover hover:scale-110 transition-transform duration-200 ease-in-out">
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- Product Details -->
            <div class="md:w-1/2 lg:w-2/3 xl:w-3/4 md:pl-6">
                <h1 class="text-3xl font-bold text-white">{{ $producto->nombre }}</h1>
                <p class="text-lg text-gray-300 mt-2">{{ $producto->descripcion }}</p>

                <div class="mt-4">
                    <span class="text-xl font-semibold text-white">Precio:</span>
                    <span class="text-xl text-red-500">{{ number_format($producto->precio_vendedor, 2) }} Bs.</span>
                </div>

                <div class="mt-2">
                    <span class="text-xl font-semibold text-white">Cantidad disponible:</span>
                    <span class="text-xl text-green-500">{{ $producto->cantidad }}</span>
                </div>

                <div class="mt-6">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $producto->id }}">
                        <input type="hidden" name="price" value="{{ $producto->precio_vendedor }}">
                        <input type="hidden" name="name" value="{{ $producto->nombre }}">
                        
                        <!-- Input para seleccionar la cantidad -->
                        <label for="quantity" class="block text-xl text-white mb-2">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $producto->cantidad }}" class="w-20 text-black rounded px-2 py-1 mb-4 text-lg">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-12 text-white">
            <h2 class="text-2xl font-bold">Información adicional</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-lg">
                <div><strong>Modelo:</strong> {{ $producto->modelo->nombre ?? 'N/A' }}</div>
                <div>
                    <strong>Color:</strong> {{ $producto->colore->nombre ?? 'N/A' }}
                    <div class="flex space-x-2 mt-2">
                        @foreach ($producto->colore->imagenColores as $image)
                            <img src="{{ asset($image->url) }}" alt="Color Image" class="rounded-full w-12 h-12 shadow-lg">
                        @endforeach
                    </div>
                </div>
                <div><strong>Talla:</strong> {{ $producto->talla->talla ?? 'N/A' }}</div>
                <div><strong>Tipo:</strong> {{ $producto->tipo }}</div>
            </div>
        </div>
    </div>

    <script>
        function updateMainImage(element) {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = element.src; // Update the source of the main image to the source of the clicked thumbnail
        }
    </script>
@endsection
