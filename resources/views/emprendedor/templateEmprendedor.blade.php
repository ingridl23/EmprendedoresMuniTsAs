<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
     <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles2.css') }}" rel="stylesheet" />
    <link href= "{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/stylesemprendedoressection.css') }}" rel="stylesheet" />
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
                            <img src="{{asset('assets/img/oficinaempleodireccioncomercio-02.png')}}" alt="Logo Tres Arroyos"
                                class="logo-img me-2">
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
                                    <a class="nav-link" href="#productos">Productos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#contacto ">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/emprendedores ">Emprendedores</a>
                                </li>
                            </ul>

                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank" class="
                                    get-started-btn crollto get-started-btn">
                                    <div class="get-started-group font-color-bl">
                                        <img src="{{asset('assets/img/MiTr-remove-removebg-preview.png')}}" slt
                                            class=" img-btn-logonav mb-1">
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
                                @if(Auth::check() && Auth::user()->hasRole('admin'))
                                <form action="/logout" method="post" class="get-started-btn scrollto btn-contact cerrarSesion">
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
                    <h1 class="text-white font-weight-bold">{{$emprendimiento->nombre}} </h1> <!--((emprendedor-nombre)) -->
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">{{$emprendimiento->descripcion}}</p> <!--((emprendedor -descripcion)) -->


                </div>
            </div>
        </div>
    </header>
    <br>
    <br>

    <!-- Card 1 --> <!--aca iria el content para traer iteradas las cards -->
    <div id="productos" class="container">
        <div class="row">


            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="assets/img/bg-masthead.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- contenido -->
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="assets/img/bg-masthead.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- contenido -->
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="assets/img/bg-masthead.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- contenido -->
                    </div>
                </div>
            </div>

            <!-- Agregár más desde la base de datos -->

            <!--card 4 -->

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="assets/img/bg-masthead.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- contenido -->
                    </div>
                </div>
            </div>
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
                        <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Sunday
                                <span class="ms-auto">Cerrado</span>
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Monday
                                <span class="ms-auto">7:00 AM to 8:00 PM</span>
                                <!--((emprendedor-- horainicio))  ((emprendedor-- horafin))-->
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Tuesday
                                <span class="ms-auto">7:00 AM to 8:00 PM</span>
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Wednesday
                                <span class="ms-auto">7:00 AM to 8:00 PM</span>
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Thursday
                                <span class="ms-auto">7:00 AM to 8:00 PM</span>
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Friday
                                <span class="ms-auto">7:00 AM to 8:00 PM</span>
                            </li>
                            <li class="list-unstyled-item list-hours-item d-flex">
                                Saturday
                                <span class="ms-auto">9:00 AM to 5:00 PM</span>
                            </li>
                        </ul>
                        <p class="address mb-5">
                            <em>
                                Encontranos en
                                <br />
                                <strong>Ciudad: {{$emprendimiento->direccion->ciudad}} - {{$emprendimiento->direccion->localidad}}</strong>
                                <br />
                                <strong>Calle: {{$emprendimiento->direccion->calle}} al {{$emprendimiento->direccion->altura}}</strong> <!--((emprendedor- direccion)) -->
                            </em>
                        </p>


                        <div class="contactoemprendedor" id="contacto">

                            <p class="mb-0">
                                <em>
                                    <h3><em>Medios de Contacto</em></h3>

                                    <br />
                                    <strong> contactate con el emprendedor aqui </strong>
                                </em>
                                <br />
                            <div class="social-links mt-3">
                                @if(isset($emprendimiento->redes->facebook))
                                    <a href="{{$emprendimiento->redes->facebook}}" class="facebook"
                                        target="_blank">
                                        <!--link de facebook -->
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if(isset($emprendimiento->redes->instagram))
                                    <a href="{{$emprendimiento->redes->instagram}}" class="instagram"
                                        target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                @endif
                                <a class="whatsapp"
                                    href="https://api.whatsapp.com/send/?phone={{$emprendimiento->redes->whatsapp}}&text&type=phone_number&app_absent=0"
                                    target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                            </p>
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
