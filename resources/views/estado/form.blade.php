<div class="container mx-auto p-4 bg-gray-700">
    <div class="mb-4">
        <div class="form-group">
            <label for="nombre" class="block text-sm font-medium text-black">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror" value="{{ old('nombre', $estado?->nombre) }}" id="nombre" placeholder="Nombre">
            @error('nombre')
                <div class="text-red-500 text-sm mt-1" role="alert"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>
    <div class="mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Submit') }}</button>
    </div>
</div>
