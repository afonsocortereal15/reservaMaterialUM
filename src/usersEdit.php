<?php
include("../inc/connect.inc");

if (isset($_GET["user"])) {
  $user = $_GET["user"];
  $sql = "SELECT nameUser FROM users WHERE idUser=$user";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $strUser = "Editar utilizador: " . $rows[0]['nameUser'];
}

if(isset($_GET["idUser"])) {
  $idUser=$_GET["idUser"];
  $nameUser=$_GET["nameUser"];

  $sql = "UPDATE users SET idUser=$idUser, nameUser='$nameUser' WHERE idUser=$idUser";
  if (mysqli_query($conn, $sql)) {
    header("Location:../public/dashboardUsers.php?user=".$idUser);
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}

function printForm($user) {
  global $conn;
  $sql ="SELECT * FROM users WHERE idUser=$user";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo '
  <form action="../src/usersEdit.php" method="GET">
    <div class="input-group mb-3">
      <span class="input-group-text" id="idUser">ID</span>
      <input type="text" class="form-control" value="'. $rows[0]['idUser'] .'"  id="idUser" name="idUser" readonly>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="nameUser">Nome</span>
      <input type="text" class="form-control" value="'. $rows[0]['nameUser'] .'"  id="nameUser" name="nameUser">
    </div>
    <button type="submit" class="btn save-btn">Guardar</button>
    
    <button type="button" class="btn btn-danger" id="delete-btn" onclick="deleteUser('. $user .')">Apagar Utilizador</button>
  </form>
  ';
}

function deleteUser($user) {
  global $conn;
  echo $user;
  $sql ="DELETE FROM users WHERE idUser=$user";
  if (mysqli_query($conn, $sql)) {
    echo "apagado";
  } else {
    // If there was an error, display the error message
    echo "Error: ". $sql. "<br>". mysqli_error($conn);
  }
}
