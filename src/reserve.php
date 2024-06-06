<?php
// Include the necessary connection file
include("../inc/connect.inc");

// Convert the start and end reservation times from ISO 8601 format to MySQL datetime format
$startReservation = str_replace("T", " ", $_POST['startReservation']);
$endReservation = str_replace("T", " ", $_POST['endReservation']);

// Get the user and material information from the POST request
$user = $_POST['user'];
$material = $_POST['material'];

// Prepare the SQL query to insert a new reservation into the database
$sql = "INSERT INTO reservations VALUES (NULL, '$startReservation', '$endReservation', '$user', '$material')";

// Execute the SQL query and check for any errors
if (mysqli_query($conn, $sql)) {
  // If the reservation was successfully added, update the material status to 'reserved'
  $sql2 = "UPDATE materials SET statusMaterial = 1 WHERE materials.idMaterial = $material";
  mysqli_query($conn, $sql2);

  // Redirect the user to the search result page
  header("Location:../public/searchResult.php");
} else {
  // If there was an error, display the error message
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}
