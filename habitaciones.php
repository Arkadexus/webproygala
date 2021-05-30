<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/r-2.2.7/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Habitaciones</title>
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
                    <li><b>Habitaciones</b></li>
                    <li><a href="contactos.php" class="estiloEnlace">Contactos</a></li>
                    <li><a href="reservas.php" class="estiloEnlace">Reservas</a></li>
                    <li><a href="ofertas.php" class="estiloEnlace">Ofertas</a></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="panelAdmin">
            <h2>Administrar Habitaciones</h2>
           <table id="tablaAdmin" class="display" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Huespedes</th>
                        <th>Mínimo de Noches</th>
                        <th>Espacio</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("scripts/conexion.php");
                        $resultado = $galador->query("SELECT DISTINCT *
                        FROM habitacion GROUP BY nombre ORDER BY n_habitacion ASC") or die ($galador->error);
                        while ($fila = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><div class="nombreImagen"><img src="<?php echo $fila['foto']?>" alt="<?php echo $fila['nombre']?> width="30px" height="30px"><?php echo $fila['nombre']?></div></td>
                        <td><?php echo $fila['max_huespedes']?></td>
                        <td><?php echo $fila['min_noches']?></td>
                        <td><?php echo $fila['espacio']?></td>
                        <td><?php echo $fila['descripcion']?></td>
                        <td><?php echo $fila['precio_n']?>€</td>
                        <td align="center"><button type="button" class="botonEditar" data-id="<?php echo $fila[0]?>"
                                            data-huespedes="<?php echo $fila['max_huespedes']?>"
                                            data-noches="<?php echo $fila['min_noches']?>"
                                            data-espacio="<?php echo $fila['espacio']?>"
                                            data-descripcion="<?php echo $fila['descripcion']?>"
                                            data-precio="<?php echo $fila['precio_n']?>"
                                            data-imagen="<?php echo $fila['foto']?>"
                                            data-nombre="<?php echo $fila['nombre']?>"
                                            data-bs-toggle="modal" data-bs-target="#modalEditar">
                                            <i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                    </tr>
                <?php } ?>
                </tbody>
           </table>
        </div>
    </section>
</div>
<div class="modal" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <!-- FORMULARIO -->
        <form enctype="multipart/form-data" id="formularioEditar">
      <div class="modal-header">
        <h5 class="modal-title">Editar Habitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="exito"></div>
        <div id="error"></div>
        <input type="hidden" id="idNombre" name="idNombre">
        <div class="form-group">
            <label for="nombreEdit">Nombre*</label>
            <input type="text" name="nombreEdit" id="nombreEdit" maxlength="45" required>
        </div>
        <div class="form-group">
            <label for="descripcionEdit">Descripcion*</label>
            <textarea name="descripcionEdit" id="descripcionEdit" rows="4" required>
            </textarea>
        </div>
        <div class="form-group">
            <label for="huespedesEdit">Huespedes*</label>
            <input type="number" name="huespedesEdit" id="huespedesEdit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="1" maxlength="11" required>
        </div>
        <div class="form-group">
            <label for="nochesEdit">Mínimo de Noches*</label>
            <input type="number" name="nochesEdit" id="nochesEdit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="1" maxlength="11" required>
        </div>
        <div class="form-group">
            <label for="espacioEdit">Espacio*</label>
            <input type="number" name="espacioEdit" id="espacioEdit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="1" maxlength="11" required>
        </div>
        <div class="form-group">
            <label for="nombreEdit">Precio*</label>
            <input type="text" name="precioEdit" id="precioEdit" maxlength="6" required>
        </div>
        <div class="form-group">
            <label for="imagenEdit">Imagen</label>
            <input type="file" name="imagenEdit" id="imagenEdit">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="button" id="guardarCambios" name="guardarCambios" value="Guardar Cambios" onclick="validarEdicion()">
      </div>
    </form>
    </div>
  </div>
</div>
<?php }else{
    header("Location: login.php");
}
?>
<?php include("templates/footer.html")?>
<script src="scripts/menu.js"></script>
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

    $(".botonEditar").click(function(){
        idEditar = $(this).data('id');
        let nombre=$(this).data('nombre');
        let imagen=$(this).data('imagen');
        let huespedes=$(this).data('huespedes');
        let noches=$(this).data('noches');
        let espacio=$(this).data('espacio');
        let descripcion=$(this).data('descripcion');
        let precio=$(this).data('precio');
        fila=$(this).parent('td').parent('tr');
        $("#idNombre").val(nombre)
        $("#nombreEdit").val(nombre);
        $("#huespedesEdit").val(huespedes);
        $("#nochesEdit").val(noches);
        $("#espacioEdit").val(espacio);
        $("#descripcionEdit").val(descripcion);
        $("#precioEdit").val(precio);
    });
} );
</script>

<script>
    function validarEdicion(){
        let nombre2 = document.getElementById("nombreEdit").value;
        let huespedes2 = document.getElementById("huespedesEdit").value;
        let noches2 = document.getElementById("nochesEdit").value;
        let espacio2 = document.getElementById("espacioEdit").value;
        let descripcion2 = document.getElementById("descripcionEdit").value;
        let precio2 = document.getElementById("precioEdit").value;

        let error = document.getElementById("error");
        let exito = document.getElementById("exito");

        if (nombre2.length == 0 || nombre2 == null || /^\s+$/.test(nombre2) ||
        huespedes2.length == 0 || huespedes2 == null || /^\s+$/.test(huespedes2) ||
        noches2.length == 0 || noches2 == null || /^\s+$/.test(noches2) ||
        espacio2.length == 0 || espacio2 == null || /^\s+$/.test(espacio2) ||
        descripcion2.length == 0 || descripcion2 == null || /^\s+$/.test(descripcion2) ||
        precio2.length == 0 || precio2 == null || /^\s+$/.test(precio2)
        ){
            $("#error").html("Todos los campos son obligatorios.");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        if(!(/^[0-9]*\.[0-9]+$/).test(precio2)){
            $("#error").html("El formato de precio es 000.00 .");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        var formData = new FormData(document.getElementById("formularioEditar"));

        $.ajax({
            url: "scripts/editarHabitacion.php",
            type: "POST",
            data: formData,
            success: function (data) {
                if(data == "La imagen debe ser .jpg o .png"){
                    $("#error").html(data);
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                }else{
                    $("#exito").html("La habitación ha sido editada. Refresca la página para ver los cambios.");
                    $(exito).fadeIn(1000).css("display","inline-block");
                    $(exito).fadeOut(5000);
                }
            },
            error: function (data) {
                $("#error").html("Ha habido un error creando la cuenta. Inténtelo de nuevo.");
                error.style.display = 'inline-block';
                exito.style.display = 'none';
            },
            cache: false,
            contentType: false,
            processData: false
        });
    };
</script>
</body>
</html>