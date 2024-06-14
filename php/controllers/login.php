<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/establecerConexión.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['usuario'];
    $password = $_POST['contraseña'];

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
    if ($user && $password === $user['contraseña']) {  // Comparar directamente
        // Iniciar la sesión y redirigir al usuario
        $_SESSION['username'] = $user['nombre'];
        echo "<script>
            document.getElementById('noti').style.display = 'block';
            document.getElementById('noti').innerHTML = 'Has ingresado con éxito';
            setTimeout(function() {
                location.href = '../../index.php';
            }, 2000);
        </script>";
    } else {
        // Si la contraseña es incorrecta, mandar un mensaje de error
        echo "<script>
            window.onload = function() {
                document.getElementById('noti').style.display = 'block';
                document.getElementById('noti').style.color = '#ffffff';
                document.getElementById('noti').style.backgroundColor = '#811d1d';
                document.getElementById('noti').innerHTML = 'El usuario o contraseña es incorrecta';
            }
        </script>";
    }

    $stmt->close();
    $conn->close();
}
