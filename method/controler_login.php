<?php
include_once("login_class.php");
if(!isset($_SESSION))session_start();
if(!isset($_SESSION['id']))$_SESSION['id'] = 0;

 

// Inicializar variables de sesión para manejo de intentos fallidos y bloqueo
if (!isset($_SESSION['intentos_fallidos'])) {
    $_SESSION['intentos_fallidos'] = array();
}
if (!isset($_SESSION['bloqueado_hasta'])) {
    $_SESSION['bloqueado_hasta'] = array();
}

if (isset($_GET['recorrido'])) {
    $recorrido = intval($_GET['recorrido']);
    $documento = isset($_POST['documento']) ? $_POST['documento'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    // Verificar si la cuenta está bloqueada
    if ($documento && isset($_SESSION['bloqueado_hasta'][$documento])) {
        if ($_SESSION['bloqueado_hasta'][$documento] > time()) {
            $tiempo_restante = $_SESSION['bloqueado_hasta'][$documento] - time();
            header("Location: ../login.php?error=blocked&tiempo=$tiempo_restante");
            exit();
        } else {
            // Si el tiempo de bloqueo ha pasado, desbloquear la cuenta
            unset($_SESSION['bloqueado_hasta'][$documento]);
        }
    }

    if ($recorrido == 1) {
        if ($_POST['captcha'] !== $_SESSION['captcha_text']) {
            header("location:../login.php?error=captcha");
            exit;
            }
        if (Loguin::verificaUsuarios($documento, $contraseña)) {
            // Reiniciar los intentos fallidos en caso de inicio de sesión exitoso
            unset($_SESSION['intentos_fallidos'][$documento]);
            $_SESSION['id'] = $documento;

            // Redirigir según el rol del usuario
            if (Loguin::verRol($_SESSION['id']) == 1) {
                header("Location: ../usuarios/conBaBus.php");
                exit(); // Asegúrate de llamar a exit() después de redirigir
            } elseif (Loguin::verRol($_SESSION['id']) == 0) {
                header("Location: ../admi/ctroBar.php");
                exit(); // Asegúrate de llamar a exit() después de redirigir
            }
        } else {
            // Incrementar los intentos fallidos solo si el usuario no está bloqueado
            if (!isset($_SESSION['bloqueado_hasta'][$documento]) || $_SESSION['bloqueado_hasta'][$documento] <= time()) {
                if (!isset($_SESSION['intentos_fallidos'][$documento])) {
                    $_SESSION['intentos_fallidos'][$documento] = 0;
                }
                $_SESSION['intentos_fallidos'][$documento] += 1;

                // Bloquear la cuenta si se alcanzan 3 intentos fallidos
                if ($_SESSION['intentos_fallidos'][$documento] >= 3) {
                    $_SESSION['bloqueado_hasta'][$documento] = time() + 180; // Bloquear por 3 minutos (180 segundos)
                    unset($_SESSION['intentos_fallidos'][$documento]); // Reiniciar el conteo de intentos fallidos
                    $tiempo_restante = $_SESSION['bloqueado_hasta'][$documento] - time();
                    header("Location: ../login.php?error=blocked&tiempo=$tiempo_restante");
                    exit(); // Asegúrate de llamar a exit() después de redirigir
                } else {
                    header("Location: ../login.php?error=1");
                    exit(); // Asegúrate de llamar a exit() después de redirigir
                }
            }
        }
    }

    if ($recorrido == 2) {
        $documento = isset($_POST['documento']) ? $_POST['documento'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
        $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';
    
        // Llama a la función para registrar el usuario
        $registro_exitoso = Loguin::registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha);
    
        if ($registro_exitoso == false) {
            // Si ya existe, redirige con un mensaje de error
            header("location:../registrar.php?error=usuario_existente");
            exit();
        } else {
            $_SESSION['id'] = $documento;
            header("location:../usuarios/conBaBus.php");
            exit();
        }
    }
    
}    