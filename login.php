<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Inicio de Sesión</title>
</head>
<body id="colorRegistro">
    <?php
        include('templates/header.php');
        require("scripts/conexion.php");
        if(isset($_SESSION["usuario"])){
            header("location: micuenta.php");
        }
        if(isset($_POST['usuario'])){
            $usuario = $_POST['usuario'];
            $contrasenya = $_POST['contrasenya'];
            $resultado = $galador->query("SELECT * FROM usuarios WHERE login='$usuario' AND contrasenya=SHA('$contrasenya')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
            $filas = mysqli_num_rows($resultado);
            if($filas == 0){
                echo("Este usuario y/o contraseñas son incorrectos.");
            }else{
                session_start();
                $_SESSION["usuario"] = $usuario;
                $fila = mysqli_fetch_row($resultado);
                if($fila[6] == 1){
                    $_SESSION["admin"] = true;
                }
                header("location: micuenta.php");
            }
        }else{
    ?>
<div class="contenido">
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" id="inicioSesion">
    <section id="login">
        <img src="img/logo_small.png" alt="Gala d'Or">
        <label for="usuario">Nombre de Usuario</label>
        <input type="text" name="usuario" id="usuario" minlength="6" autofocus required>
        <label for="contrasenya">Contraseña</label>
        <input type="password" name="contrasenya" id="contrasenya" minlength="6" required>
        <div id="recuerdame">
        <input type="checkbox" name="recordar" id="recordar"><label for="recordar">Recuérdame</label><br><br>
        <input type="submit" value="Iniciar Sesión" id ="EnviarLogin">
        <!--<a href="#" class="estiloEnlace">¿Olvidaste la contraseña?</a><br>-->
        <a href="registro.php" class="estiloEnlace">Crear una cuenta</a>
        </div>
    </section>
    </form>
</div>
<?php
        }
        ?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
</body>
</html>