<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or</title>
</head>
<body>

    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
<!-- Slider -->
    <div class="splide anchoCompleto">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide"><div class="contenido_slider"><h2>La habitación perfecta <i>cerca del mar</i></h2><span>Precioso hotel ubicado en la Barceloneta,<br> óptimo para turismo en Barcelona y playa.</span></div><img src="img/slider1.png" alt="slide hotel 1"></li>
                <li class="splide__slide"><div class="contenido_slider"><h2>Experiencia como ninguna otra</h2><span>El hotel y ubicación perfectos para tus vacaciones.</span></div><img src="img/slider2.png" alt="slide hotel 2"></li>
                <li class="splide__slide"><div class="contenido_slider"><h2>Comida gourmet del mediterraneo</h2><span>Ofrecemos servicio de restaurante con recetas mediterraneas</span></div><img src="img/slider3.png" alt="slide hotel 3"></li>
            </ul>
        </div>
    </div>
    <div id="botonReservar">
        <a href="reservar.php"><button>Reservar</button></a>
    </div>
    <section id="habitacionesYSuites">
        <div id="hYSContenido">
            <div>
            <h3>Habitaciones y Suites</h3>
            <p>Disfrute de las gloriosas vistas a las aguas cristalinas del mar Mediterráneo en nuestras 50 habitaciones y suites. Gala d’Or está en una ubicación cercana a la playa, incluye interiores elegantes y un servicio impecable, incluida la asistencia de nuestros amables conserjes. Disponemos de un servicio de comida propio y además cerca nuestro hay una elegante selección de bares y restaurantes de destino, spas de lujo, y otros comercios.</p><br>
            <p>Tenemos la intención de adaptarnos a todos los tipos de cliente, por lo que además incluimos suites de centros de conferencias contemporáneos, que son impresionantes y flexibles. Diseño interior de felpa, franjas de luz natural e imagen, el panorama perfecto del mar las hace populares como opción para bodas y otros eventos hechos a medida como negocios. Reserve sus vacaciones o evento con nosotros y consulte nuestras ofertas especiales para experimentar lo mejor que la costa mediterránea tiene para ofrecer.</p>
            <br><a href="reservar.php"><button>Reservar</button></a>
            </div>
        </div>
        <div id="HYSImagen">
            <img src="img/playa_barcelona.jpg" alt="playa de barcelona">
        </div>
    </section>

    <section id="ofertas">
        <h2>Ofertas</h2>
        <p>Aproveche las ofertas exclusivas al reservar directamente con Gala d’Or. Ya sea que esté buscando explorar Barcelona y otras partes de la hermosa costa catalana, o tal vez sólo desee un fin de semana de distancia, nuestras ofertas están adaptadas para satisfacer sus necesidades. Desde detalles sencillos para mejorar su experiencia de vacaciones, hasta itinerarios a medida que le ayudan a explorar el rico patrimonio del destino, sus museos y atracciones; nuestras ofertas especiales están diseñadas para adaptarse a los servicios y comodidades más solicitados de nuestros huéspedes.</p>
        <div id="ofertasActuales">
            <div>
                <img src="img/hotel-index.jpg" alt="Quedate mas">
                <div class="ofertasContenido">
                    <h3>Quédate más</h3>
                    <p>¡Tómate un poco más de tiempo!  Si está cinco noches con nosotros, le daremos un descuento.</p>
                </div>
            </div>
            <div>
                <img src="img/ofertaComida.jpg" alt="Comida incluida">
                <div class="ofertasContenido">
                    <h3>Comida Incluida</h3>
                    <p>Si su reserva cuesta más de 125€, le ofreceremos un día gratuito de nuestro servicio de restaurante.</p>
                </div>
            </div>
            <div>
                <img src="img/turismo.jpg" alt="Ofertas contenido">
                <div class="ofertasContenido">
                    <h3>Turismo por Barcelona</h3>
                    <p>Por (precio placeholder) por noche, le ofrecemos un servicio de turismo donde un guía de  habla inglesa estará a su  disposición por 2 horas al día.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="comidas">
        <div id="comidasContenido">
            <h2 class="tituloAlt">Comidas</h2>
            <p>Disponemos de un servicio de restaurante que le dará a conocer la comida mediterránea y de la magnífica cultura culinaria española. Le proporcionamos solo lo mejor de la cocina, preparando tanto platos clásicos como los más modernos. Si incluye el servicio de restaurante en su reserva, se le aplicarán las mismas ofertas que aplicamos con las habitaciones. </p>
            <p>Si además quiere probar otros lugares, tenemos una gran cantidad de restaurantes y bares cerca del hotel, perfecto para sus actividades de turismo.</p>
        </div>
        <div id="comidasImagen">
        </div>
    </section>
    <section id="zonaDigital">
        <div id="zdImagen">
        </div>
        <div id="zdContenido">
            <h2 class="tituloAlt">Zona Digital</h2>
            <p>Disponemos de un servicio de restaurante que le dará a conocer la comida mediterránea y de la magnífica cultura culinaria española. Le proporcionamos solo lo mejor de la cocina, preparando tanto platos clásicos como los más modernos. Si incluye el servicio de restaurante en su reserva, se le aplicarán las mismas ofertas que aplicamos con las habitaciones. </p>
            <p>Si además quiere probar otros lugares, tenemos una gran cantidad de restaurantes y bares cerca del hotel, perfecto para sus actividades de turismo.</p>
        </div>
    </section>
</div>
<?php include("templates/footer.html")?>
<!-- SCRIPTS-->
<script src="scripts/cargarSlider.js"></script>
<script src="scripts/sliderHome.js"></script>
<script src="scripts/headerTransparente.js"></script>
<script src="scripts/menu.js"></script>
</body>
</html>