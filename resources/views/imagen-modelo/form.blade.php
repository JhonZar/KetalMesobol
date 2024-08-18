<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="modelo_id" class="form-label">{{ __('Modelo Id') }}</label>
            <input type="text" name="modelo_id" class="form-control @error('modelo_id') is-invalid @enderror" value="{{ old('modelo_id', $imagenModelo?->modelo_id) }}" id="modelo_id" placeholder="Modelo Id">
            {!! $errors->first('modelo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="url" class="form-label">{{ __('Url') }}</label>
            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $imagenModelo?->url) }}" id="url" placeholder="Url">
            {!! $errors->first('url', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>