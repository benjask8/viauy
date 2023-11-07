const seatLayoutInput = document.getElementById("seatLayout");
const previewContainer = document.getElementById("seat-preview");
const maxCapacityInput = document.getElementById("capacidad"); // Agregamos esta línea

seatLayoutInput.addEventListener("input", updateSeatPreview);

function updateSeatPreview() {
  const layoutString = seatLayoutInput.value;
  const maxCapacity = parseInt(maxCapacityInput.value, 10);

  if (validateSeatLayout(layoutString)) {
    const seatArray = layoutString.split(",").map(Number);

    const totalSeats = seatArray.reduce((a, b) => a + b, 0);
    const availableSeats = maxCapacity - totalSeats;
    const isValid =
      seatArray.every((num) => num <= 8) && totalSeats <= maxCapacity;

    if (isValid) {
      const previewHTML = generateSeatPreview(seatArray);
      previewContainer.innerHTML = previewHTML;

      // Actualiza el estado de los asientos
      document.getElementById("available-seats").textContent = availableSeats;
      return true;
    } else {
      previewContainer.innerHTML =
        "Los números de asientos no deben superar 8 y la suma no debe superar la capacidad del bus.";
      return false;
    }
  } else {
    previewContainer.innerHTML =
      "Formato incorrecto. Usa números separados por comas.";
    return false;
  }
}

function validateSeatLayout(layout) {
  const pattern = /^\d+(,\d{1,8})*$/;
  return pattern.test(layout);
}

function generateSeatPreview(seats) {
  let seatPreviewHTML = '<table class="seat-layout-table">';
  const labels = "abcdefghijklmnopqrstuvwxyz".split(""); // Etiquetas personalizadas

  seats.forEach((seatsInRow, rowIndex) => {
    seatPreviewHTML += "<tr>";

    for (let i = 0; i < seatsInRow; i++) {
      const isAvailable = i % 2 === 0 ? "seat-available" : "seat-unavailable";
      seatPreviewHTML += `<td class="seat ${isAvailable}">${labels[rowIndex]}-${
        i + 1
      }</td>`;
    }

    seatPreviewHTML += "</tr>";
  });

  seatPreviewHTML += "</table>";
  return seatPreviewHTML;
}

function validateInput(input) {
  var pattern = /^[A-Za-z0-9]*$/;
  if (!pattern.test(input.value)) {
    input.value = input.value.replace(/[^A-Za-z0-9]/g, "");
  }
}
