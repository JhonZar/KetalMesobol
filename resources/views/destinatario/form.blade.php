@php
    $cart = session('cart', []);
    $firstKey = array_key_first($cart);
    $firstProduct = $firstKey ? $cart[$firstKey] : null;
    $clientId = session('id_clie', null);
@endphp

<div class="container mx-auto">
    <div class="flex flex-wrap -mx-3">
        <!-- Columna para el buscador -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <div class="mb-4">
                <input type="text" id="searchClientInput" placeholder="Buscar cliente por nombre o CI..."
                    class="px-4 py-2 border rounded text-black w-full">
            </div>
            <div id="clientResults" class="mb-4 overflow-auto text-white bg-gray-800 rounded p-2"
                style="max-height: 200px;"></div>
        </div>

        <!-- Columna para la tabla de clientes agregados -->
        <div class="w-full md:w-1/2 px-3 mb-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xl font-semibold text-white">Cantidad Disponible: </span>
                <span id="cantidad-disponible" class="text-xl font-semibold text-green-500">{{ $totalProductoDisponible }}</span>
            </div>
            <table id="clientsTable" class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-800 text-white">
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">
                            Nombre
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">
                            CI
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">
                            Talla
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="text-white"></tbody>
            </table>
            <button id="addRecordButton"
                class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar
                Registro</button>
        </div>
    </div>

    <div class="flex flex-col items-center p-4">
        <div class="w-full flex flex-wrap">
            <!-- Columna Izquierda -->
            <div class="w-full md:w-1/2 px-3 mb-6">
                <!-- Fecha Entrega -->
                <div class="mb-6">
                    <label for="fecha_Entrega" class="block text-lg font-medium text-white">{{ __('Fecha Entrega') }}</label>
                    <input type="date" name="fecha_Entrega" id="fecha_Entrega" placeholder="Fecha Entrega"
                        value="{{ old('fecha_Entrega', optional($destinatario)->fecha_Entrega?->format('Y-m-d')) }}"
                        class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out text-black">
                    @error('fecha_Entrega')
                        <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Observaciones -->
                <div class="mb-6">
                    <label for="obs" class="block text-lg font-medium text-white">{{ __('Obs') }}</label>
                    <input type="text" name="obs" id="obs" placeholder="Obs"
                        value="{{ old('obs', optional($destinatario)->obs) }}"
                        class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out text-black">
                    @error('obs')
                        <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="w-full md:w-1/2 px-3 mb-6">
                <!-- ID Pedido -->
                <div class="mb-6">
                    <label for="id_pedido" class="block text-lg font-medium text-white">{{ __('Id Pedido') }}</label>
                    <input type="text" name="id_pedido" id="id_pedido" placeholder="Id Pedido"
                        value="{{ session('pasoNroPed', optional($destinatario)->id_pedido) }}"
                        class="text-black mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out"
                        readonly>
                    @error('id_pedido')
                        <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Producto -->
                <div class="mb-6">
                    <label for="id_producto" class="block text-lg font-medium text-white">{{ __('Id Producto') }}</label>
                    <input type="text" name="id_producto" id="id_producto" placeholder="Id Producto"
                        value="{{ old('id_producto', $firstProduct ? $firstProduct['name'] : optional($destinatario)->id_producto) }}"
                        class="text-black mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out"
                        readonly>
                    @error('id_producto')
                        <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Información del Cliente -->
        <input type="hidden" name="client_data" id="client_data" value="">
        <div class="container mx-auto">
            <div class="flex flex-col items-center p-4">
                <!-- Total a Pagar -->
                <div class="w-full text-center mb-4">
                    <span class="text-3xl font-semibold text-white">Total a Pagar: </span>
                    <span class="text-3xl font-semibold text-green-500">Bs {{ session('total_general', '0.00') }}</span>
                </div>
                <!-- Adelanto del 20% -->
                <div class="w-full text-center">
                    <label for="twenty_percent" class="text-lg font-medium text-white block mb-2">Adelanto 20% del Total:</label>
                    <input type="text" id="twenty_percent" name="ACC"
                        value="{{ number_format(session('total_general', 0) * 0.2, 2) }}"
                        class="text-xl px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-1/2 mx-auto shadow-sm sm:text-xl border-gray-300 rounded-md transition duration-150 ease-in-out text-black text-center"
                        oninput="validateAmount(this)">
                </div>
                <!-- Alerta -->
                <div id="alert"
                    class="hidden mt-4 px-4 py-2 border border-red-400 text-red-400 bg-red-100 rounded-md w-1/2 text-center">
                    El monto no puede ser menor al 20% del total.
                </div>
            </div>
        </div>

        <!-- Botón de Envío -->
        <div class="w-full mt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    var defaultClientCounter = 1;
    var tallas = @json($tallas);
    var totalDisponible = {{ $totalProductoDisponible }};
    var cantidadRestante = totalDisponible;

    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }

    function searchClients() {
        var search = document.getElementById('searchClientInput').value;
        fetch(`/search-clients?search=${search}`)
            .then(response => response.json())
            .then(data => {
                var resultsDiv = document.getElementById('clientResults');
                resultsDiv.innerHTML = ''; // Limpiar resultados anteriores
                data.forEach(cliente => {
                    let clienteDiv = document.createElement('div');
                    clienteDiv.className = 'p-2 border-b border-gray-600 hover:bg-gray-700';
                    clienteDiv.textContent = `${cliente.nombre} - ${cliente.ci} `;

                    let addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.textContent = 'Agregar';
                    addButton.className = 'ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded';
                    addButton.addEventListener('click', () => addClientToTable(cliente, tallas)); // Pasar tallas aquí
                    clienteDiv.appendChild(addButton);

                    resultsDiv.appendChild(clienteDiv);
                });
            });
    }

    let addedClients = [];

    function updateHiddenInput() {
        const clientData = addedClients.map(client => ({
            id_cliente: client.id || 'default', // Asignar 'default' si no hay id de cliente
            id_talla: document.getElementById(`talla-${client.id || 'default'}`)
                .value, // Asegurarse de que se toma el valor actual de cada select de talla.
            cantidad: document.getElementById(`cantidad-${client.id || 'default'}`)
                .value // Añadimos la cantidad al objeto
        }));
        document.getElementById('client_data').value = JSON.stringify(clientData);
    }

    function addClientToTable(cliente, tallas) {
        const clientId = cliente.id ? cliente.id : `default-${defaultClientCounter++}`; // Usar ID iterativo si no hay id de cliente
        const existingClient = addedClients.find(c => c.id === clientId);

        if (existingClient) {
            alert('Este cliente ya está agregado.');
            return;
        }

        if (cantidadRestante <= 0) {
            alert('No puedes agregar más productos de los disponibles.');
            return;
        }

        const inputCantidad = document.createElement('input');
        inputCantidad.type = 'number';
        inputCantidad.className = 'input-cantidad bg-gray-700 text-white';
        inputCantidad.id = `cantidad-${clientId}`;
        inputCantidad.value = 1;
        inputCantidad.min = 1;
        inputCantidad.max = cantidadRestante; // Establecer el máximo según la cantidad restante
        inputCantidad.addEventListener('input', (event) => {
            const nuevaCantidad = parseInt(event.target.value) || 0;
            const cantidadPrevia = parseInt(event.target.defaultValue);
            if (nuevaCantidad > (totalDisponible - getTotalCantidad() + cantidadPrevia)) {
                event.target.value = cantidadPrevia; // Restablecer al valor anterior
                alert('No puedes agregar más productos de los disponibles.');
            } else {
                event.target.defaultValue = nuevaCantidad;
                updateHiddenInput();
                updateCantidadRestante();
            }
        }); // Actualizar cuando cambia la cantidad

        addedClients.push({ ...cliente, id: clientId });

        const tableBody = document.getElementById('clientsTable').getElementsByTagName('tbody')[0];
        const row = tableBody.insertRow();
        row.className = 'bg-gray-800';

        const cellNombre = row.insertCell(0);
        cellNombre.textContent = cliente.nombre || 'Cliente por Defecto';

        const cellCi = row.insertCell(1);
        cellCi.textContent = cliente.ci || 'N/A';

        const selectTalla = document.createElement('select');
        selectTalla.className = 'select-talla bg-gray-700 text-white';
        selectTalla.id = `talla-${clientId}`;
        selectTalla.addEventListener('change', () => updateHiddenInput()); // Actualizar cuando cambia la selección de talla
        tallas.forEach(talla => {
            const option = document.createElement('option');
            option.value = talla.id;
            option.textContent = talla.talla + ' (' + talla.genero + ')';
            selectTalla.appendChild(option);
        });
        const cellTalla = row.insertCell(2);
        cellTalla.appendChild(selectTalla);

        const cellCantidad = row.insertCell(3);
        cellCantidad.appendChild(inputCantidad);

        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Eliminar';
        deleteBtn.className = 'ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded';
        deleteBtn.addEventListener('click', () => removeClientFromTable(deleteBtn, clientId));
        const cellAction = row.insertCell(4);
        cellAction.appendChild(deleteBtn);

        updateHiddenInput(); // Asegurarse de que los datos iniciales se guarden correctamente.
        updateCantidadRestante(); // Actualizar la cantidad restante después de agregar
    }

    function removeClientFromTable(btn, clientId) {
        var row = btn.parentNode.parentNode;
        const cantidadARemover = parseInt(document.getElementById(`cantidad-${clientId}`).value) || 0;
        row.parentNode.removeChild(row); // Eliminar la fila de la tabla
        addedClients = addedClients.filter(c => (c.id || 'default') !== clientId); // Actualizar el arreglo
        cantidadRestante += cantidadARemover; // Añadir la cantidad removida a la cantidad restante
        updateHiddenInput(); // Vuelve a actualizar el input oculto después de eliminar un cliente
        updateCantidadRestante(); // Actualizar la cantidad restante después de eliminar
    }

    function getTotalCantidad() {
        return addedClients.reduce((total, client) => total + (parseInt(document.getElementById(
            `cantidad-${client.id || 'default'}`).value) || 0), 0);
    }

    function updateCantidadRestante() {
        cantidadRestante = totalDisponible - getTotalCantidad();
        document.getElementById('cantidad-disponible').textContent = cantidadRestante;
    }

    document.getElementById('addRecordButton').addEventListener('click', (event) => {
        event.preventDefault(); // Evitar que el botón envíe el formulario
        addClientToTable({
            id: null, // Sin ID específico
            nombre: 'Cliente por Defecto',
            ci: 'N/A'
        }, tallas);
    });

    document.getElementById('searchClientInput').addEventListener('keyup', debounce(searchClients, 500));
</script>
<pre>{{ print_r(session()->all()) }}</pre>
