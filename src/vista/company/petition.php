<?php
require 'src/vista/partials/head.php';

?>
<h1 class="page-title">Solicitud de Acceso a ViaUy</h1>
    <p class="page-description">Complete el formulario a continuación para solicitar acceso a la aplicación ViaUy como empresa de transporte de omnibuses:</p>
    
    <form action="index.php?c=company&m=newPetition" method="POST" class="company-container">
    <label for="nombre_empresa" class="form-label">Company Name:</label>
    <input type="text" id="nombre_empresa" name="company-name" required class="form-input">
    
    <label for="nombre_contacto" class="form-label">Contact Name:</label>
    <input type="text" id="nombre_contacto" name="contact-name" required class="form-input">
    
    <label for="correo_contacto" class="form-label">Contact Email:</label>
    <input type="email" id="correo_contacto" name="contact-email" required class="form-input">
    
    <label for="telefono_contacto" class="form-label">Contact Phone:</label>
    <input type="tel" id="telefono_contacto" name="contact-phone" required class="form-input">
    
    <label for="mensaje" class="form-label">Message:</label><br>
    <textarea id="mensaje" name="message" rows="4" cols="50" required class="form-textarea"></textarea>
    
    <input type="submit" value="Submit Petition" class="form-submit">
</form>


    <script>
        cambiarTitulo("ViaUy | Solicitud De Empresa");
    </script>
<?php
require 'src/vista/partials/footer.php';
?>