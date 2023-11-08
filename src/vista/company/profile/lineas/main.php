<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Lineas</h1>

<section class="bus-options">
  <a class="add-bus-btn" href="?c=company&m=mainProfile_lineasAdd"><span
      class="material-symbols-outlined">add</span>Agregar Linea
  </a>
  <form action="" class="buses-search">
    <input class="buses-search-input" type="search" placeholder="Buscar Linea...">
    <input type="submit" value="Buscar">
  </form>
</section>


<table class="bus-table">
  <thead>
    <tr>
      <th>Origen</th>
      <th>Destino</th>
      <th>Ida</th>
      <th>Vuelta</th>
      <th>Bus</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>


  </tbody>
</table>
<p class="sub-title" id="data-msg"></p>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>

<script src="fetch/company/profile/lineas/search.js"></script>