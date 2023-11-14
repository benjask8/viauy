<?php require_once 'src/vista/admin/partials/estructure.php'; ?>

<section class="page-container">
  <h1 class="title">Peticiones</h1>

  <form action="" method="post" class="search-form">
    <input type="search" name="search-request" id="search-request" placeholder="Buscar...">
    <input type="submit" value="Buscar">
  </form>

  <section class="cards-container" id="requests-container">
    <table class="request-table">
      <thead>
        <tr>
          <th>Company Name</th>
          <th>Contact Name</th>
          <th>Contact Email</th>
          <th>Contact Phone</th>
          <th>Token</th>
          <th>Request ID</th>
          <th>Request Status</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="request-table-body">
        <!-- Aquí se cargarán las solicitudes utilizando fetch -->
      </tbody>
    </table>
    <p id="data-msg"></p>
  </section>
</section>

<script src="fetch/admin/company/request.js"></script>
<?php require_once 'src/vista/admin/partials/endEstructure.php'; ?>