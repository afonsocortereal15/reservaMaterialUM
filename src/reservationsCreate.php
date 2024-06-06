<?php
include("../inc/connect.inc");

// Get the user information from the POST request
$idUser = $_POST['user'];
$idMaterial = $_POST['material'];
$startReservation = $_POST['startReservation'];
$endReservation= $_POST['endReservation'];

// Prepare the SQL query to insert a new reservation into the database
$sql = "INSERT INTO reservations VALUES (NULL, '$startReservation', '$endReservation', $idUser, $idMaterial)";

// Execute the SQL query and check for any errors
if (mysqli_query($conn, $sql)) {
  // Redirect the user to the search result page
  header("Location:../public/dashboardReservations.php");
} else {
  // If there was an error, display the error message
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}
