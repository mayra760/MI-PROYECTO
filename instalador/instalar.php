<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador de Base de Datos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JZR6Spejh4U02d8jH1M7M1OChxhP3fsNJw+DJQ2Ck+8ghcuxP0/9dJ7W1I5XwG8C" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
        }
        h1 {
            margin-bottom: 20px;
            color: #ffffff;
            font-size: 28px;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 0 0.2rem rgba(255, 126, 95, 0.25);
        }
        .btn-custom {
            background-color: #ff7e5f;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #feb47b;
            transform: translateY(-2px);
        }
        .btn-custom:active {
            background-color: #ff7e5f;
            transform: translateY(0);
        }
        .btn-home {
            color: #ff7e5f;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .btn-home:hover {
            color: #feb47b;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Instalación de la Base de Datos</h1>
        <form action="instalador.php" method="get">
            <div class="form-group">
                <label for="servidor" class="form-label">Servidor:</label>
                <input type="text" name="servidor" id="servidor" class="form-control" value="localhost" required>
            </div>
            <div class="form-group">
                <label for="root" class="form-label">Usuario:</label>
                <input type="text" name="root" id="root" class="form-control" value="root" required>
            </div>
            <div class="form-group">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" name="clave" id="clave" class="form-control">
            </div>
            <div class="form-group">
                <label for="nombre_bd" class="form-label">Nombre de la Base de Datos:</label>
                <input type="text" name="nombre_bd" id="nombre_bd" class="form-control" value="fw" required>
            </div>
            <button type="submit" class="btn btn-custom">Instalar</button>
        </form>
        <br>
    </div>
    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-8ON3tIYB/mzF5LsHhlHjdP1n5iwcE6M2Cxd4ll33EJZWpK00lOmMwBZaAqE3b3+Kr" crossorigin="anonymous"></script>
</body>
</html>
