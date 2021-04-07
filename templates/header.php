<?php
    session_start();
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
            <li><a href="#">Nuestra Empresa</a></li>
            <li><a href="#">Reservar</a></li>
            <li><a href="contactar.php">Contactar <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="#">Preguntas Frecuentes</a></li>
                </ul>
            </li>
            <?php
            if(!isset($_SESSION["usuario"])){
            ?>
            <li><a href="login.php">Iniciar Sesión <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="registro.php">Registrarse</a></li>
                </ul>
            </li>
            <?php
            }else{
            ?>
            <li><a href="micuenta.php">Mi cuenta <i class="fa fa-caret-down"></i></a>
                <ul>
                    <li><a href="#">Mis Datos</a></li>
                    <li><a href="#">Mis Reservas</a></li>
                    <li><a href="#">Métodos de Pago</a></li>
                    <li><a href="scripts/logout.php">Cerrar Sesión</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>