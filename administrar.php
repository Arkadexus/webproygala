<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts/comprobacion.js"></script>
    <script src="scripts/comprobacion2.js"></script>
    <title>Gala d'Or - Administrar</title>
</head>
<body id="colorRegistro">
    <?php
        include('templates/header.php');
        if(isset($_SESSION["admin"])){
    ?>
<div class="contenido">
    <section id="micuenta">
        <div>
            <div id="datosUsuario">
                <span>Bienvenid@, <?php echo($_SESSION["usuario"])?></span>
            </div>
            <div id="menuUsuario">
                <h4>Menú</h4>
                <ul>
                    <li><a href="micuenta.php" class="estiloEnlace">Escritorio</a></li>
                    <li><a href="misdatos.php" class="estiloEnlace">Mis Datos</a></li>
                    <li><a href="misreservas.php" class="estiloEnlace">Mis Reservas</a></li>
                    <?php
                    if(isset($_SESSION["admin"])){ ?>
                    <li><a href="usuarios.php" class="estiloEnlace">Usuarios</a></li>
                    <li><a href="habitaciones.php" class="estiloEnlace">Habitaciones</a></li>
                    <li><a href="contactos.php" class="estiloEnlace">Contactos</a></li>
                    <li><a href="reservas.php" class="estiloEnlace">Reservas</a></li>
                    <li><a href="ofertas.php" class="estiloEnlace">Ofertas</a></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div id="escritorio">
            <h2>Administrar</h2>
            <span></span>
            <a href="usuarios.php"><div>
                <i class="fa fa-users"></i><br>
                <span>Usuarios</span>
            </div></a>
            <a href="habitaciones.php"><div>
                <i class="fa fa-bed"></i><br>
                <span>Habitaciones</span>
            </div></a>
            <a href="contactos.php"><div>
                <i class="fa fa-comments"></i><br>
                <span>Contactos</span>
            </div></a>
            <a href="reservas.php"><div>
                <i class="fa fa-calendar-check-o"></i><br>
                <span>Reservas</span>
            </div></a>
            <a href="ofertas.php"><div>
                <i class="fa fa-bookmark-o"></i><br>
                <span>Ofertas</span>
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