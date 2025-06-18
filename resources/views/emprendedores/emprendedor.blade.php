@extends('layouts.app')

@section('content')
        <li>{{$emprendimiento->nombre}}</li>
        <li>{{$emprendimiento->descripcion}}</li>
        <li><img src="{{ asset('storage/' . $emprendimiento->imagen)}}" alt="Imagen de {{$emprendimiento->nombre}}"></li>
        <li>{{$emprendimiento->categoria}}</li>
        <li>Instagram: {{$emprendimiento->redes->instagram}}</li>
        <li>Facebook: {{$emprendimiento->redes->facebook}}</li>
        <li>Whatsapp: {{$emprendimiento->redes->whatsapp}}</li>
        <button type="button"><a href="/emprendimientos">Volver</a></button>
         @can('eliminar emprendimiento')
            <form action="/emprendimientos/{{$emprendimiento->id}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Eliminar">
            </form> 
        @endcan
        @can('editar emprendimiento')
            <button><a href="/emprendimientos/formEditarEmprendimiento/{{$emprendimiento->id}}">Editar</a></button>
        @endcan
@endsection