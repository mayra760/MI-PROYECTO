<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/factura.css"> <!-- Asegúrate de enlazar el CSS -->
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que los datos han sido enviados desde el formulario
    //var_dump($_POST); // Mostrar todos los valores enviados para depuración
    //echo "<br>"; // Separador para facilitar la lectura

    // Obtener los valores del formulario, validando que no estén vacíos
    $total = isset($_POST['total']) ? $_POST['total'] : null;
    $metodo_pago = isset($_POST['metodo_pago']) ? $_POST['metodo_pago'] : null;
    $documento = isset($_POST['documento']) ? $_POST['documento'] : null;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

    // Verificar que todos los datos requeridos estén presentes
    if (!$total || !$direccion || !$telefono || !$metodo_pago || !$documento) {
        echo "Error: Faltan datos requeridos. Por favor, asegúrate de llenar todos los campos: Total, Dirección, Teléfono, Método de Pago y Documento.";
        exit(); // Detener la ejecución si faltan datos
    }

    // Conectar a la base de datos y obtener la información del carrito
    include '../method/modelo.php';
    $consulta = Modelo::sqlverCarrito();

    // Conectar a la base de datos para insertar la factura
    include '../method/db_fashion/cb.php';

    // Preparar la declaración SQL para insertar los datos en la tabla tb_facturas
    $sql_insert = $conexion->prepare("INSERT INTO tb_facturas (documento, metodo_pago, direccion, telefono, total) VALUES (?, ?, ?, ?, ?)");

    // Vincular los parámetros y verificar los tipos
    // "isssi" significa: i - entero (documento), s - string (metodo_pago, direccion, telefono), i - entero (total)
    $sql_insert->bind_param("isssi", $documento, $metodo_pago, $direccion, $telefono, $total); 

    // Ejecutar la consulta e insertar los datos
    if ($sql_insert->execute()) {
        $id_factura = $conexion->insert_id; // Obtener el ID de la factura insertada

        // Mostrar la factura
        echo "<div class='invoice-header'>";
        echo "<h2>Factura Digital</h2>";
        echo "</div>";

        echo "<div class='invoice-details'>";
        echo "<p><strong>Documento del Usuario:</strong> {$documento}</p>";
        echo "<p><strong>Total a pagar:</strong> \${$total}</p>";
        echo "<p><strong>Método de Pago:</strong> " . ($metodo_pago == 'tarjeta' ? 'Tarjeta de Crédito/Débito' : 'PayPal') . "</p>";
        echo "</div>";
        echo "<table class='table table-hover invoice-table'>";
        echo "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead><tbody>";

        $total_factura = 0;

        // Mostrar los productos del carrito en la factura
        while ($fila = $consulta->fetch_assoc()) {
            $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];
            $total_factura += $total_producto;
            echo "
                <tr>
                    <td>{$fila['nombre_producto']}</td>
                    <td>\${$fila['precio_pro']}</td>

                    <td>{$fila['cantidad_pro']}</td>
                    <td>\${$total_producto}</td>
                </tr>";
        }

        echo "</tbody></table>";

        echo "<div class='invoice-total'>";
        echo "<p>Total de la Factura: \${$total_factura}</p>";
        echo "</div>";

        echo "<div class='print-button'>";
        echo "<button onclick='window.print()' class='btn btn-secondary'>Imprimir Factura</button>";
        echo "</div>";

        echo "<a href='carrito.php' class='btn btn-primary'>Volver al Carrito</a>";

        // Eliminar productos del carrito después de la compra
        $sql_delete = "DELETE FROM tb_carrito";
        if ($conexion->query($sql_delete) !== TRUE) {
            echo "<p>Error al vaciar el carrito: " . $conexion->error . "</p>";
        }

    } else {
        // Mostrar el error si no se puede insertar la factura
        echo "<p>Error al insertar la factura: " . $conexion->error . "</p>";
        // Mostrar los valores que se intentaron insertar para depuración
        echo "Datos enviados: Documento: {$documento}, Método de Pago: {$metodo_pago}, Dirección: {$direccion}, Teléfono: {$telefono}, Total: {$total}";
    }
} else {
    // Redirigir al formulario de pago si no se ha enviado un POST
    header("Location: pago.php");
}
?>

</body>
</html>
