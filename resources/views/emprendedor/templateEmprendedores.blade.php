<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>emprendedores</title>
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
    <link href="{{ asset('css/stylesemprendedoressection.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    @include('emprendedor.navBar')
   

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

                </div>
            </div>
        </div>
    </header>

    <!--************************************************************************************************************************* -->











    <!--******************************************************************************************************* -->
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h1 class="section-subheading text-muted"> Conoce La propuesta de cada emprendedor</h1>
            </div>
            <br>
            <div class="row">
               
               @foreach($emprendedores as $emprendedor)
                    <!--lasa redes sociales van en el otro template cuando se redirecciona a
                                     un emprendedor en especifico -->

                    <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ asset('storage/' . $emprendedor->imagen) }}" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{$emprendedor->nombre }}</div>
                                    <div class="portfolio-caption-subheading text-muted"> {{$emprendedor->categoria }}</div>
                                </div>
                    </div>
                            <div class="col-lg-4 col-sm-6 mb-4"></div>
            </div>
        </div>






                            <!-- Portfolio item 2 modal popup-->


                            <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                                                alt="Close modal" /></div>
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8">
                                                    <div class="modal-body">

                                                        <!-- Project details-->
                                                        <h2 class="text-uppercase"> {{$emprendedor->nombre }}</h2>
                                                        <!--   <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                                                        <img class="img-fluid d-block mx-auto" src="{{ asset('storage/' . $emprendedor->imagen) }}"
                                                            alt="..." />
                                                        <p>{{$emprendedor->descripcion }}</p>
                                                        <ul class="list-inline">
                                                            <li>
                                                                <strong> Emprendedor</strong>
                                                            </li>
                                                            <li>
                                                                <strong>Categoria:</strong>{{$emprendedor->categoria }}
                                                            </li>
                                                        </ul>
                                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                                            type="button">
                                                            <i class="fas fa-xmark me-1"></i>
                                                            retroceder
                                                        </button>
                                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                                            type="button">
                                                            <a href="/emprendedor/{{$emprendedor->id}}" class="linkEmprendedorMas">
                                                                <i class="fas fa-xmark me-1"></i>
                                                            ver mas acerca de {{$emprendedor->nombre }}
                                                            </a>
                                                            
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @endforeach

            <div>
    </section>
    {{ $emprendedores->onEachSide(2)->links('pagination::bootstrap-4')}}
</div>

            </div>

            <div class="col-lg-4 col-sm-6 mb-4">


            </div>
        </div>
        </div>

    </section>





    <!-- Portfolio item 2 modal popup-->

    <section>
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal">
                        <i class="fas fa-xmark me-1"></i>

                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">

                                    <!-- Project details-->

                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/bg-masthead.jpg"
                                        alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur
                                        adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos
                                        deserunt
                                        repellat aperiam quasi sunt officia expedita beatae cupiditate,
                                        maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong> Explore
                                        </li>
                                        <li>
                                            <strong>Category:</strong> Graphic Design
                                        </li>
                                    </ul>
                                    <button class=" btn-vermas btn-xl text-uppercase" data-bs-dismiss="modal"
                                        type="button">

                                        <a id="vermas" href="/emprendedor/$id"> ver mas acerca de este
                                            emprendedor</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('layouts.panelAdmin')
   

    @include('emprendedor.footer')



    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    
    <script src="{{ asset('js/scripts.js') }} "></script>
    <script src="{{ asset('js/logicaform.js') }} "></script>
    <script src="{{ asset('js/scripts3.js') }}"></script>

    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
