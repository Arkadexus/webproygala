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
    <title>Gala d'Or - Registro</title>
</head>
<body id="colorRegistro">
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
    <form method="post" enctype="multipart/form-data" name="formRegistrar" id="formRegistrar">
    <section class="anchoReducido">
        <div id="baseRegistro">
            <div id="fondoRegistro">
                <div>
                <h2>Gala d'Or</h2>
                <p>Una experiencia para dormir de 5 estrellas a un precio de 1 estrella.</p>  
                </div>
            </div>
            <div id="registro">
                <div>
                    <h2>Registrarse</h2>
                </div>
                <div id="exito"></div>
                <div id="error"></div>
                <div>
                    <label for="username"><em>Nombre de usuario*</em></label><span id="result"></span><br/>
                    <input type="text" name="username" id="username" maxlength="45" required>
                </div>
                <div>
                    <label for="mail"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
                    <input type="email" name="mail" id="mail" maxlength="45" required>
                </div>
                <div>
                    <label for="contrasenya"><em>Contraseña*</em></label><br/>
                    <input type="password" name="contrasenya" id="contrasenya" maxlength="45" required>
                </div>
                <div>
                    <label for="repcontrasenya"><em>Repetir Contraseña*</em></label><br/>
                    <input type="password" name="repcontrasenya" id="repcontrasenya" maxlength="45" required>
                </div>
                <div>
                    <input type="checkbox" name="privacidad" id="privacidad">
                    <label for="privacidad">Acepto la política de privacidad*</label><br>
                </div>
                <div class="formBoton">
                    <input type="button" value="Registrarse" id ="enviarRegistro" name="enviarRegistro" onclick="validarCheckout()">
                </div>
            </div>
        </div>
        
    </section>
    </form>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
</body>
</html>