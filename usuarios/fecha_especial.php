<?php
include_once '../facturacion/modeloFechaEspe.php';
include_once '../facturacion/controlFechas.php';
include '../method/db_fashion/cb.php';
$fechas= FechaEspecial::obtenerFechas();    
?>
<head>
<link href="../css/fechas_espe.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
</head>
<center><a href="conBaBus.php?seccion=home" class="btn btn-home"><i class="fas fa-home">voler a Home</i></a></center>
<h2>Listado de Fechas Especiales</h2>
    <?php if ($fechas->num_rows > 0): ?>
        <?php while ($fecha = $fechas->fetch_assoc()): ?>
            <div class="fecha" style="border-color: <?php echo htmlspecialchars($fecha['color_evento']); ?>;">
                <h3><?php echo htmlspecialchars($fecha['evento']); ?></h3>
                <p>Inicio: <?php echo htmlspecialchars($fecha['fecha_inicio']); ?></p>
                <p>Fin: <?php echo htmlspecialchars($fecha['fecha_fin']); ?></p>
                <div class="acciones">
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <center><p>No hay fechas especiales registradas.</p></center>
    <?php endif; ?>