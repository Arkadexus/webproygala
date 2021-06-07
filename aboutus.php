<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Sobre Nosotros</title>
</head>
<body class="antiMargen">
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
    <div class="bannerPagina"><h1>Sobre Nosotros</h1></div>
    <section id="sobreNosotros">
        <h2 id="tituloSobreNosotros">Gala d'Or</h2>
        <p class="centrar" id="introSobreNosotros">El hotel y ubicación perfectos para tus vacaciones</p>
        <p class="espacioSuperior"><b>¿Quiénes somos?</b></p>
        <p>Somos Gala d’Or, una empresa que se está introduciendo en el sector de la hostelería. Actualmente disponemos de un Hotel ubicado en el municipio de Barcelona. Su inmejorable ubicación es uno de sus principales atractivos, ya que está rodeado de la mejor oferta cultural, el shopping más exclusivo, los centros de negocios más importantes y cercano a las cristalinas playas de la ciudad.</p>
        <p class="espacioSuperior"><b>Nuestra Historia</b></p>
        <p>Nuestra historia se remonta a tiempos muy recientes; Después de unas vacaciones alojados en un hotel de Barcelona, nos dimos cuenta que podíamos mejorar el servicio que se estaba ofreciendo. Nos surgió la oportunidad de apostar por este sector cuando sucedió la pandemia de la Covid-19, ya que muchos hoteles tuvieron que cerrar debido a su pérdida de clientes, nosotros queremos ser sus sucesores y además superar la calidad de sus servicios.</p>
    </section>
    <section id="sobreNosotrosBloques">
        <div class="dosPartes">
            <div id="fondoMision"></div>
            <div class="contenidoDosPartes" id="misionPadding">
                <p class="tituloParrafo">Misión</p>
                <p>Tenemos la misión de mejorar continuamente el sector de la hostelería y marcar la tendencia en una vida de lujo a medida, actualizándolo a los nuevos tiempos. Es el servicio de nuestro hotel, servido en total privacidad. </p>
            </div>
        </div>
        <div class="dosPartes" id="vision">
            <div class="contenidoDosPartes">
                <p class="tituloParrafo">Visión</p>
                <p>Nuestra visión es crear propiedades ricas en carácter en los destinos más exclusivos y deseables del mundo, empezando por Barcelona.</p>
                <p>Además, nuestro compromiso con la sostenibilidad comienza desde el principio. Usamos recursos locales para crear cuidadosamente cada una de nuestras propiedades, como maderas en gran cantidad de bosques cercanos, productos de negocios de propiedad local y paneles solares para energía renovable.</p>
            </div>
            <div id="fondoVision"></div>
        </div>
        <div class="dosPartes">
            <div id="fondoValores"></div>
            <div class="contenidoDosPartes">
                <p class="tituloParrafo">Valores</p>
                <p>Autenticidad, sostenibilidad y un servicio personalizado son el núcleo de nuestra identidad.</p>
                <p>Cada miembro de nuestro personal es seleccionado por sus estándares inquebrantables, ya sea un chef innovador de un restaurante de renombre o un entrenador de salud y bienestar que se adapta perfectamente a usted. </p>
            </div>
        </div>
        <br><br><br>
    </section>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
</body>
</html>