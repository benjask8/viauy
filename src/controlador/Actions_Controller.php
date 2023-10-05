<?php


use Octobyte\viauy\modelo\Petition;
use Octobyte\viauy\modelo\User;
use Octobyte\viauy\libs\Controlador;


class Actions_Controller extends Controlador
{

  public function buscar(){
    $data = [
      "error" => "No Hay termino de Busqueda"
    ];

    if(isset($_POST['searchTerm'])){
      $searchTerm = $_POST['searchTerm'];
      $data = [
        "searchTerm" => $searchTerm
      ];
    }


    $this->cargarVista("index/search", $data);
  }
}
