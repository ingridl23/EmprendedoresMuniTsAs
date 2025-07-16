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
    <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/noticias.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
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
                            <img src="{{ asset('assets/img/oficinaempleodireccioncomercio-02.png') }}"
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


                            </ul>



                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank"
                                    class="get-started-btn crollto">
                                    <div class="get-started-group font-color-bl">
                                        <img src="{{asset('assets/img/MiTr-remove-removebg-preview.png')}}"
                                            slt class=" img-btn-logonav mb-1" alt="Imagen municipalidad">
                                        <span class="btn-text">MiTresa</span>
                                    </div>
                                </a>

                                <a href="https://autogestion.tresarroyos.gov.ar/" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fa-solid fa-laptop  servicio-icono"></i>
                                        <span class="btn-text">Autogestion</span>

                                    </div>
                                </a>

                                <a href="https://www.tresarroyos.gov.ar/transparencia-fiscal" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fas fa-lock-open  img-btn-logonav servicio-icono">

                                        </i>
                                        <span class="btn-text">Gobierno<br>Abierto</span>
                                    </div>
                                </a>
                                <a href="{{ url('/showlogin') }}" class="get-started-btn scrollto btn-contact">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fa fa-user-circle img-btn-logonav servicio-icono  ">

                                        </i>
                                        <span class="btn-text">Panel<br>Admin</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    <!--- ------------->




    <div class="container-subtitulo-page">

        <h1 class="subtitulo-page">Noticias</h1>
    </div>



    <div class="page-top-news">

        <section aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li><a class="breadcrumb-item" href="#">Bolsa de Empleo <span>/</span></a></li>
                <li> <a class="breadcrumb-item " href="#">Eventos</a></li>
            </ol>
        </section>

        <div class="search">

            <input class="inputSearch" type="text" value="" placeholder="buscar">
            <button class="buttonSearch "> <img id= "img-lupa"src="/EMPRENDEDORESMUNITSAS/public/assets/img/lupa.png"
                    title="lupa"></button>
        </div>



    </div>




    <!-- aca todo esto deberia iterarse-->
    <div class="container-fluid">

        <div class="row container-card ">

            <div class="card mb-3">
                <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/portfolio/thumbnails/1.jpg" class="card-img-top1"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                        to
                        additional content. This content is a little bit longer.</p>
                    <div class="container-vermas">
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                ago</small></p>
                        <button class="vermas">ver mas</button>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/portfolio/thumbnails/1.jpg" class="card-img-top1"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                        to
                        additional content. This content is a little bit longer.</p>
                    <div class="container-vermas">
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                ago</small></p>
                        <button class="vermas">ver mas</button>
                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/portfolio/thumbnails/1.jpg" class="card-img-top1"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                        to
                        additional content. This content is a little bit longer.</p>
                    <div class="container-vermas">
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                ago</small></p>
                        <button class="vermas">ver mas</button>
                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/portfolio/thumbnails/1.jpg" class="card-img-top1"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                        to
                        additional content. This content is a little bit longer.</p>
                    <div class="container-vermas">
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                ago</small></p>
                        <button class="vermas">ver mas</button>
                    </div>
                </div>
            </div>






        </div>
    </div>

















    <!-- barra de navegacion footer -->
    @include('emprendedor.footer')

    <!-- Bootstrap core JS-->
    <script src="{{ asset('js/scripts.js') }} "></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>
