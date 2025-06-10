@extends("layouts.app")

@section("content")

<!--ESQUELETO, AGREGAR BOOTSTRAP-->

<ul>
   @foreach($emprendimientos as $emprendimiento)
        <li>{{$emprendimiento->nombre}}</li>
        <li>{{$emprendimiento->descripcion}}</li>
        <li><img src="{{ asset('storage/' . $emprendimiento->imagen)}}" alt="Imagen de {{$emprendimiento->nombre}}"></li>
         <form action="/emprendimientos/{{$emprendimiento->id}}" method="get">
            @csrf
            <input type="submit" value="Mas detalles">
        </form>
    @endforeach
</ul>

@endsection
