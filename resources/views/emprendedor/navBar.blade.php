<!-- ======= Header ======= -->
<div class="custom-navbar-container">
    <header id="header" class="fixed-top header-scrolled">
        <div class="container-fluid px-4 container">
            <!-- Navbar principal -->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">

                    <!-- Logo y marca -->
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <img src="assets/img/logo-muni-azul-claro-removebg-preview.png" alt="Logo Tres Arroyos"
                            class="logo-img me-2">
                        <span class="brand-text"></span>
                    </a>

                    <!-- Botones de toggle para móvil -->
                    <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Menú de navegación principal -->
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav mx-auto my-2 my-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#about">Presentación</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services">Objetivo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/emprendedores') }}">Emprendedores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/formarparte') }}">ser parte</a>
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

                            <a href="https://www.tresarroyos.gov.ar/transparencia-fiscal" target="_blank"
                                class="get-started-btn scrollto">
                                <div class="get-started-group font-color-bl">
                                    <i class="fas fa-lock-open  img-btn-logonav servicio-icono">

                                    </i>
                                    <span class="btn-text">Gobierno<br>Abierto</span>
                                </div>
                            </a>


                            <a href="{{ url('/login') }}" target="_blank" class="get-started-btn scrollto">
                                <div class="get-started-group font-color-bl">
                                    <i class="fa fa-user-circle img-btn-logonav servicio-icono">

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



<!-- End Header -->
