<?php


use Octobyte\viauy\modelo\Petition;
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
  
  public function newPetition()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $companyName = $_POST['company-name'];
          $contactName = $_POST['contact-name'];
          $contactEmail = $_POST['contact-email'];
          $contactPhone = $_POST['contact-phone'];
          $message = $_POST['message'];

          $petition = new Petition($companyName, $contactName, $contactEmail, $contactPhone, $message);

          if ($petition->savePetition()) {
              // Success: Petition saved
              $this->cargarVista("company/petition_success");
          } else {
              // Error: Petition not saved
              $this->cargarVista("company/petition_error");
          }
      } else {
          // Display petition form
          $this->cargarVista("company/petition");
      }
  }



}
