@extends('layouts.app')

@section('template_title')
    {{ $atencionSucursale->name ?? __('Show') . " " . __('Atencion Sucursale') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Atencion Sucursale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('atencion-sucursales.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Usuario:</strong>
                            {{ $atencionSucursale->id_usuario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Sucursal:</strong>
                            {{ $atencionSucursale->id_sucursal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fechainicio:</strong>
                            {{ $atencionSucursale->fechaInicio }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fechafin:</strong>
                            {{ $atencionSucursale->fechaFin }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
