<body>
    <div class="registrarse">

        <h1>Iniciar sesión</h1>
        <form action="iniciar-sesion.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required class="usuario">
            <input type="password" name="contraseña" placeholder="Contraseña" required class="contraseña">
            <input type="submit" value="Iniciar sesión" class="submit-sesion" id="iniciar-sesion">
            <span>¿no tienes cuenta? <a href="registrarse.php">registrate</a></span>
            <p  id="noti" class="noti">hola</p>
        </form>
        <h3><a href="../../index.php">Regresar</a></h3>
    </div>
</body>
<!-- !bug sin solucionar, no se inicia sesión en el usuario -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/establecerConexión.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['usuario'];
    $password = isset($_POST['contraseña']) ? $_POST['contraseña'] : null;

    // Consultar la base de datos para encontrar al usuario
    $query = "SELECT nombre, contraseña FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error en la consulta: ' . $conn->error);
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar la contraseña
    if ($user && password_verify($password, $user['contraseña'])) {
        // Iniciar la sesión y redirigir al usuario
        session_start();
        $_SESSION['username'] = $user['username'];
       echo "<script>setTimeout(function(){ location.href='../../index.php'; }, 4000'
       document.getElementById('noti').style.display = 'block';
       document.getElementById('noti').innerHTML = 'haz ingresado con éxito';
       </script>";
    } else {
        // Si la contraseña es incorrecta, mandar un mensaje de que 
        echo "<script>);
        window.onload = function() {
            document.getElementById('noti').style.display = 'block';
            document.getElementById('noti').style.color = '#ffffff';
            document.getElementById('noti').style.backgroundColor = '#811d1d';
            document.getElementById('noti').innerHTML = 'El usuario o contraseña es incorrecta ';
        }
            </script>";
    }

}

?>