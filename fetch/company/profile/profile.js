document.addEventListener("DOMContentLoaded", function () {
  const busForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");
  const datosContainer = document.getElementById("datos-container");
  // Obtén el ID del bus de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const name = urlParams.get("name");

  // Función para obtener los datos del bus y actualizar el formulario
  const fetchCompanyData = () => {
    fetch(`?c=company&m=getCompanyData&name=${name}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          const companyData = data.company;
          
          // Actualiza el contenido del elemento data-msg con la información de la compañía
          datosContainer.innerHTML = `
    <strong>Nombre de la Compañía:</strong> ${companyData.companyName}<br>
    <strong>Correo Electrónico:</strong> ${companyData.companyEmail}
  `;
        } else {
          dataMsg.innerHTML = "Compania no existe";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  fetchCompanyData();
});
