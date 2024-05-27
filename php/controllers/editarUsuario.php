<?php
require_once '../models/establecerConexión.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['nombre'], $_POST['correo'], $_POST['contraseña'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $nombre, $correo, $contraseña, $id);

        if ($stmt->execute()) {
            echo 'Usuario actualizado con éxito';
        } else {
            echo 'Error al actualizar el usuario: ' . $conn->error;
        }

        $stmt->close();
    } else {
        echo 'Faltan datos';
    }
} else {
    echo 'Método no permitido';
}

$conn->close();
