<?php


if (isset($_SESSION['company_name'])) {
    header('Location: /viauy');
    exit();
  }
require 'src/vista/partials/head.php';


?>
<style>
  .header,
  .footer{
    display:none;
  }
</style>
<section class="login-container">
  <form action="index.php?c=company&m=doLogin" class="login-form" method="POST" autocomplete="off">
  <a href="/viauy"class="login-form-exit">
  <span class="material-symbols-outlined">
  close
  </span>
  </a>  
    <h2 class="login-form-title">Inicia Sesion Como Compañia</h2>
    <p><?= $this->datos; ?></p>

      <label for="login-input-username">Nombre de Empresa</label>
    <input type="text" name="name" class="login-input" id="login-input-username" autocomplete="off"
      placeholder="Introduce tu Nombre">
    <label for="login-input-password">Contraseña</label>
    <input type="password" name="password" class="login-input" id="login-input-password" autocomplete="off"
      placeholder="Introduce tu Contraseña">

    <input type="submit" value="Entrar">
  </form>
  <p>¿No tienes una cuenta? <a href="index.php?c=company&m=signup">Registrate</a></p>
</section>


<script>
cambiarTitulo("ViaUy | Registrarse")
</script>
<?php
require 'src/vista/partials/footer.php';
?>
