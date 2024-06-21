<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php"); // Redirigir a la página de login si no está logueado
    exit();
}

require_once '../models/establecerConexión.php';

$username = $_SESSION['username'];
$error_message = '';
$success_message = '';

// Procesar la imagen subida
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePhoto'])) {
    $image = $_FILES['profilePhoto']['tmp_name'];

    // Verificar el tamaño del archivo
    if ($_FILES['profilePhoto']['size'] > 5 * 1024 * 1024) {
        $error_message = 'La imagen es demasiado grande. Por favor, selecciona una imagen de menos de 5MB.';
    } else {
        $imgContent = addslashes(file_get_contents($image));
        $sql = "UPDATE usuarios SET foto_perfil='$imgContent' WHERE nombre='$username'";

        if ($conn->query($sql) === TRUE) {
            $success_message = 'Foto de perfil actualizada con éxito.';
        } else {
            $error_message = 'Error al actualizar la foto de perfil. Por favor, inténtalo de nuevo.';
        }
    }
}

// Obtener la foto de perfil actual del usuario
$sql = "SELECT foto_perfil FROM usuarios WHERE nombre='$username'";
$result = $conn->query($sql);
$currentPhoto = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPhoto = base64_encode($row['foto_perfil']);
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../../css/user.css"> 
</head>

<body> <a href="../../index.php">
        <img src="../../img/salida.svg" alt="" class="user-icon">
    </a>
    <div class="container">
        <header>
            <h1>Editar Perfil</h1>

        </header>

        <?php
        if ($error_message) {
            echo '<div class="error">' . $error_message . '</div>';
        }
        if ($success_message) {
            echo '<div class="alert">' . $success_message . '</div>';
        }
        ?>

        <div class="profile-section">
            <h2>Foto de Perfil Actual</h2>
            <?php
            if ($currentPhoto) {
                echo '<img src="data:image/jpeg;base64,' . $currentPhoto . '" alt="Foto de Perfil" class="profile-pic">';
            } else {
                echo '<img src="../../img/person.svg" alt="Foto de Perfil" class="profile-pic">'; // Imagen de perfil por defecto
            }
            ?>
        </div>

        <div class="upload-section">
            <h2>Subir Nueva Foto de Perfil</h2>
            <form action="user.php" method="POST" enctype="multipart/form-data">
                <label for="profilePhoto">Seleccionar Imagen:</label>
                <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" required style="display: none;">
                <label for="profilePhoto" class="custom-file-upload">Seleccionar archivo</label>
                <button type="submit">Actualizar Foto de Perfil</button>
            </form>
        </div>
    </div>
</body>

</html>