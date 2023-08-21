<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\libs\Controlador;


class Admin_Controller extends Controlador
{
  public function dashboard()
  {
    $this->cargarVista("admin/dashboard");
  }

  public function dashboard_companyrequests()
  {
      $petitionModel = new Petition("","","","","");
      $companyRequests = $petitionModel->getAllCompanyRequests();
      if ($companyRequests !== false) {
          $data = [
              'companyRequests' => $companyRequests
          ];
          $this->cargarVista("admin/company/requests", $data);
      } else {
          // Manejar el caso de error
          echo "Error al obtener las solicitudes de compañías.";
      }
  }

  public function dashboard_optionRequest()
  {
      $action = $_POST['action'];
      $id = $_POST['id']; 
      $status = ($action === 'accept') ? 'Approved' : 'Rejected';
  
      // Actualizar el estado en la base de datos
      $petition = new Petition("","","","","");
      $msg = $petition->updateStatus($id, $status);
  
      if ($msg) {
        if($action === "accept"){
          header("Location: index.php?c=admin&m=dashboard_companyrequests&msg=Solicitud%20aceptada%20exitosamente");
          exit();
        }
        header("Location: index.php?c=admin&m=dashboard_companyrequests&msg=Solicitud%20denegada%20exitosamente");
        exit();
      } else {
        header("Location: index.php?c=admin&m=dashboard_companyrequests&msg=Solicitud%20no%20enviada");
        exit();
      }
  }
  

}
