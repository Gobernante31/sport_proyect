<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/register.css">
  <title>Registro de Usuario</title>
</head>

<body>
  <div class="registro-container">
    <form action="" method="post">
      <h2>Registro de Usuario</h2>

      <?php
      require_once './php/controlador_register.php';
      ?>

      <div class="input_box">
        <input type="text" name="nombre" placeholder="Nombre" required />
        <span class="error-message" id="nombre-error"></span>
      </div>

      <div class="input_box">
        <input type="text" name="apellido" placeholder="Apellido" required />
        <span class="error-message" id="apellido-error"></span>
      </div>

      <div class="input_box">
        <input type="number" name="cedula" maxlength="10" min="1" max="2000000000" placeholder="Cédula" required />
        <span class="error-message" id="cedula-error"></span>
      </div>

      <div class="input_box">
        <input type="email" name="email" placeholder="Correo Electrónico" required />
        <span class="error-message" id="email-error"></span>
      </div>

      <div class="input_box">
        <input type="password" name="password" id="password" placeholder="Contraseña" required />
        <span class="error-message" id="password-error"></span>
      </div>

      <div class="input_box">
        <input type="password" name="confirmar_password" id="confirmar_password" placeholder="Confirmar Contraseña" required />
        <span class="error-message" id="confirmar-password-error"></span>
      </div>

      <button class="button" name="btnregistrar" type="submit">
        Registrar
      </button>

      <div class="login_link">
        ¿Ya tienes una cuenta? <a href="./login.php">Iniciar Sesión</a>
      </div>


    </form>
  </div>

  <script src="./js/validacion.js"></script>
</body>

</html>