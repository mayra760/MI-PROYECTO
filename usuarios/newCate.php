<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevas Categorías</title>
    <link rel="stylesheet" href="../css/nuevasCte.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
</head>
<body><br>
<center><a href="../usuarios/conBaBus.php?seccion=home" class="btn btn-home"><i class="fas fa-home"><br>volver</i></a></center>

    <h2>Hola usuario, aquí puedes ver todas las categorías, incluyendo las que ya están!!</h2>

    <div class="category-container">
        <?php
        include '../method/db_fashion/cb.php';//incluya la conexion de la base de datos
        include_once '../method/modelo.php';
        $resultado = Modelo::sqlVerCate();
        if ($resultado->num_rows > 0) {
            // Itera sobre los resultados
            while ($fila = $resultado->fetch_assoc()) {
                $id_categoria = $fila['id_categoria']; // este es el id de la categoria
                echo '<div class="category-card">';
                echo '<div class="category-title">' . htmlspecialchars($fila['categoria']) . '</div>';
                echo '<a href="../method/product_cate.php?id_categoria=' . $id_categoria . '" class="btn btn-view-products">Ver Productos</a>'; // Enlace a la categoría
                echo '</div>';
            }
        } else {
            echo "No hay categorías disponibles.";//si no hay productos te aparecera esto
        }
        ?>
    </div>

</body>
</html>
