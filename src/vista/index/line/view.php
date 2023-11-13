<?php
require 'src/vista/partials/head.php';
?>
<a href="/viauy" class="view-volver-btn"><span class="material-symbols-outlined">keyboard_arrow_left</span>Volver a los
  Resultados</a>
<h1 id="data-msg"></h1>

<section class="line-data-box" id="line-data-box">
  <section class="line-data-box-header">
    <h1 class="line-data-box-header-title">Titulo</h1>
    <section class="line-data-box-header-options">
      <h2 class="line-data-box-header-price">$00.00</h2>
      <a href="/viauy" class="line-data-box-header-buy">Continuar<span
          class="material-symbols-outlined">arrow_right_alt</span> </a>
    </section>
  </section>
  <table class="line-data-box-info">
    <thead>
      <tr>
        <th>Selección de Viaje</th>
        <th>Flexibilidad y Condiciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="line-data-box-info-td">
          <p class="line-data-box-info-td-origin">Origen</p>
          <p class="line-data-box-info-td-destination">Destino</p>
        </td>
        <td class="line-data-box-info-td">
          <p class="line-data-box-info-td-title">Titulo aqui</p>
          <p class="line-data-box-info-td-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur
            sequi iusto doloribus ut iure ullam nobis natus cupiditate dicta neque.</p>
        </td>
      </tr>
    </tbody>
  </table>
</section>
<script src="fetch/index/line/view.js"></script>

<?php
require 'src/vista/partials/footer.php';
?>