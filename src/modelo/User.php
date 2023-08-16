<?php

namespace Octobyte\viauy\modelo;

use PDO;

class UsuarioModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function crearUsuario($ci, $nombre, $apellido, $telefono, $correo)
    {
        $sql = "INSERT INTO Usuarios (ci, nombre, apellido, telefono, correo) VALUES (:ci, :nombre, :apellido, :telefono, :correo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':ci', $ci, PDO::PARAM_INT);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindValue(':telefono', $telefono, PDO::PARAM_INT);
        $stmt->bindValue(':correo', $correo, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function correoExistente($correo)
    {
        $sql = "SELECT COUNT(*) FROM Usuarios WHERE correo = :correo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
    
    // Agrega otros métodos relacionados con la interacción con la tabla Usuarios si es necesario
}
