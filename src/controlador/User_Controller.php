<?php



use Octobyte\viauy\libs\Controlador;


class User_Controller extends Controlador
{
    public function login()
    {
      $this->cargarVista("user/login");
    }
    public function signup()
    {
      $this->cargarVista("user/signup");
    }

}
