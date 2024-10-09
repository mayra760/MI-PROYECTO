<?php
// Configura las credenciales temporales para la conexión
$servidor = 'localhost';
$usuario = 'root';
$clave = ''; // Contraseña vacía, o pon la temporal que corresponda
$base_de_datos = 'fw';

try {
    // Intenta conectar a la base de datos
    $conexion = new mysqli($servidor, $usuario, $clave);

    // Verifica si la conexión tiene errores
    if ($conexion->connect_error) {
        throw new Exception('Error al conectar a MySQL: ' . $conexion->connect_error);
    }

    // Intenta seleccionar la base de datos
    $existe_bd = $conexion->select_db($base_de_datos);
    
    if ($existe_bd) {
        // Si la base de datos existe, redirige a login.php
        header("Location: login.php");
        exit();
    } else {
        // Si la base de datos no existe, redirige al instalador
        header("Location: instalador/instalar.php");
        exit();
    }
    
} catch (Exception $e) {
    // Si la conexión falla, redirige al instalador
    header("Location: instalador/instalar.php");
    exit();
}
?>
