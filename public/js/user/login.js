document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.querySelector(".login-form");
  const dataMsg = document.getElementById("data-msg");
  const usernameInput = document.getElementById("login-input-mail");
  const passwordInput = document.getElementById("login-input-password");

  loginForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío automático del formulario

    // Aquí puedes escribir el código para tomar los valores de los campos del formulario
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Función para agregar o eliminar la clase "campo-vacio" en función de si el campo está vacío
    function validarCampo(campo, data) {
      if (data === "") {
        campo.classList.add("campo-vacio");
        dataMsg.innerHTML = "Complete los Campos Vacíos";
      } else {
        campo.classList.remove("campo-vacio");
      }
    }

    // Validar campos vacíos
    validarCampo(usernameInput, username);
    validarCampo(passwordInput, password);

    // Validación de longitud para contraseñas y nombres de usuario
    if (password.length < 8 || password.length > 18) {
      dataMsg.innerHTML = "La contraseña debe tener entre 8 y 18 caracteres.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Verificar si algún campo de nombre de usuario o contraseña está vacío
    if (username === "") {
      dataMsg.innerHTML = "Por favor, llena el campo de  Nombre de Usuario.";
      dataMsg.classList.remove("msg-success");
      dataMsg.classList.add("msg-error");
      return;
    }

    // Crear un objeto FormData y agregar los datos del formulario
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    // Crear una solicitud POST para el inicio de sesión
    fetch("index.php?c=user&m=doLogin", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Manejar la respuesta del controlador PHP aquí
        if (data.message === "success") {
          // Redirigir a una página de bienvenida
          window.location.href = "index.php?c=user&m=welcome&msg=bienvenido";
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
