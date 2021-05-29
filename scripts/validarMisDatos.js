let element = document.getElementById("error");
let exito = document.getElementById("exito");
const validarMisDatos = () => {
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellidos").value;
    let telefono = document.getElementById("telefono").value;
    let mail = document.getElementById("mail").value;

    let privacidad = document.getElementById("privacidad");

    if(!privacidad.checked){
        element.innerHTML = "Se debe aceptar la política de privacidad.";
        element.style.display = 'inline-block';
        exito.style.display = 'none';
        return 0;
    }

    if(telefono.length != 0 && telefono != null && !(/^\s+$/).test(telefono)){
        if(!(/^\d{9}$/).test(telefono)){
            element.innerHTML = "El número de teléfono debe contener 9 números.";
            element.style.display = 'inline-block';
            exito.style.display = 'none';
            return 0;
        }
    }

    exito.style.display = 'none';

    $.ajax({
        url: "scripts/actualizarDatos.php",
        type: "POST",
        data: {
            nombre: nombre,
            apellidos: apellido,
            telefono: telefono,
        },
        success: function (data) {
          $("#exito").html("Los datos han sido modificados.");
          exito.style.display = 'inline-block';
          element.style.display = 'none';
        },
        error: function (data) {
          $("#error").html("Ha habido un error modificando los datos. Inténtelo de nuevo.");
          element.style.display = 'inline-block';
          exito.style.display = 'none';
        }
      });
}

const validarMisDatosPass = () => {
    let contrasenya = document.getElementById("contrasenya").value;
    let repcontrasenya = document.getElementById("repcontrasenya").value;

    if(contrasenya != repcontrasenya){
      element.innerHTML = "Las contraseñas no son iguales.";
      element.style.display = 'inline-block';
      exito.style.display = 'none';
      return 0;
    }

    if(contrasenya.length < 6){
      element.innerHTML = "La contraseña debe tener 6 o más carácteres.";
      element.style.display = 'inline-block';
      exito.style.display = 'none';
      return 0;
    }

    $.ajax({
      url: "scripts/actualizarPassword.php",
      type: "POST",
      data: {
          contrasenya: contrasenya,
      },
      success: function (data) {
        $("#exito").html("La contraseña ha sido modificada.");
        exito.style.display = 'inline-block';
        element.style.display = 'none';
      },
      error: function (data) {
        $("#error").html("Ha habido un error modificando la contraseña. Inténtelo de nuevo.");
        element.style.display = 'inline-block';
        exito.style.display = 'none';
      }
    });
}