<?php
include ("conexion.php");
$galador -> query("DELETE FROM mensajes WHERE id_mensaje='".$_POST['id_mensaje']."'");
?>