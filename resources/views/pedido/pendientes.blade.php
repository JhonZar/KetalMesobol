@extends('layouts.app')

@section('template_title')
    Trabajos Pendientes
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Trabajos Pendientes</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white py-2 px-4 rounded mb-6 shadow-md animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white py-2 px-4 rounded mb-6 shadow-md animate__animated animate__fadeIn">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($pedidosPendientes as $pedido)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Pedido #{{ $pedido->id }}</h2>
                    <p class="text-gray-800"><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
                    <p class="text-gray-800"><strong>Sucursal:</strong> {{ $pedido->sucursale->nombre }}</p>
                    <p class="text-gray-800"><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
                    <p class="text-gray-800"><strong>Estado:</strong> {{ $pedido->estado }}</p>

                    <div class="mt-4">
                        <button class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="openModal('details-{{ $pedido->id }}')">Ver Detalles</button>
                    </div>
                </div>

                <!-- Modal Detalles -->
                <div id="modal-details-{{ $pedido->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-gray-800 text-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeInUp">
                            <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h2 class="text-xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h2>
                                <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
                                <p><strong>Sucursal:</strong> {{ $pedido->sucursale->nombre }}</p>
                                <p><strong>Precio Total:</strong> {{ $pedido->precioTotal }}</p>
                                <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
                                <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold mb-2">Destinatarios</h3>
                                    @foreach ($pedido->destinatarios as $destinatario)
                                        <div class="mb-4 p-4 bg-gray-700 rounded-md">
                                            <p><strong>Producto:</strong>
                                                <a href="{{ route('products.show', $destinatario->producto->id) }}" target="_blank" class="text-blue-400 hover:text-blue-600">{{ $destinatario->producto->nombre }}</a>
                                            </p>
                                            <p><strong>Cantidad:</strong> {{ $destinatario->cantidad }}</p>
                                            <p><strong>Fecha Entrega:</strong> {{ $destinatario->fecha_Entrega }}</p>
                                            <p><strong>Talla:</strong> {{ $destinatario->talla->talla }}</p>
                                            <p><strong>Modelo:</strong> {{ $destinatario->producto->modelo->nombre }}</p>
                                            <p><strong>Color:</strong> {{ $destinatario->producto->colore->nombre }}</p>
                                            <p><strong>Observaciones:</strong> {{ $destinatario->obs }}</p>
                                            <p><strong>Estado Actual:</strong> {{ $destinatario->ultimoEstado }}</p>

                                            <form action="{{ route('pedidos.actualizarEstados', $destinatario->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="estado-{{ $destinatario->id }}" class="block text-sm font-medium text-gray-300">Estado</label>
                                                    <select name="estado" id="estado-{{ $destinatario->id }}" class="mt-1 p-2 w-full bg-gray-700 rounded-md">
                                                        @foreach ($destinatario->estadosDisponibles as $estado)
                                                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
                                                </div>
                                            </form>

                                            <div class="mt-4">
                                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded" onclick="openModal('historial-{{ $destinatario->id }}')">Ver Historial</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('details-{{ $pedido->id }}')">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($pedido->destinatarios as $destinatario)
                    <!-- Modal Historial -->
                    <div id="modal-historial-{{ $destinatario->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                            </div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-gray-800 text-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeInUp">
                                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h2 class="text-xl font-bold mb-4">Historial de Estados del Destinatario</h2>
                                    <div class="mt-4">
                                        @foreach ($destinatario->historialEstados as $historial)
                                            <div class="mb-4 p-4 bg-gray-700 rounded-md">
                                                <p><strong>Estado:</strong> {{ $historial->estado->nombre }}</p>
                                                <p><strong>Usuario:</strong> {{ $historial->usuario->nombre }}</p>
                                                <p><strong>Fecha:</strong> {{ $historial->fecha }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('historial-{{ $destinatario->id }}')">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endforeach
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>
@endsection
