<?php
include ("conexion.php");
$galador -> query("DELETE FROM usuarios WHERE login='".$_POST['login']."'");
$galador -> query("UPDATE reservas SET login=NULL WHERE login='".$_POST['login']."'");
?>