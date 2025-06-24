<!DOCTYPE html>
<html lang="en">

<body>

    <form>
        <label for="nombre">Nombre:</label>
        <textarea name="nombre" id="nombre">{{ isset($emprendimiento) ? $emprendimiento->nombre : old('nombre') }}</textarea>
        <br>
        <label for="descripcion">descripcion:</label>
        <textarea name="descripcion" id="descripcion">{{ isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion') }}</textarea>
        <br>
        <label for="categoria">categoria:</label>
        <input type="text" name="categoria" id="categoria"
            value={{ isset($emprendimiento) ? $emprendimiento->categoria : old('categoria') }}>
        <br>
        <label for="imagen">Imagen</label>
        @if (isset($emprendimiento->imagen))
            <img src="{{ asset('storage/' . $emprendimiento->imagen) }}" alt="Imagen de {{ $emprendimiento->nombre }}">
        @endif
        <input type="file" name="imagen" id="imagen">
        <br>
        <label for="facebook">facebook:</label>
        <input type="text" name="facebook" id="facebook"
            value={{ isset($emprendimiento) ? $emprendimiento->facebook : old('facebook') }}>
        <br>
        <label for="instagram">instagram:</label>
        <input type="text" name="instagram" id="instagram"
            value={{ isset($emprendimiento) ? $emprendimiento->instagram : old('instagram') }}>
        <br>
        <label for="whatsapp">whatsapp:</label>
        <input type="text" name="whatsapp" id="whatsapp"
            value={{ isset($emprendimiento) ? $emprendimiento->whatsapp : old('whatsapp') }}>
        <br>
        <button type="submit" value="Guardar datos">Enviar</button>
    </form>
</body>

</html>
