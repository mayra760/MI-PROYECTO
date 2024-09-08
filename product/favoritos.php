<?php

session_start(); // Iniciar la sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include 'plantill2.php';
?>
<head>
    <title>Favoritos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/stylePro.css" rel="stylesheet">
    <link href="../css/favorito.css" rel="stylesheet">
    <link href="../css/favorito2.css" rel="stylesheet">
</head>
<body>
    <div class="container favorites-container">
        <h2 class="favorites-title"><i class='fas fa-heart'></i> Tus favoritos</h2>
        <?php
        include '../method/db_fashion/cb.php';
        include_once '../method/productos_class.php';
        echo Productos::verFavoritos();
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/scriptt.js"></script>
    <script src="../js/añadirFavo.js"></script>
</body>