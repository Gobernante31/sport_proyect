<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

class Mailer
{
  public function enviarEmail($email, $asunto, $cuerpo)
  {
    require_once './phpmailer/src/Exception.php';
    require_once './phpmailer/src/PHPMailer.php';
    require_once './phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.office365.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'correoejemplo@hotmail.com'; //CAMBIAR ESTO POR UN CORREO REAL DE HOTMAIL
      $mail->Password = 'contraseñaejemplo123'; //CAMBIAR ESTO POR UNA CONTRASEÑA REAL DE HOTMAIL
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->setFrom('correoejemplo@hotmail.com', 'nombreejemplo'); //CAMBIAR ESTO POR UN CORREO REAL DE HOTMAIL
      $mail->setLanguage('es', './phpmailer/language/');

      $mail->addAddress($email);
      $mail->CharSet = 'UTF-8';

      $mail->isHTML(true);
      $mail->Subject = $asunto;

      $mail->Body = $cuerpo;

      if ($mail->send()) {
        return true;
      } else {
        throw new Exception($mail->ErrorInfo);
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
