<?php
include("../inc/connect.inc");

if (isset($_GET["material"])) {
  $material = $_GET["material"];
  deleteMaterial($material);
}

function deleteMaterial($material) {
  global $conn;
  $sql ="DELETE FROM materials WHERE idMaterial=$material";
  if (mysqli_query($conn, $sql)) {
    echo "Material apagado";
    header("Location:../public/dashboardMaterials.php");
  } else {
    // If there was an error, display the error message
    echo "Apenas pode apagar tipos sem materiais associados";
  }
}
