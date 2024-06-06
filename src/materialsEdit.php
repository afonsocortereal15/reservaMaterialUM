<?php
include("../inc/connect.inc");

if (isset($_GET["material"])) {
  $material = $_GET["material"];
  $sql = "SELECT nameMaterial FROM materials WHERE idMaterial=$material";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $strMaterial = "Editar material: " . $rows[0]['nameMaterial'];
}

if(isset($_GET["idMaterial"])) {
  $idMaterial=$_GET["idMaterial"];
  $nameMaterial=$_GET["nameMaterial"];

  $sql = "UPDATE materials SET idmaterial=$idMaterial, namematerial='$nameMaterial' WHERE idMaterial=$idMaterial";
  if (mysqli_query($conn, $sql)) {
    header("Location:../public/dashboards.php?material=".$idMaterial);
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}

function printForm($material) {
  global $conn;
  $sql ="SELECT * FROM materials WHERE idMaterial=$material";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo '
  <form action="../src/materialsEdit.php" method="GET">
    <div class="input-group mb-3">
      <span class="input-group-text" id="idMaterial">ID</span>
      <input type="text" class="form-control" value="'. $rows[0]['idMaterial'] .'"  id="idMaterial" name="idMaterial" readonly>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="nameMaterial">Nome</span>
      <input type="text" class="form-control" value="'. $rows[0]['nameMaterial'] .'" aria-describedby="nameaterial" id="nameaterial" name="nameaterial">
    </div>
    <button type="submit" class="btn save-btn">Guardar</button>
    
    <button type="button" class="btn btn-danger" id="delete-btn" onclick="deleteMaterial('. $material .')">Apagar Material</button>
  </form>
  ';
}

function deleteMaterial($material) {
  global $conn;
  echo $material;
  $sql ="DELETE FROM materials WHERE idMaterial=$material";
  if (mysqli_query($conn, $sql)) {
    echo "apagado";
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}
