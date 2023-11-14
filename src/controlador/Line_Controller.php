<?php


use Octobyte\viauy\modelo\Line;
use Octobyte\viauy\modelo\Bus;
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
      $departureDate = $_POST['departureDate'];
      $linePrice = $_POST['price'];

      $line = new Line("", $origin, $destination, $departureTime, $arrivalTime, $idBus, $ownerLine, $lineName, $departureDate, $linePrice);

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
      'lines' => [], // Inicializa la matriz de resultados de líneas
      'buses' => []  // Inicializa la matriz de resultados de buses
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $origin = $_POST['origin'];
      $destination = $_POST['destination'];
      $departureDate = $_POST['departureDate'];

      // Realiza la búsqueda de líneas en el modelo
      $line = new Line("", "", "", "", "", "", "", "", "", "");
      $data = $line->searchLinesByData($origin, $destination, $departureDate);

      if (empty($data['lines'])) {
        $data['msg'] = 'No se encontraron resultados para la búsqueda.';
        $data['status'] = 'error';
      } else {
        $data['msg'] = 'Se han encontrado buses';
        $data['status'] = 'info';
      }
    }

    echo json_encode($data);
  }



  public function deleteLine()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $idLine = $_GET['id'];
      $lineModel = new Line("", "", "", "", "", "", "", "", "", ""); // Reemplaza 'Line' con el nombre de tu clase de modelo

      if ($lineModel->dropLine($idLine)) {
        $line = new Line("", "", "", "", "", "", "", "", "", "");
        $lines = $line->getOwnLines();
        $data['lines'] = $lines;

        $data['msg'] = 'Línea Eliminada Con Éxito';
        $this->cargarVista("company/profile/lineas/main", $data);
      } else {
        $line = new Line("", "", "", "", "", "", "", "", "", "");
        $lines = $line->getOwnLines();
        $data['lines'] = $lines;

        $data['msg'] = 'Error al eliminar la línea';
        $this->cargarVista("company/profile/lineas/main", $data);
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
      $line = new Line("", "", "", "", "", "", "", "", "", "");
      $data['lines'] = $line->searchLines($searchTerm);

      if (empty($data['lines'])) {
        $data['msg'] = 'No se encontraron resultados para la búsqueda.';
        $data['status'] = 'info';
      }
    }

    echo json_encode($data);
  }

  public function getLineData()
  {
    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lineid'])) {
      $idLine = $_GET['lineid'];
      $lineModel = new Line("", "", "", "", "", "", "", "", "", "");

      $lineData = $lineModel->getLineDataById($idLine);

      $data = [
        'line' => $lineData["line"],
        'bus' => $lineData['bus']
      ];

      if ($lineData) {
        $data['lineTime'] = $lineModel->calcularDiferenciaHoras($lineData["line"]);
        $data['status'] = 'success';
        $data['msg'] = 'Todo Salio Bien.';
        echo json_encode($data);
      } else {
        $data['status'] = 'error';
        $data['msg'] = 'Linea No Encontrado';
        echo json_encode($data);
      }
    } else {
      $data['status'] = 'error';
      $data['msg'] = 'solicitud Incorrecta';
      echo json_encode($data);
    }
  }
  public function getOwnLineData()
  {
    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lineid'])) {
      $idLine = $_GET['lineid'];
      $lineModel = new Line("", "", "", "", "", "", "", "", "", "");

      $lineData = $lineModel->getOwnLineDataById($idLine);

      $data["line"] = $lineData["line"];

      if (isset($lineData['line'])) {
        $data['line'] = $lineData['line'];
        $data['status'] = 'success';
        $data['msg'] = 'Todo salió bien.';
      } else {
        $data['status'] = 'error';
        $data['msg'] = 'Línea no encontrada o no pertenece a la compañía actual';
      }

      echo json_encode($data);
    } else {
      $data['status'] = 'error';
      $data['msg'] = 'Solicitud incorrecta';
      echo json_encode($data);
    }
  }

  public function editLine()
  {
    $data = [
      'msg' => '',
      'status' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtén los valores de los campos del formulario
      $idLine = $_POST['idLine'];
      $lineName = $_POST['lineName'];
      $origin = $_POST['origin'];
      $destination = $_POST['destination'];
      $departureDate = $_POST['departureDate'];
      $departureTime = $_POST['departureTime'];
      $arrivalTime = $_POST['arrivalTime'];
      $idBus = $_POST['idBus'];
      $price = $_POST['price']; // Cambiado a 'price' en lugar de 'linePrice'

      // Validaciones en el lado del servidor
      if (empty($idLine) || empty($lineName) || empty($origin) || empty($destination) || empty($departureDate) || empty($departureTime) || empty($arrivalTime) || empty($idBus) || empty($price)) {
        $data['status'] = 'error';
        $data['msg'] = 'Datos de entrada no válidos.';
      } else {
        // Obtén la línea existente para verificar el propietario
        $lineModel = new Line("", "", "", "", "", "", "", "", "", "");
        $existingLineData = $lineModel->getOwnLineDataById($idLine);
        $existingOwnerLine = $existingLineData['line']['ownerLine'];

        // Verifica si el propietario actual coincide con el propietario existente
        if ($_SESSION['company_name'] === $existingOwnerLine) {
          // Continuar con la edición solo si el propietario coincide
          $line = new Line($idLine, $origin, $destination, $departureTime, $arrivalTime, $idBus, $_SESSION['company_name'], $lineName, $departureDate, $price);

          if ($line->isBusValid($idBus) && $line->editLine()) {
            $data['msg'] = 'Línea editada con éxito';
            $data['status'] = 'success';
          } else {
            $data['status'] = 'error';
            $data['msg'] = 'Error al editar la línea o Bus no válido';
          }
        } else {
          // Si el propietario no coincide, muestra un mensaje de error
          $data['status'] = 'error';
          $data['msg'] = 'No tiene permisos para editar esta línea.';
        }
      }

      echo json_encode($data);
    }
  }
}