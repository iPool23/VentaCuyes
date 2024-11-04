<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cuyes Doña Juana</title>

    <link rel="icon" href="{{ asset('index-img/favicon.ico') }}">
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,400;0,600;0,700;1,200;1,700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('css/index-css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index-css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index-css/vegas.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index-css/tooplate-barista.css') }}" rel="stylesheet">

</head>

<body>

    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <img src="{{ asset('index-img/favicon.ico') }}" class="navbar-brand-image img-fluid"
                        alt="Doña Juana Logo">
                    Cuyes Doña Juana
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Nosotros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Nuestro Menu</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Contáctanos</a>
                        </li>
                    </ul>

                    <div class="ms-lg-3">
                        <a class="btn custom-btn custom-border-btn" href="{{ route('login') }}">
                            Iniciar Sesión
                            <i class="bi-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12 mx-auto">
                        <em class="small-text">Bienvenido al Restaurante</em>

                        <h1>Cuyería Doña Juana</h1>

                        <p class="text-white mb-4 pb-lg-2">
                            Preparación <em>UNICA</em> en el norte.
                        </p>

                        <a class="btn custom-btn custom-border-btn smoothscroll me-3" href="#section_2">
                            Nuestra Historia
                        </a>

                        <a class="btn custom-btn smoothscroll me-2 mb-2" href="#section_3"><strong>Revisa el
                                Menú</strong></a>
                    </div>

                </div>
            </div>

            <div class="hero-slides"></div>
        </section>


        <section class="about-section section-padding" id="section_2">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12">
                        <div class="ratio ratio-1x1">
                            <video autoplay="" loop="" muted="" class="custom-video" poster="">
                                <source src="{{ asset('videos/pexels-mike-jones-9046237.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <div class="about-video-info d-flex flex-column">
                                <h4 class="mt-auto">Iniciamos en el 2016</h4>

                                <h4>Los mejores cuyes del norte</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mt-4 mt-lg-0 mx-auto">
                        <em class="text-white">Cuyería "Doña Juana"</em>

                        <h2 class="text-white mb-3">La mejor sazón</h2>

                        <p class="text-white">Es reconocida por ofrecer los mejores cuyes del norte peruano.
                            Con una tradición que resalta el auténtico sabor local.</p>

                        <p class="text-white">Sus platos destacan por la frescura y sazón, capturando el espíritu
                            culinario de la región.
                            Es el destino ideal para quienes buscan una experiencia</p>

                        <a href="#barista-team" class="smoothscroll btn custom-btn custom-border-btn mt-3 mb-4">Conoce a
                            nuestro EQUIPO</a>
                    </div>

                </div>
            </div>
        </section>


        <section class="barista-section section-padding section-bg" id="barista-team">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                        <em class="text-white">Atención premium</em>

                        <h2 class="text-white">Conócenos</h2>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0">Juana</h4>

                                    <p class="badge ms-4"><em>La jefa</em></p>
                                </div>

                                <p class="text-white mb-0"></p>
                            </div>

                            <div class="team-block-image-wrap">
                                <img src="{{ asset('index-img/team/Juana-jefa.jpg') }}"
                                    class="team-block-image img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0">Pol</h4>

                                    <p class="badge ms-4"><em>Camarero</em></p>
                                </div>
                                <p class="text-white mb-0"></p>
                            </div>

                            <div class="team-block-image-wrap">
                                <img src="{{ asset('index-img/team/evilpol.png') }}"
                                    class="team-block-image img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0">Irvin</h4>

                                    <p class="badge ms-4"><em>Cocinero</em></p>
                                </div>


                            </div>

                            <div class="team-block-image-wrap">
                                <img src="{{ asset('index-img/team/irvin2.png') }}"
                                    class="team-block-image img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="team-block-wrap">
                            <div class="team-block-info d-flex flex-column">
                                <div class="d-flex mt-auto mb-3">
                                    <h4 class="text-white mb-0">Antoni</h4>

                                    <p class="badge ms-4"><em>Mozo</em></p>
                                </div>


                            </div>

                            <div class="team-block-image-wrap">
                                <img src="{{ asset('index-img/team/antoni.png') }}"
                                    class="team-block-image img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="menu-section section-padding" id="section_3">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                        <div class="menu-block-wrap">
                            <div class="text-center mb-4 pb-lg-2">
                                <em class="text-white">Delicioso Menu</em>
                                <h4 class="text-white">Desayunos</h4>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Panqueques</h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 5.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Panqueques de la casa con salsa casera.</small>
                                </div>
                            </div>

                            <div class="menu-block my-4">
                                <div class="d-flex">
                                    <h6>
                                        Tamales Norteños
                                    </h6>

                                    <span class="underline"></span>

                                    <strong class="text-white ms-auto"><del>S/. 8.50</del></strong>

                                    <strong class="ms-2">S/. 6.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Tamales de maíz rellenos con carne de cerdo, cocidos a fuego lento y servidos
                                        con salsa criolla.</small>
                                </div>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Cuy al Horno con Papas Doradas
                                        <span class="badge ms-3">Recomendado</span>
                                    </h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 35.00</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Nuestro clásico cuy al horno, crujiente por fuera y jugoso por dentro,
                                        acompañado de papas doradas y ensalada fresca.</small>
                                </div>
                            </div>

                            <div class="menu-block my-4">
                                <div class="d-flex">
                                    <h6>Jugo de Papaya y Maracuyá</h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 8.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Refrescante jugo natural de papaya y maracuyá, lleno de vitaminas y
                                        antioxidantes.</small>
                                </div>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Café Norteño Tradicional</h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 5.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Café orgánico de alta calidad, cultivado en las montañas del norte. Su aroma
                                        y sabor profundo hacen de esta bebida el complemento perfecto para una mañana
                                        energizante.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="menu-block-wrap">
                            <div class="text-center mb-4 pb-lg-2">
                                <em class="text-white">Menu principal</em>
                                <h4 class="text-white">Cuyes</h4>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Cuy Chactado</h6>

                                    <span class="underline"></span>

                                    <strong class="text-white ms-auto"><del>S/. 55.50</del></strong>

                                    <strong class="ms-2">S/. 45.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Un plato emblemático para quienes desean probar lo mejor de la cocina
                                        peruana.
                                    </small>
                                </div>
                            </div>

                            <div class="menu-block my-4">
                                <div class="d-flex">
                                    <h6>
                                        Seco de Cabrito con Frejoles
                                        <span class="badge ms-3">Recomendado</span>
                                    </h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 35.90</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Tiernas piezas de cabrito cocidas a fuego lento en una salsa de culantro, ají
                                        y chicha de jora, servidas con frejoles y arroz.</small>
                                </div>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Chicharrón de Cuy con Yuca</h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 55.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Delicados trozos de cuy frito, crujientes por fuera y suaves por dentro,
                                        servidos con yuca dorada</small>
                                </div>
                            </div>

                            <div class="menu-block my-4">
                                <div class="d-flex">
                                    <h6>Cuy al Palo</h6>

                                    <span class="underline"></span>

                                    <strong class="ms-auto">S/. 67.50</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Cuy entero asado a la parrilla, marinado con hierbas y especias locales para
                                        un sabor ahumado y jugoso.</small>
                                </div>
                            </div>

                            <div class="menu-block">
                                <div class="d-flex">
                                    <h6>Picante de Cuy</h6>

                                    <span class="underline">S/. 65.00</span>

                                    <strong class="ms-auto">S/. 47.25</strong>
                                </div>

                                <div class="border-top mt-2 pt-2">
                                    <small>Cuy cocido en una rica y espesa salsa de ají amarillo y maní, servido con
                                        arroz y papas doradas.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="reviews-section section-padding section-bg" id="section_4">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                        <em class="text-white">Reviews de nuestros clientes</em>

                        <h2 class="text-white">Ellos dicen</h2>
                    </div>

                    <div class="timeline">
                        <div class="timeline-container timeline-container-left">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <img src="{{ asset('index-img/reviews/young-woman-with-round-glasses-yellow-sweater.jpg') }}"
                                            class="reviews-block-image img-fluid" alt="">

                                        <div class="">
                                            <h6 class="text-white mb-0">Sandra</h6>
                                            <em class="text-white">Cliente</em>
                                        </div>
                                    </div>

                                    <div class="reviews-block-info">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>

                                        <div class="d-flex border-top pt-3 mt-4">
                                            <strong class="text-white">4.5 <small
                                                    class="ms-2">Puntuación</small></strong>

                                            <div class="reviews-group ms-auto">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-container timeline-container-right">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <img src="{{ asset('index-img/reviews/senior-man-white-sweater-eyeglasses.jpg') }}"
                                            class="reviews-block-image img-fluid" alt="">

                                        <div class="">
                                            <h6 class="text-white mb-0">José</h6>
                                            <em class="text-white"> Cliente</em>
                                        </div>
                                    </div>

                                    <div class="reviews-block-info">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>

                                        <div class="d-flex border-top pt-3 mt-4">
                                            <strong class="text-white">4.5 <small
                                                    class="ms-2">Puntuación</small></strong>

                                            <div class="reviews-group ms-auto">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-container timeline-container-left">
                            <div class="timeline-content">
                                <div class="reviews-block">
                                    <div class="reviews-block-image-wrap d-flex align-items-center">
                                        <img src="{{ asset('index-img/reviews/young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair.jpg') }}"
                                            class="reviews-block-image img-fluid" alt="">

                                        <div class="">
                                            <h6 class="text-white mb-0">Olivia</h6>
                                            <em class="text-white"> Cliente</em>
                                        </div>
                                    </div>

                                    <div class="reviews-block-info">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>

                                        <div class="d-flex border-top pt-3 mt-4">
                                            <strong class="text-white">4.5 <small
                                                    class="ms-2">Puntuación</small></strong>

                                            <div class="reviews-group ms-auto">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="contact-section section-padding" id="section_5">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <em class="text-white"></em>
                        <h2 class="text-white mb-4 pb-lg-2">Contáctanos</h2>
                    </div>

                    <div class="col-lg-6 col-12">
                        <form action="#" method="post" class="custom-form contact-form" role="form">

                            <div class="row">

                                <div class="col-lg-6 col-12">
                                    <label for="name" class="form-label">Nombre <sup
                                            class="text-danger">*</sup></label>

                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Jackson" required="">
                                </div>

                                <div class="col-lg-6 col-12">
                                    <label for="email" class="form-label">Email</label>

                                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                        class="form-control" placeholder="Jack@gmail.com" required="">
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label">Cómo te podemos ayudar??</label>

                                    <textarea name="message" rows="4" class="form-control" id="message" placeholder="Mensaje..."
                                        required=""></textarea>

                                </div>
                            </div>

                            <div class="col-lg-5 col-12 mx-auto mt-3">
                                <button type="submit" class="form-control">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-6 col-12 mx-auto mt-5 mt-lg-0 ps-lg-5">
                                                <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d557.7987759107036!2d-79.84609713320863!3d-6.771868681145993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses-419!2spe!4v1730700191822!5m2!1ses-419!2spe"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            </div>
        </section>


        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-12 me-auto">
                        <em class="text-white d-block mb-4">¿Dónde nos encontramos?</em>

                        <strong class="text-white">
                            <i class="bi-geo-alt me-2"></i>
                            Av. Siempre viva 432
                        </strong>

                        <ul class="social-icon mt-4">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook">
                                </a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" target="_new" class="social-icon-link bi-twitter">
                                </a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-12 mt-4 mb-3 mt-lg-0 mb-lg-0">
                        <em class="text-white d-block mb-4">Contáctanos</em>

                        <p class="d-flex mb-1">
                            <strong class="me-2">Celular:</strong>
                            <a href="#" class="site-footer-link">
                                (+51)
                                961 374 108
                            </a>
                        </p>

                        <p class="d-flex">
                            <strong class="me-2">Email:</strong>

                            <a href="#" class="site-footer-link">
                                contacto@cuyeriajuana.com
                            </a>
                        </p>
                    </div>


                    <div class="col-lg-5 col-12">
                        <em class="text-white d-block mb-4">Horarios</em>

                        <ul class="opening-hours-list">
                            <li class="d-flex">
                                Lunes - Viernes
                                <span class="underline"></span>

                                <strong>09:00 a.m - 08:00 p.m</strong>
                            </li>

                            <li class="d-flex">
                                Sábado
                                <span class="underline"></span>

                                <strong>10:00 a.m - 06:00 p.m</strong>
                            </li>

                            <li class="d-flex">
                                Domingo
                                <span class="underline"></span>

                                <strong>Cerrado</strong>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-8 col-12 mt-4">
                        <p class="copyright-text mb-0">Copyright © Grupo 05 USS
                            <span class="mx-2">|</span>
                            Desarrollado por <a href="#" target="_blank">Grupo 05 USS</a>
                        </p>
                    </div>
                </div>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('js/index-js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/index-js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/index-js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/index-js/click-scroll.js') }}"></script>
    <script src="{{ asset('js/index-js/vegas.min.js') }}"></script>
    <script src="{{ asset('js/index-js/custom.js') }}"></script>
    <script>
        $(function() {
            $('.hero-slides').vegas({
                slides: [{
                        src: "{{ asset('index-img/slides/familia1.jpg') }}"
                    },
                    {
                        src: "{{ asset('index-img/slides/familia2.jpg') }}"
                    },
                    {
                        src: "{{ asset('index-img/slides/familia3.jpg') }}"
                    }
                ],
                timer: false,
                animation: 'kenburns',
            });
        });
    </script>

</body>

</html>
