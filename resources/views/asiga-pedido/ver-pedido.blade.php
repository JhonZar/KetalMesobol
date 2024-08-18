@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h1>

        <div class=" shadow-md rounded p-4">
            <h2 class="text-xl font-bold mb-4">Información del Cliente</h2>
            <p><strong>Nombre:</strong> {{ $pedido->cliente->nombre }}</p>
            <p><strong>Email:</strong> {{ $pedido->cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $pedido->cliente->telefono }}</p>

            <h2 class="text-xl font-bold mt-6 mb-4">Información del Pedido</h2>
            <p><strong>Sucursal:</strong> {{ $pedido->sucursale->nombre }}</p>
            <p><strong>Usuario Asignado:</strong> {{ $pedido->usuario->nombre }}</p>
            <p><strong>Precio Total:</strong> {{ number_format($pedido->precioTotal, 2) }} Bs.</p>
            <p><strong>Pago a Cuenta:</strong> {{ number_format($pedido->pagoACuenta, 2) }} Bs.</p>
            <p><strong>Saldo:</strong> {{ number_format($pedido->saldo, 2) }} Bs.</p>
            <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

            <h2 class="text-xl font-bold mt-6 mb-4">Destinatarios</h2>
            @foreach ($pedido->destinatarios as $destinatario)
                <div class="mb-4 p-4 border rounded">
                    <h3 class="font-bold">Producto:
                        <a href="{{ route('products.show', ['id' => $destinatario->producto->id]) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                            {{ $destinatario->producto->nombre }}
                        </a>
                    </h3>
                    <p><strong>Cantidad:</strong> {{ $destinatario->cantidad }}</p>
                    <p><strong>Fecha de Entrega:</strong> {{ $destinatario->fecha_Entrega }}</p>
                    <p><strong>Talla:</strong> {{ $destinatario->talla->talla }}</p>
                    <p><strong>Observaciones:</strong> {{ $destinatario->obs }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
