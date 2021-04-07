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
    <title>Gala d'Or - Registro</title>
</head>
<body>
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
    <?php
        $error = "";
        require("scripts/conexion.php");
        if(isset($_POST['username'])){
            $contrasenya = $_POST['contrasenya'];
            stripslashes(htmlspecialchars($resultado = $galador->query("INSERT INTO `clientes`(`login`, `contrasenya`, `nombre`, `apellidos`, `genero`, `email`, `telefono`, `tipodoc`, `doc`) VALUES ('".$_POST["username"]."',SHA('$contrasenya'),'".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["genero"]."','".$_POST["mail"]."','".$_POST["telefono"]."','".$_POST["tipoDoc"]."','".$_POST["doc"]."')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
        }else{
    ?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" id="formulario" onsubmit="return validacion()">
    <section class="anchoReducido">
        <div id="registro">
        <div>
            <h2>Registrarse</h2>
        </div>
        <div></div>
        <div>
            <label for="username"><em>Nombre de usuario*</em></label><span id="result"></span><br/>
            <input type="text" name="username" id="username" maxlength="255" autofocus required>
        </div>
        <div>
            <label for="nombre"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
            <input type="email" name="mail" id="mail" maxlength="255" required>
        </div>
        <div>
            <label for="nombre"><em>Contraseña*</em></label><br/>
            <input type="password" name="contrasenya" id="contrasenya" maxlength="255" required>
        </div>
        <div>
            <label for="nombre"><em>Repetir Contraseña*</em></label><br/>
            <input type="password" name="repcontrasenya" id="repcontrasenya" maxlength="255" required>
        </div>
        <div>
            <label for="nombre"><em>Nombre*</em></label><br/>
            <input type="text" name="nombre" id="nombre" maxlength="255" required>
        </div>
        <div>
            <label for="apellidos"><em>Apellidos*</em></label><br/>
            <input type="text" name="apellidos" id="apellidos" maxlength="255" required>
        </div>
        <div>
            <label for="telefono"><em>Teléfono*</em></label><br/>
            <input type="tel" name="telefono" id="telefono" maxlength="9" required>
        </div>
        <div>
            <label for="genero"><em>Género*</em></label><br/>
            <select name="genero" id="genero">
                <option value="h">Hombre</option>
                <option value="m">Mujer</option>
            </select>
        </div>
        <div>
            <label for="tipoDoc"><em>Tipo de Documento*</em></label><br/>
            <select name="tipoDoc" id="tipoDoc">
                <option value="D">DNI</option>
                <option value="P">Pasaporte</option>
            </select>
        </div>
        <div>
            <label for="doc"><em>Documento*</em></label><br/>
            <input type="text" name="doc" id="doc" maxlength="9" required>
        </div>
        <div>
            <input type="checkbox" name="polpriv" id="polpriv" required>Acepto la política de privacidad*
        </div>
        <div></div>
        <div class="formBoton">
            <input type="submit" value="Enviar" id ="Enviar" name="Enviar">
        </div>
        <div class="formBoton">
            <input type="reset" value="Reiniciar" id="Reiniciar">
        </div>
        </div>
    </form>
    </section>
    <?php
        }
    ?>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
</body>
</html>