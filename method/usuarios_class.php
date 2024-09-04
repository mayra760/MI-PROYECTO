<?php

class Usuarios{

    public static function eliminarCuentaUser($id){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Modelo::sqlEliminarUser($id);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

    public static function buscarId($email){
        include_once("modelo.php");
        $salida = "";
        $consulta = Modelo::sqlBuscarId($email);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }

    public static function verificaCon($contraseñaN,$doc){
        include_once("modelo.php");
        $consulta = Modelo::verficaClave($contraseñaN,$doc);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }
    
    

    public static function perfilUsuario($id) {
        include_once("modelo.php");
        include_once("login_class.php");
    
        $consulta = Modelo::sqlPerfil($id);
        $salida = "<div class='perfil-container'>";
    
        while ($fila = $consulta->fetch_assoc()) {
            // Definir la ruta de la foto o usar una predeterminada si no hay foto
            $foto = !empty($fila['foto']) ? '../img/' . $fila['foto'] : '../img/user.webp';
            $rol = Loguin::verRol($id); // Verificar el rol del usuario
            
            $salida .= "<div class='perfil-foto-container'>";
            if($rol==0){
                echo "<h1><center>Perfil del Administrador</center></h1>";
                $salida .= "<img id='perfilFoto' src='" . $foto . "' alt='Foto de perfil' class='perfil-foto' onclick='document.getElementById(\"inputFoto\").click();'>";
                $salida .= "<input type='file' id='inputFoto' style='display: none;' onchange='cambiarFotoAdmi()'>";
            }else{
                $salida .= "<img id='perfilFoto' src='" . $foto . "' alt='Foto de perfil' class='perfil-foto' onclick='document.getElementById(\"inputFoto\").click();'>";
                $salida .= "<input type='file' id='inputFoto' style='display: none;' onchange='cambiarFoto()'>";
    
            }
            $salida .= "</div>";
            $salida .= "<div class='perfil-datos'>";
            $salida .= "<div class='perfil-item'><span>Documento:</span> " . $fila['documento'] . "</div>";
            $salida .= "<div class='perfil-item'><span>Nombre:</span> " . $fila['nombre'] . "</div>";
            $salida .= "<div class='perfil-item'><span>Apellido:</span> " . $fila['apellido'] . "</div>";
            $salida .= "<div class='perfil-item'><span>Correo:</span> " . $fila['correo'] . "</div>";
            $salida .= "<div class='perfil-item'><span>Contraseña:</span> " . $fila['contraseña'] . "</div>";
            $salida .= "<div class='perfil-item'><span>Fecha de nacimiento:</span> " . $fila['fecha'] . "</div>";
            
            if(Loguin::verRol($id)==0){
                $salida .= "<a class='btn btn-success' href='../admi/ctroBar.php?seccion=actuUser' role='button'><i class='fa fa-pencil-alt'></i> Editar</a><br>";
                $salida .= "<a class='btn btn-danger' href='../ctroBar.php?seccion=ctroAdmi&eliCuenta=true'><i class='fas fa-trash-alt'></i> Eliminar cuenta</a>";
            }else{
                $salida .= "<a class='btn btn-success' href='../usuarios/conBaBus.php?seccion=actuUser' role='button'><i class='fa fa-pencil-alt'></i> Editar</a><br>";
                $salida .= "<a class='btn btn-danger' href='../conBaBus.php?seccion=ctroUser&eliCuenta=true'><i class='fas fa-trash-alt'></i> Eliminar cuenta</a>";

            }
            $salida .= "</div>";
        }
    
        $salida .= "</div>";
        return $salida;
    }
    

}
