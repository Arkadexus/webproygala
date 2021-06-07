<?php
    session_start();
        $carrito = "";
        $ofertas = "";
        include ("scripts/conexion.php");
    if(isset($_SESSION['carrito'])){
        $FECHA_E = str_replace('/', '-', $_COOKIE["fechaInicio"]);  
        $FECHA_E = date("Y-m-d", strtotime($FECHA_E));
        $FECHA_S = str_replace('/', '-', $_COOKIE["fechaSalida"]);      
        $FECHA_S = date("Y-m-d", strtotime($FECHA_S)); 
        $arrayCarrito = $_SESSION['carrito'];
        // CREAR FACTURA
        $galador -> query("INSERT INTO factura(fecha, costo) VALUES (NOW(), '".$_SESSION['precio']."')") or die($galador->error);
        $id_factura = $galador->insert_id;
        // GUARDAR RESERVA EN BASE DE DATOS
        if(!isset($_SESSION["usuario"])){ //USUARIOS NO REGISTRADOS
            if(isset($_POST["crearCuenta"])){ //CREAR UNA CUENTA SI EL USUARIO LO DESEA
                $contrasenya = $_POST['contrasenya'];
                stripslashes(htmlspecialchars($galador->query("INSERT INTO usuarios(login, contrasenya, nombre, apellidos, email, telefono) VALUES ('".$_POST["username"]."',SHA('$contrasenya'),'".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["mail"]."', '".$_POST["telefono"]."')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
                stripslashes(htmlspecialchars($galador->query("INSERT INTO reservas(fecha_i, fecha_f, login, n_habitacion, n_factura, nombre, apellidos, email, telefono, estado) VALUES ('".$FECHA_E."', '".$FECHA_S."', '".$_POST["username"]."', '".$arrayCarrito[0]['Id']."', '".$id_factura."', '".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["mail"]."', '".$_POST["telefono"]."', 'Pagado')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
            }else{
                stripslashes(htmlspecialchars($galador->query("INSERT INTO reservas(fecha_i, fecha_f, n_habitacion, n_factura, nombre, apellidos, email, telefono, estado) VALUES ('".$FECHA_E."', '".$FECHA_S."', '".$arrayCarrito[0]['Id']."', '".$id_factura."', '".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["mail"]."', '".$_POST["telefono"]."', 'Pagado')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
            }
            $id_oferta = $galador->insert_id;
        }else{ //USUARIO REGISTRADO
            stripslashes(htmlspecialchars($galador->query("INSERT INTO reservas(fecha_i, fecha_f, login, n_habitacion, n_factura, nombre, apellidos, email, telefono, estado) VALUES ('".$FECHA_E."', '".$FECHA_S."', '".$_SESSION["usuario"]."', '".$arrayCarrito[0]['Id']."', '".$id_factura."', '".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["mail"]."', '".$_POST["telefono"]."', 'Pagado')") or die("Error en la consulta (" . $galador->errno . ") ". $galador->error ))); 
            $id_oferta = $galador->insert_id;
        } // AÑADIR OFERTAS
        if(isset($arrayCarrito[1]['ID_O'])){
            for($i = 1; $i < count($arrayCarrito); $i++){
                $galador -> query("INSERT INTO ofertasreservadas(id_oferta, id_res) VALUES ('".$arrayCarrito[$i]['ID_O']."', '".$id_oferta."')") or die($galador->error);
            }
        } 
        unset($_SESSION['carrito']);

    }else{
        header("Location: reservar.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Reserva Realizada</title>
</head>
<body>
    <?php
        include('templates/header.php');
    ?>
<div class="contenido compraRealizada">
    <div>
        <p class="tituloCompra">COMPRA REALIZADA</p>
        <p class="descCompra">Redireccionando en 5 segundos...</p>
    </div>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validarCheckout.js"></script>
<script src="scripts/mostrarRegistro.js"></script>
</body>
</html>
<?php
header("refresh: 5; url=index.php");
?>