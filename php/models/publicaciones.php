<?php

class Publicacion
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function crearPublicacion($usuario_nombre, $contacto, $descripcion, $imagenRuta)
    {
        try {
            $query = "INSERT INTO publicaciones (usuario_nombre, contacto, descripcion, imagen, fecha_publicacion) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssss", $usuario_nombre, $contacto, $descripcion, $imagenRuta);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerPublicaciones($orden)
    {
        $ordenSQL = $orden == 'recientes' ? 'DESC' : 'ASC';
        $query = "SELECT * FROM publicaciones ORDER BY fecha_publicacion $ordenSQL";
        $result = $this->db->query($query);
        $publicaciones = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $publicaciones[] = $row;
            }
        }

        return $publicaciones;
    }
}
