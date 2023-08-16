<?php



use Octobyte\viauy\libs\Controlador;


class Company_Controller extends Controlador
{
    public function petition()
    {
      $this->cargarVista("company/petition");
    }

}
