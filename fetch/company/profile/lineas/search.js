document.addEventListener("DOMContentLoaded", function () {
  const lineForm = document.querySelector(".buses-search");
  const searchInput = document.querySelector(".buses-search-input");
  const dataMsg = document.getElementById("data-msg");
  const searchButton = document.querySelector(
    ".buses-search input[type='submit']"
  );

  // Función para realizar la búsqueda
  const performSearch = () => {
    const searchTerm = searchInput.value.trim();

    // Realizar una solicitud POST para buscar líneas
    fetch("index.php?c=line&m=searchLines", {
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

        // Actualizar la tabla con los resultados de la búsqueda
        const tableBody = document.querySelector(".bus-table tbody");
        tableBody.innerHTML = "";

        data.lines.forEach((line) => {
          const row = document.createElement("tr");
          row.innerHTML = `
        <td>${line.lineName}</td>
        <td>${line.origin}</td>
        <td>${line.destination}</td>
        <td>${line.departureTime}</td>
        <td>${line.arrivalTime}</td>
        <td>${line.idBus}</td>
        <td>
          <a href="?c=line&m=deleteLine&id=${line.idLine}" class="delete-button" onclick="return confirm('¿Estás seguro de eliminar la línea?')">
            <span class="material-symbols-outlined">delete</span>
          </a>
          <a href="?c=company&m=mainProfile_lineasEdit&lineid=${line.idLine}" class="edit-button">
            <span class="material-symbols-outlined">edit</span>
          </a>
        </td>
      `;

          tableBody.appendChild(row);
        });
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  // Agregar un evento input para realizar la búsqueda mientras el usuario tipea
  searchInput.addEventListener("input", performSearch);

  // Agregar un evento click al botón de búsqueda
  searchButton.addEventListener("click", function (event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del botón
    performSearch(); // Realizar la búsqueda cuando se hace clic en el botón
  });

  // También puedes realizar la búsqueda cuando se carga la página inicialmente
  performSearch();
});
