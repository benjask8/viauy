<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<section class="dashboard">
  <h1 class="dashboard-title">Panel de Control</h1>
  <div class="dashboard-cards">
    <div class="dashboard-card">
      <h2 class="card-title">Resumen General</h2>
      <p class="card-description">Obtén una vista general de tu compañía de autobuses, incluyendo estadísticas y datos
        importantes.</p>
      <a href="?c=company&m=overview" class="card-link">Ver más</a>
    </div>
    <div class="dashboard-card">
      <h2 class="card-title">Gestión de Buses</h2>
      <p class="card-description">Administra y actualiza la flota de autobuses de tu compañía, agrega nuevos buses y
        realiza cambios en los existentes.</p>
      <a href="?c=bus&m=busesList" class="card-link">Ver más</a>
    </div>
    <div class="dashboard-card">
      <h2 class="card-title">Ventas y Reservas</h2>
      <p class="card-description">Revisa las ventas y reservas de tus autobuses, obtén información detallada sobre rutas
        y horarios.</p>
      <a href="?c=company&m=salesAndBookings" class="card-link">Ver más</a>
    </div>
    <div class="dashboard-card">
      <h2 class="card-title">Ayuda y Soporte</h2>
      <p class="card-description">Encuentra respuestas a tus preguntas y obtén asistencia sobre el uso de la plataforma.
      </p>
      <a href="?c=company&m=help" class="card-link">Ver más</a>
    </div>
  </div>
</section>
<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>