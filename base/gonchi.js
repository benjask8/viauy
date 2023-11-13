document.addEventListener("DOMContentLoaded", function () {
  const dataMsg = document.getElementById("data-msg");
  const lineDataBox = document.getElementById("line-data-box");
  const viewBackBtn = document.querySelector(".view-volver-btn");
  const buyForm = document.getElementById("buy-form");
  let actualUser = null;

  // Obtén el ID de la línea de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const lineId = urlParams.get("lineid");

  const fetchLineData = () => {
    fetch(`?c=line&m=getLineData&lineid=${lineId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const lineData = data.line;
          const busData = data.bus;
          const lineTime = data.lineTime;
          const seatLayout = busData.seatLayout.split(",");

          console.log(seatLayout);
          viewBackBtn.href = `?c=index&m=viewLine&lineid=${lineData.idLine}`;

          console.log(lineTime);

          // Crea dinámicamente la cadena HTML para la información de pasaje
          const passageInfoHTML = `
            <section class="line-data-box-form-box">
              <p class="line-data-box-form-box-title">Informacion del Pasaje</p>
              <form class="line-data-box-form" id="passage-form">
                <p class="line-data-box-form-company">${lineData.ownerLine} - ${lineData.lineName}</p>
                <p class="line-data-box-form-departuredate"><i class="fa-regular fa-calendar"></i> ${lineData.departureDate}</p>
                <p class="line-data-box-form-arrivaltime"><i class="fa-solid fa-arrow-right"></i> ${lineData.departureTime} - ${lineData.origin}</p>
                <i class="line-data-box-form-route"></i>
                <p class="line-data-box-form-departuretime"><i class="fa-solid fa-arrow-left"></i> ${lineData.arrivalTime} - ${lineData.destination}</p>
                <p class="line-data-box-form-price">${lineData.linePrice},00 UYU$</p>
              </form>
            </section>
          `;

          // Crea dinámicamente la cadena HTML para el diseño de asientos
          const seatLayoutHTML = generateSeatPreview(seatLayout);
          lineDataBox.innerHTML = passageInfoHTML + seatLayoutHTML;

          // Asigna la cadena HTML al innerHTML de lineDataBox

          // Actualiza otros elementos según sea necesario
        } else {
          // Manejar el caso de error
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const generateSeatPreview = (seats) => {
    let seatPreviewHTML = '<section class="seat-layout-section">';
    const labels = "abcdefghijklmnopqrstuvwxyz".split("");

    seats.forEach((seatsInRow, rowIndex) => {
      seatPreviewHTML += `<div class="seat-row">`;

      for (let i = 0; i < seatsInRow; i++) {
        const isAvailable = true; // Verdadero si el asiento está disponible

        seatPreviewHTML += `
    <div class="seat ${isAvailable ? "seat-available" : "seat-unavailable"}">
      <label for="seat-${labels[rowIndex]}-${i + 1}" class="seat-label">${
          labels[rowIndex]
        }-${i + 1}</label>
      <input type="checkbox" id="seat-${labels[rowIndex]}-${
          i + 1
        }" class="seat-checkbox" ${isAvailable ? "" : "disabled"}>
    </div>
  `;
      }

      seatPreviewHTML += `</div>`;
    });

    seatPreviewHTML += `</section>`;
    return seatPreviewHTML;
  };

  const fetchActualUser = () => {
    fetch(`?c=user&m=getActualUser`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const user = data.user;
          console.log("use");
          return user;
        } else {
          return "";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  buyForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    actualUser = await fetchActualUser(); // Esperamos a que se resuelva la promesa antes de asignar actualUser

    // Recopila los datos de los asientos seleccionados
    const selectedSeats = [];
    const seatCheckboxes = document.querySelectorAll(".seat-checkbox:checked");
    seatCheckboxes.forEach((checkbox) => {
      const seatId = checkbox.id.replace("seat-", "");
      selectedSeats.push(seatId);
    });

    // Puedes hacer lo que quieras con los datos de los asientos seleccionados, por ejemplo, enviarlos al servidor
    console.log("Asientos seleccionados:", selectedSeats, "user", actualUser);

    console.log(actualUser);

    // Aquí puedes continuar con el resto del código para enviar el formulario y manejar la respuesta del servidor
  });

  fetchLineData();
});
