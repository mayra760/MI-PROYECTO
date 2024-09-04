<?php
include '../product/plantill2.php';
?>
<head>
    <link href="../css/producBus.css" rel="stylesheet">
    <title>Tus detalles</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 mx-auto">
               <b> <h2 class="text-center my-4">Detalles de Productos</h2></b>
                <div class="productos-container">
                    <?php
                    include_once '../method/productos_class.php';
                    echo Productos::buscador();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/añadirCarro.js"></script>
    <script src="../js/añadirFavo.js"></script>
</body>
