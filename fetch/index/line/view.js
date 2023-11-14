document.addEventListener("DOMContentLoaded", function () {
  const dataMsg = document.getElementById("data-msg");
  const lineDataBox = document.getElementById("line-data-box");
  // Obtén el ID de la línea de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const lineId = urlParams.get("lineid");

  // Función para obtener los datos de la línea y actualizar el formulario
  const fetchLineData = () => {
    fetch(`?c=line&m=getLineData&lineid=${lineId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const lineData = data.line;
          const busData = data.bus;
          const lineTime = data.lineTime;

          console.log(lineTime);
          // Crea dinámicamente la cadena HTML
          const htmlContent = `
            <section class="line-data-box-header">
              <h1 class="line-data-box-header-title">${lineData.ownerLine} - ${lineData.lineName}</h1>
              
            </section>
            <section class="line-data-box-info">
            <table class="line-data-box-info-table">
              <thead>
                <tr>
                  <th>Selección de Viaje</th>
                  <th>Flexibilidad y Condiciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="line-data-box-info-td">
                    <p class="line-data-box-info-td-origin"><i class="fa-solid fa-bus"></i> ${lineData.departureTime} - ${lineData.origin}</p>
                    <i class="line-data-box-info-td-route"></i>
                    <p class="line-data-box-info-td-time"><i class="fa-solid fa-clock"></i> ${lineTime.horas} Horas y ${lineTime.minutos} Minutos</p>
                    <i class="line-data-box-info-td-route-short line-data-box-info-td-route"></i>
                    <p class="line-data-box-info-td-destination"><i class="fa-solid fa-location-dot"></i> ${lineData.arrivalTime} - ${lineData.destination}</p>
                  </td>
                  <td class="line-data-box-info-td">
                    <p class="line-data-box-info-td-title">${lineData.lineName}</p>
                    <p class="line-data-box-info-td-info">Asientos - ${busData.maximum_capacity}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            </section>
            <section class="line-data-box-footer">
              <p class="line-data-box-footer-price">${lineData.linePrice},00 UYU$</p>
              <a href="?c=index&m=buyPassage&lineid=${lineData.idLine}" class="line-data-box-footer-buy">Continuar <span class="material-symbols-outlined">arrow_right_alt</span></a>
            </section>

          `;

          // Asigna la cadena HTML al innerHTML de lineDataBox
          lineDataBox.innerHTML = htmlContent;

          // Actualiza otros elementos según sea necesario
        } else {
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  fetchLineData();
});
