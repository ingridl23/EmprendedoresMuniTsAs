@extends('emprendedor.templateEmprendedores')


<!--
@section('content')


                  ($emprendedores as $emprendedor)
                    <!--lasa redes sociales van en el otro template cuando se redirecciona a
                                     un emprendedor en especifico -->
    <!--
                                     <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{ emprendedor imagen }}" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">Emprendedor</div>
                                    <div class="portfolio-caption-subheading text-muted"> { emprendedor categoria }}</div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 mb-4">


                            </div>
                            </div>
                            </section>





                            <!-- Portfolio item 2 modal popup-->

    <!--
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
    <!--
                                                        <h2 class="text-uppercase"> { emprendedor nombre }}</h2>
                                                        <!--   <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
    <!--             <img class="img-fluid d-block mx-auto" src="{ emprendedor imagen }} "
                                                            alt="..." />
                                                        <p> { emprendedor descripcion }} </p>
                                                        <ul class="list-inline">
                                                            <li>
                                                                <strong> Emprendedor</strong>
                                                            </li>
                                                            <li>
                                                                <strong>Categoria:</strong>{ emprendedor categoria }}
                                                            </li>
                                                        </ul>
                                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                                            type="button">
                                                            <i class="fas fa-xmark me-1"></i>
                                                            retroceder
                                                        </button>
                                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                                            type="button">
                                                            <i class="fas fa-xmark me-1"></i>
                                                            ver mas acerca de { emprendedor nombre }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            //endforeach
                            //endsection
