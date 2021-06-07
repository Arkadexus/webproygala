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
        if(isset($_SESSION["usuario"])){
            header("location: micuenta.php");
        }
    ?>
<div class="contenido">
    <form  enctype="multipart/form-data" id="inicioSesion">
    <section id="login">
        <img src="img/logo_small.png" alt="Gala d'Or">
        <div id="error"></div>
        <label for="usuario">Nombre de Usuario</label>
        <input type="text" name="usuario" id="usuario" minlength="6">
        <label for="contrasenya">Contraseña</label>
        <input type="password" name="contrasenya" id="contrasenya" minlength="6">
        <div id="recuerdame">
        <input type="button" value="Iniciar Sesión" class="EnviarLogin">
        <!--<a href="#" class="estiloEnlace">¿Olvidaste la contraseña?</a><br>-->
        <a href="registro.php" class="estiloEnlace">Crear una cuenta</a>
        </div>
    </section>
    </form>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script>
    $(document).ready(function() {
        $(".EnviarLogin").click(function(){
            let nombre = document.getElementById("usuario").value;
            let contrasenya = document.getElementById("contrasenya").value;

            if (nombre.length == 0 || nombre == null || /^\s+$/.test(nombre) || 
            contrasenya.length == 0 || contrasenya == null || /^\s+$/.test(contrasenya)){
                $("#error").html("Todos los campos son obligatorios.");
                $(error).fadeIn(1000).css("display","inline-block");
                $(error).fadeOut(5000);
                return 0;
            }

            if(contrasenya.length < 6){
                $("#error").html("La contraseña debe tener 6 o más carácteres.");
                $(error).fadeIn(1000).css("display","inline-block");
                $(error).fadeOut(5000);
                return 0;
            }

            var formData = new FormData(document.getElementById("inicioSesion"));

            $.ajax({
            url: "scripts/comprobarUsuario.php",
            type: "POST",
            data:{
                usuario: nombre,
                contrasenya: contrasenya
            },
                success: function (data) {
                    if(data == ""){
                        location.replace("micuenta.php");
                    }
                    $("#error").html(data);
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                },
                error: function (data) {
                    $("#error").html("Ha habido un error iniciando sesión. Inténtelo de nuevo.");
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                }
            });
        });
    });
</script>
</body>
</html>