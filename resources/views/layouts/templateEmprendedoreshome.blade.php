<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>tres arroyos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />

    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />


</head>

<body id="page-top">
    <!-- Navigation-->




    <!-- barra de navegacion -->
    @include('emprendedor.navBar')



    <!--  ********************************************************************* -->



    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Emprendedores Culturales De Tres Arroyos </h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Esta sección está dedicada a visibilizar y apoyar a todos los
                        emprendedores que forman parte del ecosistema cultural del Municipio de Tres Arroyos.
                        Aquí encontrarás historias, productos y proyectos que reflejan el talento, la identidad y la
                        creatividad de nuestra comunidad.</p>

                    <p class="text-white-75 mb-5">Si formás parte de la Dirección de Cultura y tenés un emprendimiento,
                        ¡este es tu lugar! </p>
                    <a class="btn btn-primary btn-xl" href="#contact">Quiero Ser Parte</a>

                </div>

            </div>

        </div>
    </header>




    <!-- About-->
    <section class="page-section custom-about" id="about">


        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">¿Quiénes pueden participar?</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">


                        Emprendedores que formen parte de la Dirección de Cultura del Municipio.</li>
                        Personas o colectivos que promuevan productos o servicios vinculados a la identidad local.

                        Proyectos que reflejen valores culturales, artísticos o comunitarios.</li>

                    </p>
                    <a class="btn btn-light btn-xl" href="#services">Ver Mas</a>
                </div>
            </div>
        </div>



    </section>
    <!-- Services-->
    <section class="page-section section-services" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Apoyamos el talento local, visibilizamos el trabajo cultural</h2>
            <hr class="divider" />

            <!--
                                                                                                                                                        <div class="row gx-4 gx-lg-5">
                                                                                                                                                            <div class="col-lg-3 col-md-6 text-center">
                                                                                                                                                                <div class="mt-5">
                                                                                                                                                                    <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                                                                                                                                                                    <h3 class="h4 mb-2">Sturdy Themes</h3>
                                                                                                                                                                    <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        -->

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 text-center seccion-tenes-emprendimiento">
                    <div class="mt-5">
                        <div class="mb-2"><i
                                class="fa-solid fa-laptop fs-1 text-primary  style="color:#004d4d!important;"></i>
                        </div>
                        <h3 class="h4 mb-2">¿Tenes un emprendimiento?</h3>
                        <p class="text-muted mb-0">Si sos parte de la Dirección de Cultura, podés sumarte a esta
                            iniciativa para difundir tu proyecto.</p>
                    </div>
                </div>
            </div>


    </section>
    <!-- Portfolio-->
    <div id="portfolio">
        <div class="container-fluid p-0">
            <div class="row g-0">

                @yield('content')

                <!--esto se va y solo quedaria el foreach para traer las 6 imagenes -->
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Emprendedor</div>
                        </div>
                    </a>
                </div>


                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/4.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/5.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/5.jpg" alt="..." />
                        <div class="portfolio-box-caption">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="assets/img/portfolio/fullsize/6.jpg" title="Project Name">
                        <img class="img-fluid" src="assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                        <div class="portfolio-box-caption p-3">
                            <div class="project-category text-white-50">Category</div>
                            <div class="project-name">Project Name</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>




    <!-- Call to action-->
    <section class="page-section text-white" style="background-color: #d63333 !important;">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">¡Conocé a nuestros emprendedores que ya son parte!</h2>
            <a class="btn btn-light btn-xl" href="{{ url('/emprendedores') }}">Ver Más</a>
        </div>
    </section>








    <!-- Contact-->
    <section class="page-section" id="contact" style="background-color: white">

        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <img class="divider" src="assets//img/logocultura.png">
                    <h2 class="mt-0"> Unite como emprendedor</h2>
                    <p class="text-muted mb-5">
                        Completá el formulario con tus datos y desde la Oficina de Cultura nos pondremos en
                        contacto para que puedas integrarte a esta valiosa propuesta.

                    </p>

                    {{-- ✅ Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success text-center mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ✅ Errores generales --}}
                    @if ($errors->any())
                        <div class="alert alert-danger text-start mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>


            <div class="row gx-4 gx-lg-5 justify-content-center mb-5" id="page-top">

                <div class="col-lg-6">

                    <form method="POST" class="form" id="contactForm" action="{{ route('formulario.enviar') }}">
                        <!-- Name input-->
                        @csrf
                        <div class="field-group">

                            <input id="name" name="first_name" type="text" placeholder="" required></input>

                            @error('first_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                            <label class="message" for="message">Nombre y Apellido</label>
                            <p class="form-subtitulos">Otorgue al menos un nombre y un apellido</p>
                        </div>

                        <!--inpt email-->

                        <div class="field-group">

                            <input id="email" name="email" type="email" placeholder="" required></input>


                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                            <label class="message" for="message">Email</label>
                            <p class="form-subtitulos">Registre un email que utilice frecuentemente</p>
                        </div>


                        <!--input telefono -->

                        <div class="field-group">

                            <input type="tel" id="phone" name="tel" placeholder="" required></input>


                            @error('tel')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label class="message" for="message">Telefono</label>
                            <p class="form-subtitulos">Otorgue un numero de telefono de uso frecuente</p>
                        </div>

                        <!-- input descripcion -->
                        <div class="field-group">

                            <textarea id="descripcion" name="description" type="text" placeholder="" required></textarea>

                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                            <label class="message" for="message">Describa brevemente su emprendimiento</label>
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

                            <p>Complete los campos obligatorios</p>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        </div>

    </section>


    @include('layouts.panelAdmin')




    <!-- barra de navegacion footer -->
    @include('emprendedor.footer')

    <!-- Bootstrap core JS-->
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/logicaform.js') }} "></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>


</html>
