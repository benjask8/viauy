<?php
    require_once 'src/vista/admin/partials/estructure.php';
?>


<h1>Company requests here</h1>

<?php foreach ($datos['companyRequests'] as $request) : ?>
    <h2>Company Name: <?= $request['companyName'] ?></h2>
    <p>Contact Name: <?= $request['contactName'] ?></p>
    <p>Contact Email: <?= $request['contactEmail'] ?></p>
    <p>Contact Phone: <?= $request['contactPhone'] ?></p>
    <p>Message: <?= $request['message'] ?></p>
    <p>Id: <?= $request['id'] ?></p>

    <form action="index.php?c=admin&m=dashboard_optionRequest" method="post">
    <input type="hidden" name="id" value="<?= $request['id'] ?>">
    <select name="action" id="action">
        <option value="accept">Aceptar</option>
        <option value="deny">Denegar</option>
    </select>
    <input type="submit" value="Enviar">
    </form>

    <hr>
<?php endforeach; ?>

<?php
    require_once 'src/vista/admin/partials/endEstructure.php';
?>
