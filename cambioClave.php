<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Restablecer Contraseña</h2>
        <form action="usuarios/ctroUser.php?cambioCo=true&codigo=<?php echo $_GET['codigo']; ?>" method="post">
            <div class="mb-3">
                <label for="oldPassword" class="form-label">Contraseña temporal</label>
                <input type="password" name="nuevaClave" class="form-control" id="oldPassword" placeholder="Ingresa la contraseña que te enviamos" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Nueva Contraseña</label>
                <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="Ingresa tu nueva contraseña" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
