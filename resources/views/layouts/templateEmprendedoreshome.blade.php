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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleslogin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sectionredes.css') }}" rel="stylesheet" />
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
                    <h1 class="text-white font-weight-bold">Bienvenidos a la Oficina de Empleo y Capacitación de Tres
                        Arroyos </h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 ">
                        Desde la Oficina de Empleo y Capacitación de Tres Arroyos trabajamos diariamente para acompañar
                        a quienes buscan oportunidades laborales y
                        a quienes desean mejorar sus habilidades a través de la formación.</p>

                    <p class="text-white-75 ">
                        Nuestro objetivo es ser el vínculo entre quienes buscan trabajo y las empresas que necesitan
                        incorporar talento local, promoviendo la inclusión laboral,
                        el desarrollo profesional y el crecimiento de nuestra comunidad.

                    </p>

                    <h5 class="text-white-75"> ¡Estamos para ayudarte a dar el próximo paso!</h5>
                    <br>

                    <a class="btn btn-light btn-xl btn-xl" href="#contact">Quiero Ser Parte</a>

                </div>

            </div>

        </div>
    </header>




    <!-- About-->
    <section class="page-section custom-about" id="about">


        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="text-white-75 mb-5">Contamos con programas, beneficios e incentivos para contratar y
                        capacitar a nuevo personal, además de brindar información útil para propietarios, referentes de
                        empresas y áreas de Recursos Humanos. </p>

                    <p class="text-white-75 mb-5">Te invitamos a recorrer nuestra página y a sumarte a esta red de
                        oportunidades.

                    </p>

                    <h2 class="text-white mt-0">¿Quiénes pueden participar?</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 ">


                    <details class="details btn btn-light">
                        <p> Este programa forma parte de las acciones promovidas por el Municipio de Tres Arroyos,
                            para el desarrollo local y el apoyo a emprendimientos que sean sustentables en el mediano y
                            largo plazo y que aporten al crecimiento productivo de la región.

                            Se tiene como objetivo general potenciar el desarrollo de las micro y pequeñas empresas, así
                            como el apoyo a nuevos emprendimientos.
                        </p>

                    </details>
                    </p>

                </div>
            </div>
        </div>


        <!--  btn-xl-->
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

            <div class="row justify-content-center  align-baseline">
                <div class="col-lg-6 col-md-6 text-center seccion-tenes-emprendimiento">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary  style="color:#004d4d!important;"></i>
                        </div>
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/empleador.png" class="divider">
                        <h3 class="h4 mb-2">¿Sos empleador?</h3>
                        <p class="text-muted mb-0">podrás asesorarte acerca de los programas de empleo y capacitacion
                            vigentes.</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 text-center seccion-tenes-emprendimiento">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary  style="color:#004d4d!important;"></i>
                        </div>
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/analitica.png" class="divider">
                        <h3 class="h4 mb-2">¿Tenes un emprendimiento?</h3>
                        <p class="text-muted mb-0">Brindamos asistencia técnica y financiera para quienes quieran
                            iniciar un emprendimiento o reforzar uno existente.</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 text-center seccion-tenes-emprendimiento">
                    <div class="mt-5">
                        <div class="mb-2"><i class=" fs-1 text-primary  style="color:#004d4d!important;"></i>
                        </div>
                        <br>
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/curriculum-vitae.png" class="divider">
                        <h3 class="h4 mb-2">¿Te encontras en busqueda de empleo?</h3>

                        <p class="text-muted mb-0">recibimos tu CV y llevamos adelante acciones para la búsqueda de
                            empleo y la intermediación laboral.</p>
                    </div>
                </div>



            </div>


    </section>


    <br>


    <h1>aca va informacion de programa</h1>



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
    <section class="page-section text-white" style="background-color: #25e9a7 !important;">
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
                    <img class="divider" src="assets//img/empleosinfondo.png">
                    <h2 class="mt-0"> Unite a los programas vigentes</h2>
                    </h2>
                    <p class="text-muted mb-5">
                        Completá el formulario con tus datos y desde la Oficina de Empleo y capacitacion nos pondremos
                        en
                        contacto para
                        que puedas integrarte a esta valiosa propuesta.


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

                            <input id="name" name="first_name" type="text" required placeholder=""
                                value="{{ old('first_name') }}"></input>

                            @error('first_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                            <label class="message" for="message">Nombre y Apellido</label>
                            <p class="form-subtitulos">Otorgue al menos un nombre y un apellido</p>
                        </div>

                        <!--inpt email-->

                        <div class="field-group">

                            <input id="email" name="email" type="email" required placeholder=""
                                value="{{ old('email') }}"></input>


                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                            <label class="message" for="message">Email</label>
                            <p class="form-subtitulos">Registre un email que utilice frecuentemente</p>
                        </div>


                        <!--input telefono -->

                        <div class="field-group">

                            <input type="tel" id="phone" name="tel" required placeholder=""
                                value="{{ old('tel') }}"></input>


                            @error('tel')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label class="message" for="message">Telefono</label>
                            <p class="form-subtitulos">Otorgue un numero de telefono de uso frecuente</p>
                        </div>

                        <!-- input descripcion -->
                        <div class="field-group">

                            <textarea id="descripcion" name="description" type="text" required placeholder=""
                                value="{{ old('description') }}"></textarea>

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
                            <button class="submit btn btn-primary btn-xl" id="submitButton" type="submit">

                                <span class="btntext"> Enviar
                                    Peticion </span>


                            </button>


                        </div>

                    </form>
                </div>
            </div>

        </div>

        </div>

    </section>

    @include('layouts.sectionredes')


    @include('layouts.panelAdmin')


    <a href="https://wa.me/2983603748?text=¡Hola, contactanos a traves de nuestro whatsapp, muchas gracias , oficina de empleo"
        class="whatsapp-float" target="_blank" rel="noopener">

        <img class="whatsapp" src="assets/img/whatsapp.png">
    </a>



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
