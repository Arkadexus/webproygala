<?php
include("conexion.php");
    if($_FILES['imagenEdit']['name'] !=''){
        $carpeta = "img/";
        $nombre = $_FILES['imagenEdit']['name'];

        $temp = explode('.', $nombre);
        $extension = end($temp);

        $nombreFinal = time().'.'.$extension;
        $nombreFinal = $carpeta.$nombreFinal;

        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagenEdit']['tmp_name'], '../'.$nombreFinal)){
                $fila = $galador->query("SELECT foto FROM habitacion WHERE nombre = '".$_POST['idNombre']."'");
                $id = mysqli_fetch_row($fila);
                if(file_exists('../'.$id[0])){
                    unlink('../'.$id[0]);
                }
                $galador->query("UPDATE habitacion SET foto='$nombreFinal' WHERE nombre = '".$_POST['idNombre']."'");
            }
        }else{
            echo("La imagen debe ser .jpg o .png");
        }
    }

    $galador -> query("UPDATE habitacion SET nombre='".$_POST['nombreEdit']."', max_huespedes='".$_POST['huespedesEdit']."', min_noches='".$_POST['nochesEdit']."', espacio='".$_POST['espacioEdit']."', descripcion='".$_POST['descripcionEdit']."', precio_n='".$_POST['precioEdit']."' WHERE nombre = '".$_POST['idNombre']."'");
?>