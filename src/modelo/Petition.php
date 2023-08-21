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
}
