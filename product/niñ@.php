<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'ropa para niños y niñas'; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">
</head> 
<body>
    <?php
    include '../product/plantill2.php';
    include_once '../method/productos_class.php';
    ?>

<div class="container-fluid">

    <div class="producto" onmouseover="cambiarColor(this)" onmouseout="restablecerColor(this)">
        <div class="row">
        <div class="col-10">
            <?php
                // Llama a la función CateNiños con el ID de la categoría de "Niños"
                $categoria = 3; // Cambia este ID según la categoría de "Niños" en tu base de datos
                echo Productos::CateNiños($categoria);
            ?>
        </div>

            <div class="col-2"> <!-- Columna para tallas y colores -->
                    <div class="selector">
                            <label for="color">Color:</label>
                            <select id="color" class="form-control" onchange="filtrarPorColor(this.value)">
                                <option value="todos">Todos</option>
                                <option value="naranja">naranja</option>
                                <option value="gris">gris</option>
                                <option value="vinotinto">vinotinto</option>
                                <option value="amarillo">amarillo</option>
                                <option value="azul oscuro">azul oscuro</option>
                                <option value="negro, cafe">negro, cafe</option>
                            </select>
                    </div>
                        <br>
                    <div class="selector">
                        <label for="talla">Talla:</label>
                            <select id="talla" class="form-control" onchange="filtrarPorTalla(this.value)">
                                <option value="todos">Mostrar Todos</option>
                                <option value="talla 3">talla 3</option>
                                <option value="2">talla 2</option>
                                <option value="3">talla 3</option>
                                <option value="1">talla 1</option>
                            </select>
                    </div>
                </div>
        </div>
    </div>
</div>


    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/añadirCarro.js"></script>
    <script src="../js/añadirFavo.js"></script>
    <script src="../js/colorTalla.js"></script>
</body>
</html>
