<?php


use Octobyte\viauy\modelo\Line;
use Octobyte\viauy\libs\Controlador;


class Line_Controller extends Controlador
{

  public function newLine()
  {
    $data = [
      'msg' => '',
      'status' => ''
    ];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $origin = $_POST['origin'];
      $destination = $_POST['destination'];
      $departureTime = $_POST['departureTime'];
      $arrivalTime = $_POST['arrivalTime'];
      $idBus = $_POST['idBus'];
      $ownerLine = $_SESSION['company_name'];
      $lineName = $_POST['lineName'];

      $line = new Line("", $origin, $destination, $departureTime, $arrivalTime, $idBus, $ownerLine, $lineName);

      if ($line->isBusValid($idBus)) {
        if ($line->saveLine()) {
          $data['msg'] = 'Línea Guardada con éxito';
          $data['status'] = 'success';
        } else {
          $data['status'] = 'error';
          $data['msg'] = 'Error al guardar la línea';
        }
      } else {
        $data['status'] = 'error';
        $data['msg'] = 'Bus No Valido';
      }


      echo json_encode($data);
    }
  }

  public function searchLineByData()
  {
    $data = [
      'msg' => '',
      'status' => '',
      'lines' => [] // Inicializa la matriz de resultados de líneas
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $origin = $_POST['origin'];
      $destination = $_POST['destination'];
      $departureTime = $_POST['departureTime'];

      // Realiza la búsqueda de líneas en el modelo
      $line = new Line("", "", "", "", "", "", "", "");
      $data['lines'] = $line->searchLinesByData($origin, $destination, $departureTime);

      if (empty($data['lines'])) {
        $data['msg'] = 'No se encontraron resultados para la búsqueda.';
        $data['status'] = 'error';
      } else {
        $data['msg'] = 'Se han Encontrado buses';
        $data['status'] = 'info';
      }
    }

    echo json_encode($data);
  }


  public function deleteLine()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $idLine = $_GET['id'];
      $lineModel = new Line("", "", "", "", "", "", "", ""); // Reemplaza 'Line' con el nombre de tu clase de modelo

      if ($lineModel->dropLine($idLine)) {
        $line = new Line("", "", "", "", "", "", "", "");
        $lines = $line->getOwnLines();
        $data['lines'] = $lines;

        $data['msg'] = 'Línea Eliminada Con Éxito';
        $this->cargarVista("company/profile/lines/main", $data);
      } else {
        $line = new Line("", "", "", "", "", "", "", "");
        $lines = $line->getOwnLines();
        $data['lines'] = $lines;

        $data['msg'] = 'Error al eliminar la línea';
        $this->cargarVista("company/profile/lines/main", $data);
      }
    }
  }
  public function searchLines()
  {
    $data = [
      'msg' => '',
      'status' => '',
      'lines' => [] // Inicializa la matriz de resultados de líneas
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $searchTerm = $_POST['searchTerm']; // Obtén el término de búsqueda del formulario

      // Realiza la búsqueda de líneas en el modelo
      $line = new Line("", "", "", "", "", "", "", "");
      $data['lines'] = $line->searchLines($searchTerm);

      if (empty($data['lines'])) {
        $data['msg'] = 'No se encontraron resultados para la búsqueda.';
        $data['status'] = 'info';
      }
    }

    echo json_encode($data);
  }
}