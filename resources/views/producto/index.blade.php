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
                    <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        No
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Talla
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Colores
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Modelo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Precio Estimado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Precio Vendedor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Descripcion
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Tipo
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ ++$i }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->id_talla }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->id_colores }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->id_modelo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $producto->precio_estimado }}
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
                                                <a href="{{ route('productos.show',$producto->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                <a href="{{ route('productos.edit',$producto->id) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this producto?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
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
@endsection
