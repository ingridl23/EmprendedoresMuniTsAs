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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Navigation-->

    <!--aca va incluide component navbar -->


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
                <br>
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
                        <div class="mb-2"><i class="fa-solid fa-laptop fs-1 text-primary  style="color:
                                #004d4d!important;"></i>
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
    <section class="page-section text-white" style="background-color: #d63384 !important;">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">¡Conocé a nuestros emprendedores que ya son parte!</h2>
            <a class="btn btn-light btn-xl" href="{{ url('/emprendedores') }}">Ver Más</a>
        </div>
    </section>








    <!-- Contact-->
    <section class="page-section" id="contact">

        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0"> Unite como emprendedor</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5">
                        Completá el formulario con tus datos y desde la Oficina de Cultura nos pondremos en
                        contacto para que puedas integrarte a esta valiosa propuesta.

                    </p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">

                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Name input-->


                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text"
                                placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Nombre y apellido (nombre completo)</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">completa con al menos un
                                nombre y un
                                apellido.</div>
                        </div>
                        <!-- Email address input-->

                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com"
                                data-sb-validations="required,email" />
                            <label for="email">Correo electronico</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">ingresa un correo que uses
                                con regularidad.
                            </div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">ingresa un email valido
                                (ejemplo : @example.com).</div>
                        </div>
                        <!-- Phone number input-->

                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890"
                                data-sb-validations="required" />
                            <label for="phone">Numero de telefono</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">ingresa un numero de
                                telefono que manejes diariamente</div>
                        </div>
                        <!-- Message input-->

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..."
                                style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Describe brevemente tu emprendimiento y a que te dedicas.</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required"> Completa con una breve
                                presentacion sobre tu emprendimiento.
                            </div>
                        </div>
                        <!-- Submit success message-->

                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->

                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Enviado exitosamente!</div>
                                Gracias por completar el formulario, estamos felices que quieras ser parte de esta gran
                                iniciativa.
                                En la brevedad nos comunicaremos con vos para que puedas formar parte.
                                <br />
                                <a
                                    href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->

                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Ocurrio un error al enviar tu respuesta, verifica
                                que tengas conexion o que
                                se hayan ingresado los datos correctamente
                            </div>
                        </div>
                        <!-- Submit Button-->

                        <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton"
                                type="submit">Enviar Peticion</button></div>
                    </form>
                </div>
            </div>

        </div>

    </section>

    <!-- barra de navegacion footer -->
    @include('emprendedor.footer')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>


</html>
