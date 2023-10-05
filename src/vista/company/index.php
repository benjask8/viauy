<?php
require 'src/vista/partials/head.php';
?>

<main class="company-container">
  <h1 class="page-title">Compañías de Ómnibus</h1>
  
  <?php foreach ($datos['companys'] as $company) : ?>
    <div class="request-card">
      <h2 class="request-title"><?= $company['companyName'] ?> <span class="material-symbols-outlined">new_releases</span></h2>
    </div>
    <?php endforeach; ?>
  </main>

    <script>
  cambiarTitulo("ViaUy | Compañías");
</script>

<?php
require 'src/vista/partials/footer.php';
?>
