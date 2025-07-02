<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>formulario</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />

    <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />


</head>
<!-- header de la section del form -->



<body>
    <!-- ======= Header ======= -->
    <div class="custom-navbar-container">
        <header id="header" class="fixed-top header-scrolled">
            <div class="container-fluid px-4 container">
                <!-- Navbar principal -->
                <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
                    <div class="container px-4 px-lg-5 d-flex align-items-center justify-content-between">
                        <!-- Logo y marca -->
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <img src="\EmprendedoresMuniTsAs\public\assets\img\logo-muni-azul-claro-removebg-preview.png"
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
                                    <a class="nav-link" href="{{ url('/') }}"> Volver Al Inicio </a>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/emprendedores') }}">Emprendedores</a>
                                </li>

                            </ul>

                            <!-- Botones de servicios externos -->
                            <div class="get-started-buttons d-flex align-items-center">
                                <a href="https://mitresa.gobdigital.com.ar/web/default" target="_blank" class"
                                    get-started-btn crollto" class="get-started-btn">
                                    <div class="get-started-group font-color-bl">
                                        <img src="\EmprendedoresMuniTsAs\public\assets\img\MiTr-remove-removebg-preview.png"
                                            slt class=" img-btn-logonav img-fluid mb-1">
                                        <span class="btn-text">MiTresa</span>
                                    </div>
                                </a>

                                <a href="https://autogestion.tresarroyos.gov.ar/" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fa-solid fa-laptop servicio-icono"
                                            style="color: rgb(38, 92, 172)"></i>
                                        <span class="btn-text">Autogestion</span>

                                    </div>
                                </a>

                                <a href="https://www.tresarroyos.gov.ar/transparencia-fiscal" target="_blank"
                                    class="get-started-btn scrollto">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fas fa-lock-open  img-btn-logonav servicio-icono"
                                            style="color: rgb(38, 92, 172)">

                                        </i>
                                        <span class="btn-text">Gobierno<br>Abierto</span>
                                    </div>
                                </a>

                                <a href="{{ url('/showlogin') }}" target="_blank"
                                    class="get-started-btn scrollto btn-contact">
                                    <div class="get-started-group font-color-bl">
                                        <i class="fa fa-user-circle img-btn-logonav servicio-icono  ">

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
    <!-- fin de la seccion  -->

    <br>
    <br>
    <br>
    <br>



    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <img class="divider" src="\EmprendedoresMuniTsAs\public\assets\img\logocultura.png">
                <h2 class="mt-0"> Unite como emprendedor</h2>

                <p class="text-muted mb-5">
                    Completá el formulario con tus datos y desde la Oficina de Cultura nos pondremos en contacto para
                    que
                    puedas integrarte a esta valiosa propuesta.

                </p>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">

            <div class="col-lg-6">

                <form method="post" class="form" id="contactForm" action="{{ route('formulario.enviar') }}">
                    <!-- Name input-->
                    @csrf
                    <div class="field-group">

                        <input id="name" name="first_name" type="text" required placeholder=""></input>

                        <label for="message">Nombre y Apellido</label>
                        <p class="form-subtitulos">Otorgue al menos un nombre y un apellido</p>
                    </div>

                    <!--input email-->

                    <div class="field-group">

                        <input id="email" name="email" type="email" required placeholder=""></input>






                        <label for="message">Email</label>
                        <p class="form-subtitulos">Registre un email que utilice frecuentemente</p>
                    </div>


                    <!--input telefono -->

                    <div class="field-group">

                        <input type="tel" id="phone" name="tel" required placeholder=""></input>




                        <label for="message">Telefono</label>
                        <p class="form-subtitulos">Otorgue un numero de telefono de uso frecuente</p>
                    </div>

                    <!-- input descripcion -->
                    <div class="field-group">

                        <textarea id="descripcion" name="description" type="text" required placeholder=""></textarea>


                        <label for="message">Describa Brevemente Su Emprendimiento</label>
                        <p class="form-subtitulos">Escriba una descripcion a continuacion</p>
                    </div>

                    <!-- input oculto -->

                    <input type="text" id="oculto" name="oculto" class="oculto" autocomplete="off"
                        value="">

                    <!-- Submit Button-->
                    <div class=" d-grid  ">
                        <button class=" submit btn btn-primary btn-xl" id="submitButton" type="submit">

                            <span class="btntext"> Enviar
                                Peticion </span>


                        </button>


                    </div>

                </form>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    @include('emprendedor.footer')


    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/scripts3.js') }}"></script>



    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>



</html>
