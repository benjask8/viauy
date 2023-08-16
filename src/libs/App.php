<?php

namespace Octobyte\viauy\libs;


class App
{
  public static function iniciar()
  {
    $c              = $_GET['c'] ?? "index";
    $m              = $_GET['m'] ?? "index";
    $con            = ucfirst($c) . "_Controller";
    $controllerPath = 'src/controlador/' . $con . ".php";
    require_once $controllerPath;
    $controller = new $con();
    $controller->{$m}();
  }
}
