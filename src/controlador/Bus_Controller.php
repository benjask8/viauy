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

      // Obtén el valor de las características del autobús desde el formulario
      $hasToilet = isset($_POST['hasToilet']) ? 1 : 0;
      $hasWiFi = isset($_POST['hasWiFi']) ? 1 : 0;
      $hasAC = isset($_POST['hasAC']) ? 1 : 0;
      $seatLayout = $_POST['seatLayout'];

      $bus = new Bus($busId, $model, $maxCapacity, $ownerBus, $hasToilet, $hasWiFi, $hasAC, $seatLayout);

      if ($bus->idExists()) {
        $data['status'] = 'error';
        $data['msg'] = 'Matrícula ya registrada';
      } else {
        // El ID no está registrado, puedes guardar el nuevo registro
        if ($bus->saveBus()) {
          $data['msg'] = 'Bus Guardado con éxito';
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
      $busModel = new Bus("", "", "", "", "", "", "", ""); // Reemplaza 'Bus' con el nombre de tu clase de modelo

      if ($busModel->dropBus($idBus)) {
        $bus = new Bus("", "", "", "", "", "", "", "");
        $buses = $bus->getOwnBuses();
        $data['buses'] = $buses;

        $data['msg'] = 'Bus Eliminado Con Exito';
        $this->cargarVista("company/profile/buses/main", $data);
      } else {
        $bus = new Bus("", "", "", "", "", "", "", "");
        $buses = $bus->getOwnBuses();
        $data['buses'] = $buses;

        $data['msg'] = 'Error al eliminar el bus';
        $this->cargarVista("company/profile/buses/main", $data);
      }
    }
  }
  public function searchBuses()
  {
    $data = [
      'msg' => '',
      'status' => '',
      'buses' => [] // Inicializa la matriz de resultados de autobuses
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $searchTerm = $_POST['searchTerm']; // Obtén el término de búsqueda del formulario

      // Realiza la búsqueda de autobuses en el modelo
      $bus = new Bus("", "", "", "", "", "", "", "");
      $data['buses'] = $bus->searchBuses($searchTerm);

      if (empty($data['buses'])) {
        $data['msg'] = 'No se encontraron resultados para la búsqueda.';
        $data['status'] = 'info';
      }
    }

    echo json_encode($data);
  }

  public function getBusData()
  {
    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $idBus = $_GET['id'];
      $busModel = new Bus("", "", "", "", "", "", "", ""); // Reemplaza 'Bus_Model' con el nombre de tu modelo

      $busData = $busModel->getBusDataById($idBus);

      $data = [
        'bus' => $busData
      ];

      if ($busData) {
        $data['status'] = 'success';
        $data['msg'] = 'Todo Salio Bien.';
        echo json_encode($data);
      } else {
        $data['status'] = 'error';
        $data['msg'] = 'Bus No Encontrado';
        echo json_encode($data);
      }
    } else {
      $data['status'] = 'error';
      $data['msg'] = 'solicitud Incorrecta';
      echo json_encode($data);
    }
  }


  public function editBus()
  {
    $data = [
      'msg' => '',
      'status' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtén los valores de los campos del formulario
      $busId = $_POST['busId'];
      $model = $_POST['model'];
      $maxCapacity = $_POST['maximum_capacity'];

      // Obtén el valor de las características del autobús desde el formulario
      $hasToilet = $_POST['hasToilet'];
      $hasWiFi = $_POST['hasWiFi'];
      $hasAC = $_POST['hasAC'];
      $seatLayout = $_POST['seatLayout'];

      // Validaciones en el lado del servidor
      if (empty($busId) || empty($model) || empty($maxCapacity) || !is_numeric($maxCapacity) || !$this->isValidSeatLayout($seatLayout)) {
        $data['status'] = 'error';
        $data['msg'] = 'Datos de entrada no válidos.';
      } else {
        $bus = new Bus($busId, $model, $maxCapacity, '', $hasToilet, $hasWiFi, $hasAC, $seatLayout); // Modifica el constructor según tus necesidades

        if ($bus->editBus()) {
          $data['msg'] = 'Bus editado con éxito';
          $data['status'] = 'success';
        } else {
          $data['status'] = 'error';
          $data['msg'] = 'Error al editar el bus';
        }
      }

      echo json_encode($data);
    }
  }

  public function isValidSeatLayout($layout)
  {
    $pattern = '/^\d+(,\d{1,8})*$/';
    return preg_match($pattern, $layout);
  }
}