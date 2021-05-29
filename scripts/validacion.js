function validarCheckout(){
  let nombre = document.getElementById("username").value;
  let mail = document.getElementById("mail").value;
  let contrasenya = document.getElementById("contrasenya").value;
  let repcontrasenya = document.getElementById("repcontrasenya").value;
  let privacidad = document.getElementById("privacidad");
  let element = document.getElementById("error");
  let exito = document.getElementById("exito");

  if (nombre.length == 0 || nombre == null || /^\s+$/.test(nombre) ||
  mail.length == 0 || mail == null || /^\s+$/.test(mail) ||
  contrasenya.length == 0 || contrasenya == null || /^\s+$/.test(contrasenya) ||
  repcontrasenya.length == 0 || repcontrasenya == null || /^\s+$/.test(repcontrasenya)
  ){
    element.innerHTML = "Todos los campos son obligatorios";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  if(!privacidad.checked){
    element.innerHTML = "Se debe aceptar la política de privacidad";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  if(nombre.length < 6){
    element.innerHTML = "El nombre de usuario debe tener 6 o más carácteres.";
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

  if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(mail)){
    element.innerHTML = "Formato de correo incorrecto";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  if(document.getElementById("result2").textContent == "Este correo ya se ha utilizado"){
    element.innerHTML = "Este correo ya ha sido utilizado";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  if(document.getElementById("result").textContent == "Este nombre de usuario ya se ha utilizado"){
    element.innerHTML = "Este nombre de usuario ya se ha utilizado";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  if (contrasenya != repcontrasenya){
    element.innerHTML = "Las contraseñas no coinciden";
    element.style.display = 'inline-block';
    exito.style.display = 'none';
    return 0;
  }

  $.ajax({
    url: "scripts/crearCuenta.php",
    type: "POST",
    data: {
      username: nombre,
      contrasenya: contrasenya,
      mail: mail,
    },
    success: function (data) {
      $("#exito").html("Su cuenta ha sido creada.");
      $("#result").html("");
      $("#result2").html("");
      exito.style.display = 'inline-block';
      element.style.display = 'none';
      $("#formRegistrar")[0].reset();
    },
    error: function (data) {
      $("#error").html("Ha habido un error creando la cuenta. Inténtelo de nuevo.");
      element.style.display = 'inline-block';
      exito.style.display = 'none';
    }
  });
}