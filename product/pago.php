<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar el Pago</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../css/ofertaVis.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .payment-methods {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .payment-methods img {
            width: 100px;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f9fa;
        }
        .form-group {
            margin-bottom: 20px;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Completar el Pago</h2>

        <!-- Mostrar el total a pagar -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subtotal = $_POST['subtotal'];
            echo "<p>Total a pagar: <strong>$" . htmlspecialchars($subtotal) . "</strong></p>";
        } else {
            header("Location: carrito.php");
        }
        ?>

        <form action="procesar_pago.php" method="post">
            <input type="hidden" name="subtotal" value="<?php echo htmlspecialchars($subtotal); ?>">

            <!-- Campo para seleccionar el método de pago -->
            <div class="form-group">
                <label for="metodo_pago">Seleccione el método de pago:</label>
                <select name="metodo_pago" id="metodo_pago" class="form-control">
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <!-- Imágenes de métodos de pago -->
            <div class="payment-methods">
                <img src="../img/paypal.png" alt="PayPal">
                <img src="../img/visa.png" alt="Visa">
                <img src="../img/masterCard.png" alt="MasterCard">
                <!-- Puedes añadir más imágenes para otros métodos de pago aquí -->
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
                    include '../method/productos_class.php';
                    include '../method/modelo.php';

                    $consulta = Modelo::sqlverCarrito();
                    $subtotal = 0;

                    while ($fila = $consulta->fetch_assoc()) {
                        $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];
                        $subtotal += $total_producto;
                        echo "
                            <tr>
                                <td>{$fila['nombre_producto']}</td>
                                <td>\${$fila['precio_pro']}</td>
                                <td>{$fila['cantidad_pro']}</td>
                                <td>\${$total_producto}</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Botón para proceder al pago -->
            <button type="submit" class="btn btn-success">Pagar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
