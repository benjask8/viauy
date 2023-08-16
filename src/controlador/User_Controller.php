<?php



use Octobyte\viauy\libs\Controlador;


class User_Controller extends Controlador
{
  // renderizar
  public function login()
  {
    $this->cargarVista("user/login");
  }
  public function signup()
  {
    $this->cargarVista("user/signup");
  }


  //do
  public function doLogin()
  {
  }

  public function doSignup()
  {
    try {
      $a = 6;
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $passwordV = $_POST['verify-password'];
      //
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}