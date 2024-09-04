<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Digital</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/proce_pago.css" rel="stylesheet">
    <link href="../css/ofertaVis.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subtotal = $_POST['subtotal'];
            $metodo_pago = $_POST['metodo_pago'];
            $nombre_titular = $_POST['nombre_titular']; // Añadido

            // Conectar a la base de datos y obtener la información del carrito
            include '../method/modelo.php';
            $consulta = Modelo::sqlverCarrito();

            // Mostrar la factura
            echo "<div class='invoice-header'>";
            echo "<h2>Factura Digital</h2>";
            echo "</div>";

            echo "<div class='invoice-details'>";
            echo "<p><strong>Nombre del Usuario:</strong> {$nombre_titular}</p>";
            echo "<p><strong>Total a pagar:</strong> \${$subtotal}</p>";
            echo "<p><strong>Método de Pago:</strong> " . ($metodo_pago == 'tarjeta' ? 'Tarjeta de Crédito/Débito' : 'PayPal') . "</p>";
            echo "</div>";
            echo "<table class='table table-hover invoice-table'>";
            echo "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead><tbody>";

            $total_factura = 0;

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
            include '../method/db_fashion/cb.php'; // Asegúrate de incluir la conexión a la base de datos

            // Ejemplo de eliminar productos del carrito
            $sql_delete = "DELETE FROM tb_carrito";
            if ($conexion->query($sql_delete) === TRUE) {
                // Operación exitosa
            } else {
                echo "<p>Error al vaciar el carrito: " . $conexion->error . "</p>";
            }

        } else {
            // Redirigir a la página de pago si se accede a esta página directamente
            header("Location: pago.php");
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
