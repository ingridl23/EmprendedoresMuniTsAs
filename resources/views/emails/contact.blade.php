<!DOCTYPE html>
<html>

<head>
    <title>Nuevo mensaje de contacto</title>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Nuevo mensaje desde el sitio Oficina de Empleo y Capacitación - Tres Arroyos</h1>

    <p><strong>Nombre:</strong> {{ $data['first_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['tel'] ?? 'No provisto' }}</p>
    <p><strong>Asunto:</strong> {{ $data['asunto'] ?? 'No especificado' }}</p>
    <p><strong>Grupo seleccionado:</strong> {{ ucfirst($data['subconjuntos']) }}</p>

    @if ($data['subconjuntos'] === 'empresa')
        <hr>
        <h3>Datos de Empresa</h3>
        <p><strong>Nombre de empresa:</strong> {{ $data['nombre_empresa'] ?? 'No provisto' }}</p>
        <p><strong>Consulta:</strong><br>{{ $data['description'] }}</p>
    @elseif ($data['subconjuntos'] === 'emprendedor')
        <hr>
        <h3>Datos de Emprendedor</h3>
        <p><strong>¿Inscripto al Club de Emprendedores?:</strong> {{ $data['club_emprendedor'] ?? 'No respondido' }}</p>
        <p><strong>Consulta:</strong><br>{{ $data['description'] }}</p>
    @elseif ($data['subconjuntos'] === 'busqueda de empleo')
        <hr>
        <h3>Datos de quien busca empleo</h3>
        <p><strong>Edad:</strong> {{ $data['edad'] ?? 'No informada' }}</p>
        <p><strong>DNI:</strong> {{ $data['dni'] ?? 'No informado' }}</p>
        <p><strong>Ciudad:</strong> {{ $data['ciudad'] ?? 'No informada' }}</p>
        <p><strong>Localidad:</strong> {{ $data['localidadesDeLaCiudad'] ?? 'No informada' }}</p>
        <p><strong>Formación alcanzada:</strong> {{ $data['formacion'] ?? 'No especificada' }}</p>

        @if (isset($data['formacion']) && $data['formacion'] === 'curso')
            <p><strong>Nombre del curso:</strong> {{ $data['nombre_curso'] ?? 'No informado' }}</p>
        @endif

        <p><strong>¿Posee CUD?:</strong> {{ $data['cud'] ?? 'No especificado' }}</p>
        <p><strong>¿Trabaja en relación de dependencia?:</strong> {{ $data['dependencia'] ?? 'No especificado' }}</p>

        <h4>Referencias Laborales</h4>
        <p><strong>Rubro:</strong> {{ $data['referencia_rubro'] ?? 'No informado' }}</p>
        <p><strong>Actividad realizada:</strong> {{ $data['referencia_actividad'] ?? 'No informado' }}</p>
        <p><strong>Nombre del contratista:</strong> {{ $data['contratista'] ?? 'No informado' }}</p>
        <p><strong>Teléfono del contratista:</strong> {{ $data['referencia_telefonica'] ?? 'No informado' }}</p>

        <p><strong>Mensaje/Consulta:</strong><br>{{ $data['description'] }}</p>

        <p><strong>CV cargado:</strong> {{ isset($data['cv']) ? 'Sí' : 'No' }}</p>
    @endif

    <hr>
    <p>Gracias,<br>{{ config('app.name') }}</p>
</body>

</html>
