<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - En Mantenimiento</title>
</head>
<body>
    <?php
        include('templates/header.php');
    ?>
<div class="contenido compraRealizada">
    <div>
        <p class="tituloCompra">LO SENTIMOS</p>
        <p class="descCompra">Esta página se encuentra en mantenimiento</p>
        <p class="descCompra">Redireccionando en 10 segundos...</p>
    </div>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validarCheckout.js"></script>
<script src="scripts/mostrarRegistro.js"></script>
</body>
</html>
<?php
header("refresh: 10; url=index.php");
?>