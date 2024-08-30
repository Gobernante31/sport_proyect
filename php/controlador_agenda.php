<?php
$horas = array("08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM");


$disponibilidad = array(
  array(1, 1, 1, 1, 1, 1, 1),
  array(0, 0, 1, 1, 1, 1, 1),
  array(1, 1, 1, 1, 1, 1, 1),
);


foreach ($horas as $hora) {
  echo "<tr>";
  echo "<td>$hora</td>";


  foreach ($disponibilidad as $dias) {
    $clase = ($dias[array_search($hora, $horas)]) ? 'available' : 'unavailable';
    echo "<td class=\"$clase\">" . ($dias[array_search($hora, $horas)] ? 'Disponible' : 'No Disponible') . "</td>";
  }

  echo "</tr>";
}
