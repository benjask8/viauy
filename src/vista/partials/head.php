<?php
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ViaUy</title>
  <link rel="icon" href="public/images/minlogo.png" type="image/x-icon">

  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/presets.css">
  <link rel="stylesheet" href="public/css/responsives.css">
  <script src="public/js/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/d1b7ca4fc4.js" crossorigin="anonymous"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
</head>

<body>
  <?php if (isset($_GET['msg'])) : ?>
  <div class="floating-msg">
    <div class="message"><?= $_GET['msg']; ?></div>
    <b class="close-btn" onclick="closeMessage()"><i class="fa-solid fa-xmark"></i></b>
  </div>
  <?php endif; ?>

  <header class="header">
    <button class="header-bars" id="header-bars">
      <span class="material-symbols-outlined">
        menu
      </span>
    </button>
    <nav class="header-logo-bar">
      <h1 class="header-logo">
        <a href="/viauy" class="header-logo-a"><img src="public/images/logo.png" alt=""></a>
      </h1>
    </nav>

    <nav class="header-links" id="header-links">
      <button class="header-links-bar" id="header-links-bar">
        <span class="material-symbols-outlined">
          close
        </span>
      </button>
      <ul class="header-links-ul">
        <h1 class="header-links-logo">
          <a href="/viauy" class="header-logo-a"><i class="fa-solid fa-location-pin"
              style="font-size:.9em;color:hsl(44, 100%, 50%);"></i> viaUy</a>
        </h1>
        <li class="header-links-li header-links-li-m header-links-li-title">Opciones</a></li>
        <li class="header-links-li"><a href="/viauy/"><i class="fa-solid fa-house"></i>Inicio</a></li>
        <li class="header-links-li header-links-li-m header-links-li-space"></a></li>
        <li class="header-links-li"><a href="index.php?c=index&m=help"><i class="fa-solid fa-circle-info"></i>Ayuda</a>
        </li>
        <li class="header-links-li header-links-li-m header-links-li-title">Viajes</a></li>

        <li class="header-links-li"><a href=""><i class="fa-solid fa-bus"></i>Buses</a></li>
        <li class="header-links-li header-links-li-m header-links-li-space"></a></li>
        <li class="header-links-li"><a href=""><i class="fa-solid fa-route"></i>Rutas</a></li>
        <li class="header-links-li header-links-li-m header-links-li-title">Ususario</a></li>
        <?php if (isset($_SESSION['user_name'])) : ?>
        <li class="header-links-li header-links-li-m"><a
            href="index.php?c=user&m=profile">@<?= $_SESSION['user_name'] ?></a></li>
        <li class="header-links-li header-links-li-m header-links-li-space"></a></li>
        <li class="header-links-li header-links-li-m"><a href="index.php?c=user&m=logout">Cerrar Sesion</a></li>

        <?php if ($_SESSION['is_admin'] === 1) : ?>
        <li class="header-links-li header-links-li-m header-links-li-space"></a></li>
        <li class="header-links-li header-links-li-m"><a href="index.php?c=admin&m=dashboard" title="">Dashboard</a>
        </li>
        <?php endif; ?>
        <?php else : ?>
        <li class="header-links-li header-links-li-m"><a href="index.php?c=user&m=login"><i
              class="fa-solid fa-user"></i>Iniciar Sesion</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['company_name'])) : ?>

        <li class="header-links-li header-links-li-m"><a
            href="index.php?c=user&m=profile">@<?= $_SESSION['company_name'] ?></a></li>
        <li class="header-links-li header-links-li-m header-links-li-space"></a></li>
        <li class="header-links-li header-links-li-m"><a href="index.php?c=company&m=logout">Cerrar Sesion</a></li>
        <?php endif; ?>

      </ul>
      <ul class="header-links-social">
        <li class="header-links-li"><a href="">www.viauy.com</a></li>
        <li class="header-links-li">
          <ul>
            <li class="header-links-li"><a href=""><i class="fa-brands fa-twitter"></i></a></li>
            <li class="header-links-li"><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="header-links-li"><a href=""><i class="fa-brands fa-linkedin-in"></i></a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <section class="header-btns">
      <a href="index.php?c=index&m=help" class="header-btns-button">
        Ayuda
      </a>

      <?php if (isset($_SESSION['user_name'])) : ?>
      <button class="header-btns-button header-btns-btn" id="open-user-options">
        Usuario
      </button>
      <?php else : ?>
      <button class="header-btns-button header-btns-btn" id="open-user-options">
        iniciar sesion
      </button>
      <?php endif; ?>

      <nav class="user-options" id="user-options">
        <div class="user-options-user">
          <p class="company-label">Ususario</p>

          <?php if (isset($_SESSION['user_name'])) : ?>
          <?php if ($_SESSION['is_admin'] === 1) : ?>
          <a href="index.php?c=admin&m=dashboard" title="Dashboard">
            <i class="fas fa-cogs"></i> Dashboard
          </a>
          <?php endif; ?>
          <a href="index.php?c=user&m=mainProfile" title="<?= $_SESSION['user_name'] ?>">
            <i class="fas fa-user"></i> <?= $_SESSION['user_name'] ?>
          </a>
          <a href="index.php?c=user&m=logout">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
          </a>
          <?php else : ?>
          <a href="index.php?c=user&m=login">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
          </a>
          <a href="index.php?c=user&m=signup">
            <i class="fas fa-user-plus"></i> Registrarse
          </a>
          <?php endif; ?>

        </div>
        <?php if (isset($_SESSION['company_name'])) : ?>
        <div class="company-options">
          <p class="company-label">Empresa</p>
          <a href="index.php?c=company&m=mainProfile" title="<?= $_SESSION['company_name'] ?>">
            <i class="fas fa-building"></i> <?= $_SESSION['company_name'] ?>
          </a>
          <a href="index.php?c=company&m=logout">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
          </a>
        </div>
        <?php endif; ?>
      </nav>

    </section>

  </header>


  <script>
  function cambiarTitulo(nuevoTitulo) {
    document.title = nuevoTitulo;
  }

  const floatingMsg = document.querySelector(".floating-msg");

  <?php if (isset($_GET['msg'])) : ?>
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
  <section class="container-fluid">