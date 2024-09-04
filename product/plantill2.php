<!doctype html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://getbootstrap.com/2.0.2/assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://getbootstrap.com/2.0.2/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://getbootstrap.com/2.0.2/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="https://getbootstrap.com/2.0.2/assets/ico/apple-touch-icon-57-precomposed.png">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  <!-- iconos" -->
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link href="../css/plantill2.css" rel="stylesheet">
      </head>
<body>
      <!-- class="navbar navbar-expand-lg navbar-light bg-light" -->
    <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #f58d06;">
      <div class="container-fluid">
      <a class="navbar-brand" href="../usuarios/conBaBus.php?seccion=home"><h1><b>FASHION WORLD</b></h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../product/vista.php">ir a categorias</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="favoritos.php"><i class="fa fa-star"></i> favoritos <span id="favoritos-count" class="badge badge-pill badge-primary"></span></a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="carrito.php"><i class="fa fa-shopping-cart"></i> ver carrito <span id="carrito-count" class="badge badge-pill badge-primary"></span></a></li>
        <form id="searchForm" method="GET" action="buscar.php">
            <input type="text" name="query" placeholder="detalles de productos..." required><button type="submit"><i class="fa fa-search"></i>Buscar</button>
        </form>
      </ul>
</div>

      </div>
    </nav>


</body>

            <script async src="https://www.googletagmanager.com/gtag/js?id=G-MW395SN41J"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
            
              gtag('config', 'G-MW395SN41J');
            </script>
            
            </body>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      </body>
    </html>