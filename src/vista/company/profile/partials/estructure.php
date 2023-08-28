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
    <title>Dashboard Compañia</title>
</head>
<body>
    <section class="company-menu">
        <h1>Menu</h1>
        <a href="index.php?c=company&m=mainProfile">Inicio</a>
        <a href="index.php?c=company&m=mainProfile_buses">Buses</a>
        <a href="index.php?c=company&m=mainProfile_lineas">Lineas</a>
        <a href="index.php?c=company&m=mainProfile_admins">Admins</a>
    </section>


