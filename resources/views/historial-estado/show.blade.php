@extends('layouts.app')

@section('template_title')
    {{ $historialEstado->name ?? __('Show') . " " . __('Historial Estado') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Historial Estado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('historial-estados.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Estado:</strong>
                            {{ $historialEstado->id_estado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Destinatario:</strong>
                            {{ $historialEstado->id_destinatario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Usuarios:</strong>
                            {{ $historialEstado->id_usuarios }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha:</strong>
                            {{ $historialEstado->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
