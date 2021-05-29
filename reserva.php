<?php
    session_start();
    $carrito = "";
    if(isset($_SESSION['carrito'])){
        unset($_SESSION['carrito']);
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
            <div id="barraBusquedaReserva">
                <div class="barraFecha">
                    <div>
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <div>
                        <span><b>Fecha de entrada</b></span><br>
                        <span><?php echo $_COOKIE["fechaInicio"]?></span>
                    </div>
                </div>
                <div class="barraFecha">
                    <div>
                        <i class="fa fa-calendar-times-o"></i>
                    </div>
                    <div>
                        <span><b>Fecha de salida</b></span><br>
                        <span><?php echo $_COOKIE["fechaSalida"]?></span>
                    </div>
                </div>
                <div class="botonModificar">
                    <button>MODIFICAR</button>
                </div>
            </div>
            <div id="habitaciones">
                <?php
                    include("scripts/conexion.php");
                    $FECHA_E = str_replace('/', '-', $_COOKIE["fechaInicio"]);  
                    $FECHA_E = date("Y-m-d", strtotime($FECHA_E));
                    $FECHA_S = str_replace('/', '-', $_COOKIE["fechaSalida"]);  
                    $FECHA_S = date("Y-m-d", strtotime($FECHA_S));  
                    $resultado = $galador -> query("SELECT DISTINCT * FROM habitacion WHERE n_habitacion NOT IN (SELECT n_habitacion FROM reservas WHERE (fecha_f >= '$FECHA_S' AND fecha_i <= '$FECHA_E') OR (fecha_f <= '$FECHA_S' AND fecha_i >= '$FECHA_E')) GROUP BY nombre ORDER BY n_habitacion ASC") or die ($galador -> error);
                    while ($fila = mysqli_fetch_array($resultado)){
                ?>
                <div class="habitacion" id="<?php echo $fila['nombre']?>">
                    <div><img src="<?php echo $fila['foto']?>" alt="<?php echo $fila['nombre']?>"></div>
                    <div>
                        <div class="caracteristicasHabP">  
                        <h2><?php echo $fila['nombre']?></h2>
                        <span class="precio"><?php echo $fila['precio_n']?>€</span>
                        </div>
                        <div class="caracteristicasHab">
                            <span class="tituloCaracteristica">Húespedes</span>
                            <span class="tituloCaracteristica">Mínimo noches</span>
                            <span class="tituloCaracteristica">Area</span>
                            <span class="caracteristica"><i class="fa fa-user"></i><?php echo $fila['max_huespedes']?></span>
                            <span class="caracteristica"><i class="fa fa-moon-o"></i><?php echo $fila['min_noches']?></span>
                            <span class="caracteristica"><i class="fa fa-arrows"></i><?php echo $fila['espacio']?>m<sup>2</sup></span>
                        </div>
                        <p><?php echo $fila['descripcion']?></p>
                        <a href="reserva2.php?id=<?php echo $fila[0];?>"><button>Reservar</button></a>
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
                <hr>
                <div class="precioTotal">
                    <span>Total:</span>
                    <span class="spanPrecio">0,00€</span>
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