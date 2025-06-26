@extends('layouts.app')

@section('template_title')
    {{ $emprendedor->name ?? __('Show') . " " . __('Emprendedor') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Emprendedor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('emprendedors.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $emprendedor->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $emprendedor->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Categoria:</strong>
                            {{ $emprendedor->categoria }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Redes Id:</strong>
                            {{ $emprendedor->redes_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Imagen:</strong>
                            {{ $emprendedor->imagen }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
