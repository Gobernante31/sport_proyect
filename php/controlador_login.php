<?php
session_start();

ini_set('error_reporting', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once 'conexion.php';

  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $select_stmt = $conn->prepare("SELECT UserID, Email, Password, Activacion FROM users WHERE Email = ?");
  $select_stmt->bind_param("s", $email);
  $select_stmt->execute();
  $select_stmt->store_result();

  if ($select_stmt->num_rows > 0) {
    $select_stmt->bind_result($userID, $dbEmail, $dbPassword, $activacion);
    $select_stmt->fetch();
    if ($activacion == 1) {
      if (password_verify($password, $dbPassword)) {
        $_SESSION['UserID'] = $userID;
        header("Location: canchas.php");
        exit();
      } else {
        echo '<div class="mensaje_error" id="message">La contraseña es incorrecta.</div>';
      }
    } else {
      echo '<div class="mensaje_error" id="message">Tu cuenta aún no ha sido activada. Por favor, verifica tu correo electrónico.</div>';
    }
  } else {
    echo '<div class="mensaje_error" id="message">No se encontró ninguna cuenta con ese correo electrónico.</div>';
  }
  $conn->close();
}
