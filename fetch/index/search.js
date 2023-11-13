document.addEventListener("DOMContentLoaded", function () {
  const lineForm = document.querySelector(".hero-form");
  const salidaInput = document.querySelector("#hero-salida");
  const destinoInput = document.querySelector("#hero-destino");
  const dateInput = document.querySelector("#hero-date");
  const dataMsg = document.getElementById("data-msg");
  const linesContainer = document.getElementById("lines-container-lines");
  const headerP = document.querySelector(".results-p");
  const heroBtn = document.getElementById("hero-btn");

  // Función para renderizar los resultados de búsqueda
  const renderSearchResults = (lines, buses) => {
    linesContainer.innerHTML = ""; // Borra los resultados anteriores

    if (lines.length === 0) {
      dataMsg.innerHTML = "No se encontraron resultados para la búsqueda.";
      dataMsg.classList.remove("msg_success");
      dataMsg.classList.add("msg_info");
    } else {
      dataMsg.innerHTML = "";
      dataMsg.classList.remove("msg_info");
      var container = "";
      var origin;
      var destination;
      // Recorre los resultados y crea elementos HTML para mostrar cada línea
      var a = 0;
      lines.forEach((line) => {
        if (buses[a]) {
          container += `
            <a href="?c=index&m=viewLine&lineid=${line.idLine}" class="line-box">                                                                 
              <div class="line-box-info">
                <div class="line-box-info-owner">
                  <p class="line-box-owner"> ${line.ownerLine}</p>
                  <p class="line-box-name">${line.lineName}</p>
                </div>
                <div class="line-box-info-box">
                <div class="line-box-info-time">
                  <p class="line-box-info-time-time">${line.departureTime}</p>  
                  <p class="line-box-info-time-origin">${line.origin}</p>
                </div>
                <span class="material-symbols-outlined">trending_flat</span>
                <div class="line-box-info-time">
                  <p class="line-box-info-time-time">${line.arrivalTime}</p>  
                  <p class="line-box-info-time-origin">${line.destination}</p>
                </div>
                </div>
                <div class="line-box-has">
          `;

          // Si tiene WiFi, agrega el ícono sin la clase "has-line"
          if (buses[a].hasWiFi) {
            container += `<p><i class="fa-solid fa-wifi"></i></p>`;
          }
          // Si tiene AC, agrega el ícono sin la clase "has-line"
          if (buses[a].hasAC) {
            container += `<p><i class="fa-solid fa-wind"></i></p>`;
          }
          // Si tiene baño, agrega el ícono sin la clase "has-line"
          if (buses[a].hasToilet) {
            container += `<p><i class="fa-solid fa-restroom"></i></p>`;
          }

          container += `
                </div>
              </div>
              <div class="line-box-options">
              <button class="line-price">$100</button>
              </div>
            </a>`;
        } else {
          container += `
            <a href="?c=index&m=viewLine&lineid=${line.idLine}" class="line-box">                                                                 
              <div class="line-box-info">
                <div class="line-box-info-owner">
                  <p class="line-box-owner"> ${line.ownerLine}</p>
                  <p class="line-box-name">${line.lineName}</p>
                </div>
                <div class="line-box-info-box">
                <div class="line-box-info-time">
                  <p class="line-box-info-time-time">${line.departureTime}</p>  
                  <p class="line-box-info-time-origin">${line.origin}</p>
                </div>
                <span class="material-symbols-outlined">trending_flat</span>
                <div class="line-box-info-time">
                  <p class="line-box-info-time-time">${line.arrivalTime}</p>  
                  <p class="line-box-info-time-origin">${line.destination}</p>
                </div>
                </div>
                <div class="line-box-has">
                </div>
              
              </div>
            <div class="line-box-options">
              <button class="line-price">$100</button>
              </div>
              </a>`;
        }

        a++;
        origin = line.origin;
        destination = line.destination;
      });

      linesContainer.innerHTML = `
        <div class="line-info-box">
          <p>Resultados desde ${origin}</p>
        </div>
      `;
      headerP.innerHTML = `${lines.length} Resultados`;
      linesContainer.innerHTML += container;
    }
  };

  // Función para realizar la búsqueda de líneas
  const performSearch = () => {
    const origin = salidaInput.value.trim();
    const destination = destinoInput.value.trim();
    const departureDate = dateInput.value;

    // Realizar una solicitud POST para buscar líneas
    fetch("index.php?c=line&m=searchLineByData", {
      method: "POST",
      body: new URLSearchParams({ origin, destination, departureDate }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "info") {
          openLinesContainer();
          renderSearchResults(data.lines, data.buses);
        }
        if (data.status === "error") {
          openLinesContainer();
          headerP.innerHTML = `No hay Resultados`;

          linesContainer.innerHTML = `
          <div class="no-results-box">
          <img src="public/images/hero/not-found.svg" class="not-found-image" alt=""></img>
          <p>No hemos podido encontrar viajes que coincidan con tus preferencias.</p>
          <button>Restablecer Los Filtros</button>
          </div>`;
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
