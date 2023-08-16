<?php

namespace Octobyte\viauy\modelo;

class Persona
{
  private $nombre;
  private $apellido;
  private $edad;

  public function __construct($nombre = "", $apellido = "", $edad = "")
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->edad = $edad;
  }

  public function listar()
  {
    $lista[] = new Persona("Diego", "Forlan", 45);
    $lista[] = new Persona("Ana", "Clara", 22);
    $lista[] = new Persona("Lucas", "Paqueta", 78);
    return $lista;
  }

  /**
   * Get the value of nombre
   */
  public function getNombre()
  {
    return $this->nombre;
  }

  /**
   * Get the value of apellido
   */
  public function getApellido()
  {
    return $this->apellido;
  }

  /**
   * Get the value of edad
   */
  public function getEdad()
  {
    return $this->edad;
  }
}
