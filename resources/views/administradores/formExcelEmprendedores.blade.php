<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>filtrar emprendedores vigentes</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
</head>

<body>

    @include('emprendedor.navBar')

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Filtrar los datos que sean necesarios de emprendedores
                        vigentes
                    </h1>
                    <hr class="divider" style="background-color: white" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        Desde esta sección del panel de administración, podés filtrar y descargar los datos de los
                        emprendimientos cargados en la plataforma.
                        Es posible descargar información en formato hoja de calculo.
                        Tambien seleccionar el campo por el que quiere obtener el documento a descargar, como
                        nombre del emprendimiento ,fecha de publicacion y categoria.
                        De esa forma obtiene el documento generado ordenado con información precisa y actualizada.
                    </p>

                    <br>
                </div>
            </div>
        </div>
    </header>
    <div class="container px-4 px-lg-5 tituloNuevoEmprendimiento">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0"> Descargar Información De Emprendedores</h2>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-center mb-3">
            <p class="mensajeError">Seleccionar como filtrar</p>
        </div>
    @endif

    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
        <div class="col-lg-6 solicitantes">

            <form method="GET" action="{{ route('emprendedores.export') }}">

                <div class="field-group">
                    <input type="text" name="nombreEm" id="nombreEm" value="{{ request('nombreEm') }}">
                    <label for="nombreEm">Nombre del emprendimiento:</label>
                </div>



                <div class="field-group">
                    <input type="date" name="created_at" id="created_at" value="{{ request('created_at') }}">
                    <label for="created_at">Fecha de publicacion:</label>
                </div>

                <label for="descripcion">Seleccionar Categoria<span class="asterisco">*</span></label>
                <div class="field-group">


                    <select name="categoria">
                        <option value="">-- Seleccionar Categoría --</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <input type="text" name="ciudad" id="ciudad" value="{{ request('ciudad') }}">
                    <label for="ciudad">Ciudad:</label>
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


    <!-- Bootstrap core JS-->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts3.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/navbar.js') }} "></script>
    <script src="{{ asset('js/logicaSelectLocalidades.js') }} "></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
