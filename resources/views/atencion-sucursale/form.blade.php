<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_usuario" class="form-label">{{ __('Id Usuario') }}</label>
            <input type="text" name="id_usuario" class="form-control @error('id_usuario') is-invalid @enderror" value="{{ old('id_usuario', $atencionSucursale?->id_usuario) }}" id="id_usuario" placeholder="Id Usuario">
            {!! $errors->first('id_usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_sucursal" class="form-label">{{ __('Id Sucursal') }}</label>
            <input type="text" name="id_sucursal" class="form-control @error('id_sucursal') is-invalid @enderror" value="{{ old('id_sucursal', $atencionSucursale?->id_sucursal) }}" id="id_sucursal" placeholder="Id Sucursal">
            {!! $errors->first('id_sucursal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicio" class="form-label">{{ __('Fechainicio') }}</label>
            <input type="text" name="fechaInicio" class="form-control @error('fechaInicio') is-invalid @enderror" value="{{ old('fechaInicio', $atencionSucursale?->fechaInicio) }}" id="fecha_inicio" placeholder="Fechainicio">
            {!! $errors->first('fechaInicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_fin" class="form-label">{{ __('Fechafin') }}</label>
            <input type="text" name="fechaFin" class="form-control @error('fechaFin') is-invalid @enderror" value="{{ old('fechaFin', $atencionSucursale?->fechaFin) }}" id="fecha_fin" placeholder="Fechafin">
            {!! $errors->first('fechaFin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>