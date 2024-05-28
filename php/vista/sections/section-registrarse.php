<body>
    <div class="registrarse">
        <form action="" method="POST" id="form">
            <h1>Registrarse</h1>
            <input type="text" name="usuario" placeholder="Usuario" required class="usuario" id="usuarip">
            <input type="email" name="correo" placeholder="Correo" class="correo" id="correo">
            <input type="password" name="contrasena" placeholder="Contraseña" required class="contraseña" id="contraseña">
            <input type="password" name="confirmar_contrasena" placeholder="Confirmar contraseña" required class="contraseña" id="confirmar_contraseña">
            <p id="mensajeDeRegistro"></p>
            <input type="submit" value="Registrarse" class="submit">
            <span>¿Ya tiene una cuenta? <a href="iniciar-sesion.php">Iniciar sesión</a></span>
            <h3><a href="../../index.php">Regresar</a></h3>
        </form>
    </div>
    <script src="../controllers/confirmarContra.js"></script>
</body>

<?php
require_once '../models/establecerConexión.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = $conn->real_escape_string($_POST['contrasena']);

    $sql = "INSERT INTO usuarios (id, nombre, correo, contraseña) VALUES ('null' ,'$usuario', '$correo', '$contrasena')";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
            window.onload = function() {
                document.getElementById('mensajeDeRegistro').style.display = 'block';
              
                document.getElementById('mensajeDeRegistro').innerHTML = 'Usuario registrado con éxito';
            }
          </script>";
    } else {
        
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>