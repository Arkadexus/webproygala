document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("formulario").addEventListener('submit', validarFormulario); 
  });
  
  function validarFormulario(evento) {
    evento.preventDefault();
    var contrasenya = document.getElementById('contrasenya').value;
    var repcontrasenya = document.getElementById('repcontrasenya').value;
    if (contrasenya != repcontrasenya) {
      alert('Las contraseñas no coinciden');
      return;
    }
    this.submit();
  }