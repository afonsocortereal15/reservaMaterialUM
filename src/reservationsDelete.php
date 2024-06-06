<?php
include("../inc/connect.inc");

if (isset($_GET["reservation"])) {
  $reservation = $_GET["reservation"];
  deleteReservation($reservation);
}

function deleteReservation($reservation) {
  global $conn;
  $sql ="DELETE FROM reservations WHERE idReservation=$reservation";
  if (mysqli_query($conn, $sql)) {
    echo "Utilizador apagado";
    header("Location:../public/dashboardReservations.php");
  } else {
    // If there was an error, display the error message
    echo "Apenas pode apagar tipos sem materiais associados";
  }
}
