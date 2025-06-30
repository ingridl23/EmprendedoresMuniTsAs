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





<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">

            {{-- Panel izquierdo: logo municipalidad --}}
            <div class="col-md-6 left-panel">
                <div class="text-center">
                    <img id="logotresa" src="{{ asset('assets/img/logo-muni-azul-claro-removebg-preview.png') }}"
                        alt="Logo Tres Arroyos">
                </div>
            </div>

            {{-- Panel derecho: formulario de login --}}
            <div class="col-md-6 right-panel d-flex flex-column justify-content-center align-items-center px-4">
                <div class="card-header">
                    <img id="imgcultura" src="{{ asset('assets/img/logocultura.png') }}" alt="Logo Cultura">
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}" autocomplete="off" class="w-100"
                        style="max-width: 400px;">
                        @csrf

                        {{-- Email --}}
                        <div class="field-group">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                placeholder="">
                            <label for="email">Ingresar Email</label>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="field-group">
                            <input id="password" type="password" name="password" required placeholder=""
                                autocomplete="current-password">
                            <label for="password">Ingresar Contraseña</label>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                            <button type="submit" class="btn btn-primary w-100">
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

</body>

</html>
