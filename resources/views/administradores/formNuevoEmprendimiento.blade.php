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
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value={{isset($emprendimiento) ? $emprendimiento->nombre : old('nombre')}}>
        <br>
        <label for="descripcion">descripcion:</label>
        <input type="text" name="descripcion" id="descripcion" value={{isset($emprendimiento) ? $emprendimiento->descripcion : old('descripcion')}}>
        <br>
        <label for="categoria">categoria:</label>
        <input type="text" name="categoria" id="categoria">
        <br>
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen">
        <br>
        <label for="facebook">facebook:</label>
        <input type="text" name="facebook" id="facebook">
        <br>
        <label for="instagram">instagram:</label>
        <input type="text" name="instagram" id="instagram">

        <label for="whatsapp">whatsapp:</label>
        <input type="text" name="whatsapp" id="whatsapp">
        <br>
        <button type="submit" value="Guardar datos">Enviar</button>
    </form>

@endsection