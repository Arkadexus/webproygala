<?php
$contrasenya = $_POST['contrasenya'];
include('conexion.php');
session_start();
$galador -> query("UPDATE usuarios SET contrasenya=SHA('$contrasenya') WHERE login='".$_SESSION["usuario"]."' ") or die ($galador->error);
?>