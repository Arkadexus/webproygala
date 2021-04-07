<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Mis Datos</title>
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
                    <li><a href="micuenta.php" class="estiloEnlace">Escritorio</a></li>
                    <li>Mis Datos</li>
                    <li><a href="misreservas.php" class="estiloEnlace">Mis Reservas</a></li>
                    <li><a href="metodospago.php" class="estiloEnlace">Métodos de Pago</a></li>
                    <li><a href="script/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>

            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" id="formulario">
            <div id="registro">
                <?php
                    require("scripts/conexion.php");
                    $resultado = $galador->query("SELECT * FROM clientes WHERE login='".$_SESSION["usuario"]."'") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()){
                ?>
                <div>
                    <h2>Mis Datos</h2>
                </div>
                <div></div>
                <div>
                    <label for="mail"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
                    <input type="email" name="mail" id="mail" maxlength="255" value="<?php echo($fila["email"]); ?>" required readonly>
                </div>
                <div>
                    <label for="contrasenya"><em>Foto de perfil*</em></label><br/>
                    <input type="text" name="foto" id="foto" maxlength="255" value = "PENDIENTE" required readonly>
                </div>
                <div>
                    <label for="nombre"><em>Nombre*</em></label><br/>
                    <input type="text" name="nombre" id="nombre" maxlength="255" value="<?php echo($fila["nombre"]); ?>"required>
                </div>
                <div>
                    <label for="apellidos"><em>Apellidos*</em></label><br/>
                    <input type="text" name="apellidos" id="apellidos" maxlength="255" value="<?php echo($fila["apellidos"]); ?>" required>
                </div>
                <div>
                    <label for="telefono"><em>Teléfono*</em></label><br/>
                    <input type="tel" name="telefono" id="telefono" maxlength="9" value="<?php echo($fila["telefono"]); ?>"required>
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
                    <input type="text" name="doc" id="doc" maxlength="9" value="<?php echo($fila["doc"]); ?>" required>
                </div>
                <div>
                    <input type="checkbox" name="polpriv" id="polpriv" required>Acepto la política de privacidad*
                </div>
                <div></div>
                <div class="formBoton">
                    <input type="submit" value="Cambiar Datos" id ="Enviar" name="Enviar">
                </div>
                <div class="formBoton">
                    <input type="reset" value="Reiniciar" id="Reiniciar">
                </div> 
        </div>
        </form>
</div>
<?php }
mysqli_close($galador);
if(isset($_POST['nombre'])){
    require("scripts/conexion.php");
    $resultado = $galador->query("UPDATE `clientes` SET `nombre`='".$_POST["nombre"]."',`apellidos`='".$_POST["apellidos"]."',`genero`='".$_POST["genero"]."',`email`='".$_POST["mail"]."',`tipodoc`='".$_POST["tipoDoc"]."',`doc`='".$_POST["doc"]."',`telefono`='".$_POST["telefono"]."' WHERE login='".$_SESSION["usuario"]."'") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
    echo("Se ha realizado el cambio correctamente.");
}
}else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
</body>
</html>