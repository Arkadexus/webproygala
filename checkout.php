<?php
    if(isset($_COOKIE["fechaInicio"]) && isset($_COOKIE["fechaSalida"])){
        $FECHA_E = str_replace('/', '-', $_COOKIE["fechaInicio"]);  
        $FECHA_E = date("Y-m-d", strtotime($FECHA_E));
        $FECHA_E = new DateTime($FECHA_E);
        $FECHA_S = str_replace('/', '-', $_COOKIE["fechaSalida"]);  
        $FECHA_S = date("Y-m-d", strtotime($FECHA_S)); 
        $FECHA_S = new DateTime($FECHA_S);
        $noches = $FECHA_S->diff($FECHA_E)->format('%a');
    }
    session_start();
    $carrito = "";
    if(!isset($_SESSION['carrito'])){
        header("Location: reservar.php");
    }
    $arrayCarrito = $_SESSION['carrito'];
    $total = $arrayCarrito[0]["Precio"]*$noches;
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
    <?php
    if(!isset($_SESSION['usuario'])){ ?>
    <script src="scripts/comprobacion.js"></script>
    <script src="scripts/comprobacion2.js"></script> <?php } ?>
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
            <div id="checkout">
            <form action="comprarealizada.php" method="post" name="formCheckout" enctype="multipart/form-data">
                <div id="error"></div>
                <h2>Datos Personales</h2>
                <?php
                    if(isset($_SESSION['usuario'])){
                        include("scripts/conexion.php");
                        $res = $galador -> query("SELECT nombre, apellidos, email, telefono FROM usuarios WHERE login = '".$_SESSION['usuario']."'") or die($galador->error);
                        while ($fila = mysqli_fetch_array($res)){
                ?>
                <div class="formCheckout">
                    <div>
                        <label for="nombre"><em>Nombre*</em></label><br/>
                        <input type="text" name="nombre" id="nombre" maxlength="45" value="<?php echo $fila['nombre'] ?>">
                    </div>
                    <div>
                        <label for="apellidos"><em>Apellidos*</em></label><br/>
                        <input type="text" name="apellidos" id="apellidos" maxlength="45" value="<?php echo $fila['apellidos'] ?>">
                    </div>
                    <div>
                        <label for="telefono"><em>Teléfono*</em></label><br/>
                        <input type="tel" name="telefono" id="telefono" maxlength="9" placeholder = "000000000" value="<?php echo $fila['telefono'] ?>">
                    </div>
                    <div>
                        <label for="nombre"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
                        <input type="email" name="mail" id="mail" maxlength="45" value="<?php echo $fila['email'] ?>" readonly>
                    </div>
                </div>
                <?php
                        }
                    }else{
                ?>
                <div class="formCheckout">
                    <div>
                        <label for="nombre"><em>Nombre*</em></label><br/>
                        <input type="text" name="nombre" id="nombre" maxlength="45">
                    </div>
                    <div>
                        <label for="apellidos"><em>Apellidos*</em></label><br/>
                        <input type="text" name="apellidos" id="apellidos" maxlength="45">
                    </div>
                    <div>
                        <label for="telefono"><em>Teléfono*</em></label><br/>
                        <input type="tel" name="telefono" id="telefono" maxlength="9" placeholder = "000000000">
                    </div>
                    <div>
                        <label for="nombre"><em>Correo Electrónico*</em></label><span id="result2"></span><br/>
                        <input type="email" name="mail" id="mail" maxlength="45">
                    </div>
                </div>
                <?php
                    }
                ?>
                <h2>Información de pago</h2>
                <div class="formCheckout">
                    <div>
                        <label for="numTarjeta">Número de tarjeta*</label>
                        <input type="text" name="numTarjeta" id="numTarjeta" maxlength="16" placeholder="Sin espacios">
                    </div>
                    <div>
                        <label for="fechaVen">Fecha de vencimiento*</label>
                        <?php
                        $now = new DateTime();
                        ?>
                        <input type="month" name="fechaVen" id="fechaVen" min="20<?php echo $now->format('y-m')?>">
                    </div>
                    <div>
                        <label for="CVC">CVC*</label>
                        <input type="text" name="CVC" id="CVC" maxlength="3" placeholder="000">
                    </div>
                    <div>
                        <label for="nombreTit"><em>Nombre del Titular*</em></label><br/>
                        <input type="text" name="nombreTit" id="nombreTit" maxlength="255">
                    </div>
                </div>

                <!--MOSTRAR Y OCULTAR REGISTRO EN FUNCIÓN DEL CHECKBOX, OCULTAR SI EL
                USUARIO HA INICIADO SESIÓN -->

                <?php
                    if(!isset($_SESSION['usuario'])){
                ?>
                <h2>Realizar reservas más rápido</h2>
                <input type="checkbox" name="crearCuenta" id="crearCuenta" onchange="javascript:mostrarContenido()">
                <label for="crearCuenta">Crear una cuenta</label>
                <div class="formCheckout" id="opcional">
                    <div>                        
                        <label for="username"><em>Nombre de usuario*</em></label><span id="result"></span><br/>
                        <input type="text" name="username" id="username" maxlength="255">
                    </div>
                    <div></div><div>
                        <label for="contrasenya"><em>Contraseña*</em></label><br/>
                        <input type="password" name="contrasenya" id="contrasenya" maxlength="45" required>
                    </div>
                    <div>
                        <label for="repcontrasenya"><em>Repetir Contraseña*</em></label><br/>
                        <input type="password" name="repcontrasenya" id="repcontrasenya" maxlength="45" required>
                    </div>
                </div>
                <?php
                    }
                ?>
                <h2>Consentimiento</h2>
                <input type="checkbox" name="privacidad" id="privacidad">
                <label for="privacidad">Acepto la <a href="privacidad.php" target="_blank">política de privacidad</a>*</label><br>
                <input type="checkbox" name="condiciones" id="condiciones">
                <label for="condiciones">Acepto las condiciones de reserva*</label><br>

                <!-- ENVIAR Y VALIDAR -->
                <input type="button" name="Enviar" id="Enviar" onclick="validarCheckout()" value="Finalizar Reserva">
            </form>
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
                    <?php
                        $_SESSION['precio'] = $total;
                    ?>
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
<?php
    if(isset($_SESSION['usuario'])){
?>
<script src="scripts/validarCheckoutUser.js"></script>
<?php 
    }else{
?>
<script src="scripts/validarCheckout.js"></script>
<?php
    }
?>
<script src="scripts/mostrarRegistro.js"></script>
</body>
</html>