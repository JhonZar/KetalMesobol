@extends('layouts.app')

@section('template_title')
    {{ $destinatario->name ?? __('Show') . " " . __('Destinatario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Destinatario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('destinatarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Pedido:</strong>
                            {{ $destinatario->id_pedido }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Cliente:</strong>
                            {{ $destinatario->id_cliente }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Producto:</strong>
                            {{ $destinatario->id_producto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $destinatario->cantidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Entrega:</strong>
                            {{ $destinatario->fecha_Entrega }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Talla:</strong>
                            {{ $destinatario->id_talla }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Obs:</strong>
                            {{ $destinatario->obs }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
