<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Emprendedores</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS includes Bootstrap)-->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/noticias.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/stylesemprendedoressection.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" />
</head>

<body id="page-top">

    <!--=======Header=======-->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">
            <div class="container-fluid px-4 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">

                        <!-- Logo y marca -->
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <img src="assets/img/iconos/oficinaempleodireccioncomercio-02.png" alt="Logo Tres Arroyos"
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
                                    <a class="nav-link"href="{{ url('/') }}">Volver a inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/programas') }}">Programas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/noticias') }}">Noticias</a>
                                </li>
                                @if (Auth::check() && Auth::user()->hasRole('admin'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/solicitantes') }}">Solicitantes</a>
                                    </li>
                                @else
                                    <li class="nav-item serParte">
                                        <a class="nav-link" href="{{ url('/formar/parte') }}">Ser parte</a>
                                    </li>
                                @endif
                            </ul>


                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank"
                                    class="get-started-btn crollto">
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
    <!-- End Header -->

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Emprendedores Culturales De Tres Arroyos </h1>

                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Esta sección está dedicada a visibilizar y apoyar a todos los
                        emprendedores que forman parte del ecosistema cultural del Municipio de Tres Arroyos.
                        Aquí encontrarás historias, productos y proyectos que reflejan el talento, la identidad y la
                        creatividad de nuestra comunidad.</p>


                </div>
            </div>
        </div>
    </header>

    <!--************************************************************************************************************************* -->











    <!--******************************************************************************************************* -->
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h1 class="section-subheading text-muted">Conoce la propuesta de cada emprendedor</h1>
            </div>
            <br>

            @if (Auth::check() && Auth::user()->hasRole('admin'))
                <div class="search">
                    <button class="btn btn-primary btn-xl text-uppercase botonAgregarEmprendimiento">
                        <a href="emprendedores/nuevoEmprendimiento">Agregar Emprendimiento</a>
                    </button>
                </div>
            @endif
        </div>
        <h3 class="tituloFiltroNoticias">Filtrar emprendedores según:</h3>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed desplegarFiltro" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne">
                        Tìtulo
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="search accordion-body">
                        <input class="inputSearch inputFiltrosEmprendedores" id="emprendedores-filter" type="text"
                            value="" placeholder="Buscar por nombre">
                        <button class="buttonSearch botonFiltro"> <img
                                id= "img-lupa"src="{{ asset('assets/img/iconos/lupa.png') }}"
                                title="lupa"></button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed desplegarFiltro" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Categoria
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="search accordion-body accordionCategoria">
                        @foreach ($emprendedoresPorCategoria as $categoria => $emprendedores)
                            <a class="linkCategoria" href="#link{{ $categoria }}">{{ $categoria }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="emprendedores-container" class="emprendedores-container"></div>
        <div class="seccionCarrusel">
            @foreach ($emprendedoresPorCategoria as $categoria => $emprendedores)
                <h3 id="link{{ $categoria }}">{{ $categoria }}</h3>
                <div class="container d-flex justify-content-center align-items-center min-vh-100">
                    <div id="carrousel-{{ $loop->index }}" class="shadow-wrapper p-2 rounded-4"
                        data-interval="200000">
                        <div id="carousel-{{ $categoria }}" class="carousel slide w-50 mx-auto"
                            data-bs-ride="carousel">
                            <div class="carousel-inner contenedorCarrusel" role="listbox">
                                @foreach ($emprendedores as $index => $emprendedor)
                                    <div class="portfolio-item carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <a class="portfolio-link" data-bs-toggle="modal"
                                            href="#portfolioModal{{ $emprendedor->id }}">
                                            <div class="portfolio-hover">
                                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            @if ($emprendedor->imagenes->isNotEmpty())
                                                <img class="img-fluid"
                                                    src="{{ $emprendedor->imagenes->first()['url'] }}"
                                                    alt="{{ $emprendedor->nombre }}" />
                                            @endif
                                        </a>
                                        <div class="portfolio-caption">
                                            <div class="portfolio-caption-heading">{{ $emprendedor->nombre }}</div>
                                            <div class="portfolio-caption-subheading text-muted">
                                                {{ $emprendedor->categoria }}</div>
                                        </div>
                                    </div>

                                    <div class="portfolio-modal modal fade" id="portfolioModal{{ $emprendedor->id }}"
                                        tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="close-modal" data-bs-dismiss="modal">
                                                    <img src="assets/img/iconos/close-icon.svg" alt="Close modal"
                                                        class="cierreEmprendedor" />
                                                </div>
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-8">
                                                            <div class="modal-body">
                                                                <h2 class="text-uppercase">{{ $emprendedor->nombre }}
                                                                </h2>
                                                                @if ($emprendedor->imagenes->isNotEmpty())
                                                                    <img class="img-fluid d-block mx-auto img-modalEmprendedor"
                                                                        src="{{ $emprendedor->imagenes->first()['url'] }}"
                                                                        alt="{{ $emprendedor->nombre }}" />
                                                                @endif
                                                                <p>{!! nl2br($emprendedor->descripcion) !!}</p>
                                                                <ul class="list-inline">
                                                                    <li><strong>Emprendedor</strong></li>
                                                                    <li><strong>Categoria:</strong>
                                                                        {{ $emprendedor->categoria }}</li>
                                                                </ul>
                                                                <button
                                                                    class="btn btn-primary btn-xl text-uppercase detalleEmprendedor"
                                                                    data-bs-dismiss="modal" type="button">
                                                                    <a href="/emprendedor/{{ $emprendedor->id }}">
                                                                        Ver más acerca de {{ $emprendedor->nombre }}
                                                                    </a>
                                                                </button>

                                                                <div class="containerBotonesEmprendedor">
                                                                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                                                                        <button
                                                                            class="btn btn-primary btn-xl text-uppercase detalleEmprendedor"
                                                                            data-bs-dismiss="modal" type="button">
                                                                            <a
                                                                                href="/emprendedores/formEditarEmprendimiento/{{ $emprendedor->id }}">
                                                                                Editar emprendimiento
                                                                            </a>
                                                                        </button>
                                                                        <button
                                                                            class="btn btn-primary btn-xl text-uppercase detalleEmprendedor botonEliminar"
                                                                            data-bs-dismiss="modal" type="button">
                                                                            <form
                                                                                action="/emprendedor/{{ $emprendedor->id }}"
                                                                                class="formEliminar" method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="inputEliminar"
                                                                                    value="Eliminar emprendimiento">
                                                                            </form>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Controles del carrusel -->
                            <a class="carousel-control-prev" href="#carousel-{{ $categoria }}" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-{{ $categoria }}" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="col-lg-4 col-sm-6 mb-4"></div>
    @include('layouts.panelAdmin')


    <a href="https://wa.me/2983603748?text=¡Hola contactanos a traves de nuestro whatsapp, muchas gracias, oficina de empleo."
        class="whatsapp-float" target="_blank" rel="noopener">

        <img class="whatsapp" src="assets/img/iconos/whatsapp.png">
    </a>



    <div class="contenedor_loader">
        <div class="loader"></div>
    </div>


    @include('emprendedor.footer')





    <!-- Core theme JS-->


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


    <script src="{{ asset('js/scriptsnavlogin.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }} "></script>

    <script type="module" src="{{ asset('js/carteles/cartelEliminar.js') }} "></script>
    <script src="{{ asset('js/carteles/carteles_error_success.js') }} "></script>
    <script type="module" src="{{ asset('js/emprendedores/emprendedores.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }} "></script>
    <script src="{{ asset('js/loader.js') }}"></script>

    <!--Para alertas desde JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!--Carrusel-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
