<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../models/publicaciones.php'; // Incluye la clase Publicacion

// Inicializa la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_maltrato_animal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start(); // Iniciar sesión para el usuario

$publicacion = new Publicacion($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['nombre_usuario'])) {
        echo "Error: No se ha iniciado sesión.";
        exit();
    }

    // Obtén las variables del formulario
    $contacto = $_POST['contactNumber'];
    $descripcion = $_POST['description'];
    $imagen = $_FILES['animalPhoto']; // Asume que se pasa como un archivo

    // Verificar y mover la imagen a la carpeta de subida
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($imagen['name']);
    if (!move_uploaded_file($imagen['tmp_name'], $uploadFile)) {
        echo "Error al cargar la imagen.";
        exit();
    }

    $resultado = $publicacion->crearPublicacion($_SESSION['nombre_usuario'], $contacto, $descripcion, $uploadFile);

    if ($resultado) {
        echo "Publicación realizada correctamente.";
    } else {
        echo "Error al realizar la publicación.";
    }
}
