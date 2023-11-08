<?php
require 'src/vista/partials/head.php';
?>

<main class="company-container">
  <h1 class="page-title">Compañías de Ómnibus</h1>

  <?php foreach ($datos['companys'] as $company) : ?>
  <div class="request-card">
    <a href="http://localhost/viauy/index.php?c=company&m=profile&name=<?= $company['companyName'] ?>"
      class="request-title"><?= $company['companyName'] ?> <span class="material-symbols-outlined">new_releases</span>
    </a>
  </div>
  <?php endforeach; ?>
</main>

<script>
cambiarTitulo("ViaUy | Compañías");
</script>

<?php
require 'src/vista/partials/footer.php';
?>