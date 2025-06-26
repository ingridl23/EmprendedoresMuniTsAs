<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="instagram" class="form-label">{{ __('Instagram') }}</label>
            <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $rede?->instagram) }}" id="instagram" placeholder="Instagram">
            {!! $errors->first('instagram', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="facebook" class="form-label">{{ __('Facebook') }}</label>
            <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $rede?->facebook) }}" id="facebook" placeholder="Facebook">
            {!! $errors->first('facebook', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="whatsapp" class="form-label">{{ __('Whatsapp') }}</label>
            <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $rede?->whatsapp) }}" id="whatsapp" placeholder="Whatsapp">
            {!! $errors->first('whatsapp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>