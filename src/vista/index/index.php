<?php
require 'src/vista/partials/head.php';
?>
<p><?= $this->datos; ?></p>
<section class="hero">
  <!-- <section class="hero-txt">Viaja con Via<span style="font-size:1em;color:rgb(51, 87, 153);">Uy</span>, viaja <span id="hero-txt-span" class="hero-txt-span">Facil</span></section> -->
  <section class="hero-txt">
    <h2 class="hero-txt-title">
      Encuentra, Reserva y Compra tus Boletos de Autobús en viaUy
    </h2>
    <p class="hero-txt-desc">¡Tu Viaje Perfecto Comienza Aquí!</p>
  </section>

  <form class="hero-form" action="index.php?c=actions&m=buscar" method="GET">
    <section class="hero-form-group">
      <label class="hero-label" for="hero-salida">
        Origen
      </label>
      <input class="hero-input ida-input" type="text" id="hero-salida" name="salida" placeholder="Origen..." required>
    </section>
    <span class="ida-vuelta-icon material-symbols-outlined">
      sync_alt
    </span>
    <section class="hero-form-group">
      <label class="hero-label " for="hero-destino">
        Destino
      </label>
      <input class="hero-input vuelta-input" type="text" id="hero-destino" name="destino" placeholder="Destino..."
        required>
    </section>
    <section class="hero-form-group">
      <label class="hero-label" for="hero-hora">
        Ida
      </label>
      <input class="hero-input" type="date" id="hero-date" name="date" required>
    </section>
    <section class="hero-form-group">
      <label class="hero-label" for="hero-pasajeros">
        Pasajeros
      </label>
      <input class="hero-input" type="number" id="hero-pasajeros" name="pasajeros" placeholder="Pasajeros..." required>
    </section>
    <button type="submit" class="hero-button" id="hero-btn">
      <i class="fa-solid fa-magnifying-glass"></i> Buscar
    </button>
  </form>

</section>
<section id="lines-container" class="lines-container">
  <section class="lines-container-header">
    <p class="results-p">No hay resultados</p>
  </section>
  <section class="lines-container-box">
    <section id="lines-container-lines" class="lines-container-lines">
    </section>
  </section>
</section>
<p id="data-msg"></p>

<script src="public/js/home/hero.js"></script>
<script src="fetch/index/search.js"></script>
<?php
require 'src/vista/partials/footer.php';
?>

<script>
cambiarTitulo("ViaUy | Inicio");
</script>