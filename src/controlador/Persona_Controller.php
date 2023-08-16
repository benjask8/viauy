<?php

use Octobyte\viauy\libs\Controlador;
use Octobyte\viauy\modelo\Persona;

class Persona_Controller extends Controlador
{

  public function listar()
  {
    $modelo = new Persona();
    $lista = $modelo->listar();
    $this->cargarVista("persona/listar", $lista);
  }
}
