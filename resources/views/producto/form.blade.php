@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="step-content text-white">
    <!-- Step 1: Select position -->
    <div class="step" id="step1">
        <p class="text-gray-500 dark:text-gray-400 mb-4">Seleccione el tipo de producto:</p>
        <select name="tipo" id="tipo"
            class="block py-2.5 px-4 w-full text-sm text-white bg-gray-800 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 rounded-lg appearance-none"
            required>
            <option value="" disabled selected hidden>Seleccione el tipo</option>
            <option value="cotizacion">Cotización</option>
            <option value="venta">Venta</option>
            <option value="pedido">Pedido</option>
        </select>
    </div>

    <!-- Step 2: Additional information -->
    <div class="step hidden" id="step2">
        <p class="text-gray-500 dark:text-gray-400 mb-4">Buscar modelo:</p>
        <input type="text" id="searchModelo"
            class="px-4 py-2.5 w-full text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            placeholder="Buscar modelos...">
        <input type="hidden" id="modeloIdInput" name="id_modelo">

        <div id="modelContainer" class="mt-4 grid grid-cols-1 gap-4">
            @foreach ($modelos as $modelo)
                <div class="model-item cursor-pointer flex items-center" data-model-id="{{ $modelo->id }}">
                    @if ($modelo->imagenes->isNotEmpty())
                        <img src="{{ asset($modelo->imagenes->first()->url) }}" alt="{{ $modelo->nombre }}"
                            class="rounded-md h-24 w-24 object-cover mr-4">
                    @else
                        <div class="rounded-md bg-gray-200 px-2 py-1 h-24 w-24 mr-4">No hay imagen disponible</div>
                    @endif
                    <h1>{{ $modelo->nombre }}</h1>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Step 3: Confirmation -->
    <div class="step hidden" id="step3">
        <p class="text-gray-500 dark:text-gray-400 mb-4">Selecciona la talla:</p>
        <select name="id_talla" id="id_talla"
            class="block py-2.5 px-4 w-full text-sm text-white bg-gray-800 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 rounded-lg appearance-none"
            required>
            <option value="" disabled selected hidden>Select Talla</option>
            @foreach ($tallas as $talla)
                <option value="{{ $talla->id }}">{{ $talla->talla }}</option>
            @endforeach
        </select>
    </div>

    <!-- Step 4: Select Color -->
    <div class="step hidden" id="step4">
        <p class="text-gray-500 dark:text-gray-400 mb-4">Buscar color:</p>
        <input type="text" id="searchColor"
            class="px-4 py-2.5 w-full text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            placeholder="Buscar colores...">
        <input type="hidden" id="colorIdInput" name="id_colores">

        <div id="colorContainer" class="mt-4 grid grid-cols-1 gap-4">
            @foreach ($colores as $color)
                <div class="color-item cursor-pointer flex items-center" data-color-id="{{ $color->id }}">
                    @if ($color->imagenColores->isNotEmpty())
                        <img src="{{ asset($color->imagenColores->first()->url) }}" alt="{{ $color->nombre }}"
                            class="rounded-md h-24 w-24 object-cover mr-4">
                    @else
                        <div class="rounded-md bg-gray-200 px-2 py-1 h-24 w-24 mr-4">No hay imagen disponible</div>
                    @endif
                    <h1>{{ $color->nombre }}</h1>
                </div>
            @endforeach
        </div>
    </div>

    <div class="step hidden" id="step5">
        <div id="selectedMaterialsAccordion" data-accordion="collapse"
            data-active-classes="text-gray-100 dark:text-gray-200"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            @foreach ($categorias as $categoria)
                <h2 id="accordion-flush-heading-{{ $categoria->id }}">
                    <button type="button"
                        class="accordion-button flex items-center justify-between w-full py-3 font-medium text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 transition-all"
                        data-accordion-target="#accordion-flush-body-{{ $categoria->id }}" aria-expanded="false"
                        aria-controls="accordion-flush-body-{{ $categoria->id }}">
                        <span>{{ $categoria->nombre }}</span>
                        <svg class="accordion-icon w-4 h-4 transition-transform transform rotate-0 group-hover:rotate-180"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-{{ $categoria->id }}" class="accordion-content hidden"
                    aria-labelledby="accordion-flush-heading-{{ $categoria->id }}">
                    <div class="py-5 px-4 border-b border-gray-200 dark:border-gray-700">
                        <!-- Lista de materiales relacionados con esta categoría -->
                        @foreach ($categoria->materiales as $material)
                            <div class="material-item flex items-center mb-4" data-material-id="{{ $material->id }}">
                                <div class="w-16 h-16 rounded-md overflow-hidden mr-4">
                                    @if ($material->imagenMateriales->isNotEmpty())
                                        <img src="{{ asset($material->imagenMateriales->first()->url) }}"
                                            alt="{{ $material->nombre }}"
                                            class="material-image object-cover w-full h-full"
                                            data-material-id="{{ $material->id }}">
                                    @else
                                        <!-- Si no hay imagen disponible -->
                                        <div class="bg-gray-200 w-full h-full"></div>
                                    @endif
                                </div>
                                <div class="flex-1" data-precio="{{ $material->precio }}">
                                    <p class="text-gray-300 dark:text-gray-400">{{ $material->nombre }} - {{ $material->precio }} Bs</p>
                                    <a class="select-button text-blue-400 hover:underline cursor-pointer"
                                        data-material-id="{{ $material->id }}">Seleccionar</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <input type="hidden" id="selectedMaterialsInput" name="selectedMaterials">
        </div>
    </div>

    <!-- Step 6: Final step -->
    <div class="step hidden" id="step6">
        <div class="relative z-0 w-full mb-5 group text-white">
            <input type="text" name="nombre" id="floating_nombre"
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_nombre"
                class="peer-focus:font-medium absolute text-sm text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" id="floating_precio_estimado_display"
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                disabled />
            <input type="hidden" name="precio_estimado" id="floating_precio_estimado" value="">

            <label for="floating_precio_estimado_display"
                class="peer-focus:font-medium absolute text-sm dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Precio Estimado
            </label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="precio_vendedor" id="floating_precio_vendedor"
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_precio_vendedor"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio
                Vendedor</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="cantidad" id="floating_cantidad"
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_cantidad"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cantidad</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="descripcion" id="floating_descripcion"
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_descripcion"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
        </div>
    </div>
