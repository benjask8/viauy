<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\libs\Controlador;


class Admin_Controller extends Controlador
{
  public function dashboard()
  {
    $this->cargarVista("admin/dashboard");
  }

}
