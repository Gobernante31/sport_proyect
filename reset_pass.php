<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/reset_password.css">
  <title>Restablecer Contraseña</title>
</head>

<body>
  <div class="reset-container">
    <form action="" method="post">
      <h2>Restablecer Contraseña</h2>

      <?php
      require_once './php/controlador_reset_password.php';
      ?>

      <div class="input_box">
        <input type="password" id="password" name="password" placeholder="Contraseña" required />
        <span class="error-message" id="password-error"></span>
      </div>

      <div class="input_box">
        <input type="password" id="confirmar_password" name="confirmar_password" placeholder="Confirmar Contraseña" required />
        <span class="error-message" id="confirmar-password-error"></span>
      </div>


      <button class="button" name="btnRestablecer" type="submit">Restablecer Contraseña</button>

      <div class="home-link">
        <a href="./index.php">Inicio</a>
      </div>
    </form>
  </div>

  <script src="./js/validacion.js"></script>
</body>

</html>