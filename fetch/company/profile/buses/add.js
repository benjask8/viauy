document.addEventListener("DOMContentLoaded", function () {
  const busForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  function validateInput(input) {
    // Expresión regular para permitir solo números y letras (mayúsculas y minúsculas)
    var pattern = /^[A-Za-z0-9]*$/;

    if (!pattern.test(input.value)) {
      // Si la entrada no cumple con la expresión regular, elimina los caracteres no permitidos
      input.value = input.value.replace(/[^A-Za-z0-9]/g, "");
    }
  }

  busForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Obtener los valores de los campos del formulario
    const busId = document.getElementById("matricula").value.trim();
    const model = document.getElementById("modelo").value.trim();
    const maxCapacity = document.getElementById("capacidad").value.trim();

    // Obtener los valores de las casillas de verificación
    const hasToilet = document.getElementById("baño").checked ? 1 : 0;
    const hasWiFi = document.getElementById("wifi").checked ? 1 : 0;
    const hasAC = document.getElementById("ac").checked ? 1 : 0;

    // Validar campos (puedes agregar más validaciones si es necesario)
    if (!busId || !model || !maxCapacity) {
      dataMsg.innerHTML = "Complete todos los campos.";
      addPopAnimation(); // Aplicar animación "pop" aquí
      return;
    }

    // Crear un objeto FormData y agregar los datos del formulario
    const formData = new FormData();
    formData.append("busId", busId);
    formData.append("model", model);
    formData.append("maxCapacity", maxCapacity);
    formData.append("hasToilet", hasToilet);
    formData.append("hasWiFi", hasWiFi);
    formData.append("hasAC", hasAC);

    // Realizar una solicitud POST
    fetch("index.php?c=bus&m=newBus", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Manejar la respuesta del controlador PHP aquí
        if (data.status === "error") {
          dataMsg.innerHTML = data.msg;

          dataMsg.classList.add("msg_error");
          dataMsg.classList.remove("msg_success");
        } else if (data.status === "success") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.remove("msg_error");
          dataMsg.classList.add("msg_success");
        }
        dataMsg.classList.toggle = "pop";
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
