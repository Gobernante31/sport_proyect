<?php
require_once '../conexion.php';
ini_set('error_reporting', 0);

if (isset($_GET['token'])) {
  $Token = $_GET['token'];

  $stmt = $conn->prepare("SELECT UserID, Token FROM users WHERE Token = ?");
  $stmt->bind_param("s", $Token);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $user_id = $row['UserID'];

    $update_stmt = $conn->prepare("UPDATE users SET Activacion = 1, Token = NULL WHERE UserID = ?");
    $update_stmt->bind_param("i", $user_id);

    if ($update_stmt->execute()) {
      $_SESSION['verification'] = 'success';
      header("Location: ../login.php?verification=success");
      exit();
      die();
    } else {
      $_SESSION['verification'] = 'error';
      header("Location: ../login.php?verification=error");
      exit();
      die();
    }
  } else {
    $_SESSION['verification'] = 'error';
    header("Location: ../login.php?verification=error");
    exit();
    die();
  }
} else {
  echo "Token no proporcionado. Por favor, verifica el enlace.";
}

$conn->close();
