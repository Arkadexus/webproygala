<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Mis Datos</title>
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
                    <li><b>Mis Datos</b></li>
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

            <form method="post" enctype="multipart/form-data" id="formulario">
            <div id="misdatos">
                <?php
                    require("scripts/conexion.php");
                    $resultado = $galador->query("SELECT * FROM usuarios WHERE login='".$_SESSION["usuario"]."'") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
                    while ($fila = mysqli_fetch_array($resultado)){
                ?>
                <div>
                    <h2>Mis Datos</h2>
                </div>
                <div id="error"></div>
                <div id="exito"></div>
                <div class="formMisDatos">
                <div>
                    <label for="nombre"><em>Nombre</em></label><br/>
                    <input type="text" name="nombre" id="nombre" maxlength="45" value="<?php echo($fila["nombre"]); ?>">
                </div>
                <div>
                    <label for="apellidos"><em>Apellidos</em></label><br/>
                    <input type="text" name="apellidos" id="apellidos" maxlength="45" value="<?php echo($fila["apellidos"]); ?>">
                </div>
                <div>
                    <label for="telefono"><em>Teléfono</em></label><br/>
                    <input type="tel" name="telefono" id="telefono" maxlength="9" placeholder = "000000000" value="<?php echo($fila["telefono"]); ?>">
                </div>
                <div>
                    <label for="mail"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
                    <input type="email" name="mail" id="mail" maxlength="45" value="<?php echo($fila["email"]); ?>" readonly>
                </div>
                </div>
                <div>
                    <input type="checkbox" name="privacidad" id="privacidad">
                    <label for="privacidad">Acepto la <a href="privacidad.php" target="_blank">política de privacidad</a>*</label>
                </div>
                <div></div>
                <div class="formBoton">
                    <input type="button" value="Cambiar Datos" id ="Enviar" name="Enviar" onclick="validarMisDatos()">
                </div>
                <div>
                    <h2 style="margin-top: 20px;">Contraseña</h2>
                </div>
                <div class="formMisDatos">
                    <div>
                        <label for="contrasenya"><em>Contraseña*</em></label><br/>
                        <input type="password" name="contrasenya" id="contrasenya" maxlength="45" required>
                    </div>
                    <div>
                        <label for="repcontrasenya"><em>Repetir Contraseña*</em></label><br/>
                        <input type="password" name="repcontrasenya" id="repcontrasenya" maxlength="45" required>
                    </div>
                </div>
                <div class="formBoton">
                    <input type="button" value="Cambiar Contraseña" id ="Enviar2" name="Enviar2" onclick="validarMisDatosPass()">
                </div>
        </div>
        </form>
</div>
<?php }
}else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validarMisDatos.js"></script>
</body>
</html>