<div class="container mx-auto">
    <div class="flex flex-col items-center p-4">
        <div class="w-full">
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-white">{{ __('Nombre') }}</label>
                <input type="text" name="nombre"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('nombre') border-red-500 @enderror "
                    value="{{ old('nombre', $modelo?->nombre) }}" id="nombre" placeholder="Nombre">
                {!! $errors->first('nombre', '<p class="text-red-500 text-lg mt-1">:message</p>') !!}
            </div>
            <div class="mb-6">
                <label for="precio" class="block text-lg font-medium text-white">{{ __('Precio') }}</label>
                <input type="text" name="precio"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('precio') border-red-500 @enderror "
                    value="{{ old('precio', $modelo?->precio) }}" id="precio" placeholder="Precio">
                {!! $errors->first('precio', '<p class="text-red-500 text-lg mt-1">:message</p>') !!}
            </div>
            <div class="mb-6 col-span-2">
                <label for="imagenes" class="block text-lg font-medium text-white">{{ __('Imágenes') }}</label>
                <input type="file" name="imagenes[]" id="imagenes"
                    class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('imagenes') border-red-500 @enderror"
                    multiple>
                {!! $errors->first('imagenes', '<p class="text-red-500 text-lg mt-1">:message</p>') !!}
                <p class="text-gray-500 text-sm mt-1">Selecciona una o varias imágenes relacionadas con el material.</p>
            </div>
            <div id="preview-images" class="grid grid-cols-3 gap-4 rounded-md overflow-hidden">
                @isset($imagenes)
                    @foreach ($imagenes as $imagen)
                        <img src="{{ asset($imagen->url) }}" class="w-full h-auto object-cover"
                            style="max-width: 150px; max-height: 150px;">
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="w-full mt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
            <a href="{{ route('modelos.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>

<script>
    document.getElementById("imagenes").addEventListener("change", function(event) {
        var previewImagesContainer = document.getElementById("preview-images");
        previewImagesContainer.innerHTML = "";
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("w-full", "h-auto", "object-cover");
                img.style.maxWidth = "150px"; // Cambia este valor según tus necesidades
                img.style.maxHeight = "150px"; // Cambia este valor según tus necesidades
                previewImagesContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
