<?php
// Include the connection file to establish a database connection
include("../inc/connect.inc");
// Include the search functionality file
include("../src/search.php")
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
  <link rel="stylesheet" href="../assets/css/searchResult-style.css">

  <!-- JS for materials select -->
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
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-2">
      <div class="container">
        <div class="row gx-5 align-items-center justify-content-center">
          <div class="col-md-12 bg-white rounded-3" style="padding: 20px;">
          <div class="text-center">
            <h2>As Minhas Reservas</h2>
          </div>
            <form action="reservations.php" method="GET">
              <!-- User select -->
              <select class="mb-1" id="user" name="user" required>
                <option value="" selected>Selecione utilizador</option>
                <?php
                // Query to retrieve all users from the database
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    // Generate options for the select dropdown
                    echo "<option value=\"" . $row["idUser"] . "\">" . $row["nameUser"] . "</option>";
                  }
                } else {
                  // Display a message if no users are found
                  echo "<option>SEM RESULTADOS - CONTACTAR ADMIN</option>";
                }
                ?>
              </select>
              <!-- Search button -->
              <button type="submit" class="btn w-25" style="background: #cc6633; color: white;">Pesquisar</button>
            </form>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Material</th>
                  <th scope="col">Início reserva</th>
                  <th scope="col">Fim reserva</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Check if the search functionality received user information
                if (isset($_GET['user'])) {
                  $userSearch = $_GET['user'];
                  printUserReservations($userSearch);
                }
                ?>
              </tbody>
            </table>
            <form action="../src/cancelReservation.php">
              <select class="mb-1" name="cancelReservation" required>
                <option value="" selected>Selecione reserva</option>
                <?php
                // Query the database for reservations associated with the current user
                $sql = "SELECT * FROM reservations WHERE idUser=$userSearch";
                $result = $conn->query($sql);

                // Check if any reservations were returned
                if ($result->num_rows > 0) {
                  // Loop through the results and output an option for each reservation
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row["idReservation"] . "\">" . "Reserva nº " . $row["idReservation"] .  "</option>";
                  }
                }
                ?>
              </select>
              <button type="submit" class="btn btn-danger w-25">Cancelar reserva</button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </section>
  <footer>

  </footer>
</body>

<script>
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>

</html>