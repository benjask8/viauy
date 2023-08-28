<?php if (empty($this->datos['user'])) : ?>
    <p>Usuario no existe</p>
<?php else : ?>
    <?php foreach ($this->datos['user'] as $usuario): ?>
        <p>Nombre de usuario: <?= $usuario['username'] ?></p>
    <?php endforeach; ?>
<?php endif; ?>
