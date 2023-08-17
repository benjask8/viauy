<?php

use Octobyte\viauy\modelo\User;
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
    // Implementar la lógica de inicio de sesión
  }

  public function doSignup()
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC']; // Asegúrate de usar el nombre correcto de la entrada del formulario
    $user = new User($username, $email, $password, $passwordC); // No necesitas pasar $passwordC al constructor
    $msg = $user->saveUser();
    $this->cargarVista("user/signup", $msg);
  }
}