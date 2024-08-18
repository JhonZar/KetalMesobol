@extends('layouts.app')

@section('template_title')
    Destinatario
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="py-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold " id="card_title">
                    {{ __('Destinatario') }}
                </h2>

                <div class="flex items-center">
                    <a href="{{ route('destinatarios.create') }}" class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            No
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Id Pedido
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Id Cliente
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Id Producto
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Fecha Entrega
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Id Talla
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Obs
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($destinatarios as $destinatario)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ ++$i }}
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->id_pedido }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->id_cliente }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->id_producto }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->cantidad }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->fecha_Entrega }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->id_talla }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                                {{ $destinatario->obs }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-4">
                                                    <a href="{{ route('destinatarios.show', $destinatario->id) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                    <a href="{{ route('destinatarios.edit', $destinatario->id) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                                    <form action="{{ route('destinatarios.destroy', $destinatario->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destinatario?');">
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
        </div>
        <div class="mt-6">
            {!! $destinatarios->links() !!}
        </div>
    </div>
@endsection
