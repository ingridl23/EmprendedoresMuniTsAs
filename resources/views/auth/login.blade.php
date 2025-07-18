<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>tres-arroyos-panel</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />




    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />



</head>


<!--nav para el admin -->

<body id="page-top">





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
                                    <a class="nav-link" href="{{ url('/') }}">Volver a Inicio</a>


                            </ul>


                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank" class"
                                    get-started-btn crollto" class="get-started-btn">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
                                        <img src="{{ asset('assets/img/iconosMiTr-remove-removebg-preview.png') }}" slt
                                            class=" img-btn-logonav mb-1" alt="Imagen municipalidad">
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



                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>




    <br>
    <br>
    <br>
    <br>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">

                <img class="divider" src="{{ asset('assets/img/iconos/empleosinfondo.png') }}" alt="Logo Empleo">
                <p class="text-muted mb-5"> Ingreso solo perfiles autorizados </p>


                {{-- ✅ Mensaje de éxito --}}
                @if (session('success'))
                    <div class="alert alert-success text-center mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ✅ Errores generales --}}
                @if ($errors->any())
                    <div class="text-center mb-3 alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">

            <div class="col-lg-6">

                <form method="POST" class="form"action="{{ route('login') }}" autocomplete="off" class="w-100">
                    @csrf

                    {{-- input  Email --}}
                    <div class="field-group">
                        <input id="email" type="email" name="email" required placeholder=""
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <label for="message">Email</label>
                        <p class="form-subtituloslogin">Ingrese con su email institucional</p>
                    </div>


                    {{-- Contraseña --}}
                    <div class="field-group">
                        <input id="password" type="password" name="password" required placeholder=""
                            autocomplete="current-password" value="{{ old('email') }}">

                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <label for="password">Ingresar contraseña</label>
                    </div>

                    {{-- Recordar credenciales --}}
                    <div class="checkbox-group mb-3">
                        <label>
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            Recordar credenciales
                        </label>
                    </div>

                    <!-- input oculto -->

                    <input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off"
                        value="">

                    {{-- Botón --}}
                    <div class=" d-grid  ">
                        <button class="submit btn btn-primary btn-xl" id="submitButton" type="submit">

                            {{ __('Ingresar') }}
                        </button>
                    </div>

                    {{-- Olvidaste contraseña --}}
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste cómo ingresar?') }}
                            </a>
                        </div>
                    @endif


                </form>
            </div>


        </div>
    </div>


    <br>
    <br>
    <br>
    @include('emprendedor.footer')

    <!-- Bootstrap core JS-->
    <script src="{{ asset('js/scriptsnavlogin.js') }} "></script>
    <script src="{{ asset('js/scripts3.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>



    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
