<div class="field-group">
    <textarea name="titulo" id="titulo" required placeholder="">{{ isset($noticia) ? $noticia->titulo : old('titulo') }}</textarea>
    <label for="titulo">Titulo <span class="asterisco">*</span></label>
    @error('titulo')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue el titulo de la noticia</p>
</div>

<div class="field-group">
    <textarea name="descripcion" id="descripcion" required placeholder="">{{ isset($noticia) ? $noticia->descripcion : old('descripcion') }}</textarea>
    <label for="descripcion">Descripción <span class="asterisco">*</span></label>
    @error('descripcion')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue la descripción de la noticia</p>
</div>

<label for="descripcion">Seleccionar Categoria<span class="asterisco">*</span></label>
<div class="field-group ">
    <select name="categoria" id="categoria" required>


        @foreach ($categorias as $categoria)
            <option class="opcionesCategoria" value="{{ $categoria }}"
                {{ (isset($noticia) && $noticia->categoria == $categoria) || old('categoria') == $categoria ? 'selected' : '' }}>
                {{ $categoria }}</option>
        @endforeach
    </select>
    @error('categoria')
        <div class="text-danger small">{{ $message }}</div>
    @enderror

    <p class="form-subtitulos">Seleccione la categoria a la que pertenece la noticia</p>
</div>



<div class="field-group" id="imagenFormulario">
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <div id="previousImagen" data-mostrar="{{isset($noticia->imagen) ? 'true' : 'false'}}" data-array="{{isset($noticia->imagen) ? json_encode($noticia->imagen) : 'false' }}">
    </div>
    <p class="form-subtitulos">Cargue una imagen de la noticia</p>
</div>

<input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off">
