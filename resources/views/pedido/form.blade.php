<div class="container mx-auto text-gray-800">
    <div class="flex flex-col items-center p-4">
        <div class="w-full">
            <!-- Each form field follows the same styling pattern for consistency -->

            <!-- Id Cliente -->
            <div class="mb-6">
                <label for="search_cliente" class="block text-lg font-medium text-white">Buscar Cliente</label>
                <input type="text" id="search_cliente" placeholder="Buscar por nombre, CI o email..."
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out">
                <input type="hidden" id="id_cliente_hidden" name="id_cliente">
                <div id="client_list" class="mt-2 bg-white rounded-md shadow-lg"></div>
            </div>


            <!-- Id Usuario -->
            <div class="mb-6">
                <input type="hidden" name="id_usuario" id="id_usuario"
                    value="{{ old('id_usuario', session('user_id', $pedido?->id_usuario)) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('id_usuario') border-red-500 @enderror">
                @error('id_usuario')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Id Sucursal -->
            <div class="mb-6">
                <input type="hidden" name="id_sucursal" id="id_sucursal"
                    value="{{ old('id_sucursal', session('sucursal_id', $pedido?->id_sucursal)) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('id_sucursal') border-red-500 @enderror">
                @error('id_sucursal')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Fecha -->
            <div class="mb-6">
                <label for="fecha" class="block text-lg font-medium text-white">{{ __('Fecha') }}</label>
                <input type="text" name="fecha" id="fecha" placeholder="Fecha"
                    value="{{ old('fecha', now()->format('Y-m-d')) }}"readonly
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('fecha') border-red-500 @enderror">
                @error('fecha')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Estado -->
            <div class="mb-6">
                <label for="estado" class="block text-lg font-medium text-white">{{ __('Estado') }}</label>
                <select name="estado" id="estado"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('estado') border-red-500 @enderror">
                    <option value="" disabled selected>Select Estado</option>
                    <option value="PEDIDO" {{ old('estado', $pedido?->estado) == 'PEDIDO' ? 'selected' : '' }}>PEDIDO
                    </option>
                    <option value="VENTAS" {{ old('estado', $pedido?->estado) == 'VENTAS' ? 'selected' : '' }}>VENTAS
                    </option>
                </select>
                @error('estado')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Submission and Cancel buttons -->
        <div class="w-full mt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
            <a href="{{ route('pedidos.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>
<script>
    // Assuming $clients is passed to the view from your Laravel controller
    var clients = @json($clientes); // Embed client data into JavaScript

    document.getElementById('search_cliente').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const filteredClients = clients.filter(client =>
            client.nombre.toLowerCase().includes(query) ||
            client.ci.includes(query) ||
            client.email.toLowerCase().includes(query)
        );

        const list = filteredClients.map(client =>
            `<li class="px-4 py-2 border-b border-gray-300 cursor-pointer hover:bg-gray-100" onclick="selectClient('${client.nombre}', ${client.id})">
                ${client.nombre} - ${client.ci} - ${client.email}
            </li>`
        ).join('');

        document.getElementById('client_list').innerHTML = `<ul>${list}</ul>`;
    });

    function selectClient(name, id) {
        document.getElementById('search_cliente').value = name; // Update the visible input with the client's name
        document.getElementById('id_cliente_hidden').value = id; // Update the hidden input with the client's ID
        document.getElementById('client_list').innerHTML = ''; // Clear the list after selection
    }
</script>
