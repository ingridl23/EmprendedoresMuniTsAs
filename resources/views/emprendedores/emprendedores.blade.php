@extends("layouts.app")

@section("content")

<!--ESQUELETO, AGREGAR BOOTSTRAP-->

<ul>
   @foreach($emprendimientos as $emprendimiento)
        <li>{{$emprendimiento->nombre}}</li>
        <li>{{$emprendimiento->descripcion}}</li>
        <li>{{$emprendimiento->imagen}}</li>
         <form action="/emprendimientos/{{$emprendimiento->id}}" method="get">
            @csrf
            <input type="submit" value="Mas detalles">
        </form>
    @endforeach
</ul>

@endsection
