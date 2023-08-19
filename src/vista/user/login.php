<?php
require 'src/vista/partials/head.php';

if (isset($_SESSION['user_name'])) {
  header('Location: /viauy');
  exit();
}


?>
<style>
  .header,
  .footer{
    display:none;
  }
</style>

<section class="login-container">
  <form action="index.php?c=user&m=doLogin" class="login-form" method="POST" autocomplete="off">
  <a href="/viauy"class="login-form-exit">
    <i class="fa-solid fa-xmark"></i>
  </a>  
  <h2 class="login-form-title">Iniciar Sesión</h2>
    <?= $this->datos; ?>  
  <i>o</i>
    <label for="login-input-mail">Email o Nombre de Usuario</label>
    <input type="text" name="username" class="login-input" id="login-input-mail" autocomplete="off"
      placeholder="Introduce tu Email o Nombre de Usuario">
    <label for="login-input-password">Contraseña</label>
      <input type="password" name="password" class="login-input login-input-password" id="login-input-password"
        autocomplete="off" placeholder="Introduce tu Contraseña">
    <input type="submit" value="Iniciar Sesión">
  </form>
  <p>¿No tienes una cuenta? <a href="index.php?c=user&m=signup">Regístrate</a></p>
</section>
<script>

cambiarTitulo("ViaUy | Iniciar Sesión");

</script>
<?php
require 'src/vista/partials/footer.php';
?>