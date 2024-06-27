<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../models/establecerConexión.php';

if (isset($_POST['post_id']) && isset($_SESSION['username'])) {
    $postId = intval($_POST['post_id']);
    $username = $_SESSION['username'];

    // Verificar si la publicación pertenece al usuario logueado
    $sql = "SELECT * FROM publicaciones WHERE id='$postId' AND usuario_nombre='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Eliminar la publicación
        $deleteSql = "DELETE FROM publicaciones WHERE id='$postId'";
        if ($conn->query($deleteSql) === TRUE) {
            $_SESSION['success_message'] = "Publicación eliminada con éxito.";
        } else {
            $_SESSION['error_message'] = "Error al eliminar la publicación.";
        }
    } else {
        $_SESSION['error_message'] = "No tienes permiso para eliminar esta publicación.";
    }

    $conn->close();
}

header('Location: ../vista/animales-perdidos.php');
exit();
