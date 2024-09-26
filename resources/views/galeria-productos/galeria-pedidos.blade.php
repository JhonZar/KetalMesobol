@extends('layouts.app')

@section('template_title')
    Tienda
@endsection

@section('content')
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($productos as $producto)
            <div class="group relative overflow-hidden">
                @if($producto->modelo->imagenModelos->first())
                    <img class="h-auto w-full max-h-[300px] object-cover object-center rounded-lg transition-transform duration-300 ease-in-out transform group-hover:scale-[1.05]"
                         src="{{ $producto->modelo->imagenModelos->first()->url }}" alt="{{ $producto->nombre }}">
                @else
                    <img class="h-auto w-full max-h-[300px] object-cover object-center rounded-lg transition-transform duration-300 ease-in-out transform group-hover:scale-[1.05]"
                         src="https://via.placeholder.com/300" alt="{{ $producto->nombre }}">
                @endif
                <div class="absolute bottom-0 left-0 w-full text-white text-center py-2 bg-black bg-opacity-50">
                    <span class="font-semibold">{{ $producto->nombre }}</span>
                    <span class="block">Disponible: {{ $producto->cantidad }}</span>
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 flex justify-center items-center space-x-2 opacity-0 group-hover:bg-opacity-40 group-hover:opacity-100 transition duration-300 ease-in-out">
                    <form action="{{ route('cart.add') }}" method="POST" class="text-white flex items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $producto->id }}">
                        <input type="hidden" name="price" value="{{ $producto->precio_vendedor }}">
                        <input type="hidden" name="name" value="{{ $producto->nombre }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="px-4 py-2 rounded hover:bg-gray-900 focus:outline-none flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"/>
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    </form>
                    <a href="{{ route('products.show', ['id' => $producto->id]) }}" class="text-white px-4 py-2 rounded hover:dark:bg-gray-900 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path fill-rule="evenodd"
                                  d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                  clip-rule="evenodd" />
                        </svg>
                        View
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
