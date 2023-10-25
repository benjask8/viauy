<?php

namespace Octobyte\viauy\modelo;

use PDOException;
use Octobyte\viauy\libs\Conexion;

class Bus extends Conexion
{
  private $idBus;
  private $model;
  private $maxCapacity;

  public function __construct($idBus, $model, $maxCapacity)
  {
    $this->idBus = $idBus;
    $this->model = $model;
    $this->maxCapacity = $maxCapacity;
  }

  public function idExists()
  {
  }
  //guardar un bus
  public function saveBus()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlInsert = 'INSERT INTO bus (idBus, model, maxCapacity) VALUES (:idBus, :model, :maxCapacity)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':idBus', $this->idBus);
      $stmtInsert->bindParam(':model', $this->model);
      $stmtInsert->bindParam(':maxCapacity', $this->maxCapacity);

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
