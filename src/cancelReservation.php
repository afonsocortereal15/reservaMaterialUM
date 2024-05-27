<?php
// Include the connection file to establish a database connection
include("../inc/connect.inc");

// Declare the global variable $conn to access the database connection
global $conn;

// Retrieve the reservation ID from the GET request
$idReservation = $_GET['cancelReservation'];

// Query to select all columns from the reservations table where the idReservation matches the provided ID
$sql = "SELECT * FROM reservations WHERE idReservation = $idReservation";

// Execute the query and store the result
$result = $conn->query($sql);

// Check if the query returned at least one row
if ($result->num_rows > 0) {
  // Loop through each row in the result set
  while ($row = $result->fetch_assoc()) {
    // Retrieve the idMaterial from the current row
    $idMaterial = $row["idMaterial"];
  }
}

// Query to delete the reservation with the matching ID
$sql2 = "DELETE FROM reservations WHERE idReservation = $idReservation";

// Execute the delete query
if (mysqli_query($conn, $sql2)) {
  // Query to update the status of the material to '0' (available) where the idMaterial matches
  $sql3 = "UPDATE materials SET statusMaterial = '0' WHERE materials.idMaterial = $idMaterial";
  
  // Execute the update query
  mysqli_query($conn, $sql3);
  
  // Redirect to the reservations page after successful deletion
  header("Location:../public/reservations.php?user=0");
} else {
  // Display an error message if the deletion fails
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}