<?php
include("../src/search.php");
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
              <a class="nav-link" href="/public/reservations.php">As Minhas Reservas</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-2">
      <div class="container">
        <div class="row gx-5 align-items-center justify-content-center">
          <div class="col-md-12 bg-white rounded-3" style="padding: 20px;">
            <button type="button" class="btn reserve-btn" data-bs-toggle="modal" data-bs-target="#reservationModal">Reservar material</button>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php printMaterialsTable(); ?>
              </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="../src/reserve.php" method="POST">
                    <!-- Modal header -->
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="reservationModalLabel">Reservar Material</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

                      <!-- User select -->
                      <select class="form-select" aria-label="Default select example" id="materialType" name="user"required>
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
                      <select class="form-select" aria-label="Default select example" name="material" required>
                        <option value="" selected>Selecione o material</option>
                        <?php
                        $sql = "SELECT * FROM materials";
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
                      <input class="datetimePicker" type="datetime-local" id="startReservation" name="startReservation">

                      <!-- End reservation -->
                      <input class="datetimePicker" type="datetime-local" id="endReservation" name="endReservation">
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn" style="background: #cc6633; color: white;">Reservar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>
  <footer>

  </footer>
</body>

</html>