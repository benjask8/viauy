<?php
require 'src/vista/company/profile/partials/estructure.php';
?>

<h1 class="title">Buses</h1>
<h2 class="sub-title">Agregar Nuevo Bus</h2>
<section class="login-container">
  <form action="index.php?c=bus&m=newBus" class="login-form" method="POST" autocomplete="off">
    <a href="?c=company&m=mainProfile_buses" class="login-form-exit">
      <span class="material-symbols-outlined">
        close
      </span>
    </a>
    <h2 class="login-form-title">Agregar Bus</h2>
    <p id="data-msg"></p>

    <label for="modelo">Modelo del Bus:</label>
    <input type="text" name="model" class="login-input" id="modelo" required placeholder="Introduce el modelo del Bus">

    <label for="capacidad">Capacidad del Bus (solo números):</label>
    <input type="number" name="maxCapacity" class="login-input" id="capacidad" required
      placeholder="Introduce la capacidad del Bus" inputmode="numeric" pattern="[0-9]*" title="Ingrese solo números">

    <label for="matricula">Matrícula del Bus:</label>
    <input type="text" name="busId" class="login-input" id="matricula" required
      placeholder="Introduce la matrícula del Bus" oninput="validateInput(this)">

    <label for="asientos">Disposición de los Asientos (Ejemplo: 2,4,2):</label>
    <input type="text" name="seatLayout" class="login-input" id="seatLayout" required
      placeholder="Introduce la disposición de los asientos">

    <!-- Casilla de verificación para baño -->
    <input type="checkbox" name="hasToilet" id="baño" value="1">
    <label for="baño">¿Tiene baño?</label><br>

    <!-- Casilla de verificación para wifi -->
    <input type="checkbox" name="hasWiFi" id="wifi" value="1">
    <label for="wifi">¿Tiene WiFi?</label><br>

    <!-- Casilla de verificación para aire acondicionado -->
    <input type="checkbox" name="hasAC" id="ac" value="1">
    <label for="ac">¿Tiene Aire Acondicionado?</label><br>
    <input class="login-input" type="submit" value="Agregar Bus">
  </form>
  <div id="seat-status">
    Asientos disponibles: <span id="available-seats">0</span><br>
  </div>

  <p class="title">Vista previa Asientos</p>
  <div class="seat-preview" id="seat-preview"></div>
</section>


<?php
require 'src/vista/company/profile/partials/endEstructure.php';
?>


<script>
function validateInput(input) {
  // Expresión regular para permitir solo números y letras (mayúsculas y minúsculas)
  var pattern = /^[A-Za-z0-9]*$/;

  if (!pattern.test(input.value)) {
    // Si la entrada no cumple con la expresión regular, elimina los caracteres no permitidos
    input.value = input.value.replace(/[^A-Za-z0-9]/g, '');
  }
}
</script>

<script src="fetch/company/profile/buses/add.js"></script>
<script src="fetch/company/profile/buses/seatLayout.js"></script>