<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>noticias</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />





    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/noticias.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/acordeon.css') }}" rel="stylesheet" />
</head>


<body id="page-top">


    <!-- ======= Header ======= -->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">
            <div class="container-fluid px-6 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-6 d-flex align-items-center justify-content-between">

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
                                    <a class="nav-link" href="{{ url('/') }}">Volver al inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"href="{{ url('/programas') }}">Programas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/emprendedores') }}">Emprendedores</a>
                                </li>
                                <li class="nav-item serParte">
                                    <a class="nav-link" href="{{ url('/formar/parte') }}">ser parte</a>
                                </li>


                            </ul>



                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank"
                                    class="get-started-btn crollto">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
                                        <img src="{{ asset('assets/img/iconos/MiTr-remove-removebg-preview.png') }}"
                                            slt class=" img-btn-logonav mb-1" alt="Imagen municipalidad">
                                        <span class="btn-text">MiTresa</span>
                                    </div>
                                </a>

                                <a href="https://autogestion.tresarroyos.gov.ar/" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
                                        <i class="fa-solid fa-laptop  servicio-icono"></i>
                                        <span class="btn-text">Autogestion</span>

                                    </div>
                                </a>

                                <a href="https://www.tresarroyos.gov.ar/transparencia-fiscal" target="_blank"
                                    class="get-started-btn scrollto">
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
    <!--- ------------->

    <header class="masthead headerNoticias">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold subtitulo-page">Noticias y Novedades</h1>
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        Mantente al día con la información más reciente de la Oficina de Empleo y Capacitación de Tres
                        Arroyos.
                        En esta sección encontrarás actualizaciones sobre eventos, ferias, capacitaciones, charlas y
                        oportunidades laborales disponibles en la ciudad.
                    </p>

                    <p class="text-white-75 ">
                        Un espacio pensado para que, como emprendedor o buscador de empleo, puedas acceder a información
                        útil y aprovechar al
                        máximo las iniciativas y recursos que ponemos a tu disposición.
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </header>

    <div class="page-top-news">
        @if (Auth::check() && Auth::user()->hasRole('admin'))
            <div class="search">
                <button class="btn btn-primary btn-xl text-uppercase agregarNoticia">
                    <a href="noticias/nuevaNoticia">Agregar noticia</a>
                </button>
            </div>
        @endif

    </div>

    <h3 class="tituloFiltroNoticias subtitulo-page">Filtrar noticias según:</h3>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Tìtulo
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="search accordion-body">
                    <input class="inputSearch inputFiltrosNoticias" id="Titulo" type="text"
                        placeholder="Buscar por título">
                    <button class="buttonSearch botonFiltro"> <img
                            id= "img-lupa"src="{{ asset('assets/img/iconos/lupa.png') }}" title="lupa"></button>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Categoria
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="search accordion-body">
                    <input class="inputSearch inputFiltrosNoticias" id="Categoria" type="text"
                        placeholder="Buscar por categoria">
                    <button class="buttonSearch botonFiltro"> <img
                            id= "img-lupa"src="{{ asset('assets/img/iconos/lupa.png') }}" title="lupa"></button>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Fecha de publicación
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="search accordion-body">
                    <input class="inputSearch inputFiltrosNoticias" id="Fecha" type="date"
                        placeholder="Buscar por fecha de publicación">
                    <button class="buttonSearch botonFiltro"> <img
                            id= "img-lupa"src="{{ asset('assets/img/iconos/lupa.png') }}" title="lupa"></button>
                </div>
            </div>
        </div>
    </div>

    <div id="noticias-container"></div>

    <!-- aca todo esto deberia iterarse-->
    <div class="container-fluid">

        @foreach ($noticias as $noticia)
            <div class="row container-card ">

                <!-- Mostrar cada noticia -->


                <div class="card mb-3">
                    <img src="{{ $noticia->imagen }}" class="card-img-top1" alt={{ $noticia->titulo }}>
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <p class="card-text">{{ $noticia->categoria }}</p>
                        <div class="container-vermas">
                            <p class="card-text"><small class="text-body-secondary">Publicación :
                                    {{ $noticia->created_at->format('Y-m-d') }}</small></p>
                            <p class="card-text"><small class="text-body-secondary">Última Actualización :
                                    {{ $noticia->updated_at->format('Y-m-d') }}</small></p>
                            <button class="vermas"><a href="noticias/{{ $noticia->id }}">Ver más</a></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="navegacionPags">
        {{ $noticias->onEachSide(2)->links('pagination::bootstrap-4') }}
    </div>

    </div>















    <!-- barra de navegacion footer -->
    @include('emprendedor.footer')

    @if (session('success'))
        <script>
            window.mensajeExito = @json(session('success'));
        </script>
    @endif

    @if (session('error'))
        <script>
            window.mensajeError = @json(session('error'));
        </script>
    @endif



    <!--Para cambio de color del navbar-->
    <script src="{{ asset('js/navbar.js') }} "></script>
    <script src="{{ asset('js/noticias/buscarNoticias.js') }} "></script>
    <script src="{{ asset('js/carteles/carteles_error_success.js') }} "></script>

    <!--Para alertas desde JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap core JS-->
    <script src="{{ asset('js/scripts.js') }} "></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>
