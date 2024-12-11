<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IACSA</title>
    @Vite('resources/css/landing.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="nav">
        <img src="{{asset('assets/logo.png')}}" alt="Imagen 1" class="hero-image">
    </div>
    <section class="hero fade-in">

        <div class="hero-content">
            <h1 class="hero-title">Grupo IAC del Norte S.A. de C.V.</h1>
            <a href="mailto:contacto@empresa.com" class="btn-contact">CONTÁCTANOS</a>
        </div>
    </section>

    <section class="about fade-in">
        <div class="about-content">
            <section class="about-video bg-light py-5">
                <div class="container">
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe src="https://player.vimeo.com/video/935036374?h=430b92b037&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" title="IACSA.mp4"></iframe>
                    </div>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                </div>
            </section>

            <section class="about-info py-5">
                <div class="container">
                    <h1 class="text-center mb-5">Nuestra Empresa</h1>
                    <div class="row gy-4">
                        <div class="col-lg-7">
                            <h2 class="mb-3">Grupo IAC del Norte</h2>
                            <p class="text-muted">
                                Fue constituida el 15 de marzo de 2016, creada por profesionales en el ramo de la construcción con más de 35 años de experiencia. Ejecutamos obras como:
                            </p>
                            <ul class="list-unstyled">
                                <li><strong>• Vivienda:</strong> Construcción de vivienda residencial y en serie.</li>
                                <li><strong>• Obra Civil:</strong> Cimentaciones, albañilería, estructuras de concreto y metálicas, obras pluviales.</li>
                                <li><strong>• Acabados:</strong> Muros y cielos falsos, pintura, pisos, carpintería, herrería, cancelería, impermeabilizaciones.</li>
                                <li><strong>• Infraestructura Urbana:</strong> Puentes, parques, calles, banquetas, iluminación, alcantarillado.</li>
                                <li><strong>• Caminos:</strong> Pavimentaciones, terracerías, movimientos de tierras, obras de drenaje.</li>
                                <li><strong>• Instalaciones:</strong> Eléctricas, hidrosanitarias, aire acondicionado, fibra óptica.</li>
                                <li><strong>• Telecomunicaciones:</strong> Radio bases, instalación de equipos y torres.</li>
                            </ul>
                        </div>
                        <div class="col-lg-5">
                            <div class="capital text-white p-4 rounded">
                                <h2>Capital Humano</h2>
                                <p>
                                    Nuestro personal ha desarrollado habilidades en construcción de obra y mantenimiento de carreteras. Contamos con la colaboración de profesionales de diversos ramos, lo que nos permite ofrecer servicios de alta calidad.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="vision" class="py-5 bg-light  fade-in">
                <div class="container">

                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <img src="assets/vision.webp" class="img-fluid rounded shadow" alt="Visión">
                        </div>
                        <div class="col-md-6">
                            <h1 class="text-center mb-5">Nuestra Visión</h1>
                            <p class="lead">“Ser considerados por nuestros clientes y socios comerciales como una opción confiable para la realización de sus obras”</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="mision" class="py-5  fade-in">
                <div class="container">

                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h1 class="text-center mb-5 ">Nuestra Misión</h1>
                            <p class="lead">“Proporcionar a nuestros clientes obras de calidad, realizados por un equipo humano altamente capacitado”</p>
                        </div>
                        <div class="col-md-6">

                            <img src="assets/mision.webp" class="img-fluid rounded shadow" alt="Misión">
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-5 text-center">
                <div class="container">
                    <h1 class="mb-5">Conoce nuestro curriculum.</h1>
                    <a href="empresa.pdf" class="btn-pdf  btn-lg" download><i class="bi bi-file-earmark-pdf-fill"></i> Descargar PDF</a>
                </div>
            </section>
        </div>
    </section>

    <section class="carousel fade-in">

        <div class="carousel-container">
            <div class="carousel-item active"><img src="{{asset('assets/carrusel1.png')}}" alt="Imagen 1"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel2.png')}}" alt="Imagen 2"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel3.png')}}" alt="Imagen 3"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel4.png')}}" alt="Imagen 4"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel5.png')}}" alt="Imagen 5"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel6.png')}}" alt="Imagen 6"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel7.png')}}" alt="Imagen 7"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel8.png')}}" alt="Imagen 8"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel9.png')}}" alt="Imagen 9"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel10.png')}}" alt="Imagen 10"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel11.png')}}" alt="Imagen 11"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel12.png')}}" alt="Imagen 12"></div>
            <div class="carousel-item"><img src="{{asset('assets/carrusel13.png')}}" alt="Imagen 13"></div>

            <button class="carousel-control prev">❮</button>
            <button class="carousel-control next">❯</button>
        </div>
    </section>

    <section class="contact fade-in">
        <h1 class="text-center text-contact end-text">Contáctanos</h1>
        <div class="contact-content p-10">
            <div id="contact-info" class="contact-info text-center">
                <div class="content-info">
                    <h1 class="text-center tx-contact">GRUPO IAC DEL NORTE, S.A. DE C.V</h1>
                    <span class="text-center">Micro Empresario No. 117, Col. Las Palmas, Santa Catarina, Nuevo León. C.P. 66187</span>
                    <span class="text-center">Disponibles a través de nuestro correo:</span>
                    <a class="text-center correo" href="mailto:contacto@iacsa.org"><b> contacto@iacsa.org</b></a>
                    
                <div class="work-hours mt-3">
                    <h1 class="text-center tx-contact">Horario de Atención</h1>
                    <div class="col-12">
                        <button id="toggle-hours" class="btn d-flex">Abre hoy : <b>
                                <p id="today-schedule" class="m-0 correo"></p>
                            </b> <i class="bi bi-caret-down-fill"></i></button>
                        <ul id="work-hours-list" class="hidden">
                            <li>Lunes: 9:00 AM - 5:00 PM</li>
                            <li>Martes: 9:00 AM - 5:00 PM</li>
                            <li>Miércoles: 9:00 AM - 5:00 PM</li>
                            <li>Jueves: 9:00 AM - 5:00 PM</li>
                            <li>Viernes: 9:00 AM - 5:00 PM</li>
                            <li>Sábado: Cerrado</li>
                            <li>Domingo: Cerrado</li>
                        </ul>
                    </div>
                </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <button id="show-form-btn" class="btn-contact-2 mt-5">Comunícate con nosotros.</button>
                </div>

            </div>

            <div id="contact-form" class="hidden">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-center tx-contact">Comunícate con nosotros.</h4>
                    <button id="close-form-btn" class="btn btn-light btn-close" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form class="contact-form">
                    <input type="text" placeholder="Nombre" required>
                    <input type="email" placeholder="Correo Electrónico" required>
                    <textarea placeholder="Mensaje" required></textarea>
                    <p>Este sitio está protegido por reCAPTCHA y aplican las Política de privacidad y los Términos de servicio de Google.</p>
                    <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn-contact-2 mt-5">Enviar</button>
                </div>
                </form>
            </div>
        </div>

    </section>
    <footer>
        <div class="footer-content">
            <p>
                Copyright © 2024 GRUPO IAC DEL NORTE, S.A. DE C.V - Todos los derechos reservados.
            </p>
            <span> <b> IACSA</b></span>
        </div>
    </footer>
    @Vite('resources/js/landing.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>