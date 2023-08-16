<?php

namespace Octobyte\viauy\modelo;

use PDOException;
use Octobyte\viauy\libs\Conexion;

class Producto
{
  private $id;
  private $codigo;
  private $descripcion;
  private $precio;
  private $fecha;

  public function __construct($id, $codigo, $descripcion, $precio, $fecha)
  {
    $this->id = $id;
    $this->codigo = $codigo;
    $this->descripcion = $descripcion;
    $this->precio = $precio;
    $this->fecha = $fecha;
  }

  private static function arrayAProducto($item)
  {
    $producto             = new Producto(
      $item['id'],
      $item['codigo'],
      $item['descripcion'],
      $item['precio'],
      $item['fecha']
    );
    return $producto;
  }

  public static function listar()
  {
    $pdo = null;
    $query = null;
    $items = [];
    $pdo = Conexion::getConexion()->getPdo();
    try {
      $query      = $pdo->query('SELECT id, codigo,descripcion,precio,fecha FROM productos');
      while ($row = $query->fetch()) {
        $item = self::arrayAProducto($row);
        $items[] =   $item;
        //$item->url = isset($row['url']) ? $row['url'] : $urlDefecto;
      }
      return $items;
    } catch (PDOException $th) {
      //throw $th;
    } finally {
      $pdo = null;
    }
  }

  public function crear()
  {
    $pdo = null;
    $query = null;
    $pdo = Conexion::getConexion()->getPdo();
    $id = -1;
    try {
      $query      = $pdo->prepare('INSERT INTO productos 
      (codigo,
      descripcion,
      precio,
      fecha)
VALUES(:codigo,:descripcion,:precio,:fecha
)');
      $query->bindParam(':codigo', $this->codigo);
      $query->bindParam(':descripcion', $this->descripcion);
      $query->bindParam(':precio', $this->precio);
      $query->bindParam(':fecha', $this->fecha);
      if ($query->execute()) {
        $id = $pdo->lastInsertId();
      }
      return $id;
    } catch (PDOException $th) {
      //throw $th;
    } finally {
      $pdo = null;
    }
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the value of codigo
   */
  public function getCodigo()
  {
    return $this->codigo;
  }

  /**
   * Get the value of descripcion
   */
  public function getDescripcion()
  {
    return $this->descripcion;
  }

  /**
   * Get the value of precio
   */
  public function getPrecio()
  {
    return $this->precio;
  }

  /**
   * Get the value of fecha
   */
  public function getFecha()
  {
    return $this->fecha;
  }
}
