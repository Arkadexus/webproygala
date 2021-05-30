<?php
include ("conexion.php");
$galador -> query("UPDATE reservas SET estado='Cancelado' WHERE id_res='".$_POST['id_res']."'");
?>