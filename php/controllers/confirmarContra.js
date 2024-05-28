document.getElementById('form').addEventListener('submit', function(event) {
    let contra = document.getElementById('contraseña').value;
    let confirmarContra = document.getElementById('confirmar_contraseña').value;
    let mensaje = document.getElementById('mensajeDeRegistro');
    let mensajeError = "Las contraseñas no coinciden";

    if(contra != confirmarContra){
        mensaje.textContent = mensajeError;
        mensaje.style.display = 'block'
        mensaje.style.backgroundColor = "#a34141"; // Cambia el color de fondo del mensaje a rojo
        event.preventDefault();
    } 
 

});


window.onload = function() {


}

