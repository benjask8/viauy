<?php
require 'src/vista/partials/head.php';
?>

<main class="help-container">
  <h2 class="help-title">¡Bienvenido a la Ayuda de ViaUy!</h2>
  <p class="help-description">
    En esta sección, te proporcionamos información sobre cómo utilizar la aplicación de gestión de autobuses ViaUy.
  </p>

  <section class="help-section">
    <h3 class="help-subtitle">Cómo Agregar un Nuevo Autobús</h3>
    <p class="help-text">
      Para agregar un nuevo autobús, sigue estos pasos:
    </p>
    <ol class="help-list">
      <li>Ingresa a tu cuenta o regístrate si eres un nuevo usuario.</li>
      <li>Navega hasta la sección "Agregar Autobús".</li>
      <li>Completa el formulario con la información del autobús, como número de matrícula, capacidad y características.</li>
      <li>Haz clic en "Guardar" para agregar el autobús a la base de datos.</li>
    </ol>
  </section>

  <section class="help-section">
    <h3 class="help-subtitle">Cómo Programar un Viaje</h3>
    <p class="help-text">
      Para programar un nuevo viaje, sigue estos pasos:
    </p>
    <ol class="help-list">
      <li>Inicia sesión en tu cuenta.</li>
      <li>Dirígete a la sección "Programar Viaje".</li>
      <li>Selecciona el autobús disponible y la ruta deseada.</li>
      <li>Elige la fecha y hora de salida del viaje.</li>
      <li>Confirma la información y haz clic en "Programar Viaje".</li>
    </ol>
  </section>

  <!-- Agregar más secciones de ayuda según sea necesario -->

</main>

<script>
  cambiarTitulo("ViaUy | Ayuda");
</script>

<?php
require 'src/vista/partials/footer.php';
?>