</div>

<div class="flex justify-end p-4 md:p-5">
    <button id="prev-step-button"
        class="hidden text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-600 mr-4"
        type="button">Atras</button>
    <button id="next-step-button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">Siguiente Paso</button>
    <button type="submit"
        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-4">Submit</button>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll('.step');
    const prevButton = document.getElementById('prev-step-button');
    const nextButton = document.getElementById('next-step-button');
    let currentStep = 1;

    function showStep(step) {
        steps.forEach(s => s.classList.add('hidden'));
        document.querySelector(`#step${step}`).classList.remove('hidden');
        prevButton.style.display = step === 1 ? 'none' : 'block';
        nextButton.textContent = step === 6 ? 'Finalizar' : 'Siguiente Paso';
    }

    function updateButtons() {
        prevButton.classList.toggle('hidden', currentStep === 1);
        if (currentStep === 6) {
            nextButton.textContent = 'Finish';
        } else {
            nextButton.textContent = 'Next step';
        }
    }

    function goToNextStep() {
        if (currentStep < 6) {
            currentStep++;
            showStep(currentStep);
            updateButtons();
        }
    }

    function goToPrevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            updateButtons();
        }
    }

    nextButton.addEventListener('click', function() {
        if (currentStep === 6) {
            // Aquí podrías hacer alguna acción final si lo deseas
        } else {
            goToNextStep();
        }
    });
    prevButton.addEventListener('click', goToPrevStep);

    showStep(currentStep);
    updateButtons();
});

document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('modelContainer');

    // Función para filtrar modelos
    document.getElementById("searchModelo").addEventListener("input", function() {
        const filter = this.value.trim().toUpperCase();
        const models = container.querySelectorAll('.model-item');

        models.forEach(function(model) {
            const modelName = model.querySelector("h1").textContent.trim().toUpperCase();
            model.style.display = modelName.includes(filter) ? "" : "none";
        });
    });

    // Manejo de clics en modelos
    container.addEventListener('click', function(event) {
        const modelItem = event.target.closest('.model-item');
        if (modelItem) {
            const modeloId = modelItem.getAttribute('data-model-id');
            const allModels = container.querySelectorAll('.model-item');

            // Oculta todos los modelos excepto el seleccionado
            allModels.forEach(item => {
                item.style.display = item === modelItem ? "" : "none";
            });

            // Muestra todas las imágenes asociadas al modelo seleccionado
            const images = document.querySelectorAll('.model-images[data-model-id="' + modeloId + '"]');
            images.forEach(image => {
                image.style.display = "block";
            });

            // Guarda el ID del modelo
            console.log('ID del modelo seleccionado:', modeloId);
            document.getElementById('modeloIdInput').value = modeloId;
        }
    });
});

// COLORES
document.addEventListener("DOMContentLoaded", function() {
    const colorContainer = document.getElementById('colorContainer');

    // Función para filtrar colores
    document.getElementById("searchColor").addEventListener("input", function() {
        const filter = this.value.trim().toUpperCase();
        const colors = colorContainer.querySelectorAll('.color-item');

        colors.forEach(function(color) {
            const colorName = color.querySelector("h1").textContent.trim().toUpperCase();
            color.style.display = colorName.includes(filter) ? "" : "none";
        });
    });

    // Manejo de clics en colores
    colorContainer.addEventListener('click', function(event) {
        const colorItem = event.target.closest('.color-item');
        if (colorItem) {
            const colorId = colorItem.getAttribute('data-color-id');
            const allColors = colorContainer.querySelectorAll('.color-item');

            // Oculta todos los colores excepto el seleccionado
            allColors.forEach(item => {
                item.style.display = item === colorItem ? "" : "none";
            });

            // Guarda el ID del color
            console.log('ID del color seleccionado:', colorId);
            document.getElementById('colorIdInput').value = colorId;
        }
    });
});

