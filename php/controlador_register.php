<?php
require_once 'mailer.php';
require_once './lib/funciones.php';

ini_set('error_reporting', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once 'conexion.php';

  $cedula = trim($_POST["cedula"]);
  $nombre = trim($_POST["nombre"]);
  $apellido = trim($_POST["apellido"]);
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $confirmar_password = trim($_POST["confirmar_password"]);
  $token = generarToken();

  if ($password !== $confirmar_password) {
    echo '<div class="mensaje_error" id="message">Las contraseñas no coinciden.</div>';
  } else {
    $validacion_contraseña = validarContraseña($password);
    if ($validacion_contraseña !== true) {
      echo '<div class="mensaje_error" id="message">' . $validacion_contraseña . '</div>';
    } else {
      $cedula = filter_var($cedula, FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      $mailer = new Mailer();

      try {
        $conn->begin_transaction();

        $select_stmt = $conn->prepare("SELECT UserID FROM users WHERE Cedula = ?");
        $select_stmt->bind_param("s", $cedula);
        $select_stmt->execute();
        $select_stmt->store_result();

        if ($select_stmt->num_rows > 0) {
          echo '<div class="mensaje_error" id="message">Ya existe un usuario con esa cedula.</div>';
        } else {
          if (checkIfEmailExists($conn, $email)->num_rows > 0) {
            echo '<div class="mensaje_error" id="message">Ya existe un usuario con esta dirección de correo electrónico.</div>';
          } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_stmt = $conn->prepare("INSERT INTO users (Cedula, Nombre, Apellido, Email, Password, Token) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $email, $hashed_password, $token);

            if ($insert_stmt->execute()) {
              $userID = mysqli_insert_id($conn);

              if (empty($errors)) {
                $url = 'http://localhost/sport_proyect/php/verify.php?user=' . $nombre . '&token=' . $token;
                $asunto = "Activar cuenta";
                $cuerpo = "<h4>¡Hola " . ucfirst($nombre) . "!</h4>";
                $cuerpo .= "<p>¡Gracias por registrarte! <br>Antes de comenzar, solo necesitamos confirmar que eres tú. <br><br>Haga clic a continuación para verificar su dirección de correo electrónico: </p>";
                $cuerpo .= "<a href='$url'>Activar cuenta</a>";

                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                  echo '<div class="mensaje_ok" id="verify-message">El correo de verificación se ha enviado a la dirección: ' . $email . '</div>';
                } else {
                  throw new Exception("Ha ocurrido un error al enviar el correo. Asegúrate de que la dirección de correo sea válida.");
                }
              } else {
              }
            } else {
              throw new Exception("¡Lo siento, ha ocurrido un error al registrar al usuario!");
            }
          }
        }
        $conn->commit();
      } catch (Exception $e) {
        $conn->rollback();
        echo '<div class="mensaje_error" id="message">' . $e->getMessage() . '</div>';
      }
    }
  }

  $conn->close();
}
