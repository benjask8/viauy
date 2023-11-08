document.addEventListener("DOMContentLoaded", function () {
  const busForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  function validateInput(input) {
    var pattern = /^[A-Za-z0-9]*$/;

    if (!pattern.test(input.value)) {
      input.value = input.value.replace(/[^A-Za-z0-9]/g, "");
    }
  }

  function validateSeatLayout(input) {
    const pattern = /^\d+(,\d{1,8})*$/;
    return pattern.test(input.value);
  }

  busForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const busId = document.getElementById("matricula").value.trim();
    const model = document.getElementById("modelo").value.trim();
    const maxCapacity = document.getElementById("capacidad").value.trim();

    const hasToilet = document.getElementById("baño").checked ? 1 : 0;
    const hasWiFi = document.getElementById("wifi").checked ? 1 : 0;
    const hasAC = document.getElementById("ac").checked ? 1 : 0;
    const seatLayout = document.getElementById("seatLayout");

    if (!busId || !model || !maxCapacity || !validateSeatLayout(seatLayout)) {
      dataMsg.innerHTML =
        "Complete todos los campos y asegúrese de que la disposición de asientos sea válida.";
      addPopAnimation();
      return;
    }

    // Validar seatLayout similar a seatLayout.js
    const layoutString = seatLayout.value;
    const maxCapacityValue = parseInt(maxCapacity, 10);
    const seatArray = layoutString.split(",").map(Number);
    const totalSeats = seatArray.reduce((a, b) => a + b, 0);
    const availableSeats = maxCapacityValue - totalSeats;
    const isValid =
      seatArray.every((num) => num <= 8) && totalSeats == maxCapacityValue;

    if (!isValid) {
      dataMsg.innerHTML =
        "La disposición de asientos no es válida. Verifique que ningún número supere 8 y que la suma no exceda la capacidad del bus.";
      addPopAnimation();
      return;
    }

    const formData = new FormData();
    formData.append("busId", busId);
    formData.append("model", model);
    formData.append("maxCapacity", maxCapacity);
    formData.append("hasToilet", hasToilet);
    formData.append("hasWiFi", hasWiFi);
    formData.append("hasAC", hasAC);
    formData.append("seatLayout", seatLayout.value);

    fetch("index.php?c=bus&m=newBus", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "error") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.add("msg_error");
          dataMsg.classList.remove("msg_success");
        } else if (data.status === "success") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.remove("msg_error");
          dataMsg.classList.add("msg_success");
        }
        dataMsg.classList.toggle("pop");
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
