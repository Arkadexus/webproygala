<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Mis Reservas</title>
</head>
<body id="colorRegistro">
    <?php
        include('templates/header.php');
        if(isset($_SESSION["usuario"])){
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
                    <li>Mis Reservas</li>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>

        <div>
            <h2>Mis Reservas</h2>
            <?php
            if(isset($_POST['enviar'])){
                include("scripts/conexion.php");
                //DATOS USUARIO
                $usuario = $galador -> query("SELECT * from usuarios
                WHERE login = '".$_SESSION['usuario']."'") or die ($galador->error);
                $filausuario = mysqli_fetch_row($usuario);
                //CREAR MENSAJE EN BBDD
                $galador -> query("INSERT INTO mensajes(asunto, cuerpo, login, email, telefono, fecha)
                VALUES ('".$_POST['asunto']."', '".$_POST['cuerpo']."', '".$filausuario[0]."', '".$filausuario[4]."', '".$filausuario[5]."', NOW())") or die ($galador->error);
                $filausuario = mysqli_fetch_row($usuario);
                echo '<div id="exito" style="display:inline-block">Tu mensaje ha sido recibido. Se te redireccionará en 5 segundos.</div>';
                header("refresh: 5; url=misreservas.php");
            }else{
            ?>
            <div id="modificarReserva">
                <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
                    <label for="asunto">Asunto</label>
                    <input type="text" name="asunto" id="asunto" maxlength="255" value="Modificación Reserva #<?php echo$_GET["id"] ?>" required readonly>
                    <label for="cuerpo">Cuerpo</label>
                    <textarea name="cuerpo" id="cuerpo" cols="30" rows="10" placeholder="Indícanos lo que deseas modificar." required></textarea>
                    <input type="submit" value="Enviar" name="enviar" id="enviar">
                </form>
            </div>
        </div>
</div>
<?php
            }
}else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
</body>
</html>