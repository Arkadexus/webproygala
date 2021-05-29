<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Mis Reservas</title>
</head>
<body id="colorRegistro">
    <?php
        include('templates/header.php');
        if(isset($_SESSION["usuario"])){
    ?>
<div class="contenido">
    <section id="micuenta">
        <div>
            <div id="datosUsuario">
                <span>Bienvenid@, <?php echo($_SESSION["usuario"])?></span>
            </div>
            <div id="menuUsuario">
                <h4>Menú</h4>
                <ul>
                    <li><a href="micuenta.php" class="estiloEnlace">Escritorio</a></li>
                    <li><a href="misdatos.php" class="estiloEnlace">Mis Datos</a></li>
                    <li>Mis Reservas</li>
                    <?php
                    if(isset($_SESSION["admin"])){ ?>
                        <li><a href="usuarios.php" class="estiloEnlace">Usuarios</a></li>
                        <li><a href="habitaciones.php" class="estiloEnlace">Habitaciones</a></li>
                        <li><a href="contactos.php" class="estiloEnlace">Contactos</a></li>
                        <li><a href="reservas.php" class="estiloEnlace">Reservas</a></li>
                        <li><a href="ofertas.php" class="estiloEnlace">Ofertas</a></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>

        <div>
            <h2>Mis Reservas</h2>
             <?php
                include("scripts/conexion.php");
                $resultado = $galador -> query("SELECT *, habitacion.nombre as hnom, habitacion.descripcion as hdesc, habitacion.foto as hfoto, DATEDIFF(fecha_f, fecha_i) as noches
                FROM habitacion
                INNER JOIN reservas on reservas.n_habitacion = habitacion.n_habitacion
                INNER JOIN factura on factura.n_factura = reservas.n_factura
                WHERE reservas.login = '".$_SESSION['usuario']."'
                 ORDER BY fecha_i DESC") or die ($galador -> error);
                if ($resultado->num_rows != 0){
                while ($fila = mysqli_fetch_array($resultado)){
                    $id_reserva = $fila['id_res'];
             ?>
             <div class="habitacionReserva" id="<?php echo $fila['hnom']?>">
                    <div><img src="<?php echo $fila['hfoto']?>" alt="<?php echo $fila['hnom']?>"></div>
                    <div>
                        <div class="caracteristicasHabP">  
                        <h2><?php echo $fila['hnom']?></h2>
                        <span class="precio"><?php echo $fila['costo']?>€</span>
                        </div>
                        <div class="caracteristicasHab">
                            <span class="tituloCaracteristica">Noches</span>
                            <span class="tituloCaracteristica">Entrada</span>
                            <span class="tituloCaracteristica">Salida</span>
                            <span class="tituloCaracteristica">Estado</span>
                            <span class="caracteristica"><i class="fa fa-moon-o"></i><?php echo $fila["noches"]?></span>
                            <span class="caracteristica"><i class="fa fa-calendar-check-o"></i><?php echo str_replace('-', '/',(date("d-m-y", strtotime($fila["fecha_i"]))))?></span>
                            <span class="caracteristica"><i class="fa fa-calendar-times-o"></i><?php echo str_replace('-', '/',(date("d-m-y", strtotime($fila["fecha_f"]))))?></span>
                            <span class="caracteristica"><i class="fa fa-info-circle"></i><?php echo $fila['estado']?></span>
                        </div>
                        <p><?php echo $fila['hdesc']?></p>
                        <ul class="ofertasMiCuenta">
                            <?php
                                $resultado2 = $galador -> query("SELECT *
                                FROM ofertas
                                INNER JOIN ofertasreservadas ON ofertasreservadas.id_oferta = ofertas.id_oferta
                                WHERE ofertasreservadas.id_res = '$id_reserva'
                                ") or die ($galador->error); ?>
                            <h4>Ofertas</h4>
                            <?php
                                while($fila2 = mysqli_fetch_array($resultado2)){
                            ?>
                            <li><span><?php echo $fila2["nombre"]?></span><span><?php echo $fila2["precio"]?>€</span></li>
                            <?php } ?>
                        </ul>
                        <a href="modificarReserva.php?id=<?php echo $fila['id_res']?>"><button>MODIFICAR</button></a>
                    </div>
            </div>
                <?php 
            }
            }else{
            ?>
            <div id="error" style="display: inline-block">No has reservado nada aún.</div>
            <?php
            }
            ?>
        </div>
</div>
<?php 
}else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
</body>
</html>