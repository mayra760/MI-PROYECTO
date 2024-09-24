
<head>
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="../css/product_cate.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
</head>
<body><br>
<center><a href="../usuarios/conBaBus.php?seccion=home" class="btn btn-home"><i class="fas fa-home"><br>volver</i></a></center>
<?php
include '../method/modelo.php'; 

if (isset($_GET['id_categoria'])) {
    $id_categoria = intval($_GET['id_categoria']); 
    $resultado_categoria = Modelo::sqlVerCatePorId($id_categoria); // Llama a la función que obtendrá la categoría
    $resultado_productos = Modelo::obtenerProductosPorCategoria($id_categoria); // Llama a la función que obtendrá los productos

    // Verifica si la categoría existe
    if ($resultado_categoria && $resultado_categoria->num_rows > 0) {
        $categoria = $resultado_categoria->fetch_assoc();
        echo '<h1>' . htmlspecialchars($categoria['categoria']) . '</h1>'; // Muestra el nombre de la categoría

        // Verifica si hay productos
        if ($resultado_productos && $resultado_productos->num_rows > 0) {
            echo '<div class="productos-container">';
            while ($producto = $resultado_productos->fetch_assoc()) {
                echo '<div class="producto">
                        <img src="' . htmlspecialchars($producto['ruta_img']) . '" alt="' . htmlspecialchars($producto['nombre_producto']) . '" />
                        <h2>' . htmlspecialchars($producto['nombre_producto']) . '</h2>
                        <p><span>Precio:</span> $' . htmlspecialchars($producto['precio']) . '</p>
                        <p>Detalles: ' . htmlspecialchars($producto['detalles']) . '</p>
                        <div class="botones-container">
                            <button class="btn btn-info btn-agregar-carrito" data-id="' . htmlspecialchars($producto['id_producto']) . '">
                                <i class="fa fa-shopping-cart"></i> Comprar ahora
                            </button>

                        </div>
                      </div>';
            }
            echo '</div>';
        } else {
            echo '<p class="no-productos">No hay productos en esta categoría.</p>';
        }
    } else {
        echo '<p class="no-productos">Categoría no encontrada.</p>';
    }
} else {
    echo '<p class="no-productos">Categoría no especificada.</p>';
}
?>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/añadirCarro.js"></script>
</body>

