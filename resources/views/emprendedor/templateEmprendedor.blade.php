<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>emprendedor</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />>


    <!-- Core theme CSS (includes Bootstrap)-->
    <link href= "{{ asset('css/styles2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href= "{{ asset('css/footer.css') }}" rel="stylesheet" />
</head>

<body>

    <!-- ======= Header ======= -->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">
            <div class="container-fluid px-4 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">

                        <!-- Logo y marca -->
                        <a class="navbar-brand d-flex align-items-center" href="#page-top">
                            <img src="assets/img/logo-muni-azul-claro-removebg-preview.png" alt="Logo Tres Arroyos"
                                class="logo-img me-2">

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
                                    <a class="nav-link" href="#compra">Como Comprar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contacto ">Contacto</a>
                                </li>
                            </ul>

                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank" class"
                                    get-started-btn crollto" class="get-started-btn">
                                    <div class="get-started-group font-color-bl">
                                        <img src="assets/img/MiTr-remove-removebg-preview.png" slt
                                            class=" img-btn-logonav img-fluid mb-1">
                                        <span class="btn-text">MiTresa</span>
                                    </div>
                                </a>

                                <a href="https://autogestion.tresarroyos.gov.ar/" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fa-solid fa-laptop servicio-icono"></i>
                                        <span class="btn-text">Autogestion</span>

                                    </div>
                                </a>

                                <a href="/transparencia-fiscal" target="_blank" class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fas fa-lock-open  img-btn-logonav servicio-icono">

                                        </i>
                                        <span class="btn-text">Gobierno<br>Abierto</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    <!-- End Header -->



    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner bg-faded text-center rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">nombre emprendedor</span>

                        </h2>
                        <p class="mb-0">When you walk into our shop to start your day, we are dedicated to
                            providing
                            you with friendly service, a welcoming atmosphere, and above all else, excellent
                            products
                            made with the highest quality ingredients. If you are not satisfied, please let us know
                            and
                            we will do whatever we can to make things right!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- barra de navegacion -->
    @include('emprendedor.footer')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts2.js') }}"></script>

</body>

</html>
