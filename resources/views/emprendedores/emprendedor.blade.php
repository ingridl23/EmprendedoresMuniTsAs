@extends('layouts.app')

@section('content')
        <li>{{$emprendimiento->nombre}}</li>
        <li>{{$emprendimiento->descripcion}}</li>
        <li><img src="{{ asset('storage/' . $emprendimiento->imagen)}}" alt="Imagen de {{$emprendimiento->nombre}}"></li>
        <li>{{$emprendimiento->categoria}}</li>
        <li>Instagram: {{$emprendimiento->instagram}}</li>
        <li>Facebook: {{$emprendimiento->facebook}}</li>
        <li>Whatsapp: {{$emprendimiento->whatsapp}}</li>
        <form action="/emprendimientos" method="get">
            @csrf
            <input type="submit" value="Volver">
        </form>  
@endsection