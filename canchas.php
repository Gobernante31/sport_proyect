<?php
session_start();
if (empty($_SESSION['UserID'])) {
  header("Location: login.php");
  exit();
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/canchas.css">
  <title>Canchas</title>
</head>

<body>
  <header>
    <h1>Sports J.S.A</h1>

    <div class="container-icon button">
      <a href="./index.php">
        <img src="./img/verificar.png" height="40px">
        <span>Inicio</span>
      </a>
    </div>
    <div class="container-icon button">
      <a href="./agenda.php">
        <img src="./img/calendario.png" height="40px">
        <span>Agendar</span>
      </a>
    </div>
    <div class="container-icon button close-session">
      <a href="./php/controlador_cerrar_sesion.php">
        <img src="./img/verificar.png" height="40px">
        <span>Cerrar Sesión</span>
      </a>
    </div>
  </header>

  <div class="container-items">
    <?php
    function renderCancha($imgSrc, $nombre)
    {
    ?>
      <div class="item">
        <figure>
          <img src="<?= $imgSrc ?>" alt="<?= $nombre ?>">
        </figure>
        <div class="inf-canchas">
          <h2><?= $nombre ?></h2>
          <a href="https://wa.me/?text=Quiero agendar">
            <button>Agendar</button>
          </a>
        </div>
      </div>
    <?php
    }

    renderCancha("./img/basket.jpg", "BASQUETBALL");
    renderCancha("./img/Futbol.jpg", "FUTBOL");
    renderCancha("./img/Beisbol.jpg", "BEISBOL");
    renderCancha("./img/Voleibol.jpg", "VOLEIBOL");
    renderCancha("./img/Tennis.jpg", "TENNIS");
    renderCancha("./img/Multifuncional.jpg", "Cancha Multiple");
    ?>
    <br>
  </div>
</body>

</html>