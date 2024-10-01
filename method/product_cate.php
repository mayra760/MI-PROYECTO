<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                echo '<div class="producto">';
                echo '<h2>' . htmlspecialchars($producto['nombre_producto']) . '</h2>';
                echo '<p><span>Precio:</span> $' . htmlspecialchars($producto['precio']) . '</p>';
                echo '<p>Detalles: ' . htmlspecialchars($producto['detalles']) . '</p>';

                // Mostrar las imágenes
                if (!empty($producto['ruta_img'])) {
                    $rutasImagenes = explode(',', $producto['ruta_img']); // Separar las rutas
                    foreach ($rutasImagenes as $rutaImagen) {
                        $rutaImagenCompleta = "../img/" . trim($rutaImagen); // Asegúrate de que no haya espacios
                        if (file_exists($rutaImagenCompleta)) {
                            echo '<div class="imagen-container"><img src="' . $rutaImagenCompleta . '" alt="' . htmlspecialchars($producto['nombre_producto']) . '" class="producto-imagen"></div>';
                        } else {
                            echo "<p class='sin-imagen'>Imagen no disponible</p>";
                        }
                    }
                } else {
                    echo "<p class='sin-imagen'>Imagen no disponible</p>";
                }

                echo '<div class="botones-container">';
                echo '<button class="btn btn-info btn-agregar-carrito" data-id="' . htmlspecialchars($producto['id_producto']) . '">
                        <i class="fa fa-shopping-cart"></i> Comprar ahora
                      </button>';
                echo '<button class="btn btn-info btn-favoritos" data-id="' . htmlspecialchars($producto['id_producto']) . '">
                        <i class="fas fa-heart"></i> Favoritos
                      </button>';
                echo '</div>'; // Cierre botones-container
                echo '</div>'; // Cierre producto
            }
            echo '</div>'; // Cierre productos-container
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
<script src="../js/añadirFavo.js"></script>
</body>
</html>
