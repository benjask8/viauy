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
  <form action="index.php?c=user&m=doSignup" class="login-form" method="POST" autocomplete="off">
  <a href="/viauy"class="login-form-exit">
    <i class="fa-solid fa-xmark"></i>
  </a>  
    <h2 class="login-form-title">Registrarte</h2>

    <p><?= $this->datos; ?></p>

    <label for="login-input-mail">Email</label>
    <input type="email" name="email" class="login-input" id="login-input-mail" autocomplete="off"
      placeholder="Introduce tu Email">

    <label for="login-input-username">Nombre de usuario</label>
    <input type="text" name="username" class="login-input" id="login-input-username" autocomplete="off"
      placeholder="Introduce tu Nombre de usuario">

    <label for="login-input-password">Contraseña</label>
    <input type="password" name="password" class="login-input" id="login-input-password" autocomplete="off"
      placeholder="Introduce tu Contraseña">

    <label for="login-input-password">Confirmar Contraseña</label>
    <input type="password" name="passwordC" class="login-input" id="login-input-password" autocomplete="off"
      placeholder="Confirma tu Contraseña">

    <input type="submit" value="Registrarse">
  </form>
  <p>¿Ya tienes una cuenta? <a href="index.php?c=user&m=login">Iniciar Sesión</a></p>
</section>


<script>
cambiarTitulo("ViaUy | Registrarse")
</script>
<?php
require 'src/vista/partials/footer.php';
?>