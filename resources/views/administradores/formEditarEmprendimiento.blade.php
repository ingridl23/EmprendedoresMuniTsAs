<html>

<body>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar emprendimiento</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
            integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css"
            rel="stylesheet" />
        <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    </head>
    @include('emprendedor.navBarAdmin')
    <!-- End Header -->

    <div class="container px-4 px-lg-5 tituloNuevoEmprendimiento">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0"> Editar datos de un emprendimiento</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">
                    Cambia los datos que sean necesarios, envialos y ¡verás como se actualiza al
                    instante!
                </p>
            </div>
        </div>
    </div>
    <div>

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <br>
                {{ $error }}
            @endforeach
        @endif
    </div>
    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
        <div class="col-lg-6">
            <form action="/emprendedores/{{ $emprendimiento->id }}" method="POST" enctype="multipart/form-data"
                class="form" id="contactForm">
                @csrf
                {{ method_field('PATCH') }}
                @include('administradores.form')
                <div class=" d-grid  ">
                    <button class="btn btn-primary btn-xl submit" id="submitButton" type="submit">
                        <span class="btntext" value="Guardar datos"> Editar emprendimiento </span>

                    </button>

                </div>
            </form>
        </div>
    </div>
    <div>
    </div>
    @include('layouts.panelAdmin')
    @include('emprendedor.footer')
</body>

</html>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS-->
<script src="{{ asset('js/scripts3.js') }}"></script>
<script src="{{ asset('js/logicaFormNuevoYEditarEmprendimiento.js') }}"></script>
<script src="{{ asset('js/scripts.js') }} "></script>
<script src="{{ asset('js/logicaSelectLocalidades.js') }} "></script>

<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
