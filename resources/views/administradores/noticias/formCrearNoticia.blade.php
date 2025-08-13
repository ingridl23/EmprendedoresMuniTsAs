<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Nueva noticia</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" />

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
</head>

<body id="page-top">

    @include('administradores.noticias.navBarNoticias')

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">¡Agrega una nueva noticia!</h1>

                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        En esta sección podés completar el formulario para cargar una nueva noticia al sitio.
                        Ingresá el título, el contenido principal y agregá una imágen que complemente la información.
                        Es importante que la noticia sea clara, actual y relevante para los lectores.
                    </p>
                    <p class="text-white-75 ">Asegurate de revisar bien los datos antes de enviarlos.
                        Una vez cargada, la noticia será visible en la plataforma y podrá ser editada más adelante si es
                        necesario.</p>
                    <br>
                </div>
            </div>
        </div>
    </header>

    <section class="page-section section-new-entrepreneur" id="contact" style="background-color: white">
        <div class="container px-4 px-lg-5 tituloNuevoEmprendimiento">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Cargar una nueva noticia</h2>

                    <p class="text-muted textoNuevoEmprendimiento">
                        Completá el formulario con los datos de la noticia, envialos
                    </p>
                    <p class="text-muted mb-5">
                        ¡y ya se cargará para poder ser vista!
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
                <form action="/noticias/cargarNuevaNoticia" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    @include('administradores.noticias.form')
                    <div class=" d-grid  ">
                        <button class="btn btn-primary btn-xl submit" type="submit">
                            <span class="btntext" value="Guardar noticia"> Agregar noticia </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="contenedor_loader">
        <div class="loader"></div>
    </div>
    @include('emprendedor.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts3.js') }} "></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/noticias/previsualizacionImagenesNoticias.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>

    <!--Para las alertas en JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>
