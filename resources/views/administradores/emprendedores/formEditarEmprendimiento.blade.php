<html>

<body>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Editar emprendimiento</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
            integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css"
            rel="stylesheet" />
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/loader.css') }}" rel="stylesheet" />

        
    </head>
    @include('administradores.emprendedores.navBarAdmin')

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Edita los datos que sean necesarios sobre un emprendimiento
                    </h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        Desde esta sección del panel de administración, podés actualizar los datos de los
                        emprendimientos registrados en la plataforma.
                        Es posible modificar información clave como el nombre, la descripción, el rubro, los datos de
                        contacto y
                        cualquier otro campo necesario para mantener la información precisa y actualizada.
                    </p>

                    <br>
                </div>
            </div>
        </div>
    </header>
    <section class="page-section section-new-entrepreneur" id="contact" style="background-color: white">
        <div class="container px-4 px-lg-5 tituloNuevoEmprendimiento">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0"> Modificar Información del Emprendimiento</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5">
                        Corregir datos cargados,
                        incorporar cambios en la actividad del emprendimiento .
                        ¡Asegurar de revisar los campos antes de guardar los cambios!
                    </p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger text-center mb-3">
                <p class="mensajeError">Necesita completar correctamente todos los campos.</p>
            </div>
        @endif

        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
                <form action="/emprendedores/{{ $emprendimiento->id }}" method="POST" enctype="multipart/form-data"
                    class="form" id="editarForm" data-id="{{$emprendimiento->id}}">
                    @csrf
                    {{ method_field('PATCH') }}
                    @include('administradores.emprendedores.form')
                    <div class=" d-grid  ">
                        <button class="btn btn-primary btn-xl submit btnEditarEmprendimiento" id="submitButton" type="submit">
                            <span class="btntext" value="Guardar datos"> Editar emprendimiento </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
</section>
    @include('layouts.panelAdmin')
    @include('emprendedor.footer')

    <div class="contenedor_loader">
       <div class="loader"></div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts3.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/navbar.js') }} "></script>
    <script src="{{ asset('js/emprendedores/logicaSelectLocalidades.js') }} "></script>
    <script src="{{asset('js/emprendedores/envioImagenes.js')}}"></script>
      <script src="{{ asset('js/emprendedores/formOptionClose.js') }} "></script>
    <script src="{{ asset('js/loader.js') }}"></script>

            <!--Para las alertas en JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
