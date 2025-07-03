<!DOCTYPE html>
<html>

<head>
    <title>Nuevo mensaje de contacto</title>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Nuevo mensaje de contacto desde el sitio emprendedores tres arroyos</h1>

    <p><strong>Nombre:</strong> {{ $data['first_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['tel'] ?? 'No provisto' }}</p>

    <p><strong>Mensaje del emprendedor:</strong></p>
    <p>{{ $data['description'] }}</p>

    <hr>

    <p>Gracias,<br>
        {{ config('app.name') }}</p>
</body>

</html>
