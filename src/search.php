<?php
// Include the connection file to establish a database connection
include("../inc/connect.inc");

// Get the search query from the URL parameter, default to empty string if not set
$searchQuery = isset($_GET['searchQuery']) ? htmlspecialchars($_GET['searchQuery']) : '';

// Function to print the materials table based on the search query
function printMaterialsTable() {
  // Use global variables for database connection and search query
  global $conn;
  global $searchQuery;

  // SQL query to select materials with names matching the search query
  $sql = "SELECT * FROM materials WHERE nameMaterial LIKE '%$searchQuery%'";
  $result = mysqli_query($conn, $sql);

  // Check if there are any results
  if (mysqli_num_rows($result) > 0) {
    // Loop through each result and print a table row
    while ($row = mysqli_fetch_assoc($result)) {
      // Determine the badge color and status based on the material status
      $badgeColor = $row['statusMaterial'] == 0 ? 'success' : 'danger';
      $status = $row['statusMaterial'] == 0 ? 'Não Reservado' : 'Reservado';

      // Print the table row with material information and status
      echo '
      <tr>
        <th scope="row">' . $row['idMaterial'] . '</th>
        <td>' . $row['nameMaterial'] . '</td>
        <td>' . $row['typeMaterial'] . '</td>
        <td><h5><span class="badge text-bg-' . $badgeColor . '">' . $status . '</span></h5></td>
      </tr>
      ';
    }
  }
}

// Function to print user reservations based on the user ID
function printUserReservations($userSearch) {
  // Use global variable for database connection
  global $conn;

  // Check if the user ID is set
  if (isset($userSearch)) {
    // SQL query to select reservations for the specified user
    $sql = "SELECT * FROM reservations WHERE idUser=$userSearch";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
      // Loop through each result and print a table row
      while ($row = mysqli_fetch_assoc($result)) {
        // Print the table row with reservation information
        echo '
      <tr>
        <th scope="row">' . $row['idReservation'] . '</th>
        <td>' . $row['idMaterial'] . '</td>
        <td>' . substr($row['startReservation'], 0, -3) . '</td>
        <td>' . substr($row['endReservation'], 0, -3) . '</td>
      </tr>
      ';
      }
    }
  }
}
