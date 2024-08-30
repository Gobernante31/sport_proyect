<?php
$serverdb = "localhost";
$database = "sport_proyect";
$userdb = "root";
$passdb = "";

$conn = new mysqli($serverdb, $userdb, $passdb, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  echo "Errores de conexión: " . $conn->connect_error;
}
