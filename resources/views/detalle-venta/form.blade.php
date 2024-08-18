@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mx-auto p-4">
    <div class="flex flex-col items-center">
        <div class="w-full text-black">

            <div class="mb-6">
                <label for="id_pedido" class="block text-lg font-medium text-white">Id Pedido</label>
                <input type="text" name="id_pedido" id="id_pedido" placeholder="Id Pedido"
                    value="{{ old('id_pedido', session('pasoNroPed', $detalleVenta?->id_pedido ?? null)) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('id_pedido') border-red-500 @enderror"
                    readonly>
                @error('id_pedido')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex justify-between">
                <a href="{{ route('galeria.pedidos') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-in-out duration-150">
                    Agregar Más Productos
                </a>

                <a href="{{ route('cart.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150">
                    Ver Carrito
                </a>
            </div>

            <div class="mb-6">
                <label for="total_general" class="block text-lg font-medium text-white">Total a Pagar</label>
                <h2 id="total_general" class="mt-2 px-4 py-3 block w-full text-3xl font-bold text-white bg-gray-800 rounded shadow">
                    {{ number_format(session('total_general', 0), 2) }} Bs.
                </h2>
            </div>
            
            

            <!-- Campo para ingresar la cantidad que el cliente pagará -->
            <div class="mb-6">
                <label for="pago_cliente" class="block text-lg font-medium text-white">Cantidad Pagada</label>
                <input type="number" name="pago_cliente" id="pago_cliente" placeholder="Ingrese la cantidad pagada"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out"
                    min="{{ number_format(session('total_general', 0) * 0.2, 2) }}" step="0.01" required>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Submit
                </button>
                <a href="{{ route('detalle-ventas.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
