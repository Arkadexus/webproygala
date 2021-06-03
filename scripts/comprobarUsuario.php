<?php
    require("conexion.php");
    $usuario = $_POST['usuario'];
    $contrasenya = $_POST['contrasenya'];
    $resultado = $galador->query("SELECT * FROM usuarios WHERE login='$usuario' AND contrasenya=SHA('$contrasenya')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error );
    $filas = mysqli_num_rows($resultado);
    if($filas == 0){
        echo("Este usuario y/o contraseñas son incorrectos.");
    }else{
        session_start();
        $_SESSION["usuario"] = $usuario;
        $fila = mysqli_fetch_row($resultado);
        if($fila[6] == 1){
            $_SESSION["admin"] = true;
        }
    }
?>