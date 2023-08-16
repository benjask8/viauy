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
    }

}
