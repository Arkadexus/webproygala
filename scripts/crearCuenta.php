<?php
    include("conexion.php");
    $contrasenya = $_POST['contrasenya'];
    stripslashes(htmlspecialchars($resultado = $galador->query("INSERT INTO usuarios(login, contrasenya, email) VALUES ('".$_POST["username"]."',SHA('$contrasenya'),'".$_POST["mail"]."')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
?>