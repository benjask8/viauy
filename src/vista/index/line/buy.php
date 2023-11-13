<?php

if (!isset($_SESSION['user_name'])) {
  header('Location: /viauy/?c=user&m=login');
  exit();
}
require 'src/vista/partials/head.php';
?>
<a href="/viauy" class="view-volver-btn"><span class="material-symbols-outlined">keyboard_arrow_left</span>Volver</a>
<h1 id="data-msg"></h1>

<section class="line-data-box" id="line-data-box">
  <section class="line-data-box-form-box">
    <p class="line-data-box-form-box-title">Informacion del Pasaje</p>
    <form class="line-data-box-form" id="passage-form">
      <p class="line-data-box-form-time"><i class="fa-solid fa-clock"></i> 0h 0m</p>
      <p class="line-data-box-form-departuredate"><i class="fa-regular fa-calendar"></i> mar, 14 nov</p>
      <p class="line-data-box-form-arrivaltime"><i class="fa-solid fa-arrow-right"></i> 12:00</p>
      <i class="line-data-box-form-route"></i>
      <p class="line-data-box-form-departuretime"><i class="fa-solid fa-arrow-left"></i> 15:30</p>
      <p class="line-data-box-form-price"><i class="fa-solid fa-arrow-left"></i>00,00 UYU$</p>
    </form>
  </section>
</section>

<form action="" class="" id="buy-form">
  <input type="submit" value="Continuar">
</form>
<script src="fetch/index/line/buy.js"></script>

<?php
require 'src/vista/partials/footer.php';
?>