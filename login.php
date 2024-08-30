<?php
session_start();

ini_set('error_reporting', 0);

if (isset($_SESSION['UserID'])) {
  header("Location: canchas.php");
  exit();
  die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <title>Inicio de Sesión</title>
</head>

<body>
  <div class="login-container">
    <form action="" method="post">
      <h2>Iniciar sesión</h2>

      <?php
      require_once './php/controlador_login.php';
      ?>

      <div class="input_box">
        <input type="email" name="email" placeholder="Correo Electrónico" value="<?php echo $_POST['email']; ?>" required />
        <i class="uil uil-envelope-alt email"></i>
      </div>

      <div class="input_box">
        <input type="password" name="password" placeholder="Contraseña" required />
        <i class="uil uil-lock password"></i>
        <i class="uil uil-eye-slash pw_hide"></i>
      </div>

      <div class="option_field">
        <a href="./request_pass.php" class="forgot_pw">Olvidé mi contraseña</a>
      </div>

      <button class="button" name="btningresar" type="submit">
        Entrar
      </button>

      <div class="login_signup">
        ¿No tienes una cuenta? <a href="./register.php">Registrarse</a>
        <a href="./index.php">
          <i class="ri-home-2-line"></i>
        </a>
      </div>

      <div class="home-link">
        <a href="./index.php">Inicio</a>
      </div>
    </form>
  </div>
</body>

</html>