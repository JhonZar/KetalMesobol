@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Asignar Pedidos</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white py-2 px-4 rounded mb-6 shadow-md animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($sucursales as $sucursal)
                <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 text-white">{{ $sucursal->nombre }}</h2>
                    
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold mb-2 text-gray-200">Total Pedidos</h3>
                        <div class="flex items-center">
                            <div class="flex-1 h-4 bg-gray-600 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 animate-progress" style="width: {{ min($sucursal->total_pedidos, 100) }}%;"></div>
                            </div>
                            <div class="ml-4 text-lg font-bold text-gray-200">
                                {{ $sucursal->total_pedidos > 99 ? '+99' : $sucursal->total_pedidos }}
                            </div>
                        </div>
                    </div>

                    @foreach ($sucursal->pedidos_by_estado as $estado => $count)
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-200">{{ $estado }}</h3>
                            <div class="flex items-center">
                                <div class="flex-1 h-4 bg-gray-600 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-500 animate-progress" style="width: {{ min($count, 100) }}%;"></div>
                                </div>
                                <div class="ml-4 text-lg font-bold text-gray-200">
                                    {{ $count > 99 ? '+99' : $count }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Botón para abrir el modal -->
                    <button class="mt-6 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="openModal('{{ $sucursal->id }}')">Ver Detalles</button>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $sucursal->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-gray-800 text-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeInUp">
                            <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h2 class="text-xl font-bold mb-4">{{ $sucursal->nombre }}</h2>
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold mb-2">Total Pedidos</h3>
                                    <div class="flex items-center">
                                        <div class="flex-1 h-4 bg-gray-600 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-500" style="width: {{ min($sucursal->total_pedidos, 100) }}%;"></div>
                                        </div>
                                        <div class="ml-4 text-lg font-bold">
                                            {{ $sucursal->total_pedidos > 99 ? '+99' : $sucursal->total_pedidos }}
                                        </div>
                                    </div>
                                </div>

                                @foreach ($sucursal->pedidos_by_estado as $estado => $count)
                                    <div class="mt-4">
                                        <h3 class="text-lg font-semibold mb-2">{{ $estado }}</h3>
                                        <div class="flex items-center">
                                            <div class="flex-1 h-4 bg-gray-600 rounded-full overflow-hidden">
                                                <div class="h-full bg-blue-500" style="width: {{ min($count, 100) }}%;"></div>
                                            </div>
                                            <div class="ml-4 text-lg font-bold">
                                                {{ $count > 99 ? '+99' : $count }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Formulario de asignación -->
                                <div class="bg-gray-700 shadow-md rounded p-4 mt-6">
                                    <form action="{{ route('asignar.pedidos.post') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="pedido_id" class="block text-lg font-medium text-gray-300">Seleccionar Pedido:</label>
                                            <select name="pedido_id" id="pedido_id" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white">
                                                @foreach ($pedidos->where('id_sucursal', $sucursal->id) as $pedido)
                                                    <option value="{{ $pedido->id }}">Pedido #{{ $pedido->id }} - {{ $pedido->cliente->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label for="usuario_id" class="block text-lg font-medium text-gray-300">Seleccionar Usuario:</label>
                                            <select name="usuario_id" id="usuario_id" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white">
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Asignar Pedido
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('{{ $sucursal->id }}')">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sección de Filtro y Listado de Pedidos -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6 text-white">Listado de Pedidos</h2>

            <form method="GET" action="{{ route('asignar.pedidos') }}" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="filtro_sucursal" class="block text-lg font-medium text-gray-300">Filtrar por Sucursal:</label>
                        <select name="filtro_sucursal" id="filtro_sucursal" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white">
                            <option value="">Todas las Sucursales</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="filtro_estado" class="block text-lg font-medium text-gray-300">Filtrar por Estado:</label>
                        <select name="filtro_estado" id="filtro_estado" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white">
                            <option value="">Todos los Estados</option>
                            <option value="PEDIDO PROCESO">PEDIDO PROCESO</option>
                            <option value="ASIGNADO">ASIGNADO</option>
                            <option value="TERMINADO">TERMINADO</option>
                            <option value="DEVUELTO">DEVUELTO</option>
                        </select>
                    </div>

                    <div>
                        <label for="filtro_saldo" class="block text-lg font-medium text-gray-300">Filtrar por Saldo:</label>
                        <select name="filtro_saldo" id="filtro_saldo" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white">
                            <option value="">Todos</option>
                            <option value="con_saldo">Con Saldo</option>
                            <option value="sin_saldo">Sin Saldo</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="mt-6 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Aplicar Filtros
                </button>
            </form>

            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <table class="min-w-full bg-gray-700 rounded">
                    <thead>
                        <tr>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">ID</th>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">Cliente</th>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">Sucursal</th>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">Estado</th>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">Fecha</th>
                            <th class="text-left py-2 px-4 font-medium text-gray-300">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidosFiltrados as $pedido)
                            <tr>
                                <td class="py-2 px-4 text-gray-200">{{ $pedido->id }}</td>
                                <td class="py-2 px-4 text-gray-200">{{ $pedido->cliente->nombre }}</td>
                                <td class="py-2 px-4 text-gray-200">{{ $pedido->sucursale->nombre }}</td>
                                <td class="py-2 px-4 text-gray-200">
                                    <form action="{{ route('pedidos.actualizarEstado', $pedido->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado" class="bg-gray-800 text-white rounded p-2">
                                            <option value="PEDIDO PROCESO" {{ $pedido->estado == 'PEDIDO PROCESO' ? 'selected' : '' }}>PEDIDO PROCESO</option>
                                            <option value="ASIGNADO" {{ $pedido->estado == 'ASIGNADO' ? 'selected' : '' }}>ASIGNADO</option>
                                            <option value="TERMINADO" {{ $pedido->estado == 'TERMINADO' ? 'selected' : '' }}>TERMINADO</option>
                                            <option value="CANCELADO" {{ $pedido->estado == 'CANCELADO' ? 'selected' : '' }}>CANCELADO</option>
                                        </select>
                                        <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                            Cambiar
                                        </button>
                                    </form>
                                </td>
                                <td class="py-2 px-4 text-gray-200">{{ $pedido->fecha }}</td>
                                <td class="py-2 px-4 text-gray-200">
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="ml-4 text-blue-500 hover:underline">Editar</a>
                                    <button onclick="openDetailModal('{{ $pedido->id }}')" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Detalles</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($pedidosFiltrados as $pedido)
        <!-- Modal Detalles -->
        <div id="detail-modal-{{ $pedido->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-gray-800 text-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeInUp">
                    <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h2 class="text-xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h2>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold mb-2">Detalles de Venta</h3>
                            @foreach ($pedido->detalleVentas as $detalle)
                                <div class="flex justify-between mb-2">
                                    <div>{{ $detalle->producto->nombre }}</div>
                                    <div>{{ $detalle->cantidad }} x ${{ number_format($detalle->precion_unitario, 2) }}</div>
                                </div>
                            @endforeach
                            <h3 class="text-lg font-semibold mb-2 mt-4">Destinatarios</h3>
                            @foreach ($pedido->destinatarios as $destinatario)
                                <div class="flex justify-between mb-2">
                                    <div>{{ $destinatario->producto->nombre }} ({{ $destinatario->talla->nombre }})</div>
                                    <div>{{ $destinatario->cantidad }} - {{ $destinatario->cliente->nombre }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold mb-2">Saldo a Cobrar</h3>
                            <div class="text-3xl font-bold text-white mb-4">${{ number_format($pedido->saldo, 2) }}</div>
                            <form action="{{ route('pedidos.cobrarSaldo', $pedido->id) }}" method="POST">
                                @csrf
                                <label for="monto_a_cobrar" class="block text-lg font-medium text-gray-300">Monto a Cobrar:</label>
                                <input type="number" name="monto_a_cobrar" id="monto_a_cobrar" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white" step="0.01" max="{{ $pedido->saldo }}" required>
                                <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Cobrar
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeDetailModal('{{ $pedido->id }}')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }

        function openDetailModal(id) {
            document.getElementById('detail-modal-' + id).classList.remove('hidden');
        }

        function closeDetailModal(id) {
            document.getElementById('detail-modal-' + id).classList.add('hidden');
        }
    </script>
@endsection
