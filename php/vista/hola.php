<?php
require_once 'php/functions/establecerConexión.php';

$sql = "SELECT 1";
$result = $conn->query($sql);

if ($result) {
  echo "Conexión exitosa";
} else {
  echo "Error en la conexión: " . $conn->error;
}

$conn->close();

