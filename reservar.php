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
    <title>Gala d'Or - Buscar Reservas</title>
</head>
<body class="antiMargen">
    <?php
        include('templates/header.php');
    ?>
<div class="contenido">
    <section id="reservar" class="anchoCompleto">
        <div class="contenedorReservar">
            <h2>Realizar una reserva</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
            <?php
                if(isset($_POST['enviar'])){
                    $entrada = $_POST['input1'];
                    $salida = $_POST['input2'];

                    $campos = array();
                    $valores = explode('/', $_POST["input1"]);
                    $valores2 = explode('/', $_POST["input2"]);

                    if(count($valores) != 3 || checkdate($valores[1], $valores[0], $valores[2]) == false){
                        array_push($campos, "Se debe introducir fecha de entrada.");
                    }

                    if(count($valores2) != 3 || checkdate($valores2[1], $valores2[0], $valores2[2]) == false){
                        array_push($campos, "Se debe introducir fecha de salida.");
                    }

                    if($entrada == $salida && count($valores) == 3){
                        array_push($campos, "La fecha de entrada y salida no puede ser la misma.");
                    }

                    if(count($campos) > 0){
                        echo "<div class='error'>";
                        echo "<ul>";
                        for($i = 0; $i < count($campos); $i++){
                            echo ("<li>$campos[$i]</li>");
                        }
                        echo "</ul>";
                        echo "</div>";
                    }else{
                        setcookie("fechaInicio", $_POST["input1"], time() + (86400 * 30), "/");
                        setcookie("fechaSalida", $_POST["input2"], time() + (86400 * 30), "/");
                        header("Location: reserva.php");
                    }
                }
            ?>
            <div id="buscarReserva">
                <div>
                    <label><b>Llegada:</b></label>
                    <input type="text" name="input1" id="input1" size="10" require readonly>
                    <label><b>Salida:</b></label>
                    <input type="text" name="input2" id="input2" size="10" require readonly>
                    <input type="submit" name="enviar" value="Buscar Habitaciones">
                </div>
                <div>
                    <div class="datepicker"></div>
                </div>
            </div>
            </form>
        </div>
    </section>
</div>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/traducciondatepicker.js"></script>
<script src="scripts/calendario.js"></script>
<script>    
    document.getElementById("input1").value = <?php echo $_POST['input1']; ?>
    document.getElementById("input2").value = <?php echo $_POST['input2']; ?>
</script>
</body>
</html>