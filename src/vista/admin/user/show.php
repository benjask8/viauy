<?php require_once 'src/vista/admin/partials/estructure.php'; ?>


<h1>User Show</h1>
<div class="page-container">
<?php foreach ($datos['users'] as $user) : ?>
        <div class="request-card">
            <h2 class="request-title"><?= $user['username'] ?></h2>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <?php if($user['is_admin'] == 0) :?>
                <p><strong>No es Admin</strong></p>
                <?php else :?>
                <p><strong>Es Admin</strong></p>
            <?php endif ?>
            <form action="index.php?c=admin&m=userChangeAdmin" method="post" class="request-form" onsubmit="return confirm('¿Estás seguro de que deseas realizar esta acción?');">
                <input type="hidden" name="username" value="<?= $user['username'] ?>">
                <label for="action">Es Admin:</label>
                <select name="action" id="action" class="action-select">
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
                <input type="submit" value="Submit" class="submit-button">
            </form>

        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'src/vista/admin/partials/endEstructure.php'; ?>