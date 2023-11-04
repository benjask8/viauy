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
      <th>Modelo</th>
      <th>Matrícula</th>
      <th>Capacidad Máxima</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos['buses'] as $bus) : ?>
    <tr>
      <td><?= $bus['model'] ?></td>
      <td><?= $bus['idBus'] ?></td>
      <td><?= $bus['maxCapacity'] ?></td>
      <td>
        <a href="?c=bus&m=deleteBus&id=<?= $bus['idBus'] ?>" class="delete-button"
          onclick="return confirm('¿Estás seguro de eliminar el bus de matricula <?= $bus['idBus'] ?>?')">
          <span class="material-symbols-outlined">delete</span>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>

  </tbody>
</table>
<p class="sub-title" id="data-msg"></p>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>

<script src="fetch/company/profile/buses/search.js"></script>