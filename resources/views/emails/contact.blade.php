<!DOCTYPE html>
<html>

<head>
    <title>Nuevo mensaje de contacto</title>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Nuevo mensaje de contacto desde el sitio oficina de empleo y capacitación Tres Arroyos</h1>

    <p><strong>Nombre:</strong> {{ $data['first_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['tel'] ?? 'No provisto' }}</p>

    <p><strong>Grupo Seleccionado:</strong> {{ ucfirst($data['subconjuntos']) }}</p>

    @if ($data['subconjuntos'] === 'empresa')
        <p><strong>Mensaje del representante de la empresa:</strong></p>
        <p>{{ $data['description'] }}</p>
    @elseif ($data['subconjuntos'] === 'emprendedor')
        <p><strong>Mensaje del emprendedor:</strong></p>
        <p>{{ $data['description'] }}</p>
    @elseif ($data['subconjuntos'] === 'busqueda de empleo')
        <p><strong>Mensaje del postulante:</strong></p>
        <p>{{ $data['description'] }}</p>
    @else
        <p><strong>Mensaje:</strong></p>
        <p>{{ $data['description'] }}</p>
    @endif
    @if (isset($data['cv']))
        <p><strong>CV cargado:</strong> Sí</p>
    @else
        <p><strong>CV cargado:</strong> No carga cv </p>
    @endif


    <hr>

    <p>Gracias,<br>{{ config('app.name') }}</p>
</body>

</html>
