<?php
include("../inc/connect.inc");

$searchQuery = isset($_GET['searchQuery']) ? htmlspecialchars($_GET['searchQuery']) : '';

function printTable() {
  global $conn;
  global $searchQuery;

  $sql = "SELECT * FROM materials WHERE nameMaterial LIKE '%$searchQuery%'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $badgeColor = $row['statusMaterial'] == 0 ? 'success' : 'danger';
      $status = $row['statusMaterial'] == 0 ? 'Não Reservado' : 'Reservado';

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

function materialOptions() {
}
