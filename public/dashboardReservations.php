<?php
// Include the connection file to establish a database connection
include("../inc/connect.inc");
include("../src/reservationsEdit.php");
?>
<html lang="pt-pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Reserva de Material UMinho</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/dashboard-style.css">

  <!-- JS for reservations select -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>

<body class="d-flex flex-column h-100">
  <section class="flex-shrink-0 min-vh-100 background">
    <nav class="navbar navbar-expand-lg" style="padding-top: 20px">
      <div class="container px-5">
        <!-- Logo -->
        <a class="navbar-brand" href="../" style="width: 200px"><img src="../assets/imgs/logo.png" width="100%" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" \ data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="bi bi-list"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <!-- Link to the home page -->
            <li class="nav-item">
              <a class="nav-link" href="../">Home</a>
            </li>
            <!-- Link to the reservation page -->
            <li class="nav-item">
              <a class="nav-link" href="/public/searchResult.php?searchQuery=">Reservar Material</a>
            </li>
            <!-- Link to user's reservations page -->
            <li class="nav-item">
              <a class="nav-link" href="/public/reservations.php?user=0">As Minhas Reservas</a>
            </li>
            <!-- Link to dashboard page -->
            <li class="nav-item">
              <a class="nav-link" href="/public/dashboard.php">Dashboard</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-2">
      <div class="container">
        <div class="row gx-5 align-items-center justify-content-center">
          <div class="col-md-12 bg-white rounded-3" style="padding: 20px;">
            <h2>Reservas</h2>
            <form action="dashboardReservations.php" method="GET">
              <!-- Reservation select -->
              <select class="mb-1" id="reservation" name="reservation" required>
                <option value="" selected>Selecione a reserva</option>
                <?php
                // Query to retrieve all reservations from the database
                $sql = "SELECT * FROM reservations";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Generate options for the select dropdown
                    echo "<option value=\"" . $row["idReservation"] . "\">Reserva nº " . $row["idReservation"] . "</option>";
                  }
                } else {
                  // Display a message if no reservations are found
                  echo "<option>SEM RESULTADOS</option>";
                }
                ?>
              </select>
              <!-- Search button -->
              <button type="submit" class="btn w-25" style="background: #cc6633; color: white;">Selecionar</button>
            </form>
            <h4>
              <?php if (isset($strReservation)) {
                echo $strReservation;
                printForm($reservation);
              }
              ?>
            </h4>
            <button type="button" class="btn btn-success md-2 w-25" data-bs-toggle="modal" data-bs-target="#Modal">Criar reserva</button>
          </div>
        </div>
      </div>
    </main>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../src/reservationsCreate.php" method="POST">
          <!-- Modal header -->
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalLabel">Criar reserva</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <!-- User select -->
            <select class="mb-2" id="user" name="user" required>
              <option value="" selected>Selecione utilizador</option>
              <?php
              $sql = "SELECT * FROM users";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . $row["idUser"] . "\">" . $row["nameUser"] . "</option>";
                }
              } else {
                echo "<option>SEM RESULTADOS - CONTACTAR ADMIN</option>";
              }
              ?>
            </select>

            <!-- Material select -->
            <select class="mb-2" id="material" name="material" required>
              <option value="" selected>Selecione o material</option>
              <?php
              $sql = "SELECT * FROM materials WHERE nameMaterial LIKE '%$searchQuery%'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . $row["idMaterial"] . "\">" . $row["nameMaterial"] . "</option>";
                }
              } else {
                echo "<option>SEM RESULTADOS - CONTACTAR ADMIN</option>";
              }
              ?>
            </select>

            <!-- Start reservation -->
            <input class="datetimePicker mb-2" type="datetime-local" id="startReservation" name="startReservation">

            <!-- End reservation -->
            <input class="datetimePicker mb-2" type="datetime-local" id="endReservation" name="endReservation">
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-success">Criar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<script>
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>

<script>
  function deleteReservation(reservation) {
    // Send an AJAX request to the server
    fetch('../src/reservationsDelete.php?reservation=' + reservation)
      .then(response => response.text())
      .then(data => console.log('Request successful!', data))
      .catch(error => console.error('Error:', error));
    location.href = 'dashboardReservations.php';
  }
</script>

</html>