<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\modelo\Company;
use Octobyte\viauy\modelo\Bus;
use Octobyte\viauy\libs\Controlador;


class Company_Controller extends Controlador
{
  public function petition()
  {
    $this->cargarVista("company/petition");
  }
  public function index()
  {
    $company = new Company("", "", "", "");
    $companys = $company->getAllCompany();
    $data = [
      'companys' => $companys
    ];
    $this->cargarVista("company/index", $data);
  }
  public function newPetition()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $companyName = $_POST['company-name'];
      $contactName = $_POST['contact-name'];
      $contactEmail = $_POST['contact-email'];
      $contactPhone = $_POST['contact-phone'];
      $message = $_POST['message'];

      $petition = new Petition($companyName, $contactName, $contactEmail, $contactPhone, $message);

      if ($petition->petitionExists($contactEmail)) {
        $data = [
          'message' => 'Petición ya existe', // Cambia el mensaje según tus necesidades
          'status' => 'error'
        ];
      } else {
        $token = $petition->savePetition();
        $data = [
          'message' => "Token: <b>" . $token . "</b>", // Cambia el mensaje según tus necesidades
          'status' => 'success'
        ];
      }

      echo json_encode($data);
    }
  }


  public function petitionExists()
  {
    $this->cargarVista("company/petition_exists");
  }

  public function login()
  {
    $this->cargarVista("company/login");
  }
  public function signup()
  {
    $this->cargarVista("company/signup");
  }
  public function logout()
  {
    session_destroy();
    header("Location: index.php?c=company&m=login&msg=Cerraste%20sesion%20exitosamente");
    exit();
  }


  public function welcome()
  {
    $this->cargarVista("company/welcome");
  }

  public function mainProfile()
  {
    $this->cargarVista("company/profile/main");
  }
  public function mainProfile_Admins()
  {
    $this->cargarVista("company/profile/admins");
  }


  //buses
  public function mainProfile_Buses()
  {

    $bus = new Bus("", "", "", "", "", "", "", "");
    $buses = $bus->getOwnBuses();
    $data = [
      'buses' => $buses
    ];
    $this->cargarVista("company/profile/buses/main", $data);
  }

  public function mainProfile_BusesAdd()
  {
    $this->cargarVista("company/profile/buses/add");
  }

  public function mainProfile_BusesEdit()
  {
    $id = $_GET['id'] ?? "";
    $this->cargarVista("company/profile/buses/edit");
  }



  //lineas
  public function profile()
  {
    $this->cargarVista("company/profile");
  }
  public function mainProfile_Lineas()
  {
    $this->cargarVista("company/profile/lineas/main");
  }
  public function mainProfile_LineasAdd()
  {
    $this->cargarVista("company/profile/lineas/add");
  }


  public function doLogin()
  {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $company = new Company($name, '', $password, '');
    $loginResult = $company->loginCompany();

    if ($loginResult === 'success') {
      // Inicio de sesión exitoso, redirigir a una página de bienvenida
      header("Location: index.php?c=company&m=mainProfile");
      exit;
    } else {
      $this->cargarVista("company/login", $loginResult);
    }
  }

  public function doSignup()
  {
    $name = $_POST['name'];
    $token = $_POST['token'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC'];

    $petition = new Petition("", "", "", "", "");
    $isConfirmed = $petition->confirmToken($token, $email);

    if ($isConfirmed) {
      $company = new Company($name, $email, $password, $passwordC);
      $data = $company->saveCompany();
      if ($data["status"] == true) {
        $msg = $data["msg"];
        $petition->dropPetition($token);
      } else {
        $msg = $data["msg"];
        $this->cargarVista("company/signup", $msg);
      }
    } else {
      $msg = 'Token NO existe o no aprovado';
    }

    $this->cargarVista("company/signup", $msg);
  }

  public function getCompanyData()
  {
    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
      $name = $_GET['name'];
      $company = new Company("", "", "", "", "", "", "", ""); // Reemplaza 'Bus_Model' con el nombre de tu modelo

      $companyData = $company->getCompanyDataByName($name);

      $data = [
        'company' => $companyData
      ];

      if ($companyData) {
        $data['status'] = 'success';
        $data['msg'] = 'Todo Salio Bien.';
        echo json_encode($data);
      } else {
        $data['status'] = 'error';
        $data['msg'] = 'Compania No Encontrado';
        echo json_encode($data);
      }
    } else {
      $data['status'] = 'error';
      $data['msg'] = 'solicitud Incorrecta';
      echo json_encode($data);
    }
  }
}