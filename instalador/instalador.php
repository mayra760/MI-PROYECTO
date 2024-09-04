<?php
// Variables recibidas del formulario
$server = $_GET['servidor'] ?? 'localhost';
$root = $_GET['root'] ?? 'root';
$clave = $_GET['clave'] ?? '';
$base = $_GET['nombre_bd'] ?? 'fw';

// Verificar si las variables necesarias fueron proporcionadas
if (empty($server) || empty($root) || empty($base)) {
    die("Por favor, proporcione todos los datos necesarios para la conexión.");
}

// Conexión al servidor
$conexion = new mysqli($server, $root, $clave);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Crear la base de datos si no existe
$sql_create_bd = "CREATE DATABASE IF NOT EXISTS `$base`";
if ($conexion->query($sql_create_bd) === true) {
    echo "Base de datos creada o ya existente.<br>";

    // Conectar a la nueva base de datos
    $conexion2 = new mysqli($server, $root, $clave, $base);

    // Verificar conexión a la base de datos
    if ($conexion2->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion2->connect_error);
    }

    // Nombre del archivo SQL para realizar el volcado
    $ruta_base = 'fw.sql';

    // Verificar si el archivo SQL existe
    if (!file_exists($ruta_base)) {
        die("El archivo $ruta_base no se encuentra en el directorio.");
    }

    // Ejecutar el archivo SQL
    $sql = file_get_contents($ruta_base);
    if ($conexion2->multi_query($sql)) {
        echo "Base de datos configurada correctamente.<br>";

        // Eliminar el archivo instalador.php para evitar re-ejecutarlo
        if (file_exists(__FILE__)) {
            unlink(__FILE__);
            echo "Instalador eliminado correctamente.<br>";
        }

        // Redirigir al login
        header("Location: ../login.php");
        exit();
    } else {
        echo "Error al importar la base de datos: " . $conexion2->error;
    }
} else {
    echo "Error al crear la base de datos: " . $conexion->error;
}

// Cerrar conexiones
$conexion->close();
$conexion2->close();
?>
