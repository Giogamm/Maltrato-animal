<?php
// upload.php (Controlador)
require_once '../models/establecerConexión.php';// Archivo de configuración y conexión con la base de datos
include_once '../controllers/publicaciones.php';

$nombre_usuario = $_POST['usuario_nombre'];
$contacto = $_POST['contactNumber'];
$descripcion = $_POST['description'];
$imagen = basename($_FILES['animalPhoto']['name']);
$target_dir = "uploads/";
$target_file = $target_dir . $imagen;

move_uploaded_file($_FILES['animalPhoto']['tmp_name'], $target_file);

$publicacion = new Publicacion($db);
if ($publicacion->crearPublicacion($nombre_usuario, $contacto, $descripcion, $imagen)) {
echo "Publicación creada exitosamente.";
} else {
echo "Error al crear la publicación.";
}