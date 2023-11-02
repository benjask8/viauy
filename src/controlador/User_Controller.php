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
  public function welcome()
  {
    $this->cargarVista("user/welcome");
  }


  //do
  public function logout()
  {
    session_destroy();
    header("Location: index.php?c=user&m=login&msg=Cerraste%20sesion%20exitosamente");
    exit();
  }


  public function doLogin()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, '', $password, '');
    $loginResult = $user->loginUser();
    $data = [
      'message' => $loginResult
    ];

    if ($loginResult === 'success') {
      // Inicio de sesión exitoso, redirigir a una página de bienvenida
      echo json_encode($data);
    } else {
      echo json_encode($data);
    }
  }

  public function doSignup()
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC']; // Asegúrate de usar el nombre correcto de la entrada del formulario
    $user = new User($username, $email, $password, $passwordC); // No necesitas pasar $passwordC al constructor
    $msg = $user->saveUser();
    $data = [
      'message' => $msg,
      'status' => ""
    ];
    echo json_encode($data);
  }

  public function mainProfile()
  {
    $this->cargarVista("user/mainProfile");
  }

  public function profile()
  {
    $getusername = $_GET['user'] ?? "index";
    $user = new User("", "", "", "");
    $newUser = $user->getUser($getusername);

    $this->cargarVista("user/profile", ["user" => $newUser]);
  }
}
