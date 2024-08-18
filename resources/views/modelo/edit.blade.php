@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Modelo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12">
                <div class=" shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4  text-white">
                        <h2 class="text-2xl font-bold">{{ __('Update') }} Modelo</h2>
                    </div>
                    <form method="POST" action="{{ route('modelos.update', $modelo->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                    
                        @include('modelo.form')
                  
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
