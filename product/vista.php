
<head>
    <title>Vistas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">   
    <link href="../css/style2.css" rel="stylesheet">
    <link href="../css/pie_pagina.css" rel="stylesheet">
    <link href="../css/bienveInicio.css" rel="stylesheet">
    <link href="../css/ofertaVis.css" rel="stylesheet">
</head>
<body>
<div class="banner"> 
        <div class="banner-text">
            <h2>REBAJAS DE TEMPORADA</h2>
            <h1>HASTA -70%</h1>
            <a href="categ.php" class="banner-button">COMPRA YA</a>
        </div>
        <div class="banner-images">
            <div class="product">
                <img src="../img/accesorio1.png" alt="Product 1">
                <span class="price">$51.268</span>
            </div>
            <div class="product">
                <img src="../img/accesosrios5.png" alt="Product 2">
                <span class="price">$49.844</span>
            </div>
        </div>
        <div class="hand-icon"></div>
    </div><br>
    <center><a href="../usuarios/conBaBus.php?seccion=home" class="btn btn-home"><i class="fas fa-home"></i></a></center>
    <div class="product-view">
        <div class="container-fluid">
        <div class="welcome-message">
        <h1>¡Hola y bienvenidos a <span>FASHION WORLD</span>!</h1>
        <p>Nos alegra que estés aquí. Disfruta de nuestra selección exclusiva y encuentra lo que
        hace brillar tu estilo. ¡Gracias por ser parte de nuestra familia!</p>
    </div>
            <div class="row">
             <div class="col-lg-8">
                    <div class="productos-container">
                        <?php
                        include_once '../method/productos_class.php'; 
                        echo Productos::mostrarPro();
                        ?>
                    </div>
                </div>           
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-widget category">
                        <h2 class="title">Categorías</h2>
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="niñ@.php"><i class="fa fa-child"></i>Ropa para niños y bebés</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="categ.php"><i class="fa fa-tshirt"></i>Ropa para damas y caballeros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="accesorios.php"><i class="fa fa-gem"></i>Accesorios para damas y caballeros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="zapatos.php"><i class="fa fa-shoe-prints"></i>Calzado para damas caballeros y niñ@s</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="footer-widget">
                        <h2>Contáctenos:</h2>
                        <div class="contacto-info">
                            <p><i class="fa fa-map-marker"></i> San José del Guaviare, Colombia</p>
                            <p><i class="fa fa-envelope"></i> fashionworld@gmail.com</p>
                            <p><i class="fa fa-phone"></i> +57-3135678748</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="footer-widget">
                        <h5>Encuéntrenos en nuestras redes sociales</h5>
                        <div class="contacto-info">
                            <div class="social">
                                <a href="https://x.com/?lang=es"><i class="fab fa-twitter"></i></a>
                                <a href="https://web.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

