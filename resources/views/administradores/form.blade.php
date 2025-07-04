<div class="field-group">
    <textarea name="nombre" id="nombre" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->nombre : old('nombre') }}</textarea>
    <label for="nombre">Nombre:</label>
    <p class="form-subtitulos">Otorgue nombre del emprendimiento</p>
</div>
<div class="field-group">
    <textarea name="descripcion" id="descripcion" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion') }}</textarea>
    <label for="descripcion">Descripción:</label>
    <p class="form-subtitulos">Otorgue una descripción del emprendimiento</p>
</div>
<div class="field-group">
    <input type="text" name="categoria" id="categoria" required placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->categoria : old('categoria') }}>
    <label for="categoria">Categoria:</label>
    <p class="form-subtitulos">Otorgue una categoria del emprendimiento</p>
</div>

<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen))
        <img src="{{ asset('storage/' . $emprendimiento->imagen) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen</label>
    <p class="form-subtitulos">Cargue una imagen del emprendimiento</p>
</div>

<input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off">

<div class="field-group">
    <input type="text" name="facebook" id="facebook" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->facebook : old('facebook') }}>
    <label for="facebook">Facebook:</label>
    <p class="form-subtitulos">Si tiene un facebook, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
    <input type="text" name="instagram" id="instagram" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->instagram : old('instagram') }}>
    <label for="instagram">Instagram:</label>
    <p class="form-subtitulos">Si tiene un Instagram, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
    <input type="number" name="whatsapp" id="whatsapp" required placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->whatsapp : old('whatsapp') }}>
    <label for="whatsapp">Número de WhatsApp:</label>
    <p class="form-subtitulos">Otorgue un número de WhatsApp del emprendimiento</p>
</div>
<div>
    <div class="field-group">
        <label for="inputCity" class="direccionEmprendimiento">Ciudad</label>
        <select id="ciudad" name="ciudad" required placeholder="">
            <option class="oculto" {{!isset($emprendimiento) ?  'selected' : ""}}></option>
            <option {{(isset($emprendimiento) && $emprendimiento->direccion->ciudad=="Tres Arroyos") ? 'selected' :""}}>Tres Arroyos</option>
            <option {{(isset($emprendimiento) && $emprendimiento->direccion->ciudad=="Adolfo Gonzales Chaves") ? 'selected': ""}}>Adolfo Gonzales Chaves</option>
            <option {{(isset($emprendimiento) && $emprendimiento->direccion->ciudad=="Benito Juarez") ? 'selected':""}}>Benito Juarez</option>
        </select>
    </div>
    <div class="field-group oculto localidadesDeLaCiudad">
         <label for="localidad" class="direccionEmprendimiento localidad">Localidad</label>
        <select id="localidadesDeLaCiudad" name="localidad" required placeholder="">
            <option value="{{isset($emprendimiento) ? $emprendimiento->direccion->localidad : old('localidad')}}" class="oculto opcionValorCargado"></option>
        </select>
    </div>
</div>
<div class="alturaYCalle field-group">
    <div class="field-group">
        <textarea name="calle" id="calle" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->direccion->calle : old('calle') }}</textarea>
        <label for="calle">Calle</label>
        <p class="form-subtitulos">Otorgue el nombre de la calle</p>
    </div>
    <div class="field-group">
        <input type="number" name="altura" id="altura" required placeholder="" min=1 
            value={{ isset($emprendimiento) ? $emprendimiento->direccion->altura : old('altura') }}>
        <label for="whatsapp">Altura:</label>
        <p class="form-subtitulos">Otorgue la altura de la calle</p>
    </div>
</div>