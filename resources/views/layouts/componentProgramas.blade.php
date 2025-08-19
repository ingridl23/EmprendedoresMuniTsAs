<head>
    <link href="{{ asset('css/programas.css') }}" rel="stylesheet" />
</head>

<div class="container-programas">

    <h1 class="text-center mt-0 titulo1"> Conoce Los Programas Vigentes</h1>



    <div id="carouselLinks" class="carouselLinks">
        <div class="carousel-links-inner">
            <div class="carousel-links-item visible">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Programa 1</h5>
                        <a href="#clubDeEmprendedores" class="card-link">Club de emprendedores</a>
                    </div>
                </div>
            </div>
            <div class="carousel-links-item visible ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Programa 2</h5>
                        <a href="#escuelaDeEmprendedores" class="card-link">Escuela de emprendedores</a>
                    </div>
                </div>

            </div>
            <div class="carousel-links-item visible ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Programa 3</h5>
                        <a href="#feriaParqueCabanias" class="card-link">Feria Parque Cabañas</a>
                    </div>
                </div>
            </div>
            <div class="carousel-links-item visible">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">Programa 4</h5>
                        <a href="#programasDeEmpleo" class="card-link">Programas de empleo</a>
                    </div>
                </div>

            </div>
        </div>
        <a class="control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="programas">
        <h3 class="subtitulo1" id="clubDeEmprendedores">Club de Emprendedores</h3>

        <p class="text-clubs">El Club de Emprendedores es una iniciativa de la Oficina de Empleo y Capacitación de Tres
            Arroyos que funciona como un espacio de encuentro, acompañamiento y crecimiento para emprendedores y PyMEs
            locales. Este club ofrece un ámbito físico de reuniones periódicas entre sus miembros, donde se generan
            vínculos entre los distintos actores del ecosistema productivo local y se fomenta la conexión con
            instituciones municipales, provinciales y nacionales. </p>

        <!--seccion carrousel club de  emprendedores -->
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
            <ul class="estiloLista">
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
            <ul class="estiloLista">
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
                    <div class="row g-0 portfolio-container">
                        @foreach ($ultimos as $emprendedor)
                            <div class="col-lg-4 col-sm-6">
                                @if ($emprendedor->imagenes->isNotEmpty())
                                    <a class="portfolio-box" href="https://res.cloudinary.com/djnlbzis1/image/upload/v1755605297/emprendedores/gst8nn8wxowzoztyq7nr.jpg"
                                        title="{{ $emprendedor->nombre }}">
                                        <img class="img-fluid" src="https://res.cloudinary.com/djnlbzis1/image/upload/v1755605297/emprendedores/gst8nn8wxowzoztyq7nr.jpg"
                                            alt={{ $emprendedor->nombre }} />
                                
                                        <div class="portfolio-box-caption">
                                            <div class="project-category text-white-50">{{ $emprendedor->categoria->categoria }}</div>
                                            <div class="project-name">{{ $emprendedor->nombre }}</div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>


        <!-- Call to action-->
        <section class="page-section text-white" id="SeccionFotosEmprendedores">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">¡Conocé a los emprendedores que ya son parte!</h2>
                <a class="btn btn-light btn-xl" href="{{ url('/emprendedores') }}">Ver Más</a>
            </div>
        </section>
    </div>










    <div class="programas">
        <div class="container-img-logo-escuela">


            <img class="imagen-escuela img-fluid "
                src="{{ asset('assets/img/iconos/logoescuelaemprendedores.png') }}"
                alt="Logo de Escuela de Emprendedores" />
        </div>


        <h2 id="escuelaDeEmprendedores" class="subtitulo1 subtituloProgramas">Escuela de Emprendedores</h2>
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



        <ul class="detallesDesarrolloLista">
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/persona.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Dirigido a:</h5>
                        <p class="card-text">Emprendedores locales en etapa inicial o de consolidación</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/objetivo.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Objetivo:</h5>
                        <p class="card-text"> Crear un programa integral de formación emprendedora</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/modalidad.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Modalidad:</h5>
                        <p class="card-text"> Cursos, talleres y asesoramiento técnico personalizado</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>











    <div class="programas">
        <h2 class="subtitulo1" id="feriaParqueCabanias">Feria Del Parque Cabañas</h2>
        <h4>Impulsando el trabajo local y el comercio emprendedor</h4>
        <p class="text-clubs">La Feria del Parque Cabañas es una propuesta organizada por el Club de
            Emprendedores,
            bajo
            la
            coordinación de la
            Oficina de Empleo y Capacitación de la Municipalidad de Tres Arroyos.

            Este espacio tiene como objetivo promover el trabajo autogestivo y la
            comercialización de productos realizados por emprendedores locales,
            en un entorno natural y accesible para toda la comunidad.</p>




        <ol class="detallesDesarrolloLista">
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/dias.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Días:</h5>
                        <p class="card-text">Primer domingo de cada mes</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/horarios.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Horario:</h5>
                        <p class="card-text">De 12:00 a 18:00 hs (sin excepción)</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header card-header-img"><img
                            src="{{ asset('assets/img/iconos/programas/lugar.webp') }}" alt=""></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">Lugar:</h5>
                        <p class="card-text">Parque Cabañas, Tres Arroyos</p>
                    </div>
                </div>
            </li>
        </ol>






        <!--seccion carrousel ferias de emprendedores al aire libre -->
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


