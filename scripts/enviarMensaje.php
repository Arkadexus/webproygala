<?php
include("conexion.php");
$galador -> query("INSERT INTO mensajes(asunto, cuerpo, email) VALUES ('".$_POST['asunto']."', '".$_POST['mensaje']."', '".$_POST['correo']."')")
?>