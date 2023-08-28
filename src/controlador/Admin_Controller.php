<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\modelo\User;
use Octobyte\viauy\libs\Controlador;


class Admin_Controller extends Controlador
{
  public function dashboard()
  {
    $this->cargarVista("admin/dashboard");
  }

  public function dashboardCompanyRequests()
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

  public function dashboardOptionRequest()
  {
      $action = $_POST['action'];
      $id = $_POST['id']; 
      $status = ($action === 'accept') ? 'Approved' : 'Rejected';
  
      // Actualizar el estado en la base de datos
      $petition = new Petition("","","","","");
      $msg = $petition->updateStatus($id, $status);
  
      if ($msg) {
        if($action === "accept"){
          header("Location: index.php?c=admin&m=dashboardCompanyRequests&msg=Solicitud%20aceptada%20exitosamente");
          exit();
        }
        header("Location: index.php?c=admin&m=dashboardCompanyRequests&msg=Solicitud%20denegada%20exitosamente");
        exit();
      } else {
        header("Location: index.php?c=admin&m=dashboardCompanyRequests&msg=Solicitud%20no%20enviada");
        exit();
      }
  }


  public function filterRequests(){
    $filter = $_POST['filter'];
    $petition = new Petition("","","","","");
    $companyRequests = $petition->filterByStatus($filter);

    if ($companyRequests !== false) {
      $data = [
          'companyRequests' => $companyRequests,
          'actualFilter' => $filter
      ];
      $this->cargarVista("admin/company/requests", $data);
  } else {
      // Manejar el caso de error
      echo "Error al obtener las solicitudes de compañías.";
  }
  }

  public function userShow()
  {
    $userModel = new User("","","","","");
      $users = $userModel->getAllUsers();
      if ($users !== false) {
          $data = [
              'users' => $users
          ];
          $this->cargarVista("admin/user/show", $data);
      } else {
          // Manejar el caso de error
          echo "Error al obtener los usuarios.";
      }
  }
  
  public function userChangeAdmin()
  {
      $action = $_POST['action'];
      $username = $_POST['username']; 
      $esAdmin = ($action === '1') ? "1" : "0";

      // Actualizar el estado en la base de datos
      $user = new User("","","","","");
      $msg = $user->updateAdmin($username, $esAdmin);
  
      if ($msg === "1") {
        header("Location: index.php?c=admin&m=usershow&msg=Usaurio%20ahora%20es%20administrador");
        exit();
      } else {
        header("Location: index.php?c=admin&m=usershow&msg=Usaurio%20ahora%20no%20es%20administrador");
        exit();
      }
  }

}
