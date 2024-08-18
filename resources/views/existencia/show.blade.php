@extends('layouts.app')

@section('template_title')
    {{ $existencia->name ?? __('Show') . " " . __('Existencia') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Existencia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('existencias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Producto:</strong>
                            {{ $existencia->id_producto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Usuario:</strong>
                            {{ $existencia->id_usuario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Sucursal:</strong>
                            {{ $existencia->id_sucursal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha:</strong>
                            {{ $existencia->fecha }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $existencia->cantidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo Transaccion:</strong>
                            {{ $existencia->tipo_Transaccion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
