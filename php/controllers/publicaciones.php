<?php
session_start();
include '../models/establecerConexión.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['username'])) {
        die('No has iniciado sesión.');
    }

    $username = $_SESSION['username'];
    $contactNumber = $_POST['contactNumber'];
    $description = $_POST['description'];
    $image = $_FILES['animalPhoto']['tmp_name'];

    // Verificación del tamaño del archivo
    if ($_FILES['animalPhoto']['size'] > 5 * 1024 * 1024) {
        die('La imagen es demasiado grande. Por favor, selecciona una imagen de menos de 5MB.');
    }

    $imgContent = addslashes(file_get_contents($image));

    $sql = "INSERT INTO publicaciones (usuario_nombre, contacto, descripcion, imagen, fecha_publicacion)
            VALUES ('$username', '$contactNumber', '$description', '$imgContent', CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva publicación creada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../vista/animales-perdidos.php");
    exit();
}
