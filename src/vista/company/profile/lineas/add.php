<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Lineas</h1>
<h2 class="sub-title">Agregar Nueva Línea</h2>
<section class="login-container">
  <form action="?c=company&m=procesar_linea" class="login-form" method="POST" autocomplete="off">
    <a href="?c=company&m=mainProfile_buses" class="login-form-exit">
      <span class="material-symbols-outlined">
        close
      </span>
    </a>
    <h2 class="login-form-title">Agregar Línea</h2>
    <p id="data-msg"></p>

    <label for="nombre" class="label">Nombre de la Línea:</label>
    <input type="text" name="nombre" class="login-input" id="nombre" required placeholder="Introduce el nombre de la Línea">

    <label for="descripcion" class="label">Descripción:</label>
    <input name="descripcion" class="login-input" id="descripcion" rows="4" required placeholder="Introduce la descripción de la Línea"></input>

    <button class="login-input" type="submit">Agregar Línea</button>
  </form>
</section>


<script src="fetch/company/profile/lines/add.js"></script>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>