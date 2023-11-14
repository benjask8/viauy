document.addEventListener("DOMContentLoaded", function () {
  const dataMsg = document.getElementById("data-msg");
  const lineDataBox = document.getElementById("line-data-box");
  const viewBackBtn = document.querySelector(".view-volver-btn");
  const buyForm = document.getElementById("buy-form");
  const renderFactura = document.getElementById("render-factura");

  let actualUser = null;
  let seatAvailability = []; // Almacena la disponibilidad de los asientos

  var lineData = null;
  var busData = null;

  // Obtén el ID de la línea de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const lineId = urlParams.get("lineid");

  const fetchSeatAvailability = async () => {
    try {
      const response = await fetch(
        `?c=reservation&m=getSeatAvailability&lineId=${lineId}`
      );
      const data = await response.json();

      if (data.status === "success") {
        seatAvailability = data.seatAvailability;
        console.log("Disponibilidad de asientos:", seatAvailability);
      } else {
        console.error("Error al obtener la disponibilidad de asientos");
      }
    } catch (error) {
      console.error("Error:", error);
    }
  };

  const fetchLineData = () => {
    fetch(`?c=line&m=getLineData&lineid=${lineId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          lineData = data.line;
          busData = data.bus;
          const lineTime = data.lineTime;
          const seatLayout = busData.seatLayout.split(",");

          console.log(seatLayout);
          viewBackBtn.href = `?c=index&m=viewLine&lineid=${lineData.idLine}`;

          console.log(lineTime);

          // Carga la disponibilidad de asientos antes de renderizar el diseño
          fetchSeatAvailability().then(() => {
            // Crea dinámicamente la cadena HTML para la información de pasaje
            const passageInfoHTML = `
              <section class="line-data-box-form-box">
                <p class="line-data-box-form-box-title">Informacion del Pasaje</p>
                <form class="line-data-box-form" id="passage-form">
                  <p class="line-data-box-form-company">${lineData.ownerLine} - ${lineData.lineName}</p>
                  <p class="line-data-box-form-departuredate"><i class="fa-regular fa-calendar"></i> ${lineData.departureDate}</p>
                  <p class="line-data-box-form-arrivaltime"><i class="fa-solid fa-bus"></i> ${lineData.departureTime} - ${lineData.origin}</p>
                  <i class="line-data-box-form-route"></i>
                  <p class="line-data-box-form-departuretime"><i class="fa-solid fa-location-dot"></i> ${lineData.arrivalTime} - ${lineData.destination}</p>
                  <p class="line-data-box-form-price">${lineData.linePrice},00 UYU$</p>
                </form>
              </section>
              <p class="sub-title">Elegir Asiento</p>

            `;

            // Crea dinámicamente la cadena HTML para el diseño de asientos
            const seatLayoutHTML = generateSeatPreview(
              seatLayout,
              seatAvailability
            );
            lineDataBox.innerHTML = passageInfoHTML + seatLayoutHTML + ``;

            // Asigna la cadena HTML al innerHTML de lineDataBox

            // Actualiza otros elementos según sea necesario
          });
        } else {
          // Manejar el caso de error
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };
  const generateSeatPreview = (seats, seatsOccupied) => {
    let seatPreviewHTML = '<section class="seat-layout-section">';
    const labels = "abcdefghijklmnopqrstuvwxyz".split("");

    seats.forEach((seatsInRow, rowIndex) => {
      seatPreviewHTML += `<div class="seat-row">`;

      for (let i = 0; i < seatsInRow; i++) {
        const seatLetter = labels[rowIndex];
        const isAvailable = !seatsOccupied.includes(`${seatLetter}-${i + 1}`);
        const seatId = `${seatLetter}-${i + 1}`;

        // Agrega una sección para cada letra de asiento
        if (i === 0) {
          seatPreviewHTML += `<div class="seat-section" data-section="${seatLetter}"></div>`;
        }

        seatPreviewHTML += `
          <div class="seat ${
            isAvailable ? "seat-available" : "seat-unavailable"
          }">
            <label for="seat-${seatId}" class="seat-label ${
          isAvailable ? "" : "seat-label-disable"
        }">${seatId}</label>
            <input type="radio" id="seat-${seatId}" class="seat-radio ${
          isAvailable ? "" : "seat-disabled"
        }" name="seat-group" ${isAvailable ? "" : "disabled"}>
          </div>
        `;
      }

      seatPreviewHTML += `</div>`;
    });

    seatPreviewHTML += `</section>`;
    return seatPreviewHTML;
  };

  const fetchActualUser = async () => {
    try {
      const response = await fetch(`?c=user&m=getActualUser`);
      const data = await response.json();

      if (data.status === "success") {
        return data.user;
      } else {
        return null; // Puedes devolver null u otro valor para indicar que no hay un usuario actual
      }
    } catch (error) {
      console.error("Error:", error);
      return null; // Manejar el error y devolver null u otro valor
    }
  };

  buyForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    actualUser = await fetchActualUser(); // Esperamos a que se resuelva la promesa antes de asignar actualUser
    const fechaActual = new Date();

    // Obten los componentes de la fecha
    const dia = fechaActual.getDate();
    const mes = fechaActual.getMonth() + 1; // ¡Recuerda que los meses comienzan desde 0!
    const año = fechaActual.getFullYear();

    // Formatea la fecha en formato dd/mm/yyyy
    const fechaFormateada = `${dia < 10 ? "0" : ""}${dia}/${
      mes < 10 ? "0" : ""
    }${mes}/${año}`;

    // Recopila los datos de los asientos seleccionados
    const selectedSeats = [];
    const seatRadios = document.querySelectorAll(".seat-radio:checked");
    seatRadios.forEach((radio) => {
      const seatId = radio.id.replace("seat-", "");
      selectedSeats.push(seatId);
    });

    console.log(
      "Asientos seleccionados:",
      selectedSeats[0],
      "user",
      actualUser
    );
    const formData = new FormData();
    formData.append("user", actualUser);
    formData.append("seat", selectedSeats[0]);
    formData.append("lineId", lineId);

    try {
      // Realiza la solicitud Fetch
      fetch("?c=reservation&m=makeReservation", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status == "success") {
            renderFactura.innerHTML = `
            <div class="factura-header">
    <h2>Factura de Compra</h2>
    <p>Fecha: ${fechaFormateada}</p>
  </div>

  <div class="factura-detalle">
    <h3>Detalles de la Compra</h3>
    <p><strong>Linea:</strong> ${lineData.lineName}</p>
    <p><strong>Empresa:</strong> ${lineData.ownerLine}</p>
    <p><strong>Origen:</strong> ${lineData.origin}</p>
    <p><strong>Destino:</strong> ${lineData.destination}</p>
    <p><strong>Fecha de Salida:</strong> ${lineData.departureDate}</p>
    <p><strong>Hora de Salida:</strong> ${lineData.departureTime}</p>
    <p><strong>Asiento:</strong> ${selectedSeats[0]}</p>
    <p><strong>Precio:</strong> ${lineData.linePrice},00 UYU$</p>
  </div>

  <div class="factura-total">
    <h3>Total a Pagar</h3>
    <p><strong>Total:</strong> ${lineData.linePrice},00 UYU$</p>
  </div>

  <div class="factura-informacion">
    <h3>Información del Usuario</h3>
    <p><strong>Nombre:</strong> ${actualUser}</p>
  </div>

  <div class="factura-pie">
    <p>¡Gracias por tu compra!</p>
  </div>
            `;
            dataMsg.innerHTML = "";
          } else {
            dataMsg.innerHTML = data.msg;
          }
        });
    } catch (error) {
      console.error("Error:", error);
    }

    fetchLineData();
  });

  fetchLineData();
});
