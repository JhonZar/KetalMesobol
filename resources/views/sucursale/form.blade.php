<div class="container mx-auto">
    <div class="flex flex-col items-center p-4">
        <div class="w-full">
            <!-- Nombre -->
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-white">{{ __('Nombre') }}</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                    value="{{ old('nombre', $sucursale?->nombre) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Direccion -->
            <div class="mb-6">
                <label for="direccion" class="block text-lg font-medium text-white">{{ __('Direccion') }}</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion"
                    value="{{ old('direccion', $sucursale?->direccion) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('direccion') border-red-500 @enderror">
                @error('direccion')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Telefono -->
            <div class="mb-6">
                <label for="telefono" class="block text-lg font-medium text-white">{{ __('Telefono') }}</label>
                <input type="text" name="telefono" id="telefono" placeholder="Telefono"
                    value="{{ old('telefono', $sucursale?->telefono) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('telefono') border-red-500 @enderror">
                @error('telefono')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Estado -->
            <div class="mb-6">
                <label for="estado" class="block text-lg font-medium text-white">{{ __('Estado') }}</label>
                <input type="text" name="estado" id="estado" placeholder="Estado"
                    value="{{ old('estado', $sucursale?->estado) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('estado') border-red-500 @enderror">
                @error('estado')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full mt-6">
            <!-- Submit Button -->
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
            <!-- Cancel Button -->
            <a href="{{ route('sucursales.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>
