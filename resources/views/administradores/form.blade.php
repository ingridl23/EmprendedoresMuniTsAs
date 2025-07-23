<div class="field-group">
    <textarea name="nombre" id="nombre" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->nombre : old('nombre') }}</textarea>
    <label for="nombre">Nombre <span class="asterisco">*</span></label>
    @error('nombre')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue nombre del emprendimiento</p>
</div>
<div class="field-group">
    <textarea name="descripcion" id="descripcion" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion') }}</textarea>
    <label for="descripcion">Descripción <span class="asterisco">*</span></label>
    @error('descripcion')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue una descripción del emprendimiento</p>
</div>
<label for="descripcion">Seleccionar Categoria<span class="asterisco">*</span></label>
<div class="field-group">
    <select name="categoria" id="categoria" required>
        <option value="" disabled
            {{ !old('categoria') && (!isset($emprendimiento) || !$emprendimiento->categoria) ? 'selected' : '' }}>
            Seleccione una categoría
        </option>
        @foreach($categorias as $categoria => $datos)
        <option value="Artesanía"
            {{ (isset($emprendimiento) && $emprendimiento->categoria == $categoria) || old('categoria') == $categoria ? 'selected' : '' }}>
            {{$categoria}}</option>
        @endforeach
    </select>


    @error('categoria')
        <div class="text-danger small">{{ $message }}</div>
    @enderror

    <p class="form-subtitulos">Otorgue una categoría del emprendimiento</p>
</div>

<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen))
        <img src="{{ asset('storage/' . $emprendimiento->imagen) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Cargar imagen principal del emprendimiento</p>
</div>



<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen1))
        <img src="{{ asset('storage/' . $emprendimiento->imagen1) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Cargar imagen 1 del emprendimiento</p>
</div>


<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen2))
        <img src="{{ asset('storage/' . $emprendimiento->imagen2) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Cargar imagen 2 del emprendimiento</p>
</div>


<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen3))
        <img src="{{ asset('storage/' . $emprendimiento->imagen3) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Cargar imagen 3 del emprendimiento</p>
</div>



<div class="field-group" id="imagenFormulario">
    @if (isset($emprendimiento->imagen4))
        <img src="{{ asset('storage/' . $emprendimiento->imagen4) }}" alt="Imagen de {{ $emprendimiento->nombre }}"
            class="imagenEmprendimientoFormulario">
    @endif
    <input type="file" name="imagen" id="imagen">
    <label for="imagen">Imagen <span class="asterisco">*</span></label>
    @error('imagen')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Cargar imagen 4 del emprendimiento</p>
</div>





<input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off">

<div class="field-group">
    <input type="text" name="facebook" id="facebook" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->facebook : old('facebook') }}>
    <label for="facebook">Facebook</label>
    @error('facebook')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Si tiene un facebook, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
    <input type="text" name="instagram" id="instagram" placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->instagram : old('instagram') }}>
    <label for="instagram">Instagram</label>
    @error('instagram')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Si tiene un Instagram, ingrese su nombre de usuario</p>
</div>
<div class="field-group">
    <input type="number" name="whatsapp" id="whatsapp" required placeholder=""
        value={{ isset($emprendimiento) ? $emprendimiento->redes->whatsapp : old('whatsapp') }}>
    <label for="whatsapp">Número de WhatsApp <span class="asterisco">*</span></label>
    @error('whatsapp')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue un número de WhatsApp del emprendimiento</p>
</div>
<div>
    <div class="field-group">
        <label for="inputCity" class="direccionEmprendimiento">Ciudad <span class="asterisco">*</span></label>
        <select id="ciudad" name="ciudad" required placeholder="">
            <option class="oculto" {{ !isset($emprendimiento) ? 'selected' : '' }}></option>
            <option
                {{ isset($emprendimiento) && $emprendimiento->direccion->ciudad == 'Tres Arroyos' ? 'selected' : '' }}>
                Tres Arroyos</option>
            <option
                {{ isset($emprendimiento) && $emprendimiento->direccion->ciudad == 'Adolfo Gonzales Chaves' ? 'selected' : '' }}>
                Adolfo Gonzales Chaves</option>
            <option
                {{ isset($emprendimiento) && $emprendimiento->direccion->ciudad == 'Benito Juarez' ? 'selected' : '' }}>
                Benito Juarez</option>
        </select>
        @error('ciudad')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="field-group oculto localidadesDeLaCiudad">
        <label for="localidad" class="direccionEmprendimiento localidad">Localidad <span
                class="asterisco">*</span></label>
        <select id="localidadesDeLaCiudad" name="localidad" required placeholder="">
            <option value="{{ isset($emprendimiento) ? $emprendimiento->direccion->localidad : old('localidad') }}"
                class="oculto opcionValorCargado"></option>
        </select>
        @error('localidad')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="alturaYCalle field-group">
    <div class="field-group">
        @if (isset($emprendimiento->direccion->calle))
            <textarea name="calle" id="calle" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->direccion->calle : old('calle') }}</textarea>
        @else
            <input type="text" name="calle" id="calle" required placeholder="" value: old('calle')>
        @endif
        <label for="calle">Calle <span class="asterisco">*</span></label>
        @error('calle')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
        <p class="form-subtitulos">Otorgue el nombre de la calle</p>
    </div>
    <div class="field-group">
        <input type="number" name="altura" id="altura" required placeholder="" min=1
            value={{ isset($emprendimiento) ? $emprendimiento->direccion->altura : old('altura') }}>
        <label for="altura">Altura <span class="asterisco">*</span></label>
        @error('altura')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
        <p class="form-subtitulos">Otorgue la altura de la calle</p>
    </div>
</div>
