<?php
class Publicacion {
private $conn;

public function __construct($db) {
$this->conn = $db;
}

public function crearPublicacion($usuario_nombre, $contacto, $descripcion, $imagen) {
$query = "INSERT INTO publicaciones(usuario_nombre, contacto, descripcion, imagen) VALUES(:usuario_nombre, :contacto, :descripcion, :imagen)";
$stmt = $this->conn->prepare($query);

$stmt->bindParam(':usuario_nombre', $usuario_nombre);
$stmt->bindParam(':contacto', $contacto);
$stmt->bindParam(':descripcion', $descripcion);
$stmt->bindParam(':imagen', $imagen);

return $stmt->execute();
}

public function obtenerPublicaciones($orden = 'recientes') {
$query = "SELECT * FROM publicaciones";

if ($orden === 'antiguos') {
$query .= " ORDER BY fecha_publicacion ASC";
} else {
$query .= " ORDER BY fecha_publicacion DESC";
}

$stmt = $this->conn->prepare($query);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}