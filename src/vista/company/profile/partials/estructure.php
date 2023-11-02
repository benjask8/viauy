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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
  <link rel="stylesheet" href="public/css/company4.css">
  <title>Dashboard Compañia</title>
</head>

<body>
  <button class="menu-toggle" onclick="toggleMenu()">☰</button>
  <section class="company-menu">
    <h1>Menu</h1>
    <a href="index.php?c=company&m=mainProfile"><span class="material-symbols-outlined">
        home
      </span>Inicio</a>
    <a href="index.php?c=company&m=mainProfile_buses"><span class="material-symbols-outlined">local_shipping</span>Buses</a>
    <a href="index.php?c=company&m=mainProfile_lineas"><span class="material-symbols-outlined">
        location_on
      </span>Lineas</a>
    <a href="index.php?c=company&m=mainProfile_admins"><span class="material-symbols-outlined">shield_person</span>Admins</a>
    <a href="index.php?c=company&m=mainProfile_blog"><span class="material-symbols-outlined">library_books</span>Blog</a>
  </section>


  <script>
    function toggleMenu() {
      var menu = document.querySelector('.company-menu');
      menu.classList.toggle('menu-open');
    }
  </script>