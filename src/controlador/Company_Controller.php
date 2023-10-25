<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\modelo\Company;
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
        header("Location: index.php?c=company&m=petitionExists");
        return;
      }
      $token = $petition->savePetition();
      if ($token) {
        // Success: Petition saved
        $this->cargarVista("company/petition_success", $token);
      } else {
        // Error: Petition not saved
        $this->cargarVista("company/petition_error");
      }
    } else {
      // Display petition form
      $this->cargarVista("company/petition");
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
    $this->cargarVista("company/profile/buses/main");
  }

  public function mainProfile_BusesAdd()
  {
    $this->cargarVista("company/profile/buses/add");
  }



  //lineas
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
      header("Location: index.php?c=company&m=welcome&msg=bienvenido");
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
      $msg = $company->saveCompany();

      if ($msg == true) {
        $msg = "Registrado con exito";
        $petition->dropPetition($token);
      }
    } else {
      $msg = 'Token NO existe o no aprovado';
    }

    $this->cargarVista("company/signup", $msg);
  }
}
