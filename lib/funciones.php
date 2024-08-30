<?php
require_once 'conexion.php';


function insertarUsuario($nombre, $apellido, $cedula, $email, $password, $activacion, $token)
{
  global $conexion;

  $stmt = $conexion->prepare("INSERT INTO users (Nombre, Apellido, Cedula, Email, Password, Activacion, Token) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $nombre, $apellido, $cedula, $email, $password, $activacion, $token);

  $result = $stmt->execute();

  $stmt->close();

  return $result;
}

function buscarUsuarioRepetido($email)
{
  global $conexion;

  $stmt = $conexion->prepare("SELECT * FROM users WHERE Email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result();
  $stmt->close();

  return $result->num_rows > 0;
}

function checkIfEmailExists($conn, $email)
{
  $select_stmt = $conn->prepare("SELECT UserID FROM users WHERE Email = ?");
  $select_stmt->bind_param("s", $email);
  $select_stmt->execute();

  return $select_stmt->get_result();
}

function validarContraseña($password)
{
  $errores = array();
  if (strlen($password) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres.";
  }
  if (!preg_match("/[a-z]/", $password)) {
    $errores[] = "La contraseña debe contener al menos una letra minúscula.";
  }
  if (!preg_match("/[A-Z]/", $password)) {
    $errores[] = "La contraseña debe contener al menos una letra mayúscula.";
  }
  return (empty($errores)) ? true : implode(" ", $errores);
}

function generarToken()
{
  return bin2hex(random_bytes(32));
}

function solicitarPassword($userID, $conn)
{
  $Token = generarToken();
  $stmt = $conn->prepare("UPDATE users SET Token_password = ?, Password_request = 1 WHERE UserID = ?");
  if ($stmt->bind_param("si", $Token, $userID) && $stmt->execute()) {
    return $Token;
  }
  return null;
}

function verificarTokenRequest($userID, $Token, $conn)
{
  $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserID = ? AND Token_password = ? AND Password_request = 1 LIMIT 1");
  $stmt->bind_param("is", $userID, $Token);
  $stmt->execute();
  $stmt->store_result();
  return $stmt->num_rows > 0;
}
