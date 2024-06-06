<?php
// Include the connection file to establish a database connection
include("../inc/connect.inc");
include("../src/dashboardData.php");
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
            <div class="text-center">
              <h1>Dashboard</h1>
            </div>
            <div class="row">
              <div class="col text-center mb-3">
                <a type="button" class="btn btn-primary w-50" href="dashboardMaterialTypes.php">
                  <h3>Tipos de Material</h3>
                  <h5><?php echo $typeCount ?></h5>
                </a>
              </div>
              <div class="col text-center">
                <a type="button" class="btn btn-primary w-50" href="dashboardMaterials.php">
                  <h3>Materiais</h3>
                  <h5><?php echo $materialsCount ?></h5>
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col text-center">
                <a type="button" class="btn btn-primary w-50" href="dashboardUsers.php">
                  <h3>Utilizadores</h3>
                  <h5><?php echo $usersCount ?></h5>
                </a>
              </div>
              <div class="col text-center">
                <a type="button" class="btn btn-primary w-50" href="dashboardReservations.php">
                  <h3>Reservas</h3>
                  <h5><?php echo $reservationsCount ?></h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>
</body>

</html>