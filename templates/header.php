<?php
    if(!isset($carrito)){
        session_start();
    }
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: login.php");
        }
    }
?>
<header>
    <div>
        <a href="index.php"><img src="img/logo_small.png" alt="logo gala d'or"></a>
    </div>
    <nav>
        <div>
                <i class="fa fa-bars"></i>
              </div>
        <ul id="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="reservar.php">Reservar</a></li>
            <li><a href="#">El Hotel <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="aboutus.php">Sobre Nosotros</a></li>
                    <li><a href="mantenimiento.php">Galería</a></li>
                </ul>
            </li>
            <li><a href="#">Servicios <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="mantenimiento.php">Gastronomía</a></li>
                    <li><a href="mantenimiento.php">Turismo</a></li>
                    <li><a href="mantenimiento.php">Zona Digital</a></li>
                </ul>
            </li>
            <li><a href="contactar.php">Contactar</a></li>
            <?php
            if(!isset($_SESSION["usuario"])){
            ?>
            <li><a href="login.php">Iniciar Sesión</a></li>
            <?php
            }else{
            ?>
            <li><a href="micuenta.php">Mi cuenta <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="misdatos.php">Mis Datos</a></li>
                    <li><a href="misreservas.php">Mis Reservas</a></li>
                    <?php if(isset($_SESSION["admin"])){ ?>
                    <li><a href="administrar.php">Administrar</a></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php">Cerrar Sesión</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>