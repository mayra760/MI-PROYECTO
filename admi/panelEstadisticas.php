<?php
include '../method/db_fashion/cb.php';
include_once '../method/modelo.php';
include_once '../method/productos_class.php';
// Consultas para obtener datos de estadísticas
$total_usuarios_query = "SELECT COUNT(*) AS total_usuarios FROM tb_usuarios";
$total_usuarios_result = $conexion->query($total_usuarios_query);
$total_usuarios = $total_usuarios_result->fetch_assoc()['total_usuarios'];

$total_productos_query = "SELECT COUNT(*) AS total_productos FROM tb_productos";
$total_productos_result = $conexion->query($total_productos_query);
$total_productos = $total_productos_result->fetch_assoc()['total_productos'];

$total_productos_vendidos_query = "SELECT SUM(cantidad_pro) AS total_productos_vendidos FROM tb_carrito";
$total_productos_vendidos_result = $conexion->query($total_productos_vendidos_query);
$total_productos_vendidos = $total_productos_vendidos_result->fetch_assoc()['total_productos_vendidos'];

$ingresos_totales_query = "SELECT SUM(total) AS ingresos_totales FROM tb_facturas";
$ingresos_totales_result = $conexion->query($ingresos_totales_query);
$ingresos_totales = $ingresos_totales_result->fetch_assoc()['ingresos_totales'];

$total_likes_query = "SELECT COUNT(*) AS total_likes FROM tb_likes";
$total_likes_result = $conexion->query($total_likes_query);
$total_likes = $total_likes_result->fetch_assoc()['total_likes'];

$total_lista_deseos_query = "SELECT COUNT(*) AS total_lista_deseos FROM tb_lista_deseos";
$total_lista_deseos_result = $conexion->query($total_lista_deseos_query);
$total_lista_deseos = $total_lista_deseos_result->fetch_assoc()['total_lista_deseos'];

// Datos para los gráficos
// Productos más vendidos
$productos_query = "SELECT p.nombre_producto, SUM(c.cantidad_pro) AS cantidad_vendida 
                    FROM tb_productos p
                    JOIN tb_carrito c ON p.id_producto = c.id_ca
                    GROUP BY p.id_producto";
$productos_result = $conexion->query($productos_query);

$productoLabels = [];
$productoData = [];

while ($row = $productos_result->fetch_assoc()) {
    $productoLabels[] = $row['nombre_producto'];
    $productoData[] = $row['cantidad_vendida'];
}

$conexion->close();
?>

<head>
    <title>Panel de Estadísticas</title>
    <link rel="stylesheet" href="../css/styleEstadisticas.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head><br>
<body>
    <div class="container">
        <header class="header">
            <h1>Panel de Estadísticas</h1>
            <h3>Bienvenido, Administrador</h3>
            <p>¡Nos alegra verte de nuevo! Gestiona tu tienda con confianza y haz crecer tu negocio.</p>
        </header><br>
        
        <div class="dashboard">
            <div class="chart-container">
                <h2>Usuarios Registrados</h2>
                <canvas id="usuariosRegistrados"></canvas>
            </div>

            <div class="chart-container">
                <h2>Productos Vendidos</h2>
                <canvas id="productosVendidos"></canvas>
            </div>

            <div class="chart-container">
                <h2>Total de Productos en Inventario</h2>
                <canvas id="totalProductos"></canvas>
            </div>

            <div class="chart-container">
                <h2>Ingresos Totales</h2>
                <canvas id="ingresosTotales"></canvas>
            </div>

            <div class="chart-container">
                <h2>Total de Likes</h2>
                <canvas id="totalLikes"></canvas>
            </div>

            <div class="chart-container">
                <h2>Total de Productos en Lista de Deseos</h2>
                <canvas id="listaDeseos"></canvas>
            </div>

            <div class="chart-container">
                <h2>Productos Más Vendidos</h2>
                <canvas id="graficoProductos"></canvas>
            </div>
        </div><br>

        <script>
        // Configuración de gráficos con Chart.js

        // Gráfico de Usuarios Registrados
        var ctxUsuarios = document.getElementById('usuariosRegistrados').getContext('2d');
        new Chart(ctxUsuarios, {
            type: 'doughnut',
            data: {
                labels: ['Usuarios Registrados'],
                datasets: [{
                    label: 'Usuarios Registrados',
                    data: [<?php echo $total_usuarios; ?>],
                    backgroundColor: ['#36A2EB'],
                    borderColor: ['#36A2EB'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Productos Vendidos
        var ctxProductosVendidos = document.getElementById('productosVendidos').getContext('2d');
        new Chart(ctxProductosVendidos, {
            type: 'doughnut',
            data: {
                labels: ['Productos Vendidos'],
                datasets: [{
                    label: 'Productos Vendidos',
                    data: [<?php echo $total_productos_vendidos; ?>],
                    backgroundColor: ['#FF6384'],
                    borderColor: ['#FF6384'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Total de Productos en Inventario
        var ctxTotalProductos = document.getElementById('totalProductos').getContext('2d');
        new Chart(ctxTotalProductos, {
            type: 'doughnut',
            data: {
                labels: ['Total de Productos en Inventario'],
                datasets: [{
                    label: 'Total Productos',
                    data: [<?php echo $total_productos; ?>],
                    backgroundColor: ['#4BC0C0'],
                    borderColor: ['#4BC0C0'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Ingresos Totales
        var ctxIngresosTotales = document.getElementById('ingresosTotales').getContext('2d');
        new Chart(ctxIngresosTotales, {
            type: 'doughnut',
            data: {
                labels: ['Ingresos Totales'],
                datasets: [{
                    label: 'Ingresos Totales',
                    data: [<?php echo number_format($ingresos_totales, 2); ?>],
                    backgroundColor: ['#FFCE56'],
                    borderColor: ['#FFCE56'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': $' + context.raw.toFixed(2);
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Total de Likes
        var ctxTotalLikes = document.getElementById('totalLikes').getContext('2d');
        new Chart(ctxTotalLikes, {
            type: 'doughnut',
            data: {
                labels: ['Total de Likes'],
                datasets: [{
                    label: 'Total Likes',
                    data: [<?php echo $total_likes; ?>],
                    backgroundColor: ['#E7E9ED'],
                    borderColor: ['#E7E9ED'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Total de Productos en Lista de Deseos
        var ctxListaDeseos = document.getElementById('listaDeseos').getContext('2d');
        new Chart(ctxListaDeseos, {
            type: 'doughnut',
            data: {
                labels: ['Total de Productos en Lista de Deseos'],
                datasets: [{
                    label: 'Total Lista de Deseos',
                    data: [<?php echo $total_lista_deseos; ?>],
                    backgroundColor: ['#36A2EB'],
                    borderColor: ['#36A2EB'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Productos Más Vendidos
        var ctxGraficoProductos = document.getElementById('graficoProductos').getContext('2d');
        new Chart(ctxGraficoProductos, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($productoLabels); ?>,
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: <?php echo json_encode($productoData); ?>,
                    backgroundColor: '#4BC0C0',
                    borderColor: '#4BC0C0',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });
        </script>
    </div>
</body>
