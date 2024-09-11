<?php
include '../method/db_fashion/cb.php';

// Arreglo para almacenar las estadísticas
$estadisticas = [];

// Tablas a contar
$tablas = [
    'tb_categoria',
    'tb_facturas',
    'tb_usuarios',
    'tb_likes',
    'tb_favoritos',
    'tb_carrito',
    'tb_fecha_especial',
    'tb_productos',
    // Agrega más tablas aquí si es necesario
];

// Contar registros en cada tabla
foreach ($tablas as $tabla) {
    $sql = "SELECT COUNT(*) AS cantidad FROM $tabla";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        $estadisticas[$tabla] = $fila['cantidad'];
    } else {
        $estadisticas[$tabla] = "Error en la consulta: " . $conn->error;
    }
}

// Cerrar conexión
$conexion->close();

// Preparar datos para el gráfico
$labels = array_keys($estadisticas);
$data = array_values($estadisticas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estadísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        #myChart {
            max-width: 600px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Estadísticas de la Base de Datos</h1>
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Cantidad de Registros',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
