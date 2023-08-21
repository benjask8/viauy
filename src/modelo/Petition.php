<?php
namespace Octobyte\viauy\modelo;

use PDOException;
use Octobyte\viauy\libs\Conexion;

class Petition extends Conexion
{
    private $companyName;
    private $contactName;
    private $contactEmail;
    private $contactPhone;
    private $message;

    public function __construct($companyName, $contactName, $contactEmail, $contactPhone, $message) {
        $this->companyName = $companyName;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactPhone = $contactPhone;
        $this->message = $message;
    }

    public function savePetition()
    {
      $pdo = $this->getConexion()->getPdo();

        try {
            $query = "INSERT INTO companyrequest (companyName, contactName, contactEmail, contactPhone, message)
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$this->companyName, $this->contactName, $this->contactEmail, $this->contactPhone, $this->message]);
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }
    public function getAllCompanyRequests()
    {
        try {
            $pdo = $this->getConexion()->getPdo();
            $query = "SELECT * FROM companyrequest";
            $stmt = $pdo->query($query);
            $companyRequests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $companyRequests;
        } catch (PDOException $e) {
            return false; // Error
        }
    }

    public function updateStatus($id, $status)
{
    try {
        $pdo = $this->getConexion()->getPdo();
        $query = "UPDATE companyrequest SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($query); // Usar prepare en lugar de query
        $stmt->execute([$status, $id]);
        return $status; // Devolver verdadero en caso de éxito
    } catch (PDOException $e) {
        return false; // Devolver falso en caso de error
    }
}

    
}
