document.addEventListener("DOMContentLoaded", function () {
  const busForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  // Obtén el ID del bus de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const busId = urlParams.get("id");

  // Función para obtener los datos del bus y actualizar el formulario
  const fetchBusData = () => {
    fetch(`?c=bus&m=getBusData&id=${busId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Actualiza los campos del formulario con los datos obtenidos
          const busData = data.bus;
          document.getElementById("modelo").value = busData.model;
          document.getElementById("capacidad").value = busData.maximum_capacity;
          document.getElementById("matricula").value = busData.idBus;

          // Actualiza las casillas de verificación de comodidades
          document.querySelector(".hasToilet").checked =
            busData.hasToilet == "1" ? true : false;
          document.querySelector(".hasWifi").checked =
            busData.hasWiFi == "1" ? true : false;
          document.querySelector(".hasAc").checked =
            busData.hasAC == "1" ? true : false;
        } else {
          dataMsg.classList.add("msg_error");
          dataMsg.classList.remove("msg_success");
          dataMsg.innerHTML = "Bus NO Existe";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

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
    formData.append("maximum_capacity", maxCapacity);
    formData.append("hasToilet", hasToilet);
    formData.append("hasWiFi", hasWiFi);
    formData.append("hasAC", hasAC);

    // Realizar una solicitud POST
    fetch(`index.php?c=bus&m=editBus&id=${busId}`, {
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

  // Llama a la función para obtener y mostrar los datos del bus al cargar la página
  fetchBusData();
});
