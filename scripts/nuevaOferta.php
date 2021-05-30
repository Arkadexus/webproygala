<?php
include("conexion.php");
    if($_FILES['imagen']['name'] !=''){
        $carpeta = "img/";
        $nombre = $_FILES['imagen']['name'];

        $temp = explode('.', $nombre);
        $extension = end($temp);

        $nombreFinal = time().'.'.$extension;
        $nombreFinal = $carpeta.$nombreFinal;

        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], '../'.$nombreFinal)){
                $galador->query("INSERT INTO ofertas(nombre, descripcion, precio, foto, por_Noche, activa) VALUES ('".$_POST['nombre']."', '".$_POST['descripcion']."', '".$_POST['precio']."', '$nombreFinal', '".$_POST['noche']."', '".$_POST['activa']."')");
            }
        }else{
            echo("La imagen debe ser .jpg o .png");
        }
    }

?>