<br>
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">






            <!-- presentacion de la seccion noticias-->
            <section class="page-section text-white" style="background-color: #25e9a7 !important;">
                <div class="container px-4 px-lg-5 text-center">
                    <h2 class="mb-4">¡Ultimas Novedades En Programas Y Capacitaciones!</h2>
                    <a class="btn btn-light btn-xl" href="{{ url('/noticias') }}">Ver Más</a>
                </div>
            </section>





            @yield('content')

            <!--esto se va y solo quedaria el foreach para traer las 4 noticias -->
            <div class="col-lg-6 col-sm-6">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/1.jpg" title="Project Name">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">noticia 1</div>
                    </div>
                </a>
            </div>


            <div class="col-lg-6 col-sm-6">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/2.jpg" title="Project Name">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">noticia 2</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-sm-6">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Project Name">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">noticia 3</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6">
                <a class="portfolio-box" href="assets/img/portfolio/fullsize/4.jpg" title="Project Name">
                    <img class="img-fluid" src="assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">Category</div>
                        <div class="project-name">noticia 4 </div>
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>
