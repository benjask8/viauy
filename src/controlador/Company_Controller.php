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
    $this->cargarVista("company/index");
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
  
  public function petitionExists(){
    $this->cargarVista("company/petition_exists");
  }

  public function login(){
    $this->cargarVista("company/login");
  }
  public function signup(){
    $this->cargarVista("company/signup");
  }


  public function doLogin(){
    $this->cargarVista("company/login");
  }


  public function doSignup(){
    $name = $_POST['name'];
    $token = $_POST['token'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC'];

    $petition = new Petition("", "","","","");
    $isConfirmed = $petition->confirmToken($token, $email);

    if($isConfirmed){
      $company = new Company($name, $email, $password, $passwordC); 
      $msg = $company->saveCompany();

      if ($msg == true){
        $msg = "Registrado con exito";
        $petition->dropPetition($token);
      }
    }
    else{
      $msg = "Token No Existe O no Aprovado";
    }

    $this->cargarVista("company/signup", $msg);
  }



}
