<div class="field-group">
    <textarea name="nombre" id="nombre" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->nombre : old('nombre') }}</textarea>
    <label for="nombre">Nombre:</label>
    <p class="form-subtitulos">Otorgue nombre del emprendimiento</p>
</div>
<div class="field-group">
    <textarea name="descripcion" id="descripcion" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion') }}</textarea>
    <label for="descripcion">descripcion:</label>
    <p class="form-subtitulos">Otorgue una descripción del emprendimiento</p>
</div>
<div class="field-group">
    <input type="text" name="categoria" id="categoria" required placeholder=""
    value={{ isset($emprendimiento) ? $emprendimiento->categoria : old('categoria') }} >
    <label for="categoria">categoria:</label>
    <p class="form-subtitulos">Otorgue una categoria del emprendimiento</p>
</div>

<div class="field-group" id="imagenFormulario">
     @if (isset($emprendimiento->imagen))
        <img src="{{ asset('storage/' . $emprendimiento->imagen) }}" alt="Imagen de {{ $emprendimiento->nombre }}">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen</label>
    <p class="form-subtitulos">Otorgue una categoria del emprendimiento</p>
</div>

<input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off" >

<div class="field-group">
     <input type="text" name="facebook" id="facebook" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->facebook : old('facebook') }}>
    <label for="facebook">facebook:</label>
    <p class="form-subtitulos">Si tiene un facebook, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
     <input type="text" name="instagram" id="instagram" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->instagram : old('instagram') }}>
    <label for="instagram">instagram:</label>
    <p class="form-subtitulos">Si tiene un Instagram, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
      <input type="number" name="whatsapp" id="whatsapp" required placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->whatsapp : old('whatsapp') }}>
    <label for="whatsapp">Numero de WhatsApp:</label>
    <p class="form-subtitulos">Otorgue un número de WhatsApp del emprendimiento</p>
</div>


<div class=" d-grid  ">
    <button class="btn btn-primary btn-xl submit" id="submitButton" type="submit">
        <span class="btntext" value="Guardar datos"> Guardar emprendimiento </span>
        <span class="checkmark">&#10004;</span>
        <span class="checkmark2">&#10008; </span>
    </button>

    <p class="error-msg">Complete los campos obligatorios</p>
</div>

