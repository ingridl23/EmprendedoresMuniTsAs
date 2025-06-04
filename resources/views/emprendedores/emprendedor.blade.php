@extends('layouts.app')

@section('content')
        <li>{{$emprendimiento->nombre}}</li>
        <li>{{$emprendimiento->descripcion}}</li>
        <li>{{$emprendimiento->imagen}}</li>
        @if(isset($informacionRedes))
            <li>Instagram: {{$informacionRedes->instagram}}</li>
            <li>Facebook: {{$informacionRedes->facebook}}</li>
            <li>Whatsapp: {{$informacionRedes->whatsapp}}</li>
        @endif
        <form action="/emprendimientos" method="get">
            @csrf
            <input type="submit" value="Volver">
        </form>  
@endsection