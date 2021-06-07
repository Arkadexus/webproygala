<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/r-2.2.8/datatables.min.css"/>
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/r-2.2.7/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gala d'Or - Ofertas</title>
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
                    <li><a href="reservas.php" class="estiloEnlace">Reservas</a></li>
                    <li><b>Ofertas</b></li>
                    <?php } ?>
                    <li><a href="scripts/logout.php" class="estiloEnlace">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="panelAdmin">
            <h2>Administrar Ofertas</h2>
            <button class="botonAdmin" data-bs-toggle="modal" data-bs-target="#modalNuevo">Añadir Ofertas</button>
           <table id="tablaAdmin" class="display" cellspacing="0" width="100%">
               <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>¿Por Noche?</th>
                        <th>¿Activa?</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("scripts/conexion.php");
                        $resultado = $galador->query("SELECT *
                        FROM ofertas ORDER BY id_oferta ASC") or die ($galador->error);
                        while ($fila = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><div class="nombreImagen"><img src="<?php echo $fila['foto']?>" alt="<?php echo $fila['nombre']?> width="30px" height="30px"><?php echo $fila['nombre']?></div></td>
                        <td><?php echo $fila['descripcion']?></td>
                        <td><?php echo $fila['precio']?>€</td>
                        <td><?php if($fila['por_Noche'] == 1){ echo "Sí"; }else{ echo "No"; }?></td>
                        <td><?php if($fila['activa'] == 1){ echo "Sí"; }else{ echo "No"; }?></td>
                        <td align="center"><button type="button" class="botonEditar" data-id="<?php echo $fila[0]?>"
                                            data-nombre="<?php echo $fila['nombre']?>"
                                            data-descripcion="<?php echo $fila['descripcion']?>"
                                            data-precio="<?php echo $fila['precio']?>"
                                            data-pornoche="<?php echo $fila['por_Noche']?>"
                                            data-activa="<?php echo $fila['activa']?>"
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
        <h5 class="modal-title">Editar Oferta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="exito"></div>
        <div id="error"></div>
        <input type="hidden" id="idOferta" name="idOferta">
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
            <label for="nombreEdit">Precio*</label>
            <input type="text" name="precioEdit" id="precioEdit" maxlength="6" required>
        </div>
        <div class="form-group">
            <label for="nombreEdit">¿Por Noche?*</label><br>
            <input type="radio" name="nocheEdit" id="nocheEdit1" value="1" style="width: auto;" required><label for="nocheEdit1">Sí</label><br>
            <input type="radio" name="nocheEdit" id="nocheEdit0" value="0" style="width: auto;" required><label for="nocheEdit0">No</label>
        </div>
        <div class="form-group">
            <label for="nombreEdit">¿Activa?*</label><br>
            <input type="radio" name="activaEdit" id="activaEdit1" value="1" style="width: auto;" required><label for="activaEdit1">Sí</label><br>
            <input type="radio" name="activaEdit" id="activaEdit0" value="0" style="width: auto;" required><label for="activaEdit0">No</label>
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

<div class="modal" id="modalNuevo" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <!-- FORMULARIO -->
        <form enctype="multipart/form-data" id="formularioNuevo">
      <div class="modal-header">
        <h5 class="modal-title">Añadir Oferta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="exito2"></div>
        <div id="error2"></div>
        <div class="form-group">
            <label for="nombreEdit">Nombre*</label>
            <input type="text" name="nombre" id="nombre" maxlength="45" required>
        </div>
        <div class="form-group">
            <label for="descripcionEdit">Descripcion*</label>
            <textarea name="descripcion" id="descripcion" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="nombreEdit">Precio*</label>
            <input type="text" name="precio" id="precio" maxlength="6" required>
        </div>
        <div class="form-group">
            <label for="nombreEdit">¿Por Noche?*</label><br>
            <input type="radio" name="noche" id="noche1" value="1" style="width: auto;" required><label for="nocheEdit1">Sí</label><br>
            <input type="radio" name="noche" id="noche0" value="0" style="width: auto;" required><label for="nocheEdit0">No</label>
        </div>
        <div class="form-group">
            <label for="nombreEdit">¿Activa?*</label><br>
            <input type="radio" name="activa" id="activa" value="1" style="width: auto;" required><label for="activaEdit1">Sí</label><br>
            <input type="radio" name="activa" id="activa" value="0" style="width: auto;" required><label for="activaEdit0">No</label>
        </div>
        <div class="form-group">
            <label for="imagenEdit">Imagen*</label>
            <input type="file" name="imagen" id="imagen">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="button" id="nuevaOferta" name="nuevaOferta" value="Añadir Oferta" onclick="validarNueva()">
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
        let descripcion=$(this).data('descripcion');
        let precio=$(this).data('precio');
        let pornoche=$(this).data('pornoche');
        let activa=$(this).data('activa');

        fila=$(this).parent('td').parent('tr');
        $("#idOferta").val(idEditar)
        $("#nombreEdit").val(nombre);
        $("#descripcionEdit").val(descripcion);
        $("#precioEdit").val(precio);

        if(pornoche == 1){
            $('input:radio[name=nocheEdit]')[0].checked = true;
        }else{
            $('input:radio[name=nocheEdit]')[1].checked = true;
        }

        if(activa == 1){
            $('input:radio[name=activaEdit]')[0].checked = true;
        }else{
            $('input:radio[name=activaEdit]')[1].checked = true;
        }
    });
} );
</script>

