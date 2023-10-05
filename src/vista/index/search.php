<?php 
  require 'src/vista/partials/head.php';
?>
<?php if(isset( $this->datos['searchTerm'])): ?>
    <p>Buscar: "<strong><?= $this->datos['searchTerm'] ?></strong>"</p>
<?php else: ?></p>
    <p><?= $this->datos['error'] ?></p>
<?php endif ?>

<?php 
  require 'src/vista/partials/footer.php';
?>

<script>
  cambiarTitulo("ViaUy | Inicio");
</script>