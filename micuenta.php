<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts/comprobacion.js"></script>
    <script src="scripts/comprobacion2.js"></script>
    <title>Gala d'Or - Mi Cuenta</title>
</head>
<body>
    <?php
        include('templates/header.php');
        if(isset($_SESSION["usuario"])){
    ?>
<div class="contenido">
    <section id="micuenta">
        <div>
            <div id="datosUsuario">
                <img src="img/Portrait_Placeholder.png" width="125px" height="125px" alt="foto de perfil">
                <span>Bienvenid@, <?php echo($_SESSION["usuario"])?></span>
            </div>
            <div id="menuUsuario">
                <h4>Menú</h4>
                <ul>
                    <li>Escritorio</li>
                    <li><a href="misdatos.php" class="estiloEnlace">Mis Datos</a></li>
                    <li><a href="misreservas.php" class="estiloEnlace">Mis Reservas</a></li>
                    <li><a href="metodospago.php" class="estiloEnlace">Métodos de Pago</a></li>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div id="escritorio">
            <a href="#"><div>
                <i class="fa fa-server"></i><br>
                <span>Mis Datos</span>
            </div></a>
            <a href="#"><div>
                <i class="fa fa-server"></i><br>
                <span>Mis Datos</span>
            </div></a>
            <a href="#"><div>
                <i class="fa fa-server"></i><br>
                <span>Mis Datos</span>
            </div></a>
            <a href="#"><div>
                <i class="fa fa-server"></i><br>
                <span>Mis Datos</span>
            </div></a>
        </div>
    </section>
</div>
<?php }else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
</body>
</html>