const validarCheckout = () => {
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellidos").value;
    let telefono = document.getElementById("telefono").value;
    let mail = document.getElementById("mail").value;
    let numTarjeta = document.getElementById("numTarjeta").value;
    let fechaVen = document.getElementById("fechaVen").value;
    let cvc = document.getElementById("CVC").value;
    let nomT = document.getElementById("nombreTit").value;
    let privacidad = document.getElementById("privacidad");
    let condiciones = document.getElementById("condiciones");

    let crearCuenta = document.getElementById("crearCuenta");
    let username = document.getElementById("username").value;
    let contrasenya = document.getElementById("contrasenya").value;
    let repcontrasenya = document.getElementById("repcontrasenya").value;

    let element = document.getElementById("error");

    if (nombre.length == 0 || nombre == null || /^\s+$/.test(nombre) ||
    apellido.length == 0 || apellido == null || /^\s+$/.test(apellido) ||
    telefono.length == 0 || telefono == null || /^\s+$/.test(telefono) ||
    mail.length == 0 || mail == null || /^\s+$/.test(mail) ||
    numTarjeta.length == 0 || numTarjeta == null || /^\s+$/.test(numTarjeta) ||
    fechaVen.length == 0 ||
    cvc.length == 0 || cvc == null || /^\s+$/.test(cvc) ||
    nomT.length == 0 || nomT == null || /^\s+$/.test(nomT)
    ){
        element.innerHTML = "Todos los campos personales y de pago son obligatorios";
        element.style.display = 'inline-block';
        return 0;
    }

    if(!privacidad.checked){
        element.innerHTML = "Se debe aceptar la política de privacidad.";
        element.style.display = 'inline-block';
        return 0;
    }

    if(!condiciones.checked){
        element.innerHTML = "Se deben aceptar las condiciones de reserva.";
        element.style.display = 'inline-block';
        return 0;
    }

    if(!(/^\d{9}$/).test(telefono)){
        element.innerHTML = "El número de teléfono debe contener 9 números.";
        element.style.display = 'inline-block';
        return 0;
    }

    if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(mail)){
        element.innerHTML = "Formato de correo incorrecto";
        element.style.display = 'inline-block';
        return 0;
    }

    if(!(/^\d{16}$/).test(numTarjeta)){
        element.innerHTML = "Debes introducir 16 números de la tarjeta de crédito.";
        element.style.display = 'inline-block';
        return 0;
    }

    if(!(/^\d{3}$/).test(cvc)){
        element.innerHTML = "Debes introducir 3 números del CVC.";
        element.style.display = 'inline-block';
        return 0;
    }

    if(crearCuenta.checked){
        if(username.length == 0 || username == null || /^\s+$/.test(username)){
            element.innerHTML = "Debes introducir un nombre de usuario.";
            element.style.display = 'inline-block';
            return 0;
        }

        if(username.length < 6){
            element.innerHTML = "El nombre de usuario debe tener 6 o más carácteres.";
            element.style.display = 'inline-block';
            return 0;
        }

        if(contrasenya.length == 0 || contrasenya == null || /^\s+$/.test(contrasenya)){
            element.innerHTML = "Debes introducir una contraseña.";
            element.style.display = 'inline-block';
            return 0;
        }

        if(contrasenya.length < 6){
            element.innerHTML = "La contraseña debe tener 6 o más carácteres.";
            element.style.display = 'inline-block';
            return 0;
        }

        if(contrasenya != repcontrasenya){
            element.innerHTML = "Las contraseñas no coinciden";
            element.style.display = 'inline-block';
            return 0;
        }

        if(document.getElementById("result2").textContent == "Este correo ya se ha utilizado"){
            element.innerHTML = "Este correo ya ha sido utilizado";
            element.style.display = 'inline-block';
            return 0;
        }
    
        if(document.getElementById("result").textContent == "Este nombre de usuario ya se ha utilizado"){
            element.innerHTML = "Este nombre de usuario ya se ha utilizado";
            element.style.display = 'inline-block';
            return 0;
        }
    }

    document.formCheckout.submit();
}