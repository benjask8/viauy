<?php
if (!isset($_SESSION['company_name'])) {
  header('Location: /viauy');
  exit();
}
require 'src/vista/partials/head.php';
?>


<h1 class="title">Bienvenida Empresa</h1>

<?php
require 'src/vista/partials/footer.php';
?>