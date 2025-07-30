<div class="field-group">

    @php
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    @endphp

    @foreach ($dias as $dia)
        @php
            // Cargar datos antiguos o valores ya cargados del emprendimiento
            $horario = isset($emprendimiento) ? $emprendimiento->horarios->firstWhere('dia', $dia) : null;
        @endphp
        <div class="horario-dia mb-4">
            <strong>{{ $dia }}</strong>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <input type="time" name="horarios[{{ $dia }}][hora_de_apertura]" class="form-control"
                        value="{{ old("horarios.$dia.hora_de_apertura", $horario->hora_de_apertura ?? '') }}"
                        {{ old("horarios.$dia.cerrado", $horario->cerrado ?? false) ? 'disabled' : '' }}>
                    <label for="horaApertura">Horarios <span class="asterisco">*</span></label>
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
                    <p class="form-subtitulos">Marcar si participa en la feria municipal</p>
                </div>
                <div class="cerrado-checkbox ">

                    <p class="form-subtitulos">Marcar si permanece cerrado</p>
                    <input type="checkbox" id="cerrado_{{ $dia }}"
                        name="horarios[{{ $dia }}][cerrado]" value="1" data-dia="{{ $dia }}"
                        class="me-2 checkbox"
                        {{ old("horarios.$dia.cerrado", $horario->cerrado ?? false) ? 'checked' : '' }}>

                    <label for="cerrado_{{ $dia }}">
                        Cerrado
                    </label>

                </div>
            </div>
        </div>
    @endforeach



</div>