</div>






<!-- seccion programas nuevo -->
<h1 class="subtitulo1">Programas De Empleo</h1>
<h4>Impulsamos la empleabilidad, la capacitación y la inserción laboral</h4>
<p class="text-clubs">Desde la Oficina de Empleo, articulamos con programas nacionales y municipales para
    brindar oportunidades concretas de inserción laboral y formación profesional.</p>

<h2 class="subtitulo2" id="programasDeEmpleo">EPT – Entrenamiento para el Trabajo</h2>
<p class="text-clubs">Permite que las empresas entrenen aprendices en puestos reales, sin
    establecer
    relación
    laboral formal,
    compartiendo el costo de formación con el Estado.</p>


<div class="detallesClub">
    <div class="contenedorTituloDetalles">
        <h3 class="col requisitos"> Requisitos para empresas </h3>
    </div>
    <ul class="estiloLista">

        <li> Brindar una cobertura de riesgos del trabajo y una cobertura de salud que garantice el Programa
            Médico Obligatorio a los/as participantes. </li>
        <li>Abonar parte de la ayuda económica que reciben los aprendices (excepto las microempresas).
        </li>
        <li>Brindar la infraestructura, equipamiento, insumos y herramientas.
        </li>
        <li>Informar a los participantes todos los derechos, obligaciones y requisitos derivados de su
            participación en las acciones que componen el proyecto.
        </li>
        <li>
            Garantizar a los participantes un contexto de aprendizaje libre de violencia de género y acoso.
        </li>

        <li>
            Pueden presentar proyectos todas las empresas y cooperativas cualquiera sea su tamaño y actividad,
            siempre que no hayan realizado despidos masivos en los 6 meses anteriores a la presentación del
            proyecto de entrenamiento, cumplan con las obligaciones de la Seguridad Social de sus empleados/as y
            no tengan sanciones registradas en el REPSAL.
        </li>



    </ul>
</div>

<div class="detallesClub beneficiosDetallesClub">
    <div class="contenedorTituloDetalles">
        <h3 class="col">Requisitos para trabajadores</h3>
    </div>
    <ul class="estiloLista">
        <li>Tener entre 18 y 24 años</li>
        <li>Tener el secundario completo</li>
        <li>No haber trabajado en relación de dependencia en los últimos 3 meses</li>
        <li>Podrán inscribirse a través del Portal Empleo. Una vez registrados en el portal, deberán registrar
            su historia laboral y, luego, postularse a una oferta de Entrenamiento para el Trabajo</li>
    </ul>

</div>
<h2 class="subtitulo2">PIL – Programa de Inserción Laboral</h2>
<p class="text-clubs">Promueve la contratación de personas con dificultades de empleabilidad
    mediante un subsidio para las empresas
    que cubre parte del salario del trabajador.</p>


<div class="detallesClub contenedorMasGrande">
    <div class="contenedorTituloDetalles">
        <h3 class="col">Beneficios </h3>
    </div>
    <ul class="estiloLista">
        <li>Beneficio: Reducción de carga salarial para las empresas</li>
        <li>Objetivo: Estimular la inserción laboral sostenida</li>
    </ul>




</div>




<div class="detallesClub contenedorMasGrande">
    <div class="contenedorTituloDetalles">
        <h3 class="col">Requisitos para empresas </h3>
    </div>
    <ul class="estiloLista">
        <li>Beneficio: Reducción de carga salarial para las empresas</li>
        <li>Objetivo: Estimular la inserción laboral sostenida</li>
    </ul>
</div>


<h2 class="subtitulo2" id="programasDeEmpleo">
    PROMOVER – Inclusión Laboral para Personas con Discapacidad</h2>
<p class="text-clubs">Brinda acompañamiento personalizado a personas con discapacidad para que
    puedan
    acceder a
    empleos de calidad o desarrollar sus propios emprendimientos.</p>




<div class="detallesClub">
    <div class="contenedorTituloDetalles">
        <h3 class="col">Beneficios </h3>
    </div>
    <ul class="estiloLista">
        <li>Apoyo integral: Orientación, formación y vinculación con el mundo laboral</li>
        <li>Enfoque: Autonomía, desarrollo y sostenibilidad</li>
        <li> DURACION 12 MESES </li>

    </ul>
</div>


<div class="detallesClub  beneficiosDetallesClub">
    <div class="contenedorTituloDetalles">
        <h3 class="col"> Requisitos para empresas</h3>
    </div>
    <ul class="estiloLista">
        <li>No figurar en Registro Público de Empleadores con Sanciones Laborales (REPSAL)
        </li>
    </ul>
</div>

<div class="detallesClub">
    <div class="contenedorTituloDetalles">
        <h3 class="col"> Requisitos para trabajadores </h3>
    </div>
    <ul class="estiloLista">
        <li>Trabajadores desocupados mayores de 18 años </li>
    </ul>
</div>
