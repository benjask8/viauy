<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Buses</h1>
<?php if (!empty($this->datos["msg"])) : ?>
<p class="sub-title"><?= $this->datos["msg"]; ?></p>
<?php endif; ?>

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
        <a href="?c=bus&m=deleteBus&id=<?= $bus['idBus'] ?>" class="delete-button">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<a href="?c=company&m=mainProfile_busesAdd">Agregar bus</a>
<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>