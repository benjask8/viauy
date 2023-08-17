<?php

namespace Octobyte\viauy\libs;

class Controlador
{
  public $datos;
  public function __construct()
  {
  }

  function cargarVista($vistaRuta, $datos = null)
  {
    $this->datos = $datos;
    $ruta = "src/vista/{$vistaRuta}.php";
    require_once $ruta;
  }
}