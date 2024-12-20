<?php

class Loguin{

    public static function verificaUsuarios($documento, $contraseña) {
        include_once("modelo.php");
        // Recuperar el hash de la contraseña
        $consulta = Modelo::sqlLoguin($documento);

        if ($consulta) {
            $hashAlmacenado = $consulta['contraseña'];

            // Verificar la contraseña ingresada con el hash almacenado
            if (password_verify($contraseña, $hashAlmacenado)) {
                return true; // Contraseña correcta
            } else {
                return false; // Contraseña incorrecta
            }
        } else {
            return false; // Usuario no encontrado
        }
    }

    public static function registraUsuarios($documento, $nombre, $apellido, $correo, $contraseña, $fecha) {
        include_once("modelo.php");
        $salida = 0;

        // Configuración para password_hash
        $cont = [
            "cost" => 12
        ];

        // Encriptar la contraseña
        $contraEncrip = password_hash($contraseña, PASSWORD_DEFAULT, $cont);

        // Registrar al usuario en la base de datos
        $registro_exitoso = Modelo::sqlRegistar($documento, $nombre, $apellido, $correo, $contraEncrip, $fecha);
        
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
    

    public static function verRol($id) {
        include_once("modelo.php");  // Incluir el archivo del modelo, que contiene la lógica de acceso a datos.
        $salida = 0;  // Inicializa la variable $salida para almacenar el rol del usuario.
        $consulta = Modelo::sqlRol($id);  // Llama a la función sqlRol del modelo, pasando el ID, para obtener el rol correspondiente.
        // Itera sobre los resultados de la consulta.
        while ($fila = $consulta->fetch_array()) {  
            $salida = $fila[0];  // Asigna el primer valor de la fila (que se espera que sea el rol) a $salida.
        }
        return $salida;  // Devuelve el rol del usuario (o 0 si no se encontró).
    }
    public static function verDuplicados($documento,$correo){
        include_once("modelo.php");
        return Modelo::sqliDuplicados($documento, $correo) > 0;
    }
}