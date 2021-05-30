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
                $fila = $galador->query("SELECT foto FROM ofertas WHERE id_oferta = '".$_POST['idOferta']."'");
                $id = mysqli_fetch_row($fila);
                if(file_exists('../'.$id[0])){
                    unlink('../'.$id[0]);
                }
                $galador->query("UPDATE ofertas SET foto='$nombreFinal' WHERE id_oferta = '".$_POST['idOferta']."'");
            }
        }else{
            echo("La imagen debe ser .jpg o .png");
        }
    }

   $galador -> query("UPDATE ofertas SET nombre='".$_POST['nombreEdit']."',descripcion='".$_POST['descripcionEdit']."', precio='".$_POST['precioEdit']."', por_Noche='".$_POST['nocheEdit']."', activa='".$_POST['activaEdit']."' WHERE id_oferta = '".$_POST['idOferta']."'");
?>