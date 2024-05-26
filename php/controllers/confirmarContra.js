document.getElementById('form').addEventListener('submit', function(event) {
 let contra = document.getElementById('contraseña').value;
 let confirmarContra = document.getElementById('confirmar_contraseña').value;
 let mensaje = document.getElementById('mensajeDeRegistro').value;

 if(contra != confirmarContra){
     alert('Las contraseñas no coinciden');
     event.preventDefault();
 } 
 

});

