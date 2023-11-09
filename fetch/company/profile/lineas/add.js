document.addEventListener("DOMContentLoaded", function () {
  const lineForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");

  lineForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const lineName = document.getElementById("lineName").value.trim();
    const origin = document.getElementById("origin").value.trim();
    const destination = document.getElementById("destination").value.trim();
    const departureTime = document.getElementById("departureTime").value.trim();
    const arrivalTime = document.getElementById("arrivalTime").value.trim();
    const idBus = document.getElementById("idBus").value.trim();

    if (
      !lineName ||
      !origin ||
      !destination ||
      !departureTime ||
      !arrivalTime ||
      !idBus
    ) {
      dataMsg.innerHTML = "Complete todos los campos.";
      return;
    }

    const formData = new FormData();
    formData.append("lineName", lineName);
    formData.append("origin", origin);
    formData.append("destination", destination);
    formData.append("departureTime", departureTime);
    formData.append("arrivalTime", arrivalTime);
    formData.append("idBus", idBus);

    fetch("index.php?c=line&m=newLine", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "error") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.add("msg_error");
        } else if (data.status === "success") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.remove("msg_error");
          dataMsg.classList.add("msg_success");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
