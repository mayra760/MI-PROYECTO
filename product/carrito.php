<?php
session_start();
include 'plantill2.php';
?>
<head>

    <title>Carrito</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../css/carrito.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">

</head>
<body> 
    <div class="container cart-container">
        <h2 class="cart-title"><i class='fa fa-shopping-cart'></i> Tu carrito</h2>
        <?php
        include '../method/db_fashion/cb.php';
        include_once '../method/productos_class.php';
        echo Productos::verCarrito();
        ?>
         
         <center><a href="factura.php" class="btn btn-success">Pagar Ahora</a></center>

    </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/añadirCarro.js"></script>
    <script src="../js/scriptt.js"></script>
    <script src="../js/elimiCa.js"></script>
    
</body>
