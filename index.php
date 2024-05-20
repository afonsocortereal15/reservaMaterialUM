<html lang="pt-pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Reserva de Material UMinho</title>

  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/index-style.css">
</head>

<body class="d-flex flex-column h-100">
  <section class="flex-shrink-0 min-vh-100 background">
    <nav class="navbar navbar-expand-lg" style="padding-top: 20px">
      <div class="container px-5">
        <a class="navbar-brand" href="./" style="width: 200px"><img src="assets/imgs/logo.png" width="100%" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" \ data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="bi bi-list"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="public/reservations.php">As Minhas Reservas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./">Ipsum</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-5">
      <div class="px-5">
        <div class="row gx-5 align-items-center justify-content-center">
          <div class="col-lg-8 col-xl-7 col-xxl-6">
            <div class="my-5 text-right text-xl-start">
              <h1 class="display-5 fw-bolder text-white mb-2">
                Reserva de Material
              </h1>
              <p class="lead fw-normal text-white mb-4">
                Esta é uma Aplicação Web com o intuito de facilitar a reserva de material como portateis, câmaras e outros equipamentos na UMinho.
              </p>
            </div>
            <div class="search">
              <i class="bi bi-search"></i>
              <form action="public/searchResult.php" method="get">
                <input type="text" class="form-control col-sm-12 col-md-6" placeholder="Pesquisar material" name="searchQuery" />
                <button class="btn btn-primary" type="submit">Pesquisar</button>
              </form>
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
