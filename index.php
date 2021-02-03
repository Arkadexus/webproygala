<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Gala d'Or</title>
</head>
<body>

    <?php
        include('templates/header.html');
    ?>

<div class="contenido">
    <div>
        <img class="mySlides fade" src="img/hotel-index.jpg">
        <img class="mySlides fade" src="img/hotel-index.jpg">
        <img class="mySlides fade" src="img/hotel-index.jpg">
        <div class="botones">
            <span class="punto" onclick="currentSlide(1)"></span>
            <span class="punto" onclick="currentSlide(2)"></span>
            <span class="punto" onclick="currentSlide(3)"></span>
        </div>
    </div>
    <h3>Esto es un test</h3>
    <p>Si esto funciona, significa que la integración con github ha funcionadooooo</p>
    <?php
        for($i = 0; $i < 50; $i++){
            echo("HOLA <br/>");
        }
    ?>
</div>
<script src="scripts/slider.js"></script>
</body>
</html>