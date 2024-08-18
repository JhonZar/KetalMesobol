@extends('layouts.app')

@section('template_title')
    {{ $imagenMateriale->name ?? __('Show') . " " . __('Imagen Materiale') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Imagen Materiale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('imagen-materiales.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Material Id:</strong>
                            {{ $imagenMateriale->material_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Url:</strong>
                            {{ $imagenMateriale->url }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
