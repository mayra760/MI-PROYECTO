<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
?>
<head>
    <title><?php echo 'Zapatos'; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">
    <link href="../css/pie_pagina.css" rel="stylesheet">
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
                    $categoria = 4;
                    echo Productos::verZapatos($categoria);
                     ?>
                </div>
                <div class="col-2"> <!-- Columna para tallas y colores -->
                    <div class="selector">
                            <label for="color">Color:</label>
                            <select id="color" class="form-control" onchange="filtrarPorColor(this.value)">
                                <option value="todos">Todos</option>
                                <option value="amarillos">amarillos</option>
                                <option value="blanco">blanco</option>
                                <option value="plateado">plateado</option>
                                <option value="blanco, gris">blanco, gris</option>
                            </select>
                    </div>
                        <br>
                    <div class="selector">
                        <label for="talla">Talla:</label>
                            <select id="talla" class="form-control" onchange="filtrarPorTalla(this.value)">
                                <option value="todos">Mostrar Todos</option>
                                <option value="talla 27">talla 27</option>
                                <option value="talla 37">talla 37</option>
                                <option value="talla 20">talla 20</option>
                                <option value="talla 39">talla 39</option>
                                <option value="talla 37">talla 37</option>
                                <option value="talla 38">talla 38</option>
                            </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/añadirCarro.js"></script>
    <script src="../js/añadirFavo.js"></script>
    <script src="../js/colorTalla.js"></script>
</body>
