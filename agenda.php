<?php
session_start();
if (empty($_SESSION['UserID'])) {
  header("Location: login.php");
  exit();
  die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservas J_S_A</title>
  <style>
    body {
      background: linear-gradient(to top, transparent, rgb(94, 149, 243));
      height: 105vh;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #34495e;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #2980b9;
    }

    td.available {
      background-color: #3498db;
    }

    td.unavailable {
      background-color: #e74c3c;
    }

    #calendario-container {
      margin-top: 20px;
      text-align: center;
    }

    #reserva-form {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>

<body>

  <h2 style="text-align: center;">Reservas J_S_A</h2>

  <table>
    <thead>
      <tr>
        <th>Hora</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>09:00 AM</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>10:00 AM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
      </tr>
      <tr>
        <td>11:00 AM</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>12:00 PM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="unavailable">No Disponible</td>
      </tr>
      <tr>
        <td>01:00 PM</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>02:00 PM</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>03:00 PM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>04:00 PM</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>05:00 PM</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>06:00 PM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>07:00 PM</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>08:00 PM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
      </tr>
      <tr>
        <td>09:00 PM</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
        <td class="available">Disponible</td>
        <td class="available">Disponible</td>
        <td class="unavailable">No Disponible</td>
      </tr>
    </tbody>
  </table>

  <div id="calendario-container">
    <label for="fecha">Selecciona la fecha de reserva</label>
    <input type="date" id="fecha" name="fecha">
  </div>
  <br>
  <center>
    <a href="whatsapp://send?phone=123456789&text=¡Hola! ¿Cómo estás?">
      <button>Reservar</button>
    </a>
  </center>


  <script type="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr("#fecha", {
        disable: [
          function(date) {
            return (date.getDay() === 1 || date.getDay() === 2);
          }
        ],
        dateFormat: "Y-m-d",
        minDate: "today",
        enableTime: flase
      });
    });
  </script>



</body>

</html>