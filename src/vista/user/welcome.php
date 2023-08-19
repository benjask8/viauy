<?php

if (!isset($_SESSION['user_name'])) {
    header('Location: /viauy');
    exit();
  }
  
require 'src/vista/partials/head.php';
?>
welcome


<span class="success-msg">Bienvenido <?=$_SESSION['user_name']?></span>


<?php
require 'src/vista/partials/footer.php';
?>
