<?php
include("../inc/connect.inc");

if (isset($_GET["reservation"])) {
  $reservation = $_GET["reservation"];
  $sql = "SELECT idReservation FROM reservations WHERE idReservation=$reservation";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $strReservation = "Editar reserva: " . $rows[0]['idReservation'];
}

if (isset($_GET["idReservation"])) {
  $idReservation = $_GET["idReservation"];
  $startReservation = str_replace("T", " ", $_GET['startReservation']);
  $endReservation = str_replace("T", " ", $_GET['endReservation']);
  $idUser = $_GET["user"];
  $idMaterial = $_GET["material"];

  $sql = "UPDATE reservations SET idReservation=$idReservation, startReservation='$startReservation', endReservation='$endReservation', idUser='$idUser', idMaterial='$idMaterial' WHERE idReservation=$idReservation";
  if (mysqli_query($conn, $sql)) {
    header("Location:../public/dashboardReservations.php?reservation=" . $idReservation);
  } else {
    // If there was an error, display the error message
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

function printForm($reservation)
{
  global $conn;
  $sql = "SELECT * FROM reservations WHERE idReservation=$reservation";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $idReservation = $rows[0]['idReservation'];
  $startReservation = $rows[0]['startReservation'];
  $endReservation = $rows[0]['endReservation'];
  $idUser = $rows[0]['idUser'];
  $idMaterial = $rows[0]['idMaterial'];
  $nameMaterial =$rows[0]['idMaterial'];

  $sql = "SELECT users.nameUser, users.idUser FROM users INNER JOIN reservations ON users.idUser=reservations.idUser WHERE idReservation=$idReservation";
  $result = $conn->query($sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo '
  <form action="../src/reservationsEdit.php" method="GET">
    <div class="input-group mb-3">
      <span class="input-group-text" id="idReservation">ID</span>
      <input type="text" class="form-control" value="' . $idReservation . '"  id="idReservation" name="idReservation" readonly>
    </div>

    <!-- User select -->
    <select class="mb-2 edit-select" id="user" name="user" required>
      <option value="'. $rows[0]["idUser"] .'" selected>'. $rows[0]["nameUser"] .'</option>
      ';
      
      $sql = "SELECT * FROM users";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value=". $row["idUser"] .">".  $row["nameUser"] ."</option>";
        }
      } else {
        echo "<option>SEM RESULTADOS - CONTACTAR ADMIN</option>";
      }
      $sql = "SELECT materials.nameMaterial, materials.idMaterial FROM materials INNER JOIN reservations ON materials.idMaterial=reservations.idMaterial WHERE idReservation=$idReservation";
      $result = $conn->query($sql);
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      echo '
    </select>

    <!-- Material select -->
    <select class="mb-2 edit-select" id="material" name="material" required>
      <option value="'. $rows[0]["idMaterial"] .'" selected>'. $rows[0]["nameMaterial"] .'</option>
      ';
      
      $sql = "SELECT * FROM materials";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value=\"" . $row["idMaterial"] . "\">" . $row["nameMaterial"] . "</option>";
        }
      } else {
        echo "<option>SEM RESULTADOS - CONTACTAR ADMIN</option>";
      }

      $sql = "SELECT startReservation, endReservation FROM reservations WHERE idReservation=$idReservation";
      $result = $conn->query($sql);
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $startReservation = str_replace(" ", "T", $rows[0]["startReservation"]);
      $endReservation = str_replace("", "T", $rows[0]["endReservation"]);

      echo '
    </select>

    <!-- Start reservation -->
    
    <input class="datetimePicker mb-2" type="datetime-local" id="startReservation" name="startReservation" value="'. $startReservation .'">

    <!-- End reservation -->
    <input class="datetimePicker mb-2" type="datetime-local" id="endReservation" name="endReservation" value="'. $endReservation .'">

    <button type="submit" class="btn save-btn">Guardar</button>
    
    <button type="button" class="btn btn-danger" id="delete-btn" onclick="deleteReservation(' . $reservation . ')">Apagar Reserva</button>
  </form>
  ';
}

function deleteReservation($reservation)
{
  global $conn;
  echo $reservation;
  $sql = "DELETE FROM reservations WHERE idReservation=$reservation";
  if (mysqli_query($conn, $sql)) {
    echo "apagado";
  } else {
    // If there was an error, display the error message
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