<script>
    function validarEdicion(){
        let nombre2 = document.getElementById("nombreEdit").value;
        let descripcion2 = document.getElementById("descripcionEdit").value;
        let precio2 = document.getElementById("precioEdit").value;
        let noche2 = document.querySelector('input[name="nocheEdit"]:checked').value;
        let activa2 = document.querySelector('input[name="activaEdit"]:checked').value;

        let error = document.getElementById("error");
        let exito = document.getElementById("exito");

        if (nombre2.length == 0 || nombre2 == null || /^\s+$/.test(nombre2) || 
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
            url: "scripts/editarOferta.php",
            type: "POST",
            data: formData,
            success: function (data) {
                if(data == "La imagen debe ser .jpg o .png"){
                    $("#error").html(data);
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                }else{
                    $("#exito").html("La oferta ha sido editada. Refresca la página para ver los cambios."+data);
                    $(exito).fadeIn(1000).css("display","inline-block");
                    $(exito).fadeOut(5000);
                }
            },
            error: function (data) {
                $("#error").html("Ha habido un error editando la oferta. Inténtelo de nuevo.");
                error.style.display = 'inline-block';
                exito.style.display = 'none';
            },
            cache: false,
            contentType: false,
            processData: false
        });
    };

    function validarNueva(){
        let nombre = document.getElementById("nombre").value;
        let descripcion = document.getElementById("descripcion").value;
        let precio = document.getElementById("precio").value;
        let foto = document.getElementById("imagen");

        if($('[name=ratingInput1]:checked').length)
     console.log('Yes');
else
     console.log('No');
        let error = document.getElementById("error2");
        let exito = document.getElementById("exito2");

        if($('[name=noche]:checked').length){
            let noche = document.querySelector('input[name="noche"]:checked').value;
        }else{
            $("#error2").html("Todos los campos son obligatorios.");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        if($('[name=activa]:checked').length){
            let activa = document.querySelector('input[name="activa"]:checked').value;
        }else{
            $("#error2").html("Todos los campos son obligatorios.");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        if (nombre.length == 0 || nombre == null || /^\s+$/.test(nombre) || 
        descripcion.length == 0 || descripcion == null || /^\s+$/.test(descripcion) ||
        precio.length == 0 || precio == null || /^\s+$/.test(precio) || 
        foto.files.length == 0
        ){
            $("#error2").html("Todos los campos son obligatorios.");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        if(!(/^[0-9]*\.[0-9]+$/).test(precio)){
            $("#error2").html("El formato de precio es 000.00 .");
            $(error).fadeIn(1000).css("display","inline-block");
            $(error).fadeOut(5000);
            return 0;
        }

        var formData = new FormData(document.getElementById("formularioNuevo"));

        $.ajax({
            url: "scripts/nuevaOferta.php",
            type: "POST",
            data: formData,
            success: function (data) {
                if(data == "La imagen debe ser .jpg o .png"){
                    $("#error2").html(data);
                    $(error).fadeIn(1000).css("display","inline-block");
                    $(error).fadeOut(5000);
                }else{
                    $("#exito2").html("La oferta ha sido añadida. Refresca la página para ver los cambios."+data);
                    $(exito).fadeIn(1000).css("display","inline-block");
                    $(exito).fadeOut(5000);
                }
            },
            error: function (data) {
                $("#error2").html("Ha habido un error añadiendo la oferta. Inténtelo de nuevo.");
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