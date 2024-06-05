<?php
include("../inc/connect.inc");

if (isset($_GET["type"])) {
  $type = $_GET["type"];
  deleteType($type);
}

function deleteType($type) {
  global $conn;
  $sql ="DELETE FROM materialtype WHERE idType=$type";
  if (mysqli_query($conn, $sql)) {
    echo "Tipo apagado";
    header("Location:../public/dashboardMaterialTypes.php");
  } else {
    // If there was an error, display the error message
    echo "Apenas pode apagar tipos sem materiais associados";
  }
}
