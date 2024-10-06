<?php

$server = "localhost";
$user = "root";
$pass = "root";
$db = "fw";

// esta parte es para que se pueda usar en cualquier servidor
//$server = $_GET['servidor'] ?? 'localhost';
//$user = $_GET['root'] ?? 'root';
//$pass = $_GET['clave'] ?? '';
//$db = $_GET['nombre_bd'] ?? 'fw';

// Conectar al servidor MySQL
$conexion = new mysqli($server, $user, $pass);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Verificar si la base de datos existe
$db_check = $conexion->query("SHOW DATABASES LIKE '$db'");
if ($db_check->num_rows == 0) {
    // Si la base de datos no existe, redirigir al instalador
    header("Location: ../instalador/instalar.php");
    exit();
}
$conexion->close();
$conexion = new mysqli($server, $user, $pass, $db);

// Verificar conexión a la base de datos
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}
?>
