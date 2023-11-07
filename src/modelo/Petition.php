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

    public function __construct($companyName, $contactName, $contactEmail, $contactPhone, $message)
    {
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
            $token = $this->generateUniqueToken(10);
            $query = "INSERT INTO companyrequest (companyName, contactName, contactEmail, contactPhone, message, token) VALUES (:companyName, :contactName, :contactEmail, :contactPhone, :message, :token)";
            $stmtInsert = $pdo->prepare($query);
            $stmtInsert->bindParam(':companyName', $this->companyName);
            $stmtInsert->bindParam(':contactName', $this->contactName);
            $stmtInsert->bindParam(':contactEmail', $this->contactEmail);
            $stmtInsert->bindParam(':contactPhone', $this->contactPhone);
            $stmtInsert->bindParam(':message', $this->message);
            $stmtInsert->bindParam(':token', $token);
            $stmtInsert->execute();

            return $token;
        } catch (PDOException $e) {
            return
                'Error al guardar la solicitud: ' . $e->getMessage(); // Error
        }
    }

    // Función para generar un token único similar a la función en SQL
    private function generateUniqueToken($length = 10)
    {
        if (function_exists('random_bytes')) {
            $token = bin2hex(random_bytes($length));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $token = bin2hex(openssl_random_pseudo_bytes($length));
        } else {
            // Si no se dispone de una fuente segura, se puede usar esta opción (menos segura)
            $token = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
        }

        return $token;
    }


    public function petitionExists($contactEmail)
    {
        $pdo = $this->getConexion()->getPdo();

        try {
            $query = "SELECT COUNT(*) FROM companyrequest WHERE contactEmail = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$contactEmail]);
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            return false;
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

    public function filterByStatus($filter)
    {
        try {
            $pdo = $this->getConexion()->getPdo();

            if ($filter === 'all') {
                $query = "SELECT * FROM companyrequest";
            } else {
                $query = "SELECT * FROM companyrequest WHERE status = ?";
            }

            $stmt = $pdo->prepare($query);

            if ($filter !== 'all') {
                $stmt->bindParam(1, $filter);
            }

            $stmt->execute();

            $filteredRequests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $filteredRequests; // Devolver los registros filtrados en caso de éxito
        } catch (PDOException $e) {
            return []; // Devolver un array vacío en caso de error
        }
    }


    public function confirmToken($token, $email)
    {
        $pdo = $this->getConexion()->getPdo();

        try {
            $query = "SELECT COUNT(1) FROM companyrequest WHERE token = ? AND contactEmail = ? AND status = 'Approved'";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$token, $email]);
            $count = $stmt->fetchColumn();

            return $count === 1;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function dropPetition($token)
    {
        $pdo = $this->getConexion()->getPdo();

        try {
            $query = "DELETE FROM companyrequest WHERE token = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$token]);

            return true; // Devolver true si la eliminación fue exitosa
        } catch (PDOException $e) {
            return false; // Devolver false si hubo un error
        }
    }


    public function searchCompanyRequests($searchTerm)
    {
        $pdo = $this->getConexion()->getPdo();
        try {
            $query = "SELECT * FROM companyrequest WHERE companyName LIKE :searchTerm";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':searchTerm', "%$searchTerm%");

            $stmt->execute();
            $companyRequests = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $companyRequests;
        } catch (\PDOException $e) {
            return false; // Devuelve false en caso de error
        }
    }
}