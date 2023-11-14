document.addEventListener("DOMContentLoaded", function () {
  const lineForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  // Obtén el ID de la línea de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const lineId = urlParams.get("lineid");

  // Función para obtener los datos de la línea y actualizar el formulario
  const fetchLineData = () => {
    fetch(`?c=line&m=getOwnLineData&lineid=${lineId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Actualiza los campos del formulario con los datos obtenidos
          const lineData = data.line;
          document.getElementById("lineName").value = lineData.lineName;
          document.getElementById("origin").value = lineData.origin;
          document.getElementById("destination").value = lineData.destination;
          document.getElementById("departureDate").value =
            lineData.departureDate;
          document.getElementById("departureTime").value =
            lineData.departureTime;
          document.getElementById("arrivalTime").value = lineData.arrivalTime;
          document.getElementById("idBus").value = lineData.idBus;
          document.getElementById("price").value = lineData.linePrice;

          // Puedes añadir más campos según la estructura de tu formulario
        } else {
          dataMsg.classList.add("msg_error");
          dataMsg.classList.remove("msg_success");
          dataMsg.innerHTML = "Línea NO Existe";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  lineForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Obtener los valores de los campos del formulario
    const lineName = document.getElementById("lineName").value.trim();
    const origin = document.getElementById("origin").value.trim();
    const destination = document.getElementById("destination").value.trim();
    const departureDate = document.getElementById("departureDate").value.trim();
    const departureTime = document.getElementById("departureTime").value.trim();
    const arrivalTime = document.getElementById("arrivalTime").value.trim();
    const idBus = document.getElementById("idBus").value.trim();
    const price = document.getElementById("price").value.trim();

    // Validar campos (puedes agregar más validaciones si es necesario)
    if (
      !lineId ||
      !lineName ||
      !origin ||
      !destination ||
      !departureDate ||
      !departureTime ||
      !arrivalTime ||
      !idBus ||
      !price
    ) {
      dataMsg.innerHTML = "Complete todos los campos.";
      // Puedes agregar aquí animaciones o estilos para indicar errores
      return;
    }

    // Crear un objeto FormData y agregar los datos del formulario
    const formData = new FormData();
    formData.append("idLine", lineId);
    formData.append("lineName", lineName);
    formData.append("origin", origin);
    formData.append("destination", destination);
    formData.append("departureDate", departureDate);
    formData.append("departureTime", departureTime);
    formData.append("arrivalTime", arrivalTime);
    formData.append("idBus", idBus);
    formData.append("price", price);

    // Realizar una solicitud POST
    fetch(`index.php?c=line&m=editLine&id=${lineId}`, {
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
        // Puedes agregar animaciones aquí
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  // Llama a la función para obtener y mostrar los datos de la línea al cargar la página
  fetchLineData();
});
