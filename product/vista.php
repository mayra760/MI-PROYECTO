

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
             <div class="col-11">      
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
                                <li>
                                <?php
                                    include '../method/modelo.php'; // Asegúrate de incluir el modelo

                                    // Llama a la función para obtener la última categoría
                                    $nueva_categoria_id = Modelo::obtenerUltimaCategoria(); // Obtiene el ID de la última categoría

                                    // Verifica si se obtuvo una nueva categoría
                                    if ($nueva_categoria_id) {
                                        echo '<ul class="navbar-nav">'; // Abre la lista de categorías
                                        // Ahora, obtenemos solo la nueva categoría
                                        $resultado = Modelo::sqlVerCatePorId($nueva_categoria_id); // Llama a la función para obtener la categoría por ID

                                        // Verifica si hay resultados
                                        if ($resultado && $resultado->num_rows > 0) {
                                            while ($fila = $resultado->fetch_assoc()) {
                                                // Muestra solo la nueva categoría
                                                echo '<li class="nav-item">
                                                        <a class="nav-link" href="../method/product_cate.php?id_categoria=' . $fila['id_categoria'] . '">
                                                            <i class="fa fa-tags"></i>' . htmlspecialchars($fila['categoria']) . '
                                                        </a>
                                                    </li>';
                                            }
                                        } else {
                                            echo '<li class="nav-item">No hay categorías disponibles.</li>';
                                        }
                                        echo '</ul>'; // Cierra la lista de categorías
                                    } else {
                                        echo '<li class="nav-item">No hay nueva categoría disponible.</li>';
                                    }
                                    ?>


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

