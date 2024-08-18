<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_estado" class="form-label">{{ __('Id Estado') }}</label>
            <input type="text" name="id_estado" class="form-control @error('id_estado') is-invalid @enderror" value="{{ old('id_estado', $historialEstado?->id_estado) }}" id="id_estado" placeholder="Id Estado">
            {!! $errors->first('id_estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_destinatario" class="form-label">{{ __('Id Destinatario') }}</label>
            <input type="text" name="id_destinatario" class="form-control @error('id_destinatario') is-invalid @enderror" value="{{ old('id_destinatario', $historialEstado?->id_destinatario) }}" id="id_destinatario" placeholder="Id Destinatario">
            {!! $errors->first('id_destinatario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_usuarios" class="form-label">{{ __('Id Usuarios') }}</label>
            <input type="text" name="id_usuarios" class="form-control @error('id_usuarios') is-invalid @enderror" value="{{ old('id_usuarios', $historialEstado?->id_usuarios) }}" id="id_usuarios" placeholder="Id Usuarios">
            {!! $errors->first('id_usuarios', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $historialEstado?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>