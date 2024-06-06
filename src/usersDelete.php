<?php
include("../inc/connect.inc");

if (isset($_GET["user"])) {
  $user = $_GET["user"];
  deleteUser($user);
}

function deleteUser($user) {
  global $conn;
  $sql ="DELETE FROM users WHERE idUser=$user";
  if (mysqli_query($conn, $sql)) {
    echo "Utilizador apagado";
    header("Location:../public/dashboardUsers.php");
  } else {
    // If there was an error, display the error message
    echo "Apenas pode apagar tipos sem materiais associados";
  }
}
