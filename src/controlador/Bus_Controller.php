<?php


use Octobyte\viauy\modelo\Bus;
use Octobyte\viauy\libs\Controlador;


class Bus_Controller extends Controlador
{

  public function newPetition()
  {
    $data = [
      'msg' => ''
    ];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $busId = $_POST['busId'];
      $model = $_POST['model'];
      $maxCapacity = $_POST['maxCapacity'];

      $bus = new Bus($busId, $model, $maxCapacity);


      if ($bus->idExists($busId)) {
        $data['msg'] = 'matricula ya registrada';
        $this->cargarVista("company/profile/buses/add", $data);
      }
      $this->cargarVista("company/profile/buses/addSuccess", $data);
    } else {
      $this->cargarVista("company/profile/buses/addSuccess", $data);
    }
  }
}
