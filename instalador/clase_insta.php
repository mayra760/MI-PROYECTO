<?php

class Encriptar {
    private static function encriptarPassword($password) {
        $opciones = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_DEFAULT, $opciones);
    }

    private static function verificarPassword($password, $hashPassword) {
        return password_verify($password, $hashPassword);
    }

    public static function codificar($des, $password, $hashPassword = null) {
        if ($des == 1) {
            return self::encriptarPassword($password);
        } elseif ($des == 2 && $hashPassword !== null) {
            return self::verificarPassword($password, $hashPassword);
        } else {
            return false; // Retorna falso si los parámetros no son válidos
        }
    }
}

class IdEncriptar {
    public static function encriptar($dato) {
        return base64_encode($dato);
    }
    
    public static function desencriptar($dato) {
        return base64_decode($dato);
    }
}