// MATERIALES
document.addEventListener("DOMContentLoaded", function() {
    const selectedMaterials = {}; // Objeto para almacenar los materiales seleccionados por categoría
    let totalPrecio = 0;

    // Función para actualizar el precio estimado
    function updatePrecioEstimado() {
        document.getElementById('floating_precio_estimado_display').value = totalPrecio.toFixed(2);
        document.getElementById('floating_precio_estimado').value = totalPrecio.toFixed(2);
    }

    // Agrega el evento de clic a los botones para seleccionar un material
    document.querySelectorAll('.select-button').forEach(button => {
        button.addEventListener('click', function() {
            const materialId = this.getAttribute('data-material-id');
            const categoryContent = this.closest('.accordion-content');
            const categoryId = categoryContent.getAttribute('id').replace('accordion-flush-body-', '');
            const selectedItem = categoryContent.querySelector(`.material-item[data-material-id="${materialId}"]`);
            const materialPrecio = parseFloat(selectedItem.querySelector('[data-precio]').getAttribute('data-precio'));

            if (selectedMaterials[categoryId] === materialId) {
                // Deseleccionar el material
                delete selectedMaterials[categoryId];
                selectedItem.classList.remove('border', 'border-green-500', 'bg-green-100');
                categoryContent.querySelectorAll('.material-item').forEach(item => item.classList.remove('hidden'));
                totalPrecio -= materialPrecio;
            } else {
                // Seleccionar el material
                if (selectedMaterials[categoryId]) {
                    const previouslySelectedItem = categoryContent.querySelector(`.material-item[data-material-id="${selectedMaterials[categoryId]}"]`);
                    previouslySelectedItem.classList.remove('border', 'border-green-500', 'bg-green-100');
                    totalPrecio -= parseFloat(previouslySelectedItem.querySelector('[data-precio]').getAttribute('data-precio'));
                }
                selectedMaterials[categoryId] = materialId;
                categoryContent.querySelectorAll('.material-item').forEach(item => item.classList.add('hidden'));
                selectedItem.classList.remove('hidden');
                selectedItem.classList.add('border', 'border-green-500', 'bg-green-100');
                totalPrecio += materialPrecio;
            }

            // Actualiza el valor del input oculto con el JSON de los materiales seleccionados
            document.getElementById('selectedMaterialsInput').value = JSON.stringify(selectedMaterials);
            updatePrecioEstimado();
        });
    });
});

// Funciones adicionales para la página
document.addEventListener("DOMContentLoaded", function() {
    const precioEstimadoInput = document.getElementById('floating_precio_estimado');
    const precioVendedorInput = document.getElementById('floating_precio_vendedor');

    // Función para actualizar el precio del vendedor basado en el precio estimado
    function updatePrecioVendedor() {
        const precioEstimado = parseFloat(precioEstimadoInput.value);
        let precioVendedor = parseFloat(precioVendedorInput.value);

        const minPrecioVendedor = precioEstimado * 0.90; // No menos del 10% por debajo del precio estimado

        if (precioVendedor < minPrecioVendedor) {
            precioVendedorInput.value = minPrecioVendedor.toFixed(2);
        }
    }

    // Evento para manejar cambios en el precio estimado
    precioEstimadoInput.addEventListener('input', function() {
        updatePrecioVendedor();
    });

    // También verificar al cambiar el precio del vendedor
    precioVendedorInput.addEventListener('input', function() {
        updatePrecioVendedor();
    });

    // Inicialización al cargar la página
    updatePrecioVendedor();
});

// Nombre automático
document.addEventListener("DOMContentLoaded", function() {
    let modeloNombre = '';
    let colorNombre = '';
    let tallaSeleccionada = '';

    // Función para actualizar el valor del input del nombre
    function updateNombreInput() {
        const randomDigits = Math.floor(Math.random() * 100); // Dos dígitos aleatorios
        const colorPrefix = colorNombre.substring(0, 3); // Primeros tres caracteres del color
        const nombreValor = `${modeloNombre}-${colorPrefix}-${tallaSeleccionada}_${randomDigits}`;
        document.getElementById('floating_nombre').value = nombreValor;
    }

    // Event listeners para modelos
    const modelContainer = document.getElementById('modelContainer');
    modelContainer.addEventListener('click', function(event) {
        const modelItem = event.target.closest('.model-item');
        if (modelItem) {
            modeloNombre = modelItem.querySelector('h1').textContent;
            updateNombreInput();
        }
    });

    // Event listeners para colores
    const colorContainer = document.getElementById('colorContainer');
    colorContainer.addEventListener('click', function(event) {
        const colorItem = event.target.closest('.color-item');
        if (colorItem) {
            colorNombre = colorItem.querySelector('h1').textContent;
            updateNombreInput();
        }
    });

    // Event listener para tallas
    const tallaSelect = document.getElementById('id_talla');
    tallaSelect.addEventListener('change', function() {
        tallaSeleccionada = this.options[this.selectedIndex].textContent;
        updateNombreInput();
    });
});

</script>
