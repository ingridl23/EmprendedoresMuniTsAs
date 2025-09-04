<html>

<body>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>filtrar solicitantes</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
            integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css"
            rel="stylesheet" />
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
    </head>
    @include('administradores.emprendedores.navBarAdmin')

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Filtrar los datos que sean necesarios de solicitantes
                    </h1>
                    <hr class="divider" style="background-color: white" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        Desde esta sección del panel de administración, podés filtrar y descargar los datos de los
                        solicitantes recibidos en la plataforma.
                        Es posible descargar información en formato hoja de calculo.
                        Tambien seleccionar el campo por el que quiere obtener el documento a descargar, como
                        nombre,edad,fecha,CUD,DNI
                        de esa manera se obtiene el documento generado ordenado con información precisa y actualizada.
                    </p>

                    <br>
                </div>
            </div>
        </div>
    </header>
    <div class="container px-4 px-lg-5 tituloNuevoEmprendimiento">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0"> Descargar Información De Solicitantes</h2>

                <p class="text-muted mb-5">

                </p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-center mb-3">
            <p class="mensajeError">Seleccionar como filtrar</p>
        </div>
    @endif

    <div class="row gx-4 gx-lg-5 justify-content-center mb-5 centrarFormulario">
        <div class="col-lg-6 solicitantes">

            <form method="GET" action="{{ route('empleos.export') }}">

                <div class="field-group">
                    <input type="text" name="ciudad" id="ciudad" value="{{ request('ciudad') }}">
                    <label for="ciudad">Ciudad:</label>
                </div>

                <div class="field-group">
                    <input type="number" name="edad" id="edad" value="{{ request('edad') }}">
                    <label for="edad">Edad:</label>
                </div>

                <div class="field-group">
                    <input type="date" name="created_at" id="created_at" value="{{ request('created_at') }}">
                    <label for="created_at">Fecha de creación:</label>
                </div>

                <label for="cud">Posee CUD:</label>
                <div class="field-group">
                    <select name="cud" id="cud">
                        <option value="">-- Seleccionar --</option>
                        <option value="1" {{ request('cud') === '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ request('cud') === '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="field-group">
                    <input type="text" name="dni" id="dni" value="{{ request('dni') }}">
                    <label for="dni">DNI:</label>
                </div>

                <div class="field-group">
                    <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}">
                    <label for="nombre">Nombre:</label>
                </div>

                <div class=" d-grid  ">
                    <button class="btn btn-primary btn-xl submit" id="submitButton" type="submit">
                        <span class="btntext""> Descargar Datos </span>

                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.panelAdmin')
    @include('emprendedor.footer')

    @if (session('error'))
        <script>
            window.mensajeError = @json(session('error'));
        </script>
    @endif

    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts3.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/navbar.js') }} "></script>
    <script src="{{ asset('js/logicaSelectLocalidades.js') }} "></script>
    <script src="{{ asset('js/carteles/carteles_error_success.js') }} "></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!--Para las alertas en JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
