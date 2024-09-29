<!doctype html>
<html lang="en">
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MW395SN41J"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-MW395SN41J');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styProInicio.css">
    <link rel="stylesheet" type="text/css" href="../css/styPerfil.css">
    <link rel="stylesheet" type="text/css" href="../css/styLike.css">
    <link rel="stylesheet" type="text/css" href="../css/styMostrarPro.css">
    <link rel="stylesheet" type="text/css" href="../css/styActuUser.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link href="../css/pie_pagina.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>inicio</title>
  </head>
  <body>
  <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(250, 87, 22);">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="conBaBus.php?seccion=home">
      <h2><b>FASHION WORLD</b></h2>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="fecha_especial.php">
            <i class="fas fa-calendar-alt"></i> Fechas Especiales
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="newCate.php">
            <i class="fas fa-star"></i>Nuevas Categorías
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../manuales/Manual de usuario FW.pdf" download="ManualUsuario.pdf">
            <i class="fas fa-file-alt"></i> Manual de Usuario
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="conBaBus.php?seccion=cerrarSe">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle"></i> Menú
          </a>
          <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="../product/favoritos.php">
              <i class="fas fa-heart"></i> Tus favoritos
            </a></li>
            <li><a class="dropdown-item" href="../product/carrito.php">
              <i class="fas fa-shopping-cart"></i> Carrito
            </a></li>
            <li><a class="dropdown-item" href="../product/vista.php">
              <i class="fas fa-th-large"></i> Categorías
            </a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=perfil">
              <i class="fas fa-user"></i> Mi perfil
            </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Main content -->
  <div class="container">
    <?php include($seccion . ".php"); ?>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/ajaxBusca.js"></script>
  <script src="../js/likes.js"></script>
  <script src="../js/foto.js"></script>

  </body>
</html>
