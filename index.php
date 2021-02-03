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
    <img id="imagen-principal" src="img/hotel-index.jpg" alt="slider primera imagen">
    <h3>Esto es un test</h3>
    <p>Si esto funciona, significa que la integración con github ha funcionadooooo</p>
    <?php
        for($i = 0; $i < 15; $i++){
            echo("HOLA <br/>");
        }
    ?>
</div>

    <!--<script src="scripts/alert.js"></script>-->
</body>
</html>