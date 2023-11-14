<?php
require 'src/vista/partials/head.php';
?>

<main class="blog-container">
  <h2 class="blog-title">Bienvenido al Blog de ViaUy</h2>

  <article class="blog-post">
    <h3 class="post-title">Título del Artículo 1</h3>
    <p class="post-date">Fecha de Publicación: 1 de Agosto de 2023</p>
    <p class="post-content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac libero tristique, mattis massa a, aliquet
      erat. Sed ut urna et quam lacinia consectetur. Ut in cursus est. Aliquam erat volutpat. Aenean auctor, ante
      sit amet vehicula dapibus, velit elit finibus quam, et semper risus sapien non purus.
    </p>
    <a href="#" class="read-more-link">Leer Más</a>
  </article>

  <article class="blog-post">
    <h3 class="post-title">Título del Artículo 2</h3>
    <p class="post-date">Fecha de Publicación: 15 de Agosto de 2023</p>
    <p class="post-content">
      Sed tristique et dui eget vulputate. Proin a elit nec libero tincidunt consequat. Sed id nisl nec leo semper
      fermentum in sed est. Vivamus id arcu aliquam, rhoncus orci vel, facilisis odio.
    </p>
    <a href="#" class="read-more-link">Leer Más</a>
  </article>

  <!-- Agregar más artículos de blog según sea necesario -->

  <section class="pagination-buttons">
    <a href="#" class="pagination-button">Anterior</a>
    <a href="#" class="pagination-button">Siguiente</a>
  </section>
</main>

<script>
cambiarTitulo("ViaUy | Blog");
</script>

<?php
require 'src/vista/partials/footer.php';
?>