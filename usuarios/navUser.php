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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>HOME USER</title>
    
  </head>
  <body>
  <!-- class="navbar navbar-expand-lg navbar-light bg-light" -->
    <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: #f58d06;">
  <div class="container-fluid">
  <a class="navbar-brand" href="conBaBus.php?seccion=home"><h1><b>FASHION WORLD</b></h1></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Menú 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="../product/favoritos.php">Tus favoritos</a></li>
            <li><a class="dropdown-item" href="../product/carrito.php">Carrito</a></li>
            <li><a class="dropdown-item" href="../product/vista.php">categorias</a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=perfil">Mi perfil</a></li>
            <li><a class="dropdown-item" href="conBaBus.php?seccion=cerrarSe">Cerrar sesión</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../facturacion/fechaEspecial.php">Fechas Especiales</a></li> 
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../facturacion/lista_deseos.php">Lista deseos</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../manuales/Manual de usuario FW.pdf" download="ManualUsuario.pdf">Manual de usuario</a></li>
        </ul>
      </ul>
    </div>
  </div>
</nav>



</div>
        

            
        
        
        
            <!-- Se declara un contenedor fila y después un contenedor columna. LAs columnas deben sumar 12, según la rejilla Bootstrap. -->
        <div class="container">
                    
        <?php
                
        include( $seccion.".php" );
                
        ?>
        </div>
    </body>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/ajaxBusca.js"></script>
    <script src="../js/likes.js"></script>
    <script src="../js/foto.js"></script>
   
  </body>
</html>