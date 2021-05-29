function mostrarContenido() {
    element = document.getElementById("opcional");
    check = document.getElementById("crearCuenta");
    if (check.checked) {
        element.style.display='grid';
    }
    else {
        element.style.display='none';
    }
}