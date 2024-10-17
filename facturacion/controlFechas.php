<?php
// Incluir la clase y el archivo de conexión
require_once 'modeloFechaEspe.php'; 
include("../method/db_fashion/cb.php");  // Usa la conexión de la base de datos centralizada

// Establecer la conexión en la clase FechaEspecial
FechaEspecial::setDb($conexion); // Utiliza la variable $conexion desde cb.php

// Verificar si hay una acción POST
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        // Recoge los datos del formulario
        $evento = $_POST['evento'];
        $fechaInicio = $_POST['fecha_inicio'];
        $fechaFin = $_POST['fecha_fin'];
        $colorEvento = $_POST['color_evento'];

        // Llamar a la función para agregar una nueva fecha especial
        if (FechaEspecial::agregarFecha($evento, $fechaInicio, $fechaFin, $colorEvento)) {
            // Redirige con un mensaje de éxito
            header('Location: fechaEspecial.php?mensaje=Fecha especial agregada');
        } else {
            // Redirige con un mensaje de error
            header('Location: fechaEspecial.php?mensaje=Error al agregar fecha especial');
        }
    }

    if ($accion == 'eliminar') {
        // Recoge el ID de la fecha a eliminar
        $id = $_POST['id'];

        // Llamar a la función para eliminar la fecha especial
        if (FechaEspecial::eliminarFecha($id)) {
            // Redirige con un mensaje de éxito
            header('Location: fechaEspecial.php?mensaje=Fecha especial eliminada');
        } else {
            // Redirige con un mensaje de error
            header('Location: fechaEsspecial.php?mensaje=Error al eliminar fecha especial');
        }
    }
}
?>

