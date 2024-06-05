<?php
include("../inc/connect.inc");

// Get the user information from the POST request
$nameUser = $_POST['nameUser'];
$typeUser = $_POST['typeUser'];

// Prepare the SQL query to insert a new reservation into the database
$sql = "INSERT INTO users VALUES (NULL, '$nameUser', $typeUser)";

// Execute the SQL query and check for any errors
if (mysqli_query($conn, $sql)) {
  // Redirect the user to the search result page
  header("Location:../public/dashboardUsers.php");
} else {
  // If there was an error, display the error message
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}
