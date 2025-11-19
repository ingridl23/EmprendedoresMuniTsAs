<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Emprendedor</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />

    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />



    <link href= "{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sectionredes.css') }}" rel="stylesheet" />
</head>


<body id="page-top">
    <!-- ======= Header ======= -->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">
            <div class="container-fluid px-4 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">
                        <!-- Logo y marca -->
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/iconos/oficinaempleodireccioncomercio-02.png') }}"
                                alt="Logo Tres Arroyos" class="logo-img me-2">
                            <span class="brand-text"></span>
                        </a>

                        <!-- Botones de toggle para móvil -->
                        <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Menú de navegación principal -->
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav mx-auto my-2 my-lg-0">

                                <li class="nav-item">
                                    <a class="nav-link"href="{{ url('/') }}">Inicio</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"href="{{ url('/programas') }}">Programas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/noticias') }}">Noticias</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/emprendedores ">Emprendedores</a>
                                </li>
                                <li class="nav-item serParte">
                                    <a class="nav-link" href="{{ url('/formar/parte') }}">ser parte</a>
                                </li>
                            </ul>

                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank"
                                    class="
                                    get-started-btn crollto get-started-btn">
                                    <div class="get-started-group font-color-bl">
                                        <img src="{{ asset('assets/img/iconos/MiTr-remove-removebg-preview.png') }}"
                                            slt class=" img-btn-logonav mb-1">
                                        <span class="btn-text">MiTresa</span>
                                    </div>
                                </a>

                                <a href="https://autogestion.tresarroyos.gov.ar/" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
                                        <i class="fa-solid fa-laptop servicio-icono"></i>
                                        <span class="btn-text">Autogestion</span>

                                    </div>
                                </a>

                                <a href="/transparencia-fiscal" target="_blank" class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
                                        <i class="fas fa-lock-open  img-btn-logonav servicio-icono">

                                        </i>
                                        <span class="btn-text">Gobierno<br>Abierto</span>
                                    </div>
                                </a>
                                @if (Auth::check() && Auth::user()->hasRole('admin'))
                                    <form action="/logout" method="post"
                                        class="get-started-btn scrollto btn-contact cerrarSesion">
                                        @csrf
                                        <button type="submit">
                                            <div class="get-started-group font-color-bl containerLinksExternos">
                                                <i class="fa fa-user-circle img-btn-logonav servicio-icono  "></i>
                                                <span class="btn-text">cerrar<br>sesion</span>
                                            </div>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ url('/showlogin') }}" class="get-started-btn scrollto btn-contact">
                                        <div class="get-started-group font-color-bl containerLinksExternos">
                                            <i class="fa fa-user-circle img-btn-logonav servicio-icono  ">
                                            </i>
                                            <span class="btn-text">Panel<br>Admin</span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    <!-- End nav -->

    <header class="masthead">

        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">{{ $emprendimiento->nombre }} </h1>
                    <!--((emprendedor-nombre)) -->
                    <hr class="divider text-white" style="background-color: white !important" />
                </div>
                <div class="align-self-baseline">
                    <p class="text-white-75 ">{{ $emprendimiento->descripcion }}</p>
                    <!--((emprendedor -descripcion)) -->


                </div>
            </div>
        </div>
    </header>
    <br>
    <br>

    <!-- Card 1 --> <!--aca iria el content para traer iteradas las cards -->
    <div id="productos" class="container">
        <div>

            @if ($emprendimiento->imagenes->isNotEmpty())
                <div class=" galeriaImagenes col-md-8">
                    @foreach ($emprendimiento->imagenes as $imagen)
                        <img src="{{ $imagen['url'] }}" class=" img-fluid"
                            alt="Imagen de {{ $emprendimiento->nombre }}">
                    @endforeach

                </div>
            @else
                <p>No hay imágenes disponibles para este emprendimiento.</p>
            @endif
        </div>

    </div>





    <!--seccion informacion de contacto, ubicacion  y horarios -->

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner bg-faded text-center rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Horarios De Atencion </span>

                        </h2>
                        @foreach ($emprendimiento->horarios as $horario)
                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">

                                <li class="list-unstyled-item list-hours-item d-flex">
                                    <strong>{{ $horario->dia }}:</strong>

                                    <!--((emprendedor-- horainicio))  ((emprendedor-- horafin))-->
                                    @if ($horario->cerrado)
                                        <span class="ms-auto"> Cerrado </span>
                                    @else
                                        <span class="ms-auto"> desde {{ $horario->hora_apertura }}hs -
                                            hasta {{ $horario->hora_cierre }}hs</span>
                                    @endif
                                    @if ($horario->participa_feria == 1)
                                <li> Participa en feria parque cabañas primer domingo de cada
                                    mes
                                </li>
                        @endif

                        </li>

                        </ul>
                        @endforeach
                        <p class="address mb-5">
                            <em>
                                Encontranos en
                                <br />
                                <strong>Ciudad: {{ $emprendimiento->direccion->ciudad }} -
                                    {{ $emprendimiento->direccion->localidad }}</strong>
                                <br />
                                <strong>Calle: {{ $emprendimiento->direccion->calle }} n°
                                    {{ $emprendimiento->direccion->altura }}</strong>
                                <!--((emprendedor- direccion)) -->
                            </em>
                        </p>




                    </div>
                    </p>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>

    <button class="vermas">
        <a href="/emprendedores">Volver</a>
    </button>

    <section class="page-section custom-about" id="about2">


        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0"> ¡Formas de Contacto!</h2>
                    <hr class="divider divider-light" />


                    <div class="social-icons">

                        @if (isset($emprendimiento->redes->facebook))
                            <a href="{{ $emprendimiento->redes->facebook }}" class="facebook" target="_blank">
                                <!--link de facebook -->
                                <img src="{{ asset('assets/img/iconos/facebook.png') }}" alt="Facebook"
                                    width="32">

                            </a>
                        @endif

                        @if (isset($emprendimiento->redes->instagram))
                            <a href="{{ $emprendimiento->redes->instagram }}" class="instagram" target="_blank">


                                <img src="{{ asset('assets/img/iconos/instagram.png') }}" alt="Instagram"
                                    width="32">
                            </a>
                        @endif

                        @if (isset($emprendimiento->redes->whatsapp))
                            <a class="whatsapp"
                                href="https://api.whatsapp.com/send/?phone={{ $emprendimiento->redes->whatsapp }}&text&type=phone_number&app_absent=0"
                                target="_blank">
                                <img src="{{ asset('assets/img/iconos/whatsapp.png') }}" alt="Instagram"
                                    width="32">
                            </a>
                        @endif

                    </div>





                </div>


            </div>
        </div>
        </div>



    </section>


    <br>
    <br>
    <br>
    <br>

    <!-- seccion footer -->
    @include('emprendedor.footer')

    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/scripts2.js') }}"></script>
    <script src="{{ asset('js/scriptsnavlogin.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>


    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



</body>

</html>
