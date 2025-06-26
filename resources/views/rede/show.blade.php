@extends('layouts.app')

@section('template_title')
    {{ $rede->name ?? __('Show') . " " . __('Rede') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rede</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('redes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Instagram:</strong>
                            {{ $rede->instagram }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Facebook:</strong>
                            {{ $rede->facebook }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Whatsapp:</strong>
                            {{ $rede->whatsapp }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
