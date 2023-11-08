<?php
if (!isset($_SESSION['user_name'])) {
  header('Location: /viauy');
  exit();
}

require 'src/vista/partials/head.php';
?>

<section class="welcome-section">
  <h1 class="welcome-title">¡Bienvenido, <?= $_SESSION['user_name'] ?>!</h1>
  <p class="welcome-message">Esperamos que disfrutes de tu experiencia en ViaUY. Explora nuestras características y
    servicios para sacar el máximo provecho de tu cuenta.</p>
</section>

<?php
require 'src/vista/partials/footer.php';
?>