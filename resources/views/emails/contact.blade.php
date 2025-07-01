@component('mail::message')
    #Hola Oficina De Cultura

    <br>

    <p>
        Has recibido un nuevo mensaje desde el formulario de contacto de {{ config('app.name') }}

    <p>
        motivo del mensaje : {{ $description }}
    </p>



    </p>
@endcomponent
