@extends('layouts.app')

@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="py-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold " id="card_title">
                    {{ __('Producto') }}
                </h2>

                <div class="flex items-center">
                    <a href="{{ route('productos.create') }}"
                        class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create New') }}
                    </a>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6 shadow-md animate__animated animate__fadeIn">
                    <p class="font-semibold">{{ $message }}</p>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="border-t border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Detalles
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Precio Vendedor
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Descripcion
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            Talla: {{ $producto->id_talla }} <br>
                                            Color: {{ $producto->id_colores }} <br>
                                            Modelo: {{ $producto->id_modelo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->precio_vendedor }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->cantidad }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->descripcion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->tipo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-4">
                                                <a href="{{ route('productos.show', $producto->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button onclick="openModal('{{ $producto->id }}')" class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('productos.destroy', $producto->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal para editar cantidad -->
                                    <div id="modal-{{ $producto->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                                            </div>
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                            <div class="inline-block align-bottom bg-gray-800 text-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeInUp">
                                                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <h2 class="text-xl font-bold mb-4">Editar Cantidad - {{ $producto->nombre }}</h2>
                                                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <label for="cantidad" class="block text-lg font-medium text-gray-300">Cantidad Actual: {{ $producto->cantidad }}</label>
                                                            <input type="number" name="cantidad" id="cantidad" class="w-full mt-1 p-2 border rounded bg-gray-800 text-white"
                                                                   value="{{ $producto->cantidad }}" min="{{ $producto->cantidad }}" required>
                                                        </div>


                                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                            Guardar
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('{{ $producto->id }}')">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">
            {!! $productos->links() !!}
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
