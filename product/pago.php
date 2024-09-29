<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Pedido</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloFactura.css">
</head>
<body>
    <div class="container">
        <h2>Detalles del Pago</h2>
        <form action="procesar_pago.php" method="post">
            <!-- Campo para ingresar el documento del usuario -->
            <div class="form-group">
                <label for="documento">Documento del Usuario:</label>
                <input type="text" name="documento" id="documento" class="form-control" required>
            </div>

            <!-- Campo para ingresar la dirección -->
            <div class="form-group">
                <label for="direccion">Dirección de Envío:</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>

            <!-- Campo para ingresar el teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono de Contacto:</label>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
            </div>

            <!-- Selección del método de pago -->
            <div class="form-group">
                <label for="metodo_pago">Seleccione el método de pago:</label>
                <select name="metodo_pago" id="metodo_pago" class="form-control">
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="paypal">Efectivo</option>
                </select>
            </div>

            <!-- Imágenes de métodos de pago -->
            <div class="payment-methods">
                <img src="../img/visa.png" alt="Visa">
                <img src="../img/masterCard.png" alt="MasterCard">
            </div>

            <!-- Campos adicionales para el pago -->
            <div class="form-group">
                <label for="numero_cuenta">Número de Cuenta:</label>
                <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nombre_titular">Nombre del Titular:</label>
                <input type="text" name="nombre_titular" id="nombre_titular" class="form-control" required>
            </div>

            <!-- Resumen del pedido -->
            <h3>Resumen del Pedido:</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../method/modelo.php';
                    $consulta = Modelo::sqlverCarrito();
                    $subtotal = 0;
                    while ($fila = $consulta->fetch_assoc()) {
                        $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];
                        $subtotal += $total_producto;
                        echo "
                            <tr>
                                <td>" . htmlspecialchars($fila['nombre_producto']) . "</td>
                                <td>\$" . htmlspecialchars($fila['precio_pro']) . "</td>
                                <td>" . htmlspecialchars($fila['cantidad_pro']) . "</td>
                                <td>\$" . htmlspecialchars($total_producto) . "</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Campo oculto para enviar el total del pedido -->
            <input type="hidden" name="total" value="<?php echo htmlspecialchars($subtotal); ?>">

            <!-- Botón para proceder al pago -->
            <button type="submit" class="btn btn-success">Pagar</button>
        </form>
    </div>
</body>
</html>
