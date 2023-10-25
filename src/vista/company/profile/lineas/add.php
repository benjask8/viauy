<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1>Lineas</h1>

<h2>Agregar Nueva Línea</h2>
<form action="?c=company&m=procesar_linea" method="POST">
  <label for="nombre">Nombre de la Línea:</label>
  <input type="text" name="nombre" id="nombre" required>

  <label for="descripcion">Descripción:</label>
  <textarea name="descripcion" id="descripcion" rows="4" required></textarea>

  <button type="submit">Agregar Línea</button>
</form>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>