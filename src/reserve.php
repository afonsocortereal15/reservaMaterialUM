<?php
include("../inc/connect.inc");

  global $conn;
  $typeMaterial = $_POST['materialType'];
  $material = $_POST['material'];
  $startReservation = str_replace("T", " ", $_POST['startReservation']);
  $endReservation = str_replace("T", " ", $_POST['endReservation']);

  $sql = "INSERT INTO reservations VALUES (NULL, '$startReservation', '$endReservation', '1', '2')";

  if (mysqli_query($conn, $sql)) {
    $sql2 = "UPDATE materials SET statusMaterial = 1 WHERE materials.idMaterial = $material";
    mysqli_query($conn, $sql2);

    header("Location: ../public/searchResult.php");
  } else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
  }
