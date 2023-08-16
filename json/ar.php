<?php

use stdClass;
use JsonSerializable;
use Octobyte\viauy\libs\Conexion;

require_once 'entidades/articulo.php';

class Articulos_Model implements JsonSerializable
{
    private $id;
    private $codigo;

    public function __construct($id = 1, $codigo = '')
    {
        $this->id     = $id;
        $this->codigo = $codigo;
    }

    public function get()
    {
        //define un arreglo en php
        //$items = array();
        $items = [];
        $pdo       = Conexion::getConexion()->getPdo();
        try {
            $urlDefecto = "";
            $query      = $pdo->query('SELECT id_productos, codigo,descripcion,precio,fecha FROM productos');
            while ($row = $query->fetch()) {
                $item              = new stdClass();
                $item->id          = $row['id_productos'];
                $item->codigo      = $row['codigo'];
                $item->descripcion = $row['descripcion'];
                $item->precio      = $row['precio'];
                $item->fecha       = $row['fecha'];
                //$item->url = isset($row['url']) ? $row['url'] : $urlDefecto;
                if (isset($row['url'])) {
                    $item->url = $row['url'];
                } else {
                    $item->url = $urlDefecto;
                }
                //$item->url = isset($row['url']) ? $row['url'] : $urlDefecto;
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function verArticulo($id)
    {
        $articulo = null;
        $pdo       = Conexion::getConexion()->getPdo();
        try {
            $query = $pdo->prepare('SELECT id_productos, codigo,descripcion,precio,fecha FROM productos WHERE id_productos=:id');
            $query->bindValue(':id', $id);
            //$query->execute(['nombre' => $nombre]);
            $query->execute();
            while ($row = $query->fetch()) {
                $articulo              = new stdClass();
                $articulo->id          = $row['id_productos'];
                $articulo->codigo      = $row['codigo'];
                $articulo->descripcion = $row['descripcion'];
                $articulo->precio      = $row['precio'];
                $articulo->fecha       = $row['fecha'];
            }
        } catch (PDOException $e) {
            var_dump($e);
        }
        return $articulo;
    } //end ver

    public function actualizar($articulo)
    {

        $resultado = false;
        $pdo       = Conexion::getConexion()->getPdo();
        try {
            $query = $pdo->prepare('UPDATE productos SET codigo=:codigo, descripcion=:descripcion, precio= :precio, fecha= :fecha WHERE id_productos= :id');
            $query->bindParam(':codigo', $articulo->codigo);
            $query->bindParam(':descripcion', $articulo->descripcion);
            $query->bindParam(':precio', $articulo->precio);
            $query->bindParam(':fecha', $articulo->fecha);
            $query->bindParam(':id', $articulo->id);
            //:descripcion, :precio, :fecha
            //$resultado = $query->execute();
            $resultado = $query->execute();
            $filasAf   = $query->rowCount();
            /*if ($filasAf == 0) {
            $resultado = false;
            }*/
            //$str = "valor";
            //$resultado = $query->fetch(); // return (PDOStatement) or false on failure
            //$query->close();
            return $resultado;
        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    } //end actualizar

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
        ];
    }
}
