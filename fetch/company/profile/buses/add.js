document.addEventListener("DOMContentLoaded", function () {
  const busForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  busForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Obtener los valores de los campos del formulario
    const busId = document.getElementById("matricula").value.trim();
    const model = document.getElementById("modelo").value.trim();
    const maxCapacity = document.getElementById("capacidad").value.trim();

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
