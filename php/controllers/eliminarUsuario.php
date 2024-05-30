<?php
require_once '../models/establecerConexión.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$id])) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
