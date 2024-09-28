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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styRegistro.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <img src="img/foto.jpeg" alt="Imagen">
        <div class="form-container">
            
            <h1><b>REGÍSTRATE!</b></h1>
            <center><b>Avisooo!!! no olvidar tu contraseña</b></center><br>

            <!-- Mostrar mensaje de error si el documento ya existe -->
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 'usuario_existente') {
                echo "<p style='color: red;'>El usuario con ese documento ya existe. Intente con otro documento.</p>";
            }
            ?>

            <form id="registerForm" action="method/controler_login.php?recorrido=2" method="post">
                <input type="number" name="documento" placeholder="Documento" required><br>
                <input type="text" name="nombre" placeholder="Nombre" required><br>
                <input type="text" name="apellido" placeholder="Apellido" required><br>
                <input type="email" name="correo" placeholder="Correo" required><br>
                <div>
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                    <input type="checkbox" id="showPassword" onclick="visibilidadContraseña()"> Mostrar contraseña
                </div>
                <div id="passwordRequirements" class="password-requirements">
                    <p id="passwordLength" class="error">La contraseña debe tener al menos 5 caracteres.</p>
                    <p id="passwordUppercase" class="error">Debe incluir al menos una letra mayúscula.</p>
                    <p id="passwordLowercase" class="error">Debe incluir al menos una letra minúscula.</p>
                    <p id="passwordNumber" class="error">Debe incluir al menos un número.</p>
                    <p id="passwordSpecial" class="error">Debe incluir al menos un carácter especial.</p>
                </div>
                <br>
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

            <style>
            .password-requirements {
                margin-top: 10px;
            }
            .password-requirements p {
                margin: 0;
                color: red; /* Color rojo para los mensajes de error */
                display: none; /* Ocultar mensajes por defecto */
            }
            </style>
        </div>
    </div>

    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="js/alertError.js"></script>
    <script src="js/registroca.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
