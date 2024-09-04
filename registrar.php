<!DOCTYPE html>
<html lang="en"> 
<head>
        <!-- Google tag (gtag.js) -->
         <script async src="https://www.googletagmanager.com/gtag/js?id=G-MW395SN41J"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-MW395SN41J');
        </script>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styRegistro.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <img src="img/foto.jpeg" alt="Imagen">
        <div class="form-container">
        <h1><b>REGÍSTRATE!</b></h1>
        <form id="registerForm" action="method/controler_login.php?recorrido=2" method="post">
    <input type="number" name="documento" placeholder="Documento" required><br>
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="apellido" placeholder="Apellido" required><br>
    <input type="email" name="correo" placeholder="Correo" required><br>
    <div>
        <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
        <input type="checkbox" id="showPassword" onclick="visibilidadContraseña()"> Mostrar contraseña
    </div>
    <br>
    <input type="date" name="fecha" placeholder="Fecha de nacimiento" required><br>
    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" id="termsCheck" required>
        <label class="form-check-label" for="termsCheck"><a href="usuarios/terminosCon.php" target="_blank"> Acepto los Términos y condiciones</a></label>
    </div>
    <div class="form-check mt-3 mb-3">
        <input class="form-check-input" type="checkbox" id="privacyCheck" required>
        <label class="form-check-label" for="privacyCheck"> <a href="politicaPri.php" target="_blank">He leído y acepto la Política de privacidad</a></label>
    </div>

    <input type="submit" value="Registrarse" class="btn btn-primary w-100"><br>
    <center>
        <a href="login.php">Inicia sesión</a>
    </center>
</form>

<script>
// Función para mostrar/ocultar la contraseña
function visibilidadContraseña(fieldId = 'contraseña') {
    const field = document.getElementById(fieldId);
    const showPassword = document.getElementById(fieldId === 'contraseña' ? 'showPassword' : 'showConfirmPassword');
    if (showPassword.checked) {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}
document.getElementById('registerForm').addEventListener('submit', function(event) {
        const termsCheck = document.getElementById('termsCheck');
        const privacyCheck = document.getElementById('privacyCheck');

        if (!termsCheck.checked || !privacyCheck.checked) {
            event.preventDefault(); // Evita el envío del formulario
            alert('Debes aceptar los Términos y Condiciones y la Política de Privacidad antes de registrarte.');
        }
    });
</script>
        </div>
    </div>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Incluir el archivo JavaScript con tus alertas personalizadas -->
    <script src="js/alertError.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>
