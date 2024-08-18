<div class="container mx-auto">
    <div class="flex flex-col items-center p-4">
        <div class="w-full">
            <div class="mb-6">
                <label for="talla" class="block text-lg font-medium text-white">{{ __('Talla') }}</label>
                <input type="text" name="talla" id="talla" placeholder="Talla"
                    value="{{ old('talla', $talla?->talla) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('talla') border-red-500 @enderror ">
                @error('talla')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="genero" class="block text-lg font-medium text-white">{{ __('Genero') }}</label>
                <select name="genero" id="genero"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('genero') border-red-500 @enderror">
                    <option value="" disabled selected>Seleccione Género</option>
                    <option value="1" {{ old('genero', $talla->genero) == '1' ? 'selected' : '' }}>Masculino
                    </option>
                    <option value="0" {{ old('genero', $talla->genero) == '0' ? 'selected' : '' }}>Femenino
                    </option>
                </select>
                @error('genero')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>
        <div class="w-full mt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
            <a href="{{ route('tallas.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>
