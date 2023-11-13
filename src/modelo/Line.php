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
  private $lineName;
  private $departureDate;
  private $linePrice; // Nuevo atributo 'linePrice'

  public function __construct($idLine, $origin, $destination, $departureTime, $arrivalTime, $idBus, $ownerLine, $lineName, $departureDate, $linePrice)
  {
    $this->idLine = $idLine;
    $this->origin = $origin;
    $this->destination = $destination;
    $this->departureTime = $departureTime;
    $this->arrivalTime = $arrivalTime;
    $this->idBus = $idBus;
    $this->ownerLine = $ownerLine;
    $this->lineName = $lineName;
    $this->departureDate = $departureDate;
    $this->linePrice = $linePrice; // Nuevo atributo 'linePrice'
  }

  public function saveLine()
  {
    $pdo = Conexion::getConexion()->getPdo();

    try {
      $sqlInsert = 'INSERT INTO busLine (origin, destination, departureTime, arrivalTime, idBus, ownerLine, lineName, departureDate, linePrice) VALUES (:origin, :destination, :departureTime, :arrivalTime, :idBus, :ownerLine, :lineName, :departureDate, :linePrice)';
      $stmtInsert = $pdo->prepare($sqlInsert);
      $stmtInsert->bindParam(':origin', $this->origin);
      $stmtInsert->bindParam(':destination', $this->destination);
      $stmtInsert->bindParam(':departureTime', $this->departureTime);
      $stmtInsert->bindParam(':arrivalTime', $this->arrivalTime);
      $stmtInsert->bindParam(':idBus', $this->idBus);
      $stmtInsert->bindParam(':ownerLine', $this->ownerLine);
      $stmtInsert->bindParam(':lineName', $this->lineName);
      $stmtInsert->bindParam(':departureDate', $this->departureDate);
      $stmtInsert->bindParam(':linePrice', $this->linePrice);

      if ($stmtInsert->execute()) {
        return true;
      }
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function isBusValid($idBus)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $sql = 'SELECT ownerBus FROM bus WHERE idBus = :idBus';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':idBus', $idBus);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        return $result['ownerBus'] === $_SESSION['company_name'];
      } else {
        return false;
      }
    } catch (\PDOException $e) {
      return false;
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
      $query = "SELECT * FROM busLine WHERE ownerLine = :ownerLine AND (lineName LIKE :searchTerm)";
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

  public function calcularDiferenciaHoras($line)
  {
    // Convertir las cadenas de tiempo a objetos DateTime del espacio de nombres global
    $departureTime = \DateTime::createFromFormat('H:i:s', $line["departureTime"]);
    $arrivalTime = \DateTime::createFromFormat('H:i:s', $line["arrivalTime"]);

    if ($departureTime && $arrivalTime) {
      // Calcular la diferencia en segundos
      $diferenciaSegundos = $arrivalTime->getTimestamp() - $departureTime->getTimestamp();

      // Calcular la diferencia en horas y minutos
      $diferenciaHoras = floor($diferenciaSegundos / 3600); // Horas completas
      $diferenciaMinutos = floor(($diferenciaSegundos % 3600) / 60); // Minutos restantes

      return ['horas' => $diferenciaHoras, 'minutos' => $diferenciaMinutos];
    } else {
      // Manejar el caso en el que la conversión falla
      return $line["arrivalTime"];
    }
  }


  public function getLineDataById($idLine)
  {
    $pdo = $this->getConexion()->getPdo();

    try {
      $sqlSelect = 'SELECT * FROM busLine WHERE idLine = :idLine';
      $stmtSelect = $pdo->prepare($sqlSelect);
      $stmtSelect->bindParam(':idLine', $idLine);
      $stmtSelect->execute();

      $line = $stmtSelect->fetch(PDO::FETCH_ASSOC);
      $busModel = new Bus("", "", "", "", "", "", "", ""); // Ajusta esto según tu constructor

      $busId = $line['idBus'];
      $bus = $busModel->getBusById($busId);

      return ['line' => $line, 'bus' => $bus];
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
  public function searchLinesByData($origin, $destination, $departureDate)
  {
    $pdo = $this->getConexion()->getPdo();
    $lines = [];

    try {
      $sqlSelect = 'SELECT * FROM busLine WHERE origin = :origin AND destination = :destination AND departureDate = :departureDate';
      $stmtSelect = $pdo->prepare($sqlSelect);
      $stmtSelect->bindParam(':origin', $origin);
      $stmtSelect->bindParam(':destination', $destination);
      $stmtSelect->bindParam(':departureDate', $departureDate);
      $stmtSelect->execute();

      $lines = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

      // Obtener información de buses asociados a las líneas
      $buses = [];
      $busModel = new Bus("", "", "", "", "", "", "", ""); // Ajusta esto según tu constructor

      foreach ($lines as $line) {
        $busId = $line['idBus'];
        $busInfo = $busModel->getBusById($busId);
        if ($busInfo) {
          $buses[] = $busInfo;
        }
      }

      return ['lines' => $lines, 'buses' => $buses];
    } catch (\Throwable $th) {
      throw $th;
    } finally {
      $pdo = null;
    }
  }
}