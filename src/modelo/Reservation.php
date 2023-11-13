<?php

namespace Octobyte\viauy\modelo;

use PDO;
use PDOException;
use Octobyte\viauy\libs\Conexion;

class Reservation extends Conexion
{
  private $user;
  private $seat;
  private $idLine;

  public function __construct($user, $seat, $idLine)
  {
    $this->user = $user;
    $this->seat = $seat;
    $this->idLine = $idLine;
  }

  public function makeReservation()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      // Verifica si ya existe una reserva para el mismo idLine y seat
      $sqlCheck = 'SELECT COUNT(*) FROM reservation WHERE idLine = :idLine AND seat = :seat';
      $stmtCheck = $pdo->prepare($sqlCheck);
      $stmtCheck->bindParam(':idLine', $this->idLine);
      $stmtCheck->bindParam(':seat', $this->seat);
      $stmtCheck->execute();

      $count = $stmtCheck->fetchColumn();

      if ($count > 0) {
        // Ya hay una reserva para el mismo idLine y seat
        return "Asiento no disponible";
      }

      // No hay reserva existente, procede con la inserción
      $sqlInsert = 'INSERT INTO reservation (user, seat, idLine) VALUES (:user, :seat, :idLine)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':user', $this->user);
      $stmtInsert->bindParam(':seat', $this->seat);
      $stmtInsert->bindParam(':idLine', $this->idLine);

      if ($stmtInsert->execute()) {
        return true;
      }
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }


  public function getSeatAvailability()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sql = 'SELECT seat FROM reservation WHERE idLine = :idLine';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':idLine', $this->idLine);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $result;
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }
}