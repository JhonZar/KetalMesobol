@extends('layouts.app')

@section('template_title')
    {{ $pedido->name ?? __('Show') . " " . __('Pedido') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pedidos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Cliente:</strong>
                            {{ $pedido->id_cliente }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Usuario:</strong>
                            {{ $pedido->id_usuario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Sucursal:</strong>
                            {{ $pedido->id_sucursal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Preciototal:</strong>
                            {{ $pedido->precioTotal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Pagoacuenta:</strong>
                            {{ $pedido->pagoACuenta }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Saldo:</strong>
                            {{ $pedido->saldo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha:</strong>
                            {{ $pedido->fecha }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $pedido->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
