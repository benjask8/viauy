<?php require_once 'src/vista/admin/partials/estructure.php'; ?>


<h1>User Show</h1>
<section class="page-container">
  <?php foreach ($datos['users'] as $user) : ?>
  <?php if($user['is_admin'] == 0) :?>
  <section class="request-card">
    <?php else :?>
    <section class="request-card request-card-admin">
      <span class="material-symbols-outlined status-icon status-icon-pending">admin_panel_settings</span>
      <?php endif ?>
      <h2 class="request-title"><?= $user['username'] ?></h2>

      <p><strong>Email:</strong> <?= $user['email'] ?></p>
      <?php if($user['is_admin'] == 0) :?>

      <form action="index.php?c=admin&m=userChangeAdmin" method="post" class="request-form"
        onsubmit="return confirm('¿Estás seguro de que deseas realizar esta acción?');">
        <input type="hidden" name="username" value="<?= $user['username'] ?>">
        <label for="action">Es Admin:</label>
        <select name="action" id="action" class="action-select">
          <option value="1">True</option>
          <option value="0">False</option>
        </select>
        <input type="submit" value="Submit" class="submit-button">
      </form>
      <?php endif ?>

    </section>
    <?php endforeach; ?>
  </section>

  <?php require_once 'src/vista/admin/partials/endEstructure.php'; ?>