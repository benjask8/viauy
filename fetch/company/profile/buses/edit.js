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
          dataMsg.innerHTML = "Error al obtener los datos del bus.";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  // Llama a la función para obtener y mostrar los datos del bus al cargar la página
  fetchBusData();
});
