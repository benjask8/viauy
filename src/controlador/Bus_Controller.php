<?php


use Octobyte\viauy\modelo\Bus;
use Octobyte\viauy\libs\Controlador;


class Bus_Controller extends Controlador
{

  public function newBus()
  {
    $data = [
      'msg' => '',
      'status' => ''
    ];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $busId = $_POST['busId'];
      $ownerBus = $_SESSION['company_name'];
      $model = $_POST['model'];
      $maxCapacity = $_POST['maxCapacity'];

      $bus = new Bus($busId, $model, $maxCapacity, $ownerBus);

      if ($bus->idExists()) {
        $data['status'] = 'error';
        $data['msg'] = 'Matrícula ya registrada';
        $this->cargarVista("company/profile/buses/add", $data);
      } else {
        // El ID no está registrado, puedes guardar el nuevo registro
        if ($bus->saveBus()) {
          $data['msg'] = 'Bus Guardado con exito';
          $data['status'] = 'success';

          $this->cargarVista("company/profile/buses/add", $data);
        } else {
          $data['status'] = 'error';
          $data['msg'] = 'Error al guardar el bus';
          $this->cargarVista("company/profile/buses/add", $data);
        }
      }
    } else {
      $this->cargarVista("company/profile/buses/add", $data);
    }
  }
}
