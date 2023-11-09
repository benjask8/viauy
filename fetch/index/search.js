document.addEventListener("DOMContentLoaded", function () {
  const lineForm = document.querySelector(".hero-form");
  const salidaInput = document.querySelector("#hero-salida");
  const destinoInput = document.querySelector("#hero-destino");
  const horaInput = document.querySelector("#hero-hora");
  const dataMsg = document.getElementById("data-msg");
  const linesContainer = document.getElementById("lines-container-lines");

  // Función para renderizar los resultados de búsqueda
  const renderSearchResults = (lines) => {
    linesContainer.innerHTML = ""; // Borra los resultados anteriores

    if (lines.length === 0) {
      dataMsg.innerHTML = "No se encontraron resultados para la búsqueda.";
      dataMsg.classList.remove("msg_success");
      dataMsg.classList.add("msg_info");
    } else {
      dataMsg.innerHTML = "";
      dataMsg.classList.remove("msg_info");

      // Recorre los resultados y crea elementos HTML para mostrar cada línea
      lines.forEach((line) => {
        linesContainer.innerHTML += `
        <div class="line-box">
          <p>Origen: ${line.origin}</p>
          <p>Compañia: ${line.ownerLine}</p>
          <p>Destino: ${line.destination}</p>
          <p>Salida: ${line.departureTime}</p>
        </div>
        `;
      });
    }
  };

  // Función para realizar la búsqueda de líneas
  const performSearch = () => {
    const origin = salidaInput.value.trim();
    const destination = destinoInput.value.trim();
    const departureTime = horaInput.value;

    // Realizar una solicitud POST para buscar líneas
    fetch("index.php?c=line&m=searchLineByData", {
      method: "POST",
      body: new URLSearchParams({ origin, destination, departureTime }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "info") {
          renderSearchResults(data.lines);
        }
        if (data.status === "error") {
          linesContainer.innerHTML = `<img src="public/images/hero/not-found.svg" class="not-found-image" alt=""></img>`;
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.remove("msg_success");
          dataMsg.classList.add("msg_info");
        } else {
          dataMsg.innerHTML = "";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  // Agregar un evento submit al formulario para realizar la búsqueda
  lineForm.addEventListener("submit", function (event) {
    event.preventDefault();
    performSearch(); // Realizar la búsqueda cuando se envía el formulario
  });

  // También puedes realizar la búsqueda cuando se carga la página inicialmente
  // performSearch();
});
