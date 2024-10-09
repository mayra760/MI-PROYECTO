<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Correo {
    public static function correos($correo, $asunto, $body) {
        include("../PHPMailer/PHPMailer.php");
        include("../PHPMailer/Exception.php");
        include("../PHPMailer/SMTP.php");

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // Cambiado para más información
            $mail->Host       = 'smtp.mailersend.net'; // Servidor SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'MS_CkXKL4@trial-351ndgw2yqdgzqx8.mlsender.net'; // Nombre de usuario
            $mail->Password   = 'ht1qsdHUXCkTSrnL'; // Contraseña (token de API)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Protocolo de seguridad
            $mail->Port       = 587; // Puerto

            // Recipients
            $mail->setFrom('MS_CkXKL4@trial-351ndgw2yqdgzqx8.mlsender.net', 'Fashion World'); // Usando el dominio verificado

            $mail->addAddress($correo, 'Cliente');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $body;

            $mail->send();
            $salida = "Correo enviado exitosamente, revisa tu bandeja.";
        } catch (Exception $e) {
            $salida = "Falla al enviar el correo. Error: {$mail->ErrorInfo}";
            error_log($salida); // Registro de errores
        }
        return $salida;
    }

    public static function enviarCorreo($correo, $dato) {
        include_once("modelo.php");
        include_once("usuarios_class.php");
        include_once("funciones_class.php");
        include_once("token_class.php");
        include_once("encrip_class.php");
        
        $id = Usuarios::buscarId($correo);
        $name = Modelo::buscarDatosUser(1, $id);
        $message = "Esta es la clave nueva.";
        $html = HTMLGenerator::createEmailHtml($name, $message, $dato, EncriptarURl::encriptar($id));
        
        Modelo::sqlCambiarClave($dato, $id);
        echo Correo::correos($correo, "Recuperar clave", $html);
    }
}
