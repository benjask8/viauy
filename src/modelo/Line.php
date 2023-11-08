<?php

namespace Octobyte\viauy\modelo;

use PDO;
use Octobyte\viauy\libs\Conexion;

class Line extends Conexion
{
  private $idLine;
  private $origin;
  private $destination;
  private $departureTime;
  private $arrivalTime;
  private $idBus;
  private $ownerLine;

  public function __construct($idLine, $origin, $destination, $departureTime, $arrivalTime, $idBus, $ownerLine)
  {
    $this->idLine = $idLine;
    $this->origin = $origin;
    $this->destination = $destination;
    $this->departureTime = $departureTime;
    $this->arrivalTime = $arrivalTime;
    $this->idBus = $idBus;
    $this->ownerLine = $ownerLine;
  }

  public function saveLine()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlInsert = 'INSERT INTO busLine (origin, destination, departureTime, arrivalTime, idBus, ownerLine) VALUES (:origin, :destination, :departureTime, :arrivalTime, :idBus, :ownerLine)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':origin', $this->origin);
      $stmtInsert->bindParam(':destination', $this->destination);
      $stmtInsert->bindParam(':departureTime', $this->departureTime);
      $stmtInsert->bindParam(':arrivalTime', $this->arrivalTime);
      $stmtInsert->bindParam(':idBus', $this->idBus);
      $stmtInsert->bindParam(':ownerLine', $this->ownerLine);

      if ($stmtInsert->execute()) {
        return true;
      }
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function getOwnLines()
  {
    try {
      $pdo = $this->getConexion()->getPdo();
      $query = "SELECT * FROM busLine WHERE idBus = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$this->idBus]); // Reemplaza $this->idBus con el identificador del bus actual
      $lines = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $lines;
    } catch (\PDOException $e) {
      return false;
    }
  }

  public function dropLine($idLine)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      // Verificar si la línea existe antes de eliminarla
      $lineData = $this->getLineDataById($idLine);

      if ($lineData) {
        $query = "DELETE FROM busLine WHERE idLine = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$idLine]);

        return true; // Devolver true si la eliminación fue exitosa
      } else {
        return false; // Devolver false si la línea no existe
      }
    } catch (\PDOException $e) {
      return false; // Devolver false si hubo un error
    }
  }

  public function searchLines($searchTerm)
  {
    try {
      $pdo = $this->getConexion()->getPdo();
      $query = "SELECT * FROM busLine WHERE ownerLine = :ownerLine AND (origin LIKE :searchTerm)";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':ownerLine', $_SESSION['company_name']);
      $stmt->bindValue(':searchTerm', "%$searchTerm%");
      $stmt->execute();
      $lines = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $lines;
    } catch (\PDOException $e) {
      return false; // Devuelve false en caso de error
    }
  }

  public function getLineDataById($idLine)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $sqlSelect = 'SELECT * FROM busLine WHERE idLine = :idLine AND idBus = :idBus';
      $stmtSelect = $pdo->prepare($sqlSelect);
      $stmtSelect->bindParam(':idLine', $idLine);
      $stmtSelect->bindParam(':idBus', $this->idBus); // Reemplaza $this->idBus con el identificador del autobús actual
      $stmtSelect->execute();

      return $stmtSelect->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function editLine($idLine, $origin, $destination, $departureTime, $arrivalTime)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $sqlUpdate = 'UPDATE busLine SET origin = :origin, destination = :destination, departureTime = :departureTime, arrivalTime = :arrivalTime WHERE idLine = :idLine AND idBus = :idBus';
      $stmtUpdate = $pdo->prepare($sqlUpdate);
      $stmtUpdate->bindParam(':idLine', $idLine);
      $stmtUpdate->bindParam(':idBus', $this->idBus); // Reemplaza $this->idBus con el identificador del autobús actual
      $stmtUpdate->bindParam(':origin', $origin);
      $stmtUpdate->bindParam(':destination', $destination);
      $stmtUpdate->bindParam(':departureTime', $departureTime);
      $stmtUpdate->bindParam(':arrivalTime', $arrivalTime);

      return $stmtUpdate->execute();
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }
}