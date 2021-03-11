<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Gala d'Or</title>
</head>
<body>

    <?php
        include('templates/header.html');
    ?>

<div class="contenido">
<div class="splide">
	<div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide"><img src="img/hotel-index.jpg" alt="slide hotel 1"></li>
			<li class="splide__slide"><img src="img/hotel-index2.jpg" alt="slide hotel 2"></li>
			<li class="splide__slide"><img src="img/hotel-index3.jpg" alt="slide hotel 2"></li>
		</ul>
	</div>
</div>
    <h3>Esto es un test</h3>
    <p>Si esto funciona, significa que la integración con github ha funcionadooooo</p>
    <?php
        for($i = 0; $i < 50; $i++){
            echo("<p>HOLA</p>");
        }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="scripts/cargarSlider.js"></script>
</body>
</html>