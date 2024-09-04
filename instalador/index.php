<?php

// Verifica si el archivo instalador.php existe
if (file_exists('instalador.php')) {
    // Redirecciona a la ubicación del instalador
    header("Location: instalador.php");
    exit();
} else {
    // Mensaje que indica que la base de datos se creó correctamente
    echo "La base de datos se creó correctamente";
    exit();
}
