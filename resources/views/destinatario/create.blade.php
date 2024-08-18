@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Destinatario
@endsection

@section('content')
    <section class="content container mx-auto bg-transparent">
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12">
                <div class=" shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-white">{{ __('Create') }} Destinatario</h2>
                    </div>

                    <form method="POST" action="{{ route('destinatarios.store') }}" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        @include('destinatario.form')

                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
