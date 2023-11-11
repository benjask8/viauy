<?php

if (!isset($_SESSION['company_name'])) {
  header('Location: /viauy');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
  <link rel="stylesheet" href="public/css/company.css">
  <title>Dashboard Compañia</title>
</head>

<body>
  <button class="menu-toggle" onclick="toggleMenu()">☰</button>
  <section class="company-menu">
    <h1>Menu</h1>
    <a href="index.php?c=company&m=mainProfile"><span class="material-symbols-outlined">
        home
      </span>Inicio</a>
    <a href="index.php?c=company&m=mainProfile_buses"><span
        class="material-symbols-outlined">local_shipping</span>Buses</a>
    <a href="index.php?c=company&m=mainProfile_lineas"><span class="material-symbols-outlined">
        location_on
      </span>Lineas</a>
    <a href="index.php?c=company&m=mainProfile_admins"><span
        class="material-symbols-outlined">shield_person</span>Admins</a>
    <a href="index.php?c=company&m=mainProfile_blog"><span
        class="material-symbols-outlined">library_books</span>Blog</a>
  </section>

  <!-- Header con el logo de la empresa -->
  <header class="header">
    <a href="/viauy" class="header-logo"><img src="public/images/logo.png" alt="Logo de la Empresa"></a>
    <button onclick="toggleHeaderMenu()" class="header-company"><span class="material-symbols-outlined">
        directions_bus
      </span><?= $_SESSION["company_name"]; ?></button>

    <div class="header-menu">
      <div class="menu-info">
        <img src="public/images/user.png" alt="Logo de la compañía">
        <h3><?php echo $_SESSION["company_name"]; ?></h3>
        <p>¡Bienvenido!</p>
      </div>

      <ul class="menu-options">
        <li><a href="?c=company&m=mainProfile">Inicio</a></li>
        <li><a href="?c=company&m=mainProfile_buses">Buses</a></li>
        <li><a href="?c=company&m=mainProfile_lineasAdd">Líneas</a></li>
        <li><a href="?c=company&m=mainProfile_config">Configuración</a></li>
        <li><a href="?c=company&m=logout">Cerrar Sesión</a></li>
      </ul>
    </div>

  </header>

  <script>
  function toggleMenu() {
    var menu = document.querySelector('.company-menu');
    menu.classList.toggle('menu-open');
  }

  function toggleHeaderMenu() {
    var menu = document.querySelector('.header-menu');
    menu.classList.toggle('header-menu-open');
  }
  </script>