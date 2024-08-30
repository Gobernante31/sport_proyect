<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/request_password.css">
  <title>Recuperar Contraseña</title>
</head>

<body>
  <div class="recover-container">
    <form action="" method="post">
      <h2>Recuperación de Contraseña</h2>

      <?php
      require_once './php/controlador_request.php';
      ?>

      <div class="input_box">
        <input type="email" name="email" placeholder="Correo Electrónico" required />
        <i class="i-icon">✉️</i>
      </div>

      <button class="button" name="btnRecuperar" type="submit">Recuperar Contraseña</button>


      <div class="login_link">
        ¿Recordaste tu contraseña? <a href="./login.php">Iniciar Sesión</a>
      </div>

      <div class="home-link">
        <a href="./index.php">Inicio</a>
      </div>
    </form>
  </div>

  <script src="./js/validacion-reset.js"></script>

</body>

</html>