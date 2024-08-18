@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? __('Show') . " " . __('Producto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('productos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Id Talla:</strong>
                            {{ $producto->id_talla }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Colores:</strong>
                            {{ $producto->id_colores }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Id Modelo:</strong>
                            {{ $producto->id_modelo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio Estimado:</strong>
                            {{ $producto->precio_estimado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio Vendedor:</strong>
                            {{ $producto->precio_vendedor }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $producto->cantidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo:</strong>
                            {{ $producto->tipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
