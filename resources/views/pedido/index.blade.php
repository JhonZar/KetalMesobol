@extends('layouts.app')

@section('template_title')
    Pedido
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="py-4">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold" id="card_title">
                    {{ __('Pedido') }}
                </h2>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('pedidos.create') }}"
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

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="border-t border-gray-200">
                    <div class="table-responsive">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Cliente
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Usuario
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Id Sucursal
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Precio Total
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Pago A Cuenta
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Saldo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ ++$i }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->id_cliente }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->id_usuario }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->id_sucursal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->precioTotal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->pagoACuenta }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->saldo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->fecha }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            {{ $pedido->estado }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-4">
                                                <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                                    class="text-green-600 hover:text-green-900">Edit</a>
                                                <a href="{{ route('pedidos.print', $pedido->id) }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12.2v5.8a2.2 2.2 0 01-2.2 2.2H5.2A2.2 2.2 0 013 18V12.2a2.2 2.2 0 012.2-2.2H6V6a2 2 0 012-2h8a2 2 0 012 2v4h.8a2.2 2.2 0 012.2 2.2zM16 6V4M8 6V4m8 0H8v2m8 0H8v2" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this pedido?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">Delete</button>
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
            {!! $pedidos->links() !!}
        </div>
    </div>
@endsection
