<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\modelo\User;
use Octobyte\viauy\modelo\Reservation;
use Octobyte\viauy\libs\Controlador;

class Reservation_Controller extends Controlador
{
  public function makeReservation()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Recoge los datos del formulario
      $user = $_POST["user"];
      $seat = $_POST["seat"];
      $lineId = $_POST["lineId"];

      $data = [];
      // Crea una instancia de la clase Reservation
      $reservation = new Reservation($user, $seat, $lineId);

      // Intenta hacer la reserva
      $result = $reservation->makeReservation();

      if ($result === true) {
        $data['status'] = "success";
        $data['msg'] = "Reserva Guardada Exitosamente";
      } else {
        $data['status'] = "error";
        $data['msg'] = $result; // Mensaje de "Asiento no disponible" o cualquier otro mensaje de error
      }
    } else {
      $data['status'] = "error";
      $data['msg'] = "Error en post";
    }
    echo json_encode($data);
  }
}