<?php

namespace Octobyte\viauy\modelo;

use PDO;
use Octobyte\viauy\libs\Conexion;

class Bus extends Conexion
{
  private $idBus;
  private $model;
  private $maximum_capacity;
  private $ownerBus;
  private $hasToilet;
  private $hasWiFi;
  private $hasAC;

  public function __construct($idBus, $model, $maximum_capacity, $ownerBus, $hasToilet, $hasWiFi, $hasAC)
  {
    $this->idBus = $idBus;
    $this->model = $model;
    $this->maximum_capacity = $maximum_capacity;
    $this->ownerBus = $ownerBus;
    $this->hasToilet = $hasToilet;
    $this->hasWiFi = $hasWiFi;
    $this->hasAC = $hasAC;
  }

  public function idExists()
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $sqlSelect = 'SELECT idBus FROM bus WHERE idBus = :idBus';
      $stmtSelect = $pdo->prepare($sqlSelect);
      $stmtSelect->bindParam(':idBus', $this->idBus);
      $stmtSelect->execute();

      return $stmtSelect->fetch(PDO::FETCH_ASSOC) !== false;
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  // Guardar un bus
  public function saveBus()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlInsert = 'INSERT INTO bus (idBus, model, maximum_capacity, ownerBus, hasToilet, hasWiFi, hasAC) VALUES (:idBus, :model, :maximum_capacity, :ownerBus, :hasToilet, :hasWiFi, :hasAC)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':idBus', $this->idBus);
      $stmtInsert->bindParam(':model', $this->model);
      $stmtInsert->bindParam(':maximum_capacity', $this->maximum_capacity);
      $stmtInsert->bindParam(':ownerBus', $this->ownerBus);
      $stmtInsert->bindParam(':hasToilet', $this->hasToilet);
      $stmtInsert->bindParam(':hasWiFi', $this->hasWiFi);
      $stmtInsert->bindParam(':hasAC', $this->hasAC);

      if ($stmtInsert->execute()) {
        return true;
      }
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function getOwnBuses()
  {
    try {
      $pdo = $this->getConexion()->getPdo();
      $query = "SELECT * FROM bus WHERE ownerBus = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_SESSION['company_name']]);
      $buses = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $buses; // Devuelve un array, incluso si está vacío
    } catch (PDO $e) {
      return false; // Devuelve false en caso de error
    }
  }

  public function dropBus($idBus)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $query = "DELETE FROM bus WHERE idBus = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$idBus]);

      return true; // Devolver true si la eliminación fue exitosa
    } catch (PDO $e) {
      return false; // Devolver false si hubo un error
    }
  }

  public function searchBuses($searchTerm)
  {
    try {
      $pdo = $this->getConexion()->getPdo();
      $query = "SELECT * FROM bus WHERE ownerBus = :ownerBus AND (idBus LIKE :searchTerm OR model REGEXP :regexp)";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':ownerBus', $_SESSION['company_name']);
      $stmt->bindValue(':searchTerm', "%$searchTerm%");
      $stmt->bindValue(':regexp', $searchTerm);

      $stmt->execute();
      $buses = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $buses;
    } catch (\PDOException $e) {
      return false; // Devuelve false en caso de error
    }
  }

  public function getBusDataById($idBus)
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {

      $sqlSelect = 'SELECT * FROM bus WHERE ownerBus = :ownerBus AND idBus = :idBus;';
      $stmtSelect = $pdo->prepare($sqlSelect);
      $stmtSelect->bindParam(':idBus', $idBus);
      $stmtSelect->bindParam(':ownerBus', $_SESSION['company_name']);
      $stmtSelect->execute();

      return $stmtSelect->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function editBus()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlUpdate = 'UPDATE bus SET model = :model, maximum_capacity = :maximum_capacity, hasToilet = :hasToilet, hasWiFi = :hasWiFi, hasAC = :hasAC WHERE idBus = :idBus';
      $stmtUpdate = $pdo->prepare($sqlUpdate);
      $stmtUpdate->bindParam(':idBus', $this->idBus);
      $stmtUpdate->bindParam(':model', $this->model);
      $stmtUpdate->bindParam(':maximum_capacity', $this->maximum_capacity);
      $stmtUpdate->bindParam(':hasToilet', $this->hasToilet);
      $stmtUpdate->bindParam(':hasWiFi', $this->hasWiFi);
      $stmtUpdate->bindParam(':hasAC', $this->hasAC);

      return $stmtUpdate->execute();
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }
}
