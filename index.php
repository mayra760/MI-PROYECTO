<?php

include_once 'method/db_fashion/cb.php';
if ($conexion->connect_error) {
    // Redirige al instalador si la conexión falla
    header("Location: instalador/instalar.php");
    exit();
}
// Verificar si la base de datos existe
$base_de_datos = "fw";
$existe_bd = $conexion->select_db($base_de_datos);
if (!$existe_bd) {
    // Redirige al instalador si la base de datos no existe
    header("Location: instalador/instalar.php");
    exit();
}
// Si la base de datos existe, redirige al login
header("Location: login.php");
exit();
?>
