<div class="field-group">
    <textarea name="nombre" id="nombre" required placeholder="">{{ isset($emprendimiento) ? $emprendimiento->nombre : old('nombre') }}</textarea>
    <label for="nombre">Nombre <span class="asterisco">*</span></label>
    @error('nombre')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue nombre del emprendimiento</p>
</div>
<div class="field-group">
    <textarea name="descripcion" id="descripcion" required placeholder="" wordwrap="hard">{{ isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion') }}</textarea>
    <label for="descripcion">Descripción <span class="asterisco">*</span></label>
    @error('descripcion')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <p class="form-subtitulos">Otorgue una descripción del emprendimiento</p>
</div>
<label for="descripcion">Seleccionar Categoria<span class="asterisco">*</span></label>
<div class="field-group">

    <select name="categoria" class="categoria" required>
        @foreach ($categorias as $item)
            <option class="opcionesCategoria" value="{{ $item['categoria'] }}"
                {{ (isset($emprendimiento) && $emprendimiento->categoria == $item['categoria']) || old('categoria') == $item['categoria'] ? 'selected' : '' }}>
                {{ $item['categoria'] }}</option>
        @endforeach
    </select>


    @error('categoria')
        <div class="text-danger small">{{ $message }}</div>
    @enderror

    <p class="form-subtitulos">seleccionar la categoría del emprendimiento</p>
</div>


<div class="field-group" id="imagenesFormulario">
    <input type="file" name="imagenes[]" id="imagenes" multiple accept="image/*">
    <label for="imagenes">Cargar Imágenes <span class="asterisco">*</span></label>
    @error('imagenes')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    <div id="previousImagen" data-mostrar="{{isset($imagenes) ? 'true' : 'false'}}" data-array='{{ json_encode($imagenes) }}'>
    </div>
    <p class="form-subtitulos">Subir maximo 5 imágenes del emprendimiento</p>
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
        <select id="ciudad" class="localidadesDeLaCiudad" name="ciudad" required placeholder="">
            <option class="oculto " {{ !isset($emprendimiento) ? 'selected' : '' }}></option>
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
    <div class="field-group localidadesDeLaCiudad">
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



<label for="horaApertura">Horarios <span class="asterisco">*</span></label>
<div class="field-group">
    @php
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    @endphp


    @foreach ($dias as $dia)
        @php
            // Cargar datos antiguos o valores ya cargados del emprendimiento
            $horario = isset($emprendimiento) ? $emprendimiento->horarios->firstWhere('dia', $dia) : null;
        @endphp

        <strong>{{ $dia }}</strong>
        <div class="row">

            <div class="col-md-4">
                <input type="time" name="horarios[{{ $dia }}][hora_de_apertura]" class="form-control"
                    value="{{ old("horarios.$dia.hora_de_apertura", $horario->hora_de_apertura ?? '') }}"
                    {{ old("horarios.$dia.cerrado", $horario->cerrado ?? false) ? 'disabled' : '' }}>

                @error('horaApertura')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
                <p class="form-subtitulos">Otorgar el horario de apertura</p>
            </div>

            <div class="col-md-4">
                <input type="time" name="horarios[{{ $dia }}][hora_de_cierre]" class="form-control"
                    value="{{ old("horarios.$dia.hora_de_cierre", $horario->hora_de_cierre ?? '') }}"
                    {{ old("horarios.$dia.cerrado", $horario->cerrado ?? false) ? 'disabled' : '' }}>

                @error('horaCierre')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
                <p class="form-subtitulos">Otorgar el horario de cierre</p>

            </div>

            <div class="col-md-4">
                <input type="checkbox" name="horarios[{{ $dia }}][participa_feria]" value="1"
                    {{ old("horarios.$dia.participa_feria", $horario->participa_feria ?? false) ? 'checked' : '' }}>

                @error('feria')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
                <p class="form-subtitulos ">Marcar si participa en la feria municipal</p>
            </div>

            <div class="cerrado-checkbox col-md-4">

                <p class="form-subtitulos">Marcar si permanece cerrado</p>
                <input type="checkbox" id="cerrado_{{ $dia }}"
                    name="horarios[{{ $dia }}][cerrado]" value="1" data-dia="{{ $dia }}"
                    class="me-2 checkbox"
                    {{ old("horarios.$dia.cerrado", $horario->cerrado ?? false) ? 'checked' : '' }}>

                <label for="cerrado_{{ $dia }}">
                    Cerrado
                </label>

            </div>
    @endforeach





</div>
</div>
