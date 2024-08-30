<?php
session_start();

require_once 'conexion.php';
require_once './lib/funciones.php';
require_once './php/mailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email_ingresado = trim($_POST["email"]);

  if (checkIfEmailExists($conn, $email_ingresado)) {
    $sql = $conn->prepare("SELECT UserID, Nombre, Password_request FROM users WHERE Email = ?");
    $sql->bind_param("s", $email_ingresado);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $userID = $row["UserID"];
      $nombre = $row["Nombre"];
      $passwordRequest = $row["Password_request"];

      if ($passwordRequest == 0) {
        $token = solicitarPassword($userID, $conn);

        if ($token !== null) {
          $mailer = new Mailer();

          $reset_url = 'http://localhost/sport_proyect/reset_pass.php?id=' . $userID . '&token=' . $token;
          $asunto = "Restablecer contraseña";
          $cuerpo = "<h4>Hola " . htmlspecialchars($nombre) . ", han solicitado restablecer la contraseña.</h4>";
          $cuerpo .= "<p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. <br>Si no hiciste esta solicitud, puedes ignorar este mensaje. <br><br>Para restablecer tu contraseña, haz clic en el siguiente enlace: </p>";
          $cuerpo .= "<a href='$reset_url'>Restablecer contraseña</a>";

          if ($mailer->enviarEmail($email_ingresado, $asunto, $cuerpo)) {
            echo '<div class="mensaje_ok" id="verify-message">El correo de recuperación se ha enviado a la dirección: ' . htmlspecialchars($email_ingresado) . '</div>';

            $updateSql = $conn->prepare("UPDATE users SET Password_request = 1 WHERE UserID = ?");
            $updateSql->bind_param("i", $userID);
            $updateSql->execute();
          } else {
            echo '<div class="mensaje_error" id="message">Hubo un error al enviar el correo electrónico.</div>';
          }
        } else {
          echo '<div class="mensaje_error" id="message">Hubo un error al procesar la solicitud de restablecimiento de contraseña. Por favor, inténtalo de nuevo más tarde.</div>';
        }
      } else {
        echo '<div class="mensaje_error" id="message">Ya has solicitado restablecer la contraseña. Por favor, verifica tu correo electrónico.</div>';
      }
    } else {
      echo '<div class="mensaje_error" id="message">Hubo un error al obtener información del usuario.</div>';
    }
  } else {
    echo '<div class="mensaje_error" id="message">La dirección de correo electrónico no existe en nuestra base de datos.</div>';
  }
  $conn->close();
}
