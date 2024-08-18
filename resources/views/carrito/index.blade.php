@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Carrito de Compras</h1>
        @php $total = 0; @endphp
        @forelse(session('cart', []) as $productId => $details)
            @php $total += $details['price'] * $details['quantity']; @endphp
            <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
                <h2 class="text-xl font-semibold text-gray-700">{{ $details['name'] }}</h2> <!-- Nombre del producto -->
                <p class="text-md text-gray-600">Precio Unidad: ${{ number_format($details['price'], 2) }}</p>
                <!-- Precio por unidad -->
                <div class="flex justify-between items-center mt-4">
                    <form action="{{ route('cart.update', $productId) }}" method="POST" class="flex items-center space-x-4">
                        @csrf
                        @method('PATCH')
                        <label for="quantity_{{ $productId }}" class="text-black font-medium">Cantidad:</label>
                        <input id="quantity_{{ $productId }}" type="number" name="quantity"
                            value="{{ $details['quantity'] }}" min="1" max="{{ $details['stock'] }}"
                            class="form-input border-gray-300 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black">

                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">Actualizar</button>
                    </form>

                    <p class="text-md font-semibold text-gray-800">Total:
                        ${{ number_format($details['price'] * $details['quantity'], 2) }}</p> <!-- Total calculado -->
                    <form action="{{ route('cart.remove', $productId) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:shadow-outline">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-white">No hay productos en el carrito.</p>
        @endforelse
        <!-- Muestra el total del carrito -->
        @php
            session(['total_general' => $total]);
        @endphp
        @if (session('cart') && count(session('cart')) > 0)
            <div class="text-2xl font-bold py-4 text-white">Total General: ${{ number_format($total, 2) }}</div>
        @endif
        <div class="flex justify-between mt-6">
            <a href="{{ route('galeria.pedidos') }}"
                class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:shadow-outline">Continuar
                Comprando</a>
            <a href="{{ session('tipoSalida') === 'PEDIDO' ? route('destinatarios.create') : route('detalle-ventas.create') }}"
                class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 focus:outline-none focus:shadow-outline">
                Proceder al Pago
            </a>
        </div>
    </div>
@endsection
