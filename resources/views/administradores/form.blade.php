<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>tres arroyos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />




    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />

    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />

</head>












<body>

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

</body>

</html>
