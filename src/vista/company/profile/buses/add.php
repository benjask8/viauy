<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1>Buses</h1>
<h2>Agregar Nuevo Bus</h2>

<form action="procesar_formulario.php" method="POST">
  <label for="modelo">Modelo del Bus:</label>
  <input type="text" name="modelo" id="modelo" required>

  <label for="marca">Marca del Bus:</label>
  <input type="text" name="marca" id="marca" required>

  <label for="capacidad">Capacidad del Bus:</label>
  <input type="number" name="capacidad" id="capacidad" required>

  <label for="capacidad">Matricula del Bus:</label>
  <input type="text" name="matricula" id="matricula" required>

  <button type="submit">Agregar Bus</button>
</form>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>