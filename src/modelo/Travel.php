<?php

namespace Octobyte\viauy\modelo;

use PDO;
use Octobyte\viauy\libs\Conexion;

class Travel extends Conexion
{
  private $idBus;
  private $origin;
  private $destination;
  private $departureTime;
  private $arrivalTime;
  private $ticketPrice;

  public function __construct($idBus, $origin, $destination, $departureTime, $arrivalTime, $ticketPrice)
  {
    $this->idBus = $idBus;
    $this->origin = $origin;
    $this->destination = $destination;
    $this->departureTime = $departureTime;
    $this->arrivalTime = $arrivalTime;
    $this->ticketPrice = $ticketPrice;
  }
}
