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




    <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
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
                            <img src="assets/img/logo-muni-azul-claro-removebg-preview.png" alt="Logo Tres Arroyos"
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
                                    <a class="nav-link" href="{{ url('/') }}">Volver a Inicio</a>


                            </ul>


                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank" class"
                                    get-started-btn crollto" class="get-started-btn">
                                    <div class="get-started-group font-color-bl">
                                        <img src="assets/img/MiTr-remove-removebg-preview.png" slt
                                            class=" img-btn-logonav img-fluid mb-1" alt="Imagen municipalidad">
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



                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>



    <div class="container d-flex justify-content-center align-items-center vh-1000">
        <div>



            {{-- Panel: formulario de login --}}
            <div class=" right-panel d-flex flex-column justify-content-center align-items-center px-4">
                <div class="card-header">
                    <img id="imgcultura" src="{{ asset('assets/img/logocultura.png') }}" alt="Logo Cultura">
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}" data-sb-form-api-token="TU_TOKEN_AQUI"
                        autocomplete="off" class="w-100">
                        @csrf
                        @error('error')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- Email --}}
                        <div class="field-group">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                placeholder="">
                            <label for="email">Ingresar Email</label>
                            <!--@error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror-->
                        </div>

                        @csrf

                        {{-- Contraseña --}}
                        <div class="field-group">
                            <input id="password" type="password" name="password" required placeholder=""
                                autocomplete="current-password">
                            <label for="password">Ingresar Contraseña</label>

                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror-->




                    </div>

                    {{-- Recordar credenciales --}}
                    <div class="checkbox-group mb-3">
                        <label>
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            Recordar credenciales
                        </label>
                    </div>

                    {{-- Botón --}}
                    <div class="text-center mb-2">
                        <button id="submitButton" type="submit" class="btn btn-primary w-100">

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
</div>

@include('emprendedor.footer')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.field-group input').forEach(input => {
            if (input.value.trim() !== '') {
                input.classList.add('has-value');
            }

            input.addEventListener('input', () => {
                input.classList.toggle('has-value', input.value.trim() !== '');
            });
        });
    });
</script>
<!-- Bootstrap core JS-->
<script src="{{ asset('js/scriptsnavlogin.js') }} "></script>
<script src="{{ asset('js/scripts3.js') }}"></script>


<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
