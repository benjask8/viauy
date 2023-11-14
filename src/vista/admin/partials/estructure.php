<?php
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] === 0) {
  header('Location: /viauy');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="public/css/dashboardd.css">
  <link rel="stylesheet" href="public/css/pre2.css">
  <script src="https://kit.fontawesome.com/d1b7ca4fc4.js" crossorigin="anonymous"></script>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
  <title>Dashboard</title>
</head>

<body>
  <?php if (isset($_GET['msg'])) : ?>
  <section class="floating-msg">
    <section class="message"><?= $_GET['msg']; ?></section>
    <b class="close-btn" onclick="closeMessage()"><i class="fa-solid fa-xmark"></i></b>
  </section>
  <?php endif; ?>

  <script>
  <?php if (isset($_GET['msg'])) : ?>
  const floatingMsg = document.querySelector(".floating-msg");

  setTimeout(function() {
    floatingMsg.style.opacity = "0";
    floatingMsg.style.transition = "opacity 1s ease-in-out";
    setTimeout(function() {
      floatingMsg.style.display = "none";
    }, 1000); // Tiempo de espera para que se complete la animación
  }, 5000);
  const closeBtn = document.querySelector(".close-btn");
  closeBtn.addEventListener("click", function() {
    floatingMsg.style.opacity = "0";
    floatingMsg.style.transition = "opacity 1s ease-in-out";
    setTimeout(function() {
      floatingMsg.style.display = "none";
    }, 1000);
  });
  <?php endif; ?>
  </script>


  <header class="dashboard-header">
    <button onclick="openAside()" class="aside-menu">
      <span class="material-symbols-outlined">
        menu
      </span>
    </button>
    <section class="dashboard-header-profile">
      <a title="Perfil de Usuario" href="?c=user&m=mainProfile"><span
          class="material-symbols-outlined">account_circle</span> <?= $_SESSION['user_name'] ?></a>
    </section>
  </header>
  <section class="dashboard-body">



    <aside class="dashboard-aside" id="dashboard-aside">

      <a href="?" class="aside-links-title"><img src="public/images/logo.png" alt=""></a>
      <p class="aside-links-subtitle">Empresas</p>
      <li class="aside-links-li">
        <ul class="aside-links-li-ul">
          <li class="aside-links-li-ul-li"><a href="" class="aside-links-li-ul-li-a"><i
                class="fa-solid fa-copyright"></i>Empresas</a></li>
          <li class="aside-links-li-ul-li"><a href="index.php?c=admin&m=dashboardCompanyRequests"
              class="aside-links-li-ul-li-a"><i class="fa-solid fa-hourglass-start"></i>Solicitudes</a></li>
        </ul>
      </li>
      <p class="aside-links-subtitle">Usuarios</p>
      <li class="aside-links-li">
        <ul class="aside-links-li-ul">
          <li class="aside-links-li-ul-li"><a href="index.php?c=admin&m=usershow" class="aside-links-li-ul-li-a"><i
                class="fa-solid fa-users"></i>Clientes</a></li>
          <li class="aside-links-li-ul-li"><a href="" class="aside-links-li-ul-li-a"><i
                class="fa-sharp fa-solid fa-gears"></i>Administradores</a></li>
        </ul>
      </li>
      </ul>
    </aside>

    <script>
    var asideElement = document.getElementById("dashboard-aside");

    function openAside() {
      asideElement.classList.toggle("dashboard-aside-open");
    }
    </script>