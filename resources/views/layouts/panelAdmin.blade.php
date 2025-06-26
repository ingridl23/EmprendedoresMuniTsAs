 <div class="modal-overlay" id="overlay"></div>

    {{-- Panel : formulario de login --}}
    <div class="modal" id="modal">

        <!--  logo y titulo -->
        <div class="card-header  modal-header">
            <img id="imgcultura" src="{{ asset('assets/img/logocultura.png') }}" alt="Logo Cultura">
            <span class="titulologin">Panel Para Administrador</span>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>


        <!--body del modal form -->
        <div class=" modal-body card-body">
            <form id="loginForm" method="POST" action="{{ route('login') }}" autocomplete="off" class="w-100"
                style="max-width: 400px;">
                @csrf

                {{-- Email --}}
                <div class="field-group">
                    <input id="email2" type="email" name="email" required placeholder="">
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
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Recordar credenciales
                    </label>
                </div>

                {{-- Botón --}}
                <div class="text-center mb-2">
                    <button type="submit" class="btn btn-primary w-100" id="Form">
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
