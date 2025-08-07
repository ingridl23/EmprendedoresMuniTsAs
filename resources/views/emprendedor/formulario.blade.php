<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Contacto</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sectionredes.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />


</head>

<body id="page-top">

    <!-- ======= Header ======= -->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">

            <div class="container-fluid px-4 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">

                        <!-- Logo y marca -->
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/iconos/oficinaempleodireccioncomercio-02.png') }}"
                                alt="Logo Oficina Empleo" class="logo-img me-2">
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
                                <li class="nav-item serParte">
                                    <a class="nav-link" href="{{ url('/') }}"> Volver Al Inicio </a>

                                <li class="nav-item">
                                    <a class="nav-link"href="{{ url('/programas') }}">Programas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/noticias') }}">Noticias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/emprendedores') }}">Emprendedores</a>
                                </li>


                            </ul>

                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank"
                                    class="get-started-btn crollto">
                                    <div class="get-started-group font-color-bl containerLinksExternos">
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

    <header class="masthead headerFormulario">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Formulario De Contacto</h1>

                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">

                    <h5 class="text-white-75"> ¡Estamos para ayudarte a dar el próximo paso!</h5>
                </div>

            </div>

        </div>
    </header>
    <br>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <img class="divider" src="{{ asset('assets/img/iconos/empleosinfondo.png') }}">
                <h2 class="mt-0"> ¡Unite a los programas vigentes o Contactanos! </h2>

                <p class="text-muted mb-5">
                    Completá el formulario con tus datos y desde la Oficina de Empleo y Capacitación nos pondremos
                    en
                    contacto para
                    que puedas integrarte a las propuestas laborales vigentes
                </p>



            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">

            <div class="col-lg-6">
                {{-- ✅ Mensaje de éxito --}}
                @if (session('success'))
                    <div class="alert alert-success text-center mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-center mb-3">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" class="form" id="contactForm" action="{{ route('formulario.enviar') }}"
                    enctype="multipart/form-data">
                    <!-- Name input-->
                    @csrf
                    <div class="field-group">
                        <input id="name" name="first_name" type="text" required placeholder=""
                            value="{{ old('first_name') }}"></input>
                        @error('first_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <label for="nombre-apellido">Nombre y Apellido <span class="asterisco">*</span></label>
                        <p class="form-subtitulos">Otorgar al menos un nombre y un apellido</p>
                    </div>
                    <!-- asunto input-->
                    <div class="field-group">
                        <input id="asunto" name="asunto" type="text" required placeholder=""
                            value="{{ old('asunto') }}"></input>
                        @error('asunto')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <label for="asunto">Asunto<span class="asterisco">*</span></label>
                        <p class="form-subtitulos">Otorgar asunto del email</p>
                    </div>




                    <!--input email-->

                    <div class="field-group">

                        <input id="email" name="email" type="email" required placeholder=""
                            value="{{ old('email') }}"></input>
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <label for="message">Email <span class="asterisco">*</span></label>
                        <p class="form-subtitulos">Otorgar un email de uso frecuente</p>
                    </div>


                    <!--input telefono -->

                    <div class="field-group">
                        <input type="telefono" id="phone" name="tel" required placeholder=""
                            value="{{ old('tel') }}"></input>

                        @error('tel')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <label for="telefono">Teléfono<span class="asterisco">*</span></label>
                        <p class="form-subtitulos">Otorgar un número de teléfono </p>
                    </div>








                    <!-- opciones tipo radio para empresa, emprendedor o búsqueda de empleo -->
                    <label for="subconjuntos">Seleccionar grupo <span class="asterisco">*</span></label>
                    <div class="field-group  group-subconjuntos">

                        <div class="opcion-radio">
                            <input type="radio" id="esEmpresa" name="subconjuntos" value="empresa"
                                {{ old('subconjuntos') == 'empresa' ? 'checked' : '' }} required>
                            <h6>Soy una empresa</h6>
                        </div>

                        <div class="opcion-radio">
                            <input type="radio" id="esEmprendedor" name="subconjuntos" value="emprendedor"
                                {{ old('subconjuntos') == 'emprendedor' ? 'checked' : '' }}>
                            <h6>Soy un emprendedor</h6>
                        </div>

                        <div class="opcion-radio">
                            <input type="radio" id="buscaEmpleo" name="subconjuntos" value="busqueda de empleo"
                                {{ old('subconjuntos') == 'busqueda de empleo' ? 'checked' : '' }}>
                            <h6>Busco empleo</h6>
                        </div>

                        @error('subconjuntos')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="parrafo">
                        <p class="form-subtitulos">Seleccionar una opción</p>
                    </div>

                    <!-- campo para descripción,  visible para los tres grupos -->
                    <div id="campo-descripcion" class="field-group">
                        <textarea id="descripcion" name="description" required placeholder="">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror

                        <label for="descripcion">Dar una <strong>breve</strong> descripcion sobre la experiencia
                            laboral o consulta <span class="asterisco">*</span></label>
                        <p class="form-subtitulos">Otorgue una breve descripción respecto al negocio o experiencia</p>
                    </div>


                    <!-- grupo empresa-->
                    <!-- campo para el nombre de la empresa,  visible para solo empresa -->
                    <div id="grupo-empresa" style="display: none;">

                        <div class="field-group">

                            <textarea id="nombre_empresa" name="nombre_empresa" required placeholder="">{{ old('nombre_empresa') }}</textarea>

                            @error('nombre_empresa')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="nombre-empresa">Ingresar el nombre de la empresa <span
                                    class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar el nombre de la empresa</p>
                        </div>

                    </div>

                    <!--GRUPO EMPRENDEDOR -->

                    <!-- opciones tipo radio visible para  emprendedor-->
                    <div id="grupo-emprendedor" style="display: none;">

                        <label for="club_emprendedor">Club De Emprendedores
                            <span class="asterisco">*</span></label>


                        <div class="field-group  group-subconjuntos">

                            <div class="opcion-radio">
                                <input type="radio" id="club-si" name="club_emprendedor" value="inscripto"
                                    required {{ old('club_emprendedor') == 'inscripto' ? 'checked' : '' }}>
                                <h6>Ya soy parte del club</h6>
                            </div>

                            <div class="opcion-radio">
                                <input type="radio" id="club-no" name="club_emprendedor" value="noinscripto"
                                    required {{ old('club_emprendedor') == 'noinscripto' ? 'checked' : '' }}>
                                <h6>Quiero ser parte del club</h6>
                            </div>


                            @error('club_emprendedor')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            <div class="parrafo">
                                <p class="form-subtitulos">Seleccionar una opción</p>
                            </div>
                        </div>
                    </div>



                    <!-- GRUPO BUSQUEDA DE EMPLEO-->

                    <div id="grupo-empleo" style="display: none;">

                        <!-- campo para ingresar la edad, visible solo si busca empleo -->
                        <div class="field-group">
                            <input type="number" id="edad" name="edad">
                            <label for="edad">Ingresar Edad <span class="asterisco">*</span></label>

                            @error('edad')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <p class="form-subtitulos">Ingrese su edad</p>
                        </div>


                        <!-- campo para ingresar el dni, visible solo si busca empleo -->
                        <div class="field-group">
                            <input type="number" id="dni" name="dni">
                            <label for="dni">Ingresar DNI <span class="asterisco">*</span></label>

                            @error('dni')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <p class="form-subtitulos">Ingrese su dni sin espacios ni puntos</p>
                        </div>



                        <!-- campo para ingresar la ciudad y localidad , visible solo si busca empleo -->

                        <div class="field-group">
                            <label for="ciudad" class="direccionEmprendimiento">Ciudad <span
                                    class="asterisco">*</span></label>

                            <select id="ciudad" class="ciudad-select" name="ciudad" required>
                                <option class="oculto " {{ !isset($emprendimiento) ? 'selected' : '' }}></option>
                                <option
                                    {{ old('ciudad', $emprendimiento->direccion->ciudad ?? '') == 'Tres Arroyos' ? 'selected' : '' }}>
                                    Tres Arroyos
                                </option>
                                <option
                                    {{ old('ciudad', $emprendimiento->direccion->ciudad ?? '') == 'Adolfo Gonzales Chaves' ? 'selected' : '' }}>
                                    Adolfo Gonzales Chaves
                                </option>
                                <option
                                    {{ old('ciudad', $emprendimiento->direccion->ciudad ?? '') == 'Benito Juarez' ? 'selected' : '' }}>
                                    Benito Juarez
                                </option>
                            </select>
                            @error('ciudad')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--localidades grupo-->
                        <div class="field-group">
                            <label for="localidad" class="direccionEmprendimiento localidad">Localidad <span
                                    class="asterisco">*</span></label>
                            <select id="localidadesDeLaCiudad" name="localidad" required>
                                <option value="" disabled selected>Seleccione una localidad</option>
                                @if (old('localidad') || isset($emprendimiento))
                                    <option
                                        value="{{ old('localidad', $emprendimiento->direccion->localidad ?? '') }}"
                                        selected hidden>
                                        {{ old('localidad', $emprendimiento->direccion->localidad ?? '') }}
                                    </option>
                                @endif
                            </select>
                            @error('localidad')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- opciones tipo radio visible para  solo si busca empleo-->
                        <label style="display: none;" for="formacion">Formacion Alcanzada <span
                                class="asterisco grupo-empleo">*</span></label>
                        <div class="field-group  group-subconjuntos">

                            <div class="opcion-radio">
                                <input type="radio" id="formacion-primario" name="formacion" value="primario"
                                    required {{ old('formacion') == 'primario' ? 'checked' : '' }}>
                                <h6>Primario completo</h6>
                            </div>

                            <div class="opcion-radio">
                                <input type="radio" id="formacion-primario" name="formacion" value="secundario"
                                    required {{ old('formacion') == 'secundario' ? 'checked' : '' }}>
                                <h6>Secundario completo</h6>
                            </div>
                            <div class="opcion-radio">
                                <input type="radio" id="formacion-primario" name="formacion" value="terciario"
                                    required {{ old('formacion') == 'terciario' ? 'checked' : '' }}>
                                <h6>terciario completo</h6>
                            </div>
                            <div class="opcion-radio">
                                <input type="radio" id="formacion-primario" name="formacion" value="curso"
                                    required {{ old('formacion') == 'curso' ? 'checked' : '' }}>
                                <h6>Curso/s completo/s</h6>
                            </div>
                            @error('formacion')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="parrafo">
                            <p class="form-subtitulos">Seleccionar una opción</p>
                        </div>
                        <!-- campo para nombre del curso realizado, visible solo si busca empleo -->
                        <div id="campo-nombre-curso" style="display: none;">
                            <div class="field-group">
                                <textarea id="nombre_curso" name="nombre_curso" required placeholder="">{{ old('nombre_curso') }}</textarea>

                                @error('nombre_curso')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                                <label for="nombre-curso">Nombre del curso laboral que finalizó
                                    <span class="asterisco">*</span></label>
                                <p class="form-subtitulos">Otorgar nombre/s del título/s de sus estudios</p>
                            </div>
                        </div>

                        <!-- campo para la referencia laboral,  visible para solo si busca empleo -->
                        <div class="field-group">
                            <textarea id="referencia-laboral" name="referencia_laboral" required placeholder="">{{ old('referencia_laboral') }}</textarea>

                            @error('referencia_laboral')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="nombre_curso">Referencia laboral
                                <span class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar nombre/s del negocio o empresa en el que trabajó</p>
                        </div>


                        <!-- campo para la referencia laboral rubro ,  visible para solo si busca empleo -->
                        <div class="field-group">
                            <input type="text" id="referencia-rubro" name="referencia_rubro" required
                                placeholder="">{{ old('referencia-rubro') }}</input>

                            @error('referencia-rubro')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="referencia-rubro">Referencia rubro
                                <span class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar nombre/s del rubro en el que trabajó</p>
                        </div>


                        <!-- campo para la referencia laboral actividad realizada ,  visible para solo si busca empleo -->
                        <div class="field-group">
                            <input type="text" id="referencia-actividad" name="referencia_actividad" required
                                placeholder="">{{ old('referencia-actividad') }}</textarea>

                            @error('referencia-actividad')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="referencia-actividad">Referencia de actividad
                                <span class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar actividad/es realizada/s en el lugar donde trabajó</p>
                        </div>



                        <!-- campo para la referencia del nombre del contratista   ,  visible para solo si busca empleo -->
                        <div class="field-group">
                            <input type="text" id="contratista" name="contratista" required
                                placeholder="">{{ old('contratista') }}</input>

                            @error('contratista')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="contratista">Nombre de la persona de referencia
                                <span class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar nombre del contratista del lugar donde trabajó</p>
                        </div>




                        <!-- campo para la referencia telefonica,  visible para solo si busca empleo -->
                        <div class="field-group">
                            <input type="number" id="referencia-telefonica" name="referencia_telefonica" required
                                placeholder="">{{ old('referencia-telefonica') }}</input>

                            @error('referencia-telefonica')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="nombre-telefonica">Referencia telefonica
                                <span class="asterisco">*</span></label>
                            <p class="form-subtitulos">Otorgar nombre/s del negocio o empresa en el que trabajó</p>
                        </div>


                        <!-- opciones tipo radio  si posee certificado de discapacidad, visible para  solo si busca empleo-->
                        <labelfor="cud">¿ Posee CUD? <span class="asterisco">*</span></label>
                        <div class="field-group  group-subconjuntos">

                            <div class="opcion-radio">
                                <input type="radio" id="cud-true" name="cud" value="true"
                                    {{ old('cud') == 'true' ? 'checked' : '' }} required>
                                <h6>poseo CUD</h6>
                            </div>

                            <div class="opcion-radio">
                                <input type="radio" id="cud-false" name="cud" value="false" placeholder=""
                                    {{ old('cud') == 'false' ? 'checked' : '' }}required>
                                <h6>No poseo CUD</h6>
                            </div>
                            <div class="opcion-radio">

                                @error('cud')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="parrafo">
                            <p class="form-subtitulos">Seleccionar si posee certificado unico de discapacidad
                            </p>
                        </div>

                        <!-- opciones tipo radio  si  trabaja en dependencia, visible para  solo si busca empleo-->
                        <label for="dependencia">¿ Trabaja en relacion de
                            dependencia?<span class="asterisco">*</span></label>
                        <div class="field-group  group-subconjuntos">

                            <div class="opcion-radio">
                                <input type="radio"id="dependencia-true" name="dependencia" value="true"
                                    {{ old('dependencia') == 'true' ? 'checked' : '' }} required>
                                <h6>Si,en relacion de dependencia</h6>
                            </div>

                            <div class="opcion-radio">
                                <input type="radio" id="dependencia-false" name="dependencia" value="false"
                                    placeholder="" {{ old('dependencia') == 'false' ? 'checked' : '' }}required>
                                <h6>No, de forma independiente</h6>
                            </div>
                            <div class="opcion-radio">

                                @error('dependencia')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="parrafo">
                            <p class="form-subtitulos">Seleccionar una opcion</p>
                        </div>



                        <!-- campo para cargar CV, visible solo si busca empleo -->
                        <div class="field-group">
                            <input type="file" id="cv" name="cv" accept=".pdf">
                            <label for="cv">Cargar currículum vitae <span class="asterisco">*</span></label>

                            @error('cv')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <p class="form-subtitulos">Subir currículum vitae en formato PDF</p>
                        </div>

                    </div> <!--cierre div de grupo busqueda empleo -->


                    <!-- input oculto de control -->

                    <input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off"
                        value="">

                    <!-- Submit Button-->
                    <div class=" d-grid  ">
                        <button class=" submit btn btn-primary btn-xl" id="submitButton" type="submit">
                            <span class="btntext"> Enviar
                                Formulario </span>
                        </button>


                    </div>


                </form>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <a href="https://wa.me/2983603748?text=¡Hola, contactanos a traves de nuestro whatsapp, muchas gracias , oficina de cultura"
        class="whatsapp-float" target="_blank" rel="noopener">

        <img class="whatsapp" src="{{ asset('assets/img/iconos/whatsapp.png') }}">
    </a>


    @include('layouts.sectionredes')
    @include('emprendedor.footer')


    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/scripts3.js') }}"></script>
    <script src="{{ asset('js/validacionSubconjuntos.js') }}"></script>


    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>



</html>
