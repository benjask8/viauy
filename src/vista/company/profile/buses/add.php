<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Buses</h1>
<h2 class="sub-title">Agregar Nuevo Bus</h2>
<section class="login-container">
  <form action="index.php?c=bus&m=newBus" class="login-form" method="POST" autocomplete="off">
    <a href="/viauy" class="login-form-exit">
      <span class="material-symbols-outlined">
        close
      </span>
    </a>
    <h2 class="login-form-title">Agregar Bus</h2>
    <?php if (!empty($this->datos["msg"])) : ?>
      <p class="msg_<?= $this->datos["status"]; ?>"><?= $this->datos["msg"]; ?></p>
    <?php endif; ?>

    <label for="modelo">Modelo del Bus:</label>
    <input type="text" name="model" class="login-input" id="modelo" required placeholder="Introduce el modelo del Bus">

    <label for="capacidad">Capacidad del Bus (solo números):</label>
    <input type="number" name="maxCapacity" class="login-input" id="capacidad" required placeholder="Introduce la capacidad del Bus" inputmode="numeric" pattern="[0-9]*" title="Ingrese solo números">


    <label for="matricula">Matrícula del Bus:</label>
    <input type="text" name="busId" class="login-input" id="matricula" required placeholder="Introduce la matrícula del Bus">

    <input class="login-input" type="submit" value="Agregar Bus">
  </form>
</section>

<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>