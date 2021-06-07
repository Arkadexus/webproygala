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
    <title>Gala d'Or - Contacto</title>
</head>
<body id="fondoEspecial">
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
    <section id="introContactar">
        <h2>Contactar</h2>
        <hr>
        <h3>¡Nos encantaría ayudarte!</h3>
        <p>Si tiene cualquier duda sobre nuestro hotel o página web, no dude en contactar con nosotros.</p>
    </section>
    <section id="contactar" class="anchoReducido">
        <div id="contactar1">
            <div id="error"></div>
            <div id="exito"></div>
            <form id="formContacto" enctype="multipart/form-data">
                <?php
                    if(isset($_SESSION['usuario'])){
                        include("scripts/conexion.php");
                        $res = $galador->query("SELECT * FROM usuarios WHERE login = '".$_SESSION['usuario']."'") or die ($galador->$error);
                        while ($fila = mysqli_fetch_array($res)){
                ?>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre*" maxlength="20" value="<?php echo $fila['nombre'] ?>">
                <input type="email" name="correo" id="correo" placeholder="Correo Electrónico*" maxlength="60" value="<?php echo $fila['email'] ?>">
                <input type="text" name="asunto" id="asunto" placeholder="Asunto*" maxlength="20">
                <textarea name="mensaje" id="mensaje" placeholder="Mensaje*" rows="10"></textarea>
                <input type="checkbox" name="privacidad" id="privacidad">
                <label for="privacidad">Acepto la <a href="privacidad.php" target="_blank">política de privacidad</a>*</label><br>
                <input type="button" value="Enviar" class="EnviarMensaje">
                <?php
                }
                }else{ ?>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre*" maxlength="20" autofocus>
                <input type="email" name="correo" id="correo" placeholder="Correo Electrónico*" maxlength="60">
                <input type="text" name="asunto" id="asunto" placeholder="Asunto*" maxlength="20">
                <textarea name="mensaje" id="mensaje" placeholder="Mensaje*" rows="10"></textarea>
                <input type="checkbox" name="privacidad" id="privacidad">
                <label for="privacidad">Acepto la <a href="privacidad.php" target="_blank">política de privacidad</a>*</label><br>
                <input type="button" value="Enviar" class="EnviarMensaje">
                <?php } ?>
            </form>
        </div>
        <div id="contactar2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1496.8700374532364!2d2.1910352836252383!3d41.37973162051897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a3a8329aae13%3A0x8892a4ae305574b1!2sCarrer%20de%20Sant%20Carles%2C%2035%2C%2008003%20Barcelona!5e0!3m2!1ses!2ses!4v1617561678033!5m2!1ses!2ses" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <div>
                <i class="fa fa-phone"></i><span>942 024 422</span>
                <i class="fa fa-envelope"></i><span>contacte@galador.es</span>
                <i class="fa fa-location-arrow"></i><span>Carrer de Sant Carles, 35, 08003 Barcelona</span>
            </div>
        </div>
    </section>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script>
    $(document).ready(function() {
        $(".EnviarMensaje").click(function(){
            let nombre = document.getElementById("nombre").value;
            let correo = document.getElementById("correo").value;
            let asunto = document.getElementById("asunto").value;
            let mensaje = document.getElementById("mensaje").value;
            let privacidad = document.getElementById("privacidad");

            let exito = document.getElementById("exito");
            let error = document.getElementById("error");

            if (nombre.length == 0 || nombre == null || /^\s+$/.test(nombre) || 
            correo.length == 0 || correo == null || /^\s+$/.test(correo) ||
            asunto.length == 0 || asunto == null || /^\s+$/.test(asunto) ||
            mensaje.length == 0 || mensaje == null || /^\s+$/.test(mensaje)){
                $("#error").html("Todos los campos son obligatorios.");
                $(error).fadeIn(1000).css("display","inline-block");
                $(error).fadeOut(5000);
                return 0;
            }

            if(!privacidad.checked){
                $("#error").html("Es obligatorio aceptar la política de privacidad.");
                $(error).fadeIn(1000).css("display","inline-block");
                $(error).fadeOut(5000);
                return 0;
            }

            if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(correo)){
                $("#error").html("El formato de correo es incorrecto.");
                $(error).fadeIn(1000).css("display","inline-block");
                $(error).fadeOut(5000);
                return 0;
            }

            $.ajax({
            url: "scripts/enviarMensaje.php",
            type: "POST",
            data:{
                usuario: nombre,
                correo: correo,
                asunto: asunto,
                mensaje: mensaje,
            },
                success: function (data) {
                    $("#exito").html("Se ha enviado el mensaje correctamente.");
                    $(exito).fadeIn(1000).css("display","inline-block");
                    $(exito).fadeOut(5000);
                },
                error: function (data) {
                    $("#error").html("Ha habido un error enviando el mensaje. Inténtelo de nuevo.");
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                }
            });
        });
    });
</script>
</body>
</html>