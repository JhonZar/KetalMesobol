<div class="container mx-auto">
    <div class="flex flex-col items-center p-4">
        <div class="w-full">
            <!-- Id Rol -->
            <!-- Id Rol -->
            <div class="mb-6">
                <label for="id_rol" class="block text-lg font-medium text-white">{{ __('Id Rol') }}</label>
                <select name="id_rol" id="id_rol"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('id_rol') border-red-500 @enderror">
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ old('id_rol', $usuario->id_rol) == $role->id ? 'selected' : '' }}>
                            {{ $role->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_rol')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre -->
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-white">{{ __('Nombre') }}</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                    value="{{ old('nombre', $usuario?->nombre) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Contra -->
            <div class="mb-6">
                <label for="contra" class="block text-lg font-medium text-white">{{ __('Contra') }}</label>
                <input type="text" name="contra" id="contra" placeholder="Contra"
                    value="{{ old('contra', $usuario?->contra) }}"
                    class="mt-2 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md transition duration-150 ease-in-out @error('contra') border-red-500 @enderror">
                @error('contra')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Estado -->
            <div class="mb-6">
                <label for="estado" class="block text-lg font-medium text-white">{{ __('Estado') }}</label>
                <div class="mt-2">
                    <!-- Active Radio Button -->
                    <label class="inline-flex items-center">
                        <input type="radio" name="estado" value="1"
                            class="text-indigo-600 focus:ring-indigo-500 border-gray-300"
                            {{ old('estado', $usuario?->estado) == '1' ? 'checked' : '' }}>
                        <span class="ml-2 text-white">{{ __('Activo') }}</span>
                    </label>
                    <!-- Inactive Radio Button -->
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="estado" value="0"
                            class="text-indigo-600 focus:ring-indigo-500 border-gray-300"
                            {{ old('estado', $usuario?->estado) == '0' ? 'checked' : '' }}>
                        <span class="ml-2 text-white">{{ __('Desactivo') }}</span>
                    </label>
                </div>
                @error('estado')
                    <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>
        <div class="w-full mt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                {{ __('Submit') }}
            </button>
            <a href="{{ route('usuarios.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150 mt-4 md:mt-0 ml-0 md:ml-4">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</div>
