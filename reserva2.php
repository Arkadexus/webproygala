<?php
    $total = 0;
    session_start();
    $carrito = "";
    include("scripts/conexion.php");
    // CARRITO PRINCIPAL: CONTIENE LA HABITACIÓN
    if(!isset($_SESSION['carrito'])){
        if(isset($_GET['id'])){
            $res = $galador -> query ('SELECT * FROM habitacion WHERE n_habitacion = '.$_GET['id']) or die($galador -> error);
            $fila = mysqli_fetch_row($res);
            $nombre = $fila['1'];
            $precio = $fila['6'];
            $datos[] = array(
                'Id' => $_GET['id'],
                'Nombre' => $nombre,
                'Precio' => $precio,
            );
            $_SESSION['carrito'] = $datos;
        }else{
            header("Location: reservar.php");
        }
    }else{
        //CARRITO PARA LAS OFERTAS
        if(isset($_GET['ido'])){
            $arrayCarro = $_SESSION['carrito'];
            $encuentro = false;
            for($i = 1; $i<count($arrayCarro); $i++){
                if($arrayCarro[$i]['ID_O'] == $_GET['ido']){
                    $encuentro = true;
                }
            }
            if($encuentro == false){
                $res = $galador->query('SELECT * FROM ofertas WHERE id_oferta = '.$_GET['ido'])or die($galador->error); 
                $fila = mysqli_fetch_row($res);
                $nombre = $fila['1'];
                $precio = $fila['3'];
                $porNoche = $fila['5'];
                $arrayOferta = array(
                    'ID_O'=> $_GET['ido'],
                    'Nombre'=> $nombre,
                    'Precio'=> $precio,
                    'PorNoche' => $porNoche,
                );
                array_push($arrayCarro, $arrayOferta);
                $_SESSION['carrito'] = $arrayCarro;
            }
        }else if(isset($_GET['del'])){ //ELIMINAR DEL CARRITO
            $arrayCarro = $_SESSION['carrito'];
            for($i = 0; $i<count($arrayCarro); $i++){
                if($i == 0){
                    $arrayTemp[] = array(
                        'Id' => $arrayCarro[$i]['Id'],
                        'Nombre' => $arrayCarro[$i]['Nombre'],
                        'Precio' => $arrayCarro[$i]['Precio'],
                    );
                }else{
                    if($arrayCarro[$i]['ID_O'] != $_GET['del']){
                        $arrayTemp[] = array(
                            'ID_O'=> $arrayCarro[$i]['ID_O'],
                            'Nombre'=> $arrayCarro[$i]['Nombre'],
                            'Precio'=> $arrayCarro[$i]['Precio'],
                            'PorNoche' => $arrayCarro[$i]['PorNoche'],
                        );
                    }
                }
            }
            $_SESSION['carrito'] = $arrayTemp;
        }
    }
    if(isset($_COOKIE["fechaInicio"]) && isset($_COOKIE["fechaSalida"])){
        $FECHA_E = str_replace('/', '-', $_COOKIE["fechaInicio"]);  
        $FECHA_E = date("Y-m-d", strtotime($FECHA_E));
        $FECHA_E = new DateTime($FECHA_E);
        $FECHA_S = str_replace('/', '-', $_COOKIE["fechaSalida"]);  
        $FECHA_S = date("Y-m-d", strtotime($FECHA_S)); 
        $FECHA_S = new DateTime($FECHA_S);
        $noches = $FECHA_S->diff($FECHA_E)->format('%a');
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
    <title>Gala d'Or - Reservar</title>
</head>
<body>
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
   <div id="headerReserva">
       <h1>Realiza una reserva</h1>
   </div>
   <div id="contenidoReserva">
        <div>
            <div id="ofertas">
                <h2>Añadir a su reserva</h2>
                <?php
                    include("scripts/conexion.php");
                    $resultado = $galador -> query("SELECT * FROM ofertas WHERE activa=1 ORDER BY nombre ASC") or die ($galador -> error);
                    while ($fila = mysqli_fetch_array($resultado)){
                ?>
                <div class="oferta">
                    <div>
                        <img src="<?php echo $fila['foto']?>" alt="<?php echo $fila['nombre']?>">
                    </div>
                    <div>
                        <div class="caracteristicasHabP">  
                            <h2><?php echo $fila['nombre']?></h2>
                            <span class="precio"><?php echo $fila['precio']?>€</span>
                        </div>
                        <p><?php echo $fila['descripcion']?></p>
                        <?php
                         if(isset($_SESSION['carrito'])){
                            $arrayCarrito = $_SESSION['carrito'];
                            $total = $arrayCarrito[0]["Precio"]*$noches;
                        }
                        $encuentroCarrito = false;
                        if(isset($arrayCarrito[1])){
                            for($i = 1; $i<count($arrayCarrito); $i++){
                                if($arrayCarrito[$i]['ID_O'] == $fila["id_oferta"]){
                                    $encuentroCarrito = true;
                                }
                             }
                        }
                         if($encuentroCarrito == false){
                         ?>
                        <a href="reserva2.php?ido=<?php echo $fila[0];?>"><button>Añadir a la reserva</button></a>
                        <?php
                         }else{
                        ?>
                        <a href="reserva2.php?del=<?php echo $fila[0];?>"><button>Eliminar de la reserva</button></a>
                        <?php
                         }
                        ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="estanciaFaq">
            <div id="estancia">
                <h2>SU ESTANCIA</h2>
                <div class="fechaEstancia">
                    <div>
                        <span><b>Fecha de entrada</b></span><br>
                        <span><?php echo $_COOKIE["fechaInicio"]?></span><br>
                        <span>16:00</span>
                    </div>
                    <div>
                        <span><b>Fecha de salida</b></span><br>
                        <span><?php echo $_COOKIE["fechaSalida"]?></span><br>
                        <span>12:00</span>
                    </div>
                </div>
                <div class="habitacionCarrito">
                    <span class="nombreHabitacion"><?php echo $arrayCarrito[0]["Nombre"]?></span>
                    <span><b><?php echo $arrayCarrito[0]["Precio"]*$noches?>€</b></span>
                </div>
                <div class="ofertasCarrito">
                    <?php
                        if(isset($arrayCarrito[1]["ID_O"])){
                        for($i = 1; $i<count($arrayCarrito); $i++){
                            if($arrayCarrito[$i]["PorNoche"] == 1){
                                $total = $total + ($arrayCarrito[$i]["Precio"] * $noches);
                                $precio = $arrayCarrito[$i]["Precio"] * $noches;
                            }else{
                                $total = $total + $arrayCarrito[$i]["Precio"];
                                $precio = $arrayCarrito[$i]["Precio"];
                            }
                    ?>
                        <span class="nombreOfertaCar"><?php echo $arrayCarrito[$i]["Nombre"]?></span>
                        <span><b><?php echo $precio?>€</b></span></li>
                    <?php
                        }
                    }
                    ?>
                </div>
                <hr>
                <div class="precioTotal">
                    <span>Total:</span>
                    <span class="spanPrecio"><?php echo $total?>€ IVA incluido</span>
                    <div></div>
                    <button onclick="window.location='checkout.php'">Finalizar Reserva</button>
                </div>
            </div>

            <div id="faqReserva">
                <h2>¿Por qué reservar en Gala d'Or?</h2>
                <p>Siempre ofreceremos nuestro mejor servicio al cliente. Además, le incluimos lo siguiente con su reserva:</p>
                <ul>
                    <li><i class="fa fa-wifi" aria-hidden="true"></i>Conexión Wifi</li>
                    <li><i class="fa fa-ban" aria-hidden="true"></i>Políticas de cancelación flexibles</li>
                    <li><i class="fa fa-question-circle-o" aria-hidden="true"></i>Atención al cliente profesional</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i>Correo electrónico con una pequeña guía y pronóstico del tiempo</li>
                    <li><i class="fa fa-desktop" aria-hidden="true"></i>Zona digital</li>
                </ul>
            </div>
        </div>
   </div>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/traducciondatepicker.js"></script>
<script src="scripts/calendario.js"></script>
</body>
</html>