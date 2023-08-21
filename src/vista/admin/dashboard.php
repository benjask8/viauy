<?php
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
    require_once 'src/vista/admin/partials/estructure.php';
?>

    <h3>Dashboard</h3>

<?php
    require_once 'src/vista/admin/partials/endEstructure.php';
} else {
    header('Location: /viauy');
    exit();
}
?>
