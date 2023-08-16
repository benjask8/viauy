<?php 
require 'src/vista/partials/head.php';
?>


<section class="login-container">
    <form action="/via_uy/src/views/user/login.php" class="login-form" method="POST" autocomplete="off">
        <h2 class="login-form-title">Iniciar Sesión</h2>
        <?php if (!empty($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <label for="login-input-mail">Email o Nombre de Usuario</label>
        <input type="text" name="email" class="login-input" id="login-input-mail" autocomplete="off" placeholder="Introduce tu Email o Nombre de Usuario">
        <label for="login-input-password">Contraseña</label>
        <div class="password-container">
            <input type="password" name="password" class="login-input login-input-password" id="login-input-password" autocomplete="off" placeholder="Introduce tu Contraseña">
            <input type="checkbox" id="toggle-password" class="toggle-password">
            <label for="toggle-password" class="toggle-password-l"><i class="fas fa-eye"></i></label>
            <label for="toggle-password" id="toggle-2" class="toggle-password-l"><i class="fas fa-eye-slash"></i></label>
        </div>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p>¿No tienes una cuenta? <a href="index.php?c=user&m=signup">Regístrate</a></p>
</section>

<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('login-input-password');
    const toggleIcon1 = document.querySelector('.toggle-password-l i.fa-eye');
    const toggleIcon2 = document.querySelector('.toggle-password-l i.fa-eye-slash');
    toggleIcon2.style.display = 'none';

    togglePassword.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
            toggleIcon1.style.display = 'none';
            toggleIcon2.style.display = 'inline';
        } else {
            passwordInput.type = 'password';
            toggleIcon1.style.display = 'inline';
            toggleIcon2.style.display = 'none';
        }
    });

    cambiarTitulo("ViaUy | Iniciar Sesión");
</script>
<?php 
  require 'src/vista/partials/footer.php';
?>
