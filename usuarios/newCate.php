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
        include '../method/db_fashion/cb.php';
        include_once '../method/modelo.php';

        // Llama a la función y guarda el resultado
        $resultado = Modelo::sqlVerCate();

        // Verifica si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Itera sobre los resultados
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="category-card">';
                echo '<div class="category-title">' . htmlspecialchars($fila['categoria']) . '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay categorías disponibles.";
        }
        ?>
    </div>

</body>
</html>
