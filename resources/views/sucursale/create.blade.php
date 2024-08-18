@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Sucursale
@endsection

@section('content')
    <section class="content container mx-auto ">
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12">
                <div class=" shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4 text-white">
                        <h2 class="text-2xl font-bold">{{ __('Create') }} Sucursale</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sucursales.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                @include('sucursale.form')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
