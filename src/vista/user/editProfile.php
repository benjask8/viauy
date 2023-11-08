<?php
if (!isset($_SESSION['user_name'])) {
  header('Location: /viauy');
  exit();
}
require 'src/vista/partials/head.php';
?>

<div class="edit-profile">
  <h1 class="edit-profile-title">Editar Perfil</h1>

  <div class="edit-profile-form">
    <form action="index.php?c=user&m=updateProfile" method="post">
      <div class="form-group">
        <label for="username">Nombre de Usuario</label>
        <input type="text" id="username" name="username" value="<?= $_SESSION['user_name'] ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['user_email'] ?>" required>
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Nueva contraseña">
      </div>

      <div class="form-group">
        <label for="confirm-password">Confirmar Contraseña</label>
        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmar nueva contraseña">
      </div>

      <button type="submit" class="submit-button">Guardar Cambios</button>
    </form>
  </div>

  <!-- Agregar un avatar de perfil -->
  <div class="avatar">
    <img src="path/to/user-avatar.jpg" alt="Avatar de Usuario">
    <input type="file" id="avatar-upload" accept="image/*">
    <label for="avatar-upload" class="upload-button">Cambiar Avatar</label>
  </div>
</div>

<?php
require 'src/vista/partials/footer.php';
?>