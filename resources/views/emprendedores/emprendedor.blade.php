@extends('layouts.app')

@section('content')

        @foreach($emprendimiento as $valor)
            <li>{{$valor->nombre}}</li>
            <li>{{$valor->descripcion}}</li>
            <li>{{$valor->imagen}}</li>
            <li>{{$valor->categoria}}</li>
            <li>Instagram: {{$valor->instagram}}</li>
            <li>Facebook: {{$valor->facebook}}</li>
            <li>Whatsapp: {{$valor->whatsapp}}</li>
        @endforeach
        <form action="/emprendimientos" method="get">
            @csrf
            <input type="submit" value="Volver">
        </form>  
@endsection