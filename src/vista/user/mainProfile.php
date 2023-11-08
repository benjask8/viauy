<?php
if (!isset($_SESSION['user_name'])) {
  header('Location: /viauy');
  exit();
}
require 'src/vista/partials/head.php';
?>

<section class="user-profile">
  <h1 class="profile-title">Perfil de Usuario</h1>
  <div class="profile-card">
    <h2 class="profile-username"><?= $_SESSION['user_name'] ?></h2>
    <p class="profile-info">Bienvenido a tu perfil de usuario. Aquí puedes ver y editar tu información personal.</p>
    <div class="profile-options">
      <a href="index.php?c=user&m/viewFeatures" class="profile-option">Ver Características</a>
      <a href="index.php?c=user&m/editProfile" class="profile-option">Editar Información Personal</a>
      <a href="index.php?c=user&m/logout" class="profile-option">Cerrar Sesión</a>
    </div>
  </div>
</section>

<?php
require 'src/vista/partials/footer.php';
?>