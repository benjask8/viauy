document.addEventListener("DOMContentLoaded", function () {
  const requestForm = document.querySelector(".search-form");
  const searchInput = document.querySelector("#search-request");
  const dataMsg = document.getElementById("data-msg");
  const requestTableBody = document.getElementById("request-table-body");

  // Función para realizar la búsqueda de solicitudes
  const performSearch = () => {
    const searchTerm = searchInput.value.trim();

    // Realizar una solicitud POST para buscar solicitudes de empresa
    fetch("index.php?c=admin&m=searchRequests", {
      method: "POST",
      body: new URLSearchParams({ searchTerm }),
    })
      .then((response) => response.json())
      .then((data) => {
        // Manejar la respuesta del controlador PHP aquí
        if (data.status === "info" || data.status === "error") {
          dataMsg.innerHTML = data.msg;
          dataMsg.classList.remove("msg_success");
          dataMsg.classList.add("msg_info"); // Agrega una clase de estilo para mensajes informativos
        } else {
          dataMsg.innerHTML = "";
        }

        // Actualizar la tabla de solicitudes con los resultados de la búsqueda
        requestTableBody.innerHTML = "";

        data.companyRequests.forEach((request) => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${request.companyName}</td>
            <td>${request.contactName}</td>
            <td>${request.contactEmail}</td>
            <td>${request.contactPhone}</td>
            <td>${request.token}</td>
            <td>${request.id}</td>
            <td class="request-${request.status.toLowerCase()}">${
            request.status
          }</td>
            <td>${request.message}</td>
            <td>
              <form action="index.php?c=admin&m=dashboardOptionRequest" method="post" class="request-form">
                <input type="hidden" name="id" value="${request.id}">
                <select name="action" id="action" class="action-select">
                  <option value="accept">Aprobar</option>
                  <option value="deny">Denegar</option>
                </select>
                <input type="submit" value="Aceptar" class="submit-button">
              </form>
            </td>
          `;

          requestTableBody.appendChild(row);
        });
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  // Agregar un evento input para realizar la búsqueda mientras el usuario tipea
  searchInput.addEventListener("input", performSearch);

  // Agregar un evento submit al formulario de búsqueda
  requestForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del formulario
    performSearch(); // Realizar la búsqueda cuando se envía el formulario
  });

  // También puedes realizar la búsqueda cuando se carga la página inicialmente
  performSearch();
});
