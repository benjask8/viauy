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
      } else {
        // El ID no está registrado, puedes guardar el nuevo registro
        if ($bus->saveBus()) {
          $data['msg'] = 'Bus Guardado con exito';
          $data['status'] = 'success';
        } else {
          $data['status'] = 'error';
          $data['msg'] = 'Error al guardar el bus';
        }
      }
      echo json_encode($data);
    }
  }
  public function deleteBus()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $idBus = $_GET['id'];
      $busModel = new Bus("", "", "", ""); // Reemplaza 'Bus' con el nombre de tu clase de modelo

      if ($busModel->dropBus($idBus)) {
        $bus = new Bus("", "", "", "");
        $buses = $bus->getOwnBuses();
        $data['buses'] = $buses;

        $data['msg'] = 'Bus Eliminado Con Exito';
        $this->cargarVista("company/profile/buses/main", $data);
      } else {
        $bus = new Bus("", "", "", "");
        $buses = $bus->getOwnBuses();
        $data['buses'] = $buses;

        $data['msg'] = 'Error al eliminar el bus';
        $this->cargarVista("company/profile/buses/main", $data);
      }
    }
  }
}
