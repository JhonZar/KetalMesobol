@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Categoria
@endsection

@section('content')
    <section class="content container mx-auto bg-transparent">
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12">
                <div class=" shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4 text-white">
                        <h2 class="text-2xl font-bold">{{ __('Update') }} Categoria</h2>
                    </div>
                    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                        <div class="mb-4">
                            @include('categoria.form')
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
