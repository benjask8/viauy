<?php

use Octobyte\viauy\libs\Controlador;


class Index_Controller extends Controlador
{
  public function index()
  {
    $this->cargarVista("index/index");
  }
  public function help()
  {
    $this->cargarVista("index/help");
  }
  public function blog()
  {
    $this->cargarVista("index/blog");
  }
  public function testimony()
  {
    $this->cargarVista("index/testimony");
  }

  public function viewLine()
  {
    $this->cargarVista("index/line/view");
  }

  public function buyPassage()
  {
    $this->cargarVista("index/line/buy");
  }

  public function about()
  {
    $this->cargarVista("index/about");
  }
  public function team()
  {
    $this->cargarVista("index/team");
  }
}