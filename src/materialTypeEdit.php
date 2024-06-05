<?php
include("../inc/connect.inc");

if (isset($_GET["type"])) {
  $type = $_GET["type"];
  $sql = "SELECT nameType FROM materialtype WHERE idType=$type";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $strType = "Editar tipo: " . $rows[0]['nameType'];
}

if(isset($_GET["idType"])) {
  $idType=$_GET["idType"];
  $nameType=$_GET["nameType"];

  $sql = "UPDATE materialtype SET idtype=$idType, nameType='$nameType' WHERE idType=$idType";
  if (mysqli_query($conn, $sql)) {
    header("Location:../public/dashboardMaterialTypes.php?type=".$idType);
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}

function printForm($type) {
  global $conn;
  $sql ="SELECT * FROM materialtype WHERE idType=$type";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo '
  <form action="../src/materialTypeEdit.php" method="GET">
    <div class="input-group mb-3">
      <span class="input-group-text" id="idType">ID</span>
      <input type="text" class="form-control" value="'. $rows[0]['idType'] .'" aria-describedby="idType"  id="idType" name="idType" readonly>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="nameType">Nome</span>
      <input type="text" class="form-control" value="'. $rows[0]['nameType'] .'" aria-describedby="nameType" id="nameType" name="nameType">
    </div>
    <button type="submit" class="btn save-btn">Guardar</button>
    
    <button type="button" class="btn btn-danger" id="delete-btn" onclick="deleteType('. $type .')">Apagar Tipo</button>
  </form>
  ';
}

function deleteType($type) {
  global $conn;
  echo $type;
  $sql ="DELETE FROM materialtype WHERE idType=$type";
  if (mysqli_query($conn, $sql)) {
    echo "apagado";
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}
