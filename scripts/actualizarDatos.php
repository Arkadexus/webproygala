<?php
session_start();
require("conexion.php");
$galador->query("UPDATE usuarios SET nombre='".$_POST["nombre"]."', apellidos='".$_POST["apellidos"]."', telefono='".$_POST["telefono"]."' WHERE login='".$_SESSION["usuario"]."'") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
sleep(0.5);
?>