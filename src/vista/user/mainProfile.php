<?php
if (!isset($_SESSION['user_name'])) {
    header('Location: /viauy');
    exit();
}
require 'src/vista/partials/head.php';


?>
<h1>User Profile!!!</h1>
<h2><?= $_SESSION['user_name']?></h2>

<?php
require 'src/vista/partials/footer.php';
?>
