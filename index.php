<!DOCTYPE html>
<html lang="en">
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
        include('templates/header.html');
    ?>
<div class="contenido">
<!-- Slider -->
    <div class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide"><div class="contenido_slider"><h2>La habitación perfecta <i>cerca del mar</i></h2><span>Precioso hotel ubicado en la Barceloneta,<br> óptimo para turismo en Barcelona y playa.</span></div><img src="img/slider1.png" alt="slide hotel 1"></li>
                <li class="splide__slide"><div class="contenido_slider"><h2>Experiencia como ninguna otra</h2><span>El hotel y ubicación perfectos para tus vacaciones.</span></div><img src="img/slider2.png" alt="slide hotel 2"></li>
                <li class="splide__slide"><div class="contenido_slider"><h2>Comida única del mediterraneo</h2><span>Ofrecemos servicio de restaurante con recetas mediterraneas</span></div><img src="img/slider3.png" alt="slide hotel 3"></li>
            </ul>
        </div>
    <!--
    https://pixabay.com/es/photos/paisaje-hotel-complejo-paisajes-2016308/
    https://pixabay.com/es/photos/hotel-berl%C3%ADn-kurf%C3%BCrstendamm-ciudad-951599/
    https://pixabay.com/es/photos/complejo-hotel-playa-%C3%A1rbol-956829/
    https://pixabay.com/es/photos/sill%C3%B3n-sof%C3%A1-decoraci%C3%B3n-almohada-2608761/
    https://pixabay.com/es/photos/caf%C3%A9-hotel-cama-holiday-servicio-4507707/
    -->
    </div>
    <h3>Esto es un test</h3>
    <p>Si esto funciona, significa que la integración con github ha funcionadooooo</p>
    <?php
        for($i = 0; $i < 50; $i++){
            echo("<p>HOLA</p>");
        }
    ?>
</div>
<script src="scripts/cargarSlider.js"></script>
<script src="scripts/sliderHome.js"></script>
<script src="scripts/headerTransparente.js"></script>
</body>
</html>