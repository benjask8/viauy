<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Lineas</h1>
<h2 class="sub-title">Agregar Nueva Línea</h2>
<section class="login-container">
  <form action="?c=company&m=procesar_linea" class="login-form" method="POST" autocomplete="off">
    <a href="?c=company&m=mainProfile_lineas" class="login-form-exit">
      <span class="material-symbols-outlined">
        close
      </span>
    </a>
    <h2 class="login-form-title">Agregar Línea</h2>
    <p id="data-msg"></p>
    <label for="origin" class="label">Nombre:</label>
    <input type="text" name="lineName" class="login-input" id="lineName" required
      placeholder="Introduce el origen de la Línea">

    <label for="origin" class="label">Origen:</label>
    <input type="text" name="origin" class="login-input" id="origin" required
      placeholder="Introduce el origen de la Línea">

    <label for="destination" class="label">Destino:</label>
    <input type="text" name="destination" class="login-input" id="destination" required
      placeholder="Introduce el destino de la Línea">

    <label for="departureTime" class="label">Hora de Salida:</label>
    <input type="time" name="departureTime" class="login-input" id="departureTime" required
      placeholder="Introduce la hora de salida de la Línea">

    <label for="arrivalTime" class="label">Hora de Llegada:</label>
    <input type="time" name="arrivalTime" class="login-input" id="arrivalTime" required
      placeholder="Introduce la hora de llegada de la Línea">

    <label for="idBus" class="label">ID del Autobús:</label>
    <input type="text" name="idBus" class="login-input" id="idBus" required placeholder="Introduce el ID del Autobús">

    <button class="login-input" type="submit">Agregar Línea</button>
  </form>
</section>


<script src="fetch/company/profile/lineas/add.js"></script>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>