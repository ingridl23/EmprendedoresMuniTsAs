@extends('layouts.app')

@section('content')
   @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <br>
            {{ $error }}
        @endforeach
    @endif

    <form action="/emprendedores/{{$emprendimiento->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('administradores.form');
    </form>
@endsection

