document.addEventListener("DOMContentLoaded", function () {
  const signupForm = document.getElementById("signup-form");
  const dataMsg = document.getElementById("data-msg");
  const emailInput = document.getElementById("login-input-mail");
  const nameInput = document.getElementById("login-input-username");
  const passwordInput = document.getElementById("login-input-password");
  const passwordCInput = document.getElementById(
    "login-input-password-confirm"
  );

  signupForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Aquí puedes escribir el código para tomar los valores de los campos del formulario
    const email = emailInput.value.trim();
    const name = nameInput.value.trim();
    const password = passwordInput.value.trim();
    const passwordC = passwordCInput.value.trim();

    // Función para agregar o eliminar la clase "campo-vacio" en función de si el campo está vacío
    function validarCampo(campo, data) {
      if (data === "") {
        campo.classList.add("campo-vacio");
        dataMsg.innerHTML = "Complete los Campos Vacíos";
      } else {
        campo.classList.remove("campo-vacio");
      }
    }

    // Función para validar que el nombre de usuario contiene solo letras y números
    function validarNombreUsuario(nombreUsuario) {
      const regex = /^[a-zA-Z0-9]+$/; // Expresión regular que permite solo letras y números
      return regex.test(nombreUsuario);
    }

    // Validar campos vacíos
    validarCampo(emailInput, email);
    validarCampo(passwordInput, password);
    validarCampo(passwordCInput, passwordC);

    // Validación de longitud para contraseñas y nombres de usuario
    if (password.length < 8 || password.length > 18) {
      dataMsg.innerHTML = "La contraseña debe tener entre 8 y 18 caracteres.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    if (name.length < 6 || name.length > 18) {
      dataMsg.innerHTML =
        "El nombre de usuario debe tener entre 6 y 18 caracteres.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Verificar que el nombre de usuario contiene solo letras y números
    if (!validarNombreUsuario(name)) {
      dataMsg.innerHTML =
        "El nombre de usuario solo puede contener letras y números.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Verificar si algún campo de correo electrónico está vacío
    if (email === "") {
      dataMsg.innerHTML = "Por favor, llena el campo de correo electrónico.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Verificar que las contraseñas coincidan
    if (password !== passwordC) {
      dataMsg.innerHTML = "Las contraseñas no coinciden.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }
    // Crear un objeto FormData y agregar los datos del formulario
    const formData = new FormData();
    formData.append("email", email);
    formData.append("username", name);
    formData.append("password", password);
    formData.append("passwordC", passwordC);

    // Crear una solicitud POST
    fetch("index.php?c=user&m=doSignup", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Manejar la respuesta del controlador PHP aquí
        if (data.message) {
          dataMsg.innerHTML = data.message;
          dataMsg.classList.remove("msg-error");
          dataMsg.classList.add("msg-success");
        } else {
          dataMsg.innerHTML = "Respuesta inesperada del servidor";
          dataMsg.classList.remove("msg-success");
          dataMsg.classList.add("msg-error");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
