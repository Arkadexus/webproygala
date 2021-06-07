<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/r-2.2.8/datatables.min.css"/>
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/r-2.2.7/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Reservas</title>
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
                    <li><a href="misreservas.php" class="estiloEnlace">Mis Reservas</a></li>
                    <?php
                    if(isset($_SESSION["admin"])){ ?>
                    <li><a href="usuarios.php" class="estiloEnlace">Usuarios</a></li>
                    <li><a href="habitaciones.php" class="estiloEnlace">Habitaciones</a></li>
                    <li><a href="contactos.php" class="estiloEnlace">Contactos</a></li>
                    <li><b>Reservas</b></li>
                    <li><a href="ofertas.php" class="estiloEnlace">Ofertas</a></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="panelAdmin">
            <h2>Reservas</h2>
            <div id="exito"></div>
           <table id="tablaAdmin" class="display" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Precio</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>Nombre Contacto</th>
                        <th>Mail Contacto</th>
                        <th>Teléfono Contacto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("scripts/conexion.php");
                        $resultado = $galador->query("SELECT *, habitacion.nombre as hnom, habitacion.descripcion as hdesc, habitacion.foto as hfoto, DATEDIFF(fecha_f, fecha_i) as noches
                        FROM habitacion
                        INNER JOIN reservas on reservas.n_habitacion = habitacion.n_habitacion
                        INNER JOIN factura on factura.n_factura = reservas.n_factura
                         ORDER BY fecha_i DESC") or die ($galador->error);
                        while ($fila = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?php echo $fila['hnom']?></td>
                        <td><?php echo $fila['costo']?>€</td>
                        <td><?php echo $fila['fecha_i']?></td>
                        <td><?php echo $fila['fecha_f']?></td>
                        <td><?php echo $fila['nombre'] ?> <?php echo $fila['apellidos']?></td>
                        <td><?php echo $fila['email']?></td>
                        <td><?php echo $fila['telefono']?></td>
                        <td id="estado"><?php echo $fila['estado']?></td>
                        <td align="center"><button class="botonEliminar" data-id="<?php echo $fila['id_res']?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                <?php } ?>
                </tbody>
           </table>
        </div>
    </section>
</div>
<?php }else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
<script src="scripts/validacion.js"></script>
<script>
    $(document).ready(function() {
    $('#tablaAdmin').DataTable( {
        responsive: true,
        "pageLength": 10,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sSearch":         "Buscar:",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    } );

    $("#tablaAdmin").on("click", ".botonEliminar", function(){
        idEliminar = $(this).data('id');
        fila=$(this).parent('td').parent('tr');
        celda = fila.children("#estado");
        $.ajax({
            url: "scripts/cancelarReserva.php",
            method: "POST",
            data:{
                id_res:idEliminar
            }
        }).done(function(res){
            $("#exito").html("La reserva ha sido cancelada."+res);
            $(exito).fadeIn(1000).css("display","inline-block");
            $(celda).html("Cancelado");
            $(exito).fadeOut(5000);
        })
    })
} );
</script>
</body>
</html>