<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>agregar producto</h1>
  <?php
  require 'src/vista/menu.php'; ?>
  <form action="index.php?c=producto&m=crear" method="post">
    <label for="codigo">Codigo</label>
    <input type="text" name="codigo" id="codigo" value="codigo07">
    <br>
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion" value="descripcion">
    <br>
    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio" value="25.50">
    <br>
    <label for="fecha"></label>
    <input type="date" name="fecha" id="fecha" value="2022-02-26">
    <input type="submit" value="Enviar">
  </form>

</body>

</html>