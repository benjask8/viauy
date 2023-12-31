<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Buses</h1>

<section class="bus-options">
  <a class="add-bus-btn" href="?c=company&m=mainProfile_busesAdd"><span
      class="material-symbols-outlined">add</span>Agregar bus
  </a>
  <form action="" class="buses-search">
    <input class="buses-search-input" type="search" placeholder="Buscar Bus...">
    <input type="submit" value="Buscar">
  </form>

</section>

<table class="bus-table">
  <thead>
    <tr>
      <th>Modelo</th>
      <th>Matrícula</th>
      <th>Capacidad Máxima</th>
      <th>wifi</th>
      <th>aire</th>
      <th>baño</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody id="results-container">
  </tbody>
</table>

<p class="sub-title" id="data-msg"></p>


<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>

<script src="fetch/company/profile/buses/search.js"></script>