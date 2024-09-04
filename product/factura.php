<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloFactura.css">
    <link href="../css/ofertaVis.css" rel="stylesheet">
</head>
<body>
<center><a href="carrito.php" class="btn btn-home"><i class="fas fa-home">volver</i></a></center>

    <div class="container">
        <h2>Detalles de la Facturación</h2>
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
                include '../method/db_fashion/cb.php';
                include '../method/modelo.php';

                $consulta = Modelo::sqlverCarrito();
                $subtotal = 0;

                while ($fila = $consulta->fetch_assoc()) {
                    $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];
                    $subtotal += $total_producto;
                    echo "
                        <tr>
                            <td class='product-name'>{$fila['nombre_producto']}</td>
                            <td>\${$fila['precio_pro']}</td>
                            <td>{$fila['cantidad_pro']}</td>
                            <td>\${$total_producto}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <h3 class="subtotal">Subtotal: $: <?php echo $subtotal; ?></h3>

        <form action="pago.php" method="post">
            <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
            <button type="submit" class="btn btn-primary">Proceder al Pago</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
