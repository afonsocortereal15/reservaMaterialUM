<?php
include("../inc/connect.inc");

// Get the user and material information from the POST request
$nameMaterial = $_POST['nameMaterial'];
$typeMaterial = $_POST['typeMaterial'];

// Prepare the SQL query to insert a new reservation into the database
$sql = "INSERT INTO materials VALUES (NULL, '$nameMaterial', 0, $typeMaterial)";

// Execute the SQL query and check for any errors
if (mysqli_query($conn, $sql)) {
  // Redirect the user to the search result page
  header("Location:../public/dashboardMaterials.php");
} else {
  // If there was an error, display the error message
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}
