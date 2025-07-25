<head>
    <link href="{{ asset('css/programas.css') }}" rel="stylesheet" />
</head>

<div class=" container-programas ">

    <h1 class="text-center mt-0"> Conoce Los Programas Vigentes</h1>

    <h2 class="subtitulo1 subtituloProgramas">Programas Para Emprendedores</h2>

    <div class="contenedorProgramas">
        <div class="linkProgramas">
            <div class="div-numero">
                <div class="numero">1</div>
            </div>
            <a href="#clubDeEmprendedores">Club de emprendedores</a>
        </div>
        <div class="linkProgramas">
            <div class="div-numero">
                <div class="numero">2</div>
            </div>
            <a href="#escuelaDeEmprendedores">Escuela de emprendedores</a>
        </div>
    </div>

    <div class="programas">
        <h3 class="subtitulo tituloClubEmprendedores">Club De Emprendedores</h3>

        <p class="text-clubs" id="clubDeEmprendedores">
            El Club de Emprendedores es una iniciativa de la Oficina de Empleo y Capacitación de Tres Arroyos que
            funciona como un espacio de encuentro, acompañamiento y crecimiento para emprendedores y PyMEs locales.

            Este club ofrece un ámbito físico de reuniones periódicas entre sus miembros, donde se generan vínculos
            entre los distintos actores del ecosistema productivo local y se fomenta la conexión con instituciones
            municipales, provinciales y nacionales.
        </p>

        <!--seccioon carrousel club de  emprendedores -->
        <div id="carouselExampleInterval" class="carousel slide carrousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img src="{{ asset('assets/img/clubemprendedoresadaptadas/1.jpg') }}"
                        class="img-fluid d-block  w-100" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/clubemprendedoresadaptadas/2.jpg') }}"
                        class="img-fluid d-block  w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/clubemprendedoresadaptadas/3.jpg') }}"
                        class="img-fluid d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/clubemprendedoresadaptadas/4.jpg') }}"
                        class="img-fluid d-block w-100" alt="...">
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
                <!-- pie de carrousel -->
        <p class="text-clubs">
            Desde la Oficina de Empleo y Capacitación reafirmamos nuestro compromiso de impulsar el
            emprendedurismo local, promoviendo espacios colaborativos, construyendo redes de apoyo y generando más y
            mejores oportunidades para quienes apuestan a crecer en nuestra comunidad.
        </p>

        <p class="text-clubs"> Contactanos y sumate a esta comunidad en acción.
            ¿Querés ser parte del Club de Emprendedores?</p>




    <div class="detallesClub">
        <div class="contenedorTituloDetalles">
            <h3>Objetivos y Acciones</h3>
        </div>
        <ul>
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
    </div>
        
    <div class="detallesClub beneficiosDetallesClub">
         <div class="contenedorTituloDetalles">
            <h3>Beneficios para los miembros</h3>
        </div>
        <ul>
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
       
    </div>


        <!-- seccion vista previa ultimos emprendedores-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                @if (!empty($ultimos) && $ultimos->count())
                    <div class="row g-0">

                        @foreach ($ultimos as $emprendedor)
                            <div class="col-lg-4 col-sm-6">
                                @if ($emprendedor->imagenes->isNotEmpty())
                                    <a class="portfolio-box"
                                        href="{{ asset('storage/' . $emprendedor->imagenes->first()->url) }}"
                                        title="{{ $emprendedor->nombre }}">
                                        <img class="img-fluid"
                                            src="{{ asset('storage/' . $emprendedor->imagenes->first()->url) }}"
                                            alt={{ $emprendedor->nombre }} /> 
                                @endif
                                <div class="portfolio-box-caption">
                                    <div class="project-category text-white-50">{{ $emprendedor->categoria }}</div>
                                    <div class="project-name">{{ $emprendedor->nombre }}</div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                @endif

            </div>
        </div>




        <!-- Call to action-->
        <section class="page-section text-white" id="SeccionFotosEmprendedores" >
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">¡Conocé a nuestros emprendedores que ya son parte!</h2>
                <a class="btn btn-light btn-xl" href="{{ url('/emprendedores') }}">Ver Más</a>
            </div>
        </section>
    </div>










    <div class="programas">

        <img class="img-fluid imagen-escuela" id="escuelaDeEmprendedores" src="{{ asset('assets/img/iconos/logoescuelaemprendedores.png') }}"
            alt="Logo de Escuela de Emprendedores" />

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


        <!--seccion carrousel capacitaciones emprendedores -->
        <div id="carouselCapacitacionEmprendedores" class="carousel slide carrousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img src="{{ asset('assets/img/clubemprendedoresadaptadas/escuelaemprendedores.jpg') }}"
                        class="img-fluid  d-block w-100" alt="...">

                </div>

                <div class="carousel-item">

                    <img src="{{ asset('assets/img/capacitacionesemprendedoresadaptadas/1.jpg') }}"
                        class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/img/capacitacionesemprendedoresadaptadas/4.jpg') }}"
                        class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/img/capacitacionesemprendedoresadaptadas/5.jpg') }}"
                        class="d-block w-100" alt="...">
                </div>



            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCapacitacionEmprendedores"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCapacitacionEmprendedores"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

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
        <p class="text-clubs">La Feria del Parque Cabañas es una propuesta organizada por el Club de
            Emprendedores,
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
        <div id="carouselFeriasEmprendedores" class="carousel slide carrousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                @for ($i = 1; $i <= count(scandir('assets/img/emprendedoresferiaadaptadas/')) - 2; $i++)
                    <div class="carousel-item {{ $i === 1 ? 'active' : '' }}" data-bs-interval="5000">
                        <img src="{{ asset('assets/img/emprendedoresferiaadaptadas/' . $i . '.jpg') }}"
                            class="d-block w-100" alt="Imagen de emprendedores al aire libre">
                    </div>
                @endfor
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeriasEmprendedores"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselFeriasEmprendedores"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>


    </div>

    <h2 class="subtitulo1">Programas De Empleo</h2>

    <h3 class="subtitulo">Impulsamos la empleabilidad, la capacitación y la inserción laboral</h3>
    <p class="text-clubs">Desde la Oficina de Empleo, articulamos con programas nacionales y municipales
        para
        brindar
        oportunidades concretas de inserción laboral y
        formación profesional.</p>


    <div class="programas">

        <h3 class="subtitulo">EPT – Entrenamiento para el Trabajo</h3>

        <p class="text-clubs">Permite que las empresas entrenen aprendices en puestos reales, sin
            establecer
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
        <p class="text-clubs">Brinda acompañamiento personalizado a personas con discapacidad para que
            puedan
            acceder a
            empleos de calidad o desarrollar sus propios emprendimientos.</p>

        <ul>
            <li>Apoyo integral: Orientación, formación y vinculación con el mundo laboral</li>
            <li>Enfoque: Autonomía, desarrollo y sostenibilidad</li>
        </ul>
    </div>

</div>
</div>
