@extends('layouts.app')

@section('content')
   @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <br>
            {{ $error }}
        @endforeach
    @endif

    <form action="/emprendimientos/crearEmprendimiento" method="POST" enctype="multipart/form-data">
        @csrf
        @include('administradores.form');
    </form>

@endsection