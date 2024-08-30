<?php
session_start();
error_reporting(0);

require_once 'conexion.php';
require_once './lib/funciones.php';

$userID = $_GET['id'] ?? $_POST['UserID'] ?? '';
$Token = $_GET['token'] ?? $_POST['Token_password'] ?? '';

if ($userID == '' || $Token == '') {
  header("Location: login.php");
  exit();
  die();
}

if (!verificarTokenRequest($userID, $Token, $conn)) {
  header("Location: login.php");
  exit();
  die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $contraseña = trim($_POST["password"]);
  $confirmar_contraseña = trim($_POST["confirmar_password"]);

  $validacionContraseña = validarContraseña($contraseña);

  if ($contraseña !== $confirmar_contraseña) {
    echo '<div class="mensaje_error" id="message">Las contraseñas no coinciden.</div>';
  } elseif ($validacionContraseña !== true) {
    echo '<div class="mensaje_error" id="message">' . $validacionContraseña . '</div>';
  } else {
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    $updateStmt = $conn->prepare("UPDATE users SET Password = ?, Token_password = NULL, Password_request = 0 WHERE UserID = ?");
    $updateStmt->bind_param("ss", $hashed_password, $userID);

    if ($updateStmt->execute()) {
      $_SESSION['reset-ps'] = 'success';
      header("Location: login.php?reset-ps=success");
      exit();
      die();
    } else {
      echo '<div class="mensaje_error" id="message">Error al actualizar la contraseña.</div>';
    }
  }
} else {
  $conn->close();
}
