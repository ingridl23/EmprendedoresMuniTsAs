<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>programas-oficina-de-empleo</title>
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
    <link href="{{ asset('css/navbar2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/programas.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />


</head>

<body>
    @include('emprendedor.navbar')

    <div class=" container-programas ">

        <h1 class="titulo1"> Conoce Los Programas Vigentes</h1>

        <h2 class="subtitulo1">Programas Para Emprendedores</h2>

        <div class="programas">
            <h3 class="subtitulo">Club De Emprendedores</h3>

            <p class="text-clubs">
                El Club de Emprendedores es una iniciativa de la Oficina de Empleo y Capacitación de Tres Arroyos que
                funciona como un espacio de encuentro, acompañamiento y crecimiento para emprendedores y PyMEs locales.

                Este club ofrece un ámbito físico de reuniones periódicas entre sus miembros, donde se generan vínculos
                entre los distintos actores del ecosistema productivo local y se fomenta la conexión con instituciones
                municipales, provinciales y nacionales.


            </p>

            <ul>
                <h3 class="subtitulo">Objetivos y Acciones</h3>
                <li>Ampliar la base emprendedora mediante actividades de sensibilización y promoción para diversos
                    públicos.
                </li>
                <li>Identificar emprendimientos de alto impacto para potenciar el desarrollo económico y social del
                    distrito.</li>
                <li>Proveer apoyo estratégico con herramientas, capacitaciones, redes de contacto y asistencia técnica,
                    articulando con instituciones si es necesario.</li>
                <li>Acompañar y orientar a personas con ideas o proyectos en marcha, ofreciendo una escucha activa y
                    guía
                    clara para fortalecer sus iniciativas.</li>
                <li> Informar, planificar y organizar eventos que involucren al sector emprendedor local, con aval y
                    acompañamiento del Municipio.</li>
            </ul>


            <ul>
                <h3 class="subtitulo">Beneficios para los miembros</h3>
                <li>Participación en la Mesa de Emprendedores:
                    Reuniones periódicas con otros miembros activos para compartir ideas, planificar acciones y acceder
                    a
                    información relevante.</li>
                <li>Acceso y planificación de Ferias de Emprendedores:
                    Oportunidad de formar parte de la organización y exposición en ferias locales para dar visibilidad a
                    los
                    proyectos.</li>
                <li>Asesoramiento en habilitación comercial:
                    Contacto directo con autoridades municipales para gestionar correctamente la habilitación de
                    comercios.
                </li>
                <li>Asesoramiento en registro de productos alimenticios:
                    Orientación y acompañamiento para registrar productos de manera legal y cumplir con los requisitos
                    sanitarios y normativos.</li>
            </ul>


            <!--seccioon carrousel clubs emprendedores -->
            <div id="carouselExampleInterval" class="carousel slide carrousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/clubemprendedores/foto1.jpg"
                            class="d-block w-100" alt="...">

                    </div>


                    <div class="carousel-item">
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/clubemprendedores/foto2.jpg"
                            class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/clubemprendedores/foto3.jpg"
                            class="d-block w-100" alt="...">
                    </div>


                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>


        <!-- pie de carrousel -->
        <p class="text-clubs">
            Desde la Oficina de Empleo y Capacitación reafirmamos nuestro compromiso de impulsar el
            emprendedurismo local, promoviendo espacios colaborativos, construyendo redes de apoyo y generando más y
            mejores oportunidades para quienes apuestan a crecer en nuestra comunidad.
        </p>

        <p class="text-clubs"> Contactanos y sumate a esta comunidad en acción.
            ¿Querés ser parte del Club de Emprendedores?</p>






        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">



                    <!--esto se va y solo quedaria el foreach para traer las 6 imagenes -->
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Project Name">
                            <img class="img-fluid"
                                src="/EMPRENDEDORESMUNITSAS/public/assets/img/portfolio/thumbnails/2.jpg"
                                alt="..." />
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




            <!-- Call to action-->
            <section class="page-section text-white" style="background-color: #25e9a7 !important;">
                <div class="container px-4 px-lg-5 text-center">
                    <h2 class="mb-4">¡Conocé a nuestros emprendedores que ya son parte!</h2>
                    <a class="btn btn-light btn-xl" href="{{ url('/emprendedores') }}">Ver Más</a>
                </div>
            </section>
        </div>










        <div class="programas">
            <h3 class="subtitulo">Escuela de Emprendedores</h3>
            <h4>Formación y acompañamiento para el desarrollo emprendedor</h4>
            <p class="text-clubs">
                La Escuela de Emprendedores es un programa diseñado para formar, asesorar y acompañar a quienes
                están
                iniciando
                o quieren profesionalizar su emprendimiento.

                Esta iniciativa busca generar un espacio de intercambio, brindando herramientas prácticas para la
                gestión de
                proyectos, estrategias de negocio,
                análisis de mercado y planificación financiera.


            </p>


            <!--seccioon carrousel capacitaciones emprendedores -->
            <div id="carouselExampleInterval" class="carousel slide carrousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/clubemprendedorescapacitaciones/fotocap1.jpg"
                            class="d-block w-100" alt="...">

                    </div>


                    <div class="carousel-item">
                        <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/clubemprendedorescapacitaciones/fotocap2.jpeg"
                            class="d-block w-100" alt="...">
                    </div>



                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>


        <ul>
            <li>Dirigido a: Emprendedores locales en etapa inicial o de consolidación</li>
            <li>Objetivo: Crear un programa integral de formación emprendedora</li>
            <li>Modalidad: Cursos, talleres y asesoramiento técnico personalizado

            </li>
        </ul>
    </div>











    <div class="programas">
        <h2 class="subtitulo1">Feria Del Parque Cabañas</h2>
        <h3 class="subtitulo">Impulsando el trabajo local y el comercio emprendedor</h3>
        <p class="text-clubs">La Feria del Parque Cabañas es una propuesta organizada por el Club de Emprendedores,
            bajo
            la
            coordinación de la
            Oficina de Empleo y Capacitación de la Municipalidad de Tres Arroyos.

            Este espacio tiene como objetivo promover el trabajo autogestivo y la
            comercialización de productos realizados por emprendedores locales,
            en un entorno natural y accesible para toda la comunidad.</p>


        <p class="text-clubs">

        <ol>
            <li> 🗓 Días: Primer domingo de cada mes</li>
            <li>
                🕛 Horario: De 12:00 a 18:00 hs (sin excepción)</li>
            <li>
                📍 Lugar: Parque Cabañas, Tres Arroyos
            </li>



        </ol>

        </p>




        <!--seccioon carrousel ferias de emprendedores al aire libre -->
        <div id="carouselExampleInterval" class="carousel slide carrousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto11.webp"
                        class="d-block w-100" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto13.webp"
                        class="d-block w-100" alt="...">
                </div>



                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto7.webp"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/DSC_0494.JPG"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto10.webp"
                        class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto5.webp"
                        class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto6.webp"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto1.jpg"
                        class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto9.webp"
                        class="d-block w-100" alt="...">
                </div>


                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/foto12.webp"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/EMPRENDEDORESMUNITSAS/public/assets/img/emprendedoresferias/DSC_0752.JPG"
                        class="d-block w-100" alt="...">
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>








    <h2 class="subtitulo1">Programas De Empleo</h2>

    <h3 class="subtitulo">Impulsamos la empleabilidad, la capacitación y la inserción laboral</h3>
    <p class="text-clubs">Desde la Oficina de Empleo, articulamos con programas nacionales y municipales para
        brindar
        oportunidades concretas de inserción laboral y
        formación profesional.</p>


    <div class="programas">

        <h3 class="subtitulo">EPT – Entrenamiento para el Trabajo</h3>

        <p class="text-clubs">Permite que las empresas entrenen aprendices en puestos reales, sin establecer
            relación
            laboral formal,
            compartiendo el costo de formación con el Estado.</p>

        <ul>

            <li> Dirigido a: Personas desocupadas mayores de 18 años</li>

            <li> Beneficio: Posibilidad de contratación futura con incentivo económico (vía PIL)

            </li>
        </ul>
    </div>

    <div class="programas">

        <h3 class="subtitulo">PIL – Programa de Inserción Laboral</h3>
        <p class="text-clubs">Promueve la contratación de personas con dificultades de empleabilidad
            mediante un subsidio para las empresas
            que cubre parte del salario del trabajador.</p>

        <ul>
            <li>Beneficio: Reducción de carga salarial para las empresas</li>
            <li>Objetivo: Estimular la inserción laboral sostenida</li>
        </ul>
    </div>



    <div class="programas">

        <h3 class="subtitulo">PROMOVER – Inclusión Laboral para Personas con Discapacidad</h3>
        <p class="text-clubs">Brinda acompañamiento personalizado a personas con discapacidad para que puedan
            acceder a
            empleos de calidad o desarrollar sus propios emprendimientos.</p>

        <ul>
            <li>Apoyo integral: Orientación, formación y vinculación con el mundo laboral</li>
            <li>Enfoque: Autonomía, desarrollo y sostenibilidad</li>
        </ul>
    </div>
    </div>

    @include('emprendedor.footer')
    <!-- Bootstrap core JS-->
    <script src="{{ asset('js/scripts.js') }} "></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
</body>

</html>
