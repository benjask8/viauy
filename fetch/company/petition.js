document.addEventListener("DOMContentLoaded", function () {
  const petitionForm = document.querySelector(".company-container");
  const dataMsg = document.getElementById("data-msg");

  petitionForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Obtener los valores de los campos del formulario
    const companyName = document.getElementById("nombre_empresa").value.trim();
    const contactName = document.getElementById("nombre_contacto").value.trim();
    const contactEmail = document
      .getElementById("correo_contacto")
      .value.trim();
    const contactPhone = document
      .getElementById("telefono_contacto")
      .value.trim();
    const message = document.getElementById("mensaje").value.trim();

    // Validar campos (puedes agregar más validaciones si es necesario)
    if (
      !companyName ||
      !contactName ||
      !contactEmail ||
      !contactPhone ||
      !message
    ) {
      dataMsg.innerHTML = "Complete todos los campos.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Crear un objeto FormData y agregar los datos del formulario
    const formData = new FormData();
    formData.append("company-name", companyName);
    formData.append("contact-name", contactName);
    formData.append("contact-email", contactEmail);
    formData.append("contact-phone", contactPhone);
    formData.append("message", message);

    // Crear una solicitud POST
    fetch("index.php?c=company&m=newPetition", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Manejar la respuesta del controlador PHP aquí
        if (data.message === "success") {
          dataMsg.innerHTML = "Petición enviada con éxito";
          dataMsg.classList.remove("msg-error");
          dataMsg.classList.add("msg-success");
        } else {
          dataMsg.innerHTML = data.message;
          dataMsg.classList.remove("msg-success");
          dataMsg.classList.add("msg-error");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
  