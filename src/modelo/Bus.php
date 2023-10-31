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
}
