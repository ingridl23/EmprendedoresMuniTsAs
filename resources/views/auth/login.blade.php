<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>tres arroyos</title>

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
</head>
<!--nav para el admin -->
<header class="left-panel">
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

            </div>

            <!--logo cultura  -->




        </nav>
    </div>
</header>

<body>

    <div class="right-panel">



        <div class="card-header">

            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img id="imgcultura"src="assets/img/logocultura.png" alt="Logo cultura" class="logo-img me-2">
                <span class="brand-text"></span>
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Ingresar Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password"
                        class="col-md-4 col-form-label text-md-end">{{ __('Ingrese Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recordar credenciales') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ingresar') }}
                        </button>
                        <br>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('¡Olvidate como ingresar? comunicate con centro de computos') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>




</body>

</html>
