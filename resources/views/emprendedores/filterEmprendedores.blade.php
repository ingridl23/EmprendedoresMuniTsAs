@extends('layouts.app')

@section('content')

<section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Filtro de busqueda</h2>
                <hr class="divider" />
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">


                <form class="form-inline my-2 my-lg-0">
                    <div class="mb-3 row">
                        <div class="form-floating col-auto">
                            <input id="emprendedores-filter" class="form-control mr-sm-2" type="search" placeholder="Search"
                            aria-label="Search">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary btn-xl my-2 my-sm-0" type="submit">Search</button>
                        </div>

                    </div>
                </form>
            </div>


            <div id="emprendedores-container" class="emprendedores-container">
            </div>

        </div>

     </div>
</section>
























@if(isset($emprendimientos) && count($emprendimientos) > 0)
        @foreach($emprendimientos as $emp)
            <li>{{$emp->nombre}}</li>
            <li>{{$emp->descripcion}}</li>
            <li>{{$emp->imagen}}</li>
            <li>{{$emp->categoria}}</li>
            <li>Instagram: {{$emp->redes->instagram}}</li>
            <li>Facebook: {{$emp->redes->facebook}}</li>
            <li>Whatsapp: {{$emp->redes->whatsapp}}</li>
            <br>
        @endforeach

@endif


@endsection
<!-- Template busqueda emprendedorese -->
<script src="{{ asset('js/emprendedoresFilter.js') }}"></script>
