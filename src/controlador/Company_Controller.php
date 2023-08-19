<?php



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

}
