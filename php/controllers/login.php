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

    
    if ($user && $password === $user['contraseña']) {
        session_start();
        $_SESSION['username'] = $user['nombre'];
        echo "success"; // Simplemente devuelve un mensaje de éxito
    } else {
        http_response_code(401); // Opcional: devuelve un código de estado HTTP para indicar error
        echo "El usuario o contraseña es incorrecta";
    }

    $stmt->close();
    $conn->close();
}
