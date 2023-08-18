<?php
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ViaUy</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/pre.css">
  <link rel="stylesheet" href="public/css/responsive.css">
  <script src="public/js/jquery-3.7.0.min.js"></script>
  <script src="https://kit.fontawesome.com/d1b7ca4fc4.js" crossorigin="anonymous"></script>
</head>

<body>
<?php if (isset($_GET['msg'])) : ?>
  <div class="floating-msg">
        <div class="message"><?= $_GET['msg']; ?></div>
        <b class="close-btn" onclick="closeMessage()">X</b>
  </div>
<?php endif; ?>

  <header class="header">
    <nav class="header-logo-bar">

      <button class="header-bars" id="header-bars">
        <i class="fa-solid fa-bars"></i>
      </button>
      <h1 class="header-logo">
        <a href="/viauy" class="header-logo-a">Via<span class="blue-c">Uy</span></a>
      </h1>
    </nav>
    <nav class="header-links" id="header-links">
      <ul class="header-links-ul">
        <li class="header-links-li">
          <button class="header-ul-bars" id="header-ul-bars">
            <i class="fa-solid fa-x"></i>
          </button>
        </li>
        <li class="header-links-li"><a href="/viauy/">Inicio</a></li>
        <li class="header-links-li"><a href="index.php?c=index&m=help">Ayuda</a></li>
        <li class="header-links-li"><a href="">Buses</a></li>
        <li class="header-links-li"><a href="">Lineas</a></li>
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
      <form class="header-search-form" id="header-search-form" action="index.php?c=actions&m=buscar" method="GET">
        <input placeholder="Buscar..." type="search" name="search" class="header-search-input" id="header-search-input">
        <button type="submit" class="header-search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <button class="header-btns-search" id="header-btns-search">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
      <button class="header-btns-btn" id="open-user-options">
        <i class="fa-regular fa-user"></i>
      </button>
      <nav class="user-options" id="user-options">
        <?php if (isset($_SESSION['user_id'])) : ?>
        <a href="/via_uy/src/views/user/mainProfile.php"
          title="<?= $_SESSION['user_name'] ?>"><?= $_SESSION['user_name'] ?></a> <br>
        <a href="index.php?c=user&m=logout"><i class="fa-solid fa-sign-out"></i> Cerrar Sesión</a>
        <?php if ($_SESSION['esAdmin']) : ?>
        <a href="/via_uy/src/views/user/admin/dashboard.php"><i class="fa-solid fa-code"></i> Dessarrollador</a>
        <?php endif; ?>
        <?php else : ?>
        <a href="index.php?c=user&m=login"><i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión</a>
        <a href="index.php?c=user&m=signup"><i class="fa-solid fa-user-plus"></i> Registrarse</a>
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
  setTimeout(function () {
    floatingMsg.style.opacity = "0";
    floatingMsg.style.transition = "opacity 1s ease-in-out";
    setTimeout(function () {
      floatingMsg.style.display = "none";
    }, 1000); // Tiempo de espera para que se complete la animación
  }, 5000);
  const closeBtn = document.querySelector(".close-btn");
  closeBtn.addEventListener("click", function () {
    floatingMsg.style.opacity = "0";
    floatingMsg.style.transition = "opacity 1s ease-in-out";
    setTimeout(function () {
      floatingMsg.style.display = "none";
    }, 1000);
  });
<?php endif; ?>

  </script>
  <section class="container-fluid">