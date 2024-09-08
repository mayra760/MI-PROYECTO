
<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
?>
<head>
    <title><?php echo 'CATEGORIAS'; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">
    
</head>
<body>  
<?php 
include '../product/plantill2.php';
include_once '../method/productos_class.php';
?>
<div class="producto" onmouseover="cambiarColor(this)" onmouseout="restablecerColor(this)">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <?php
                    $categoria = $_GET['categoria'] ?? 1;
                    echo " <center><h2>Categoría para hombres y mujeres</center><h2> ";
                    echo Productos::mostrarCategorias($categoria);
                    ?>
                </div>
                <div class="col-2"> <!-- Columna para tallas y colores -->
                    <div class="selector">
                            <label for="color">Color:</label>
                            <select id="color" class="form-control" onchange="filtrarPorColor(this.value)">
                                <option value="todos">Todos</option>
                                <option value="blanco">Blanco</option>
                                <option value="negro">Negro</option>
                                <option value="azul">Azul</option>
                            </select>
                    </div>
                        <br>
                    <div class="selector">
                        <label for="talla">Talla:</label>
                            <select id="talla" class="form-control" onchange="filtrarPorTalla(this.value)">
                                <option value="todos">Mostrar Todos</option>
                                <option value="talla m">M</option>
                                <option value="talla l">L</option>
                                <option value="xl">XL</option>
                            </select>
                    </div>
                </div>

            </div>
        </div>
</div>
<scrip src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/añadirCarro.js"></script>
<script src="../js/añadirFavo.js"></script>
<script src="../js/colorTalla.js"></script>

</body>
