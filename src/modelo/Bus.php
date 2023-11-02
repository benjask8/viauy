<?php

namespace Octobyte\viauy\modelo;

use PDO;
use Octobyte\viauy\libs\Conexion;

class Bus extends Conexion
{
  private $idBus;
  private $model;
  private $maxCapacity;
  private $ownerBus;

  public function __construct($idBus, $model, $maxCapacity, $ownerBus)
  {
    $this->idBus = $idBus;
    $this->model = $model;
    $this->maxCapacity = $maxCapacity;
    $this->ownerBus = $ownerBus;
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

  //guardar un bus
  public function saveBus()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlInsert = 'INSERT INTO bus (idBus, model, maxCapacity, ownerBus) VALUES (:idBus, :model, :maxCapacity, :ownerBus)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':idBus', $this->idBus);
      $stmtInsert->bindParam(':model', $this->model);
      $stmtInsert->bindParam(':maxCapacity', $this->maxCapacity);
      $stmtInsert->bindParam(':ownerBus', $this->ownerBus);

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
}
