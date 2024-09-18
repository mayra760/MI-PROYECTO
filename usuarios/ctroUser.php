<?php
include_once("../method/usuarios_class.php");
include_once("../method/productos_class.php");
include_once("../method/token_class.php");
include_once("../method/correo_class.php");
include_once("../method/modelo.php");
include_once("../method/encrip_class.php");
include_once("../method/controler_login.php");
 


if (isset($_GET['eliCuenta'])) {
    if (Usuarios::eliminarCuentaUser($_SESSION['id'])) {
        session_unset();    // Limpia la sesión
        session_destroy();  // Destruye la sesión
        // Muestra un mensaje de confirmación
        echo "<h1>Tu cuenta ha sido eliminada correctamente.</h1>";
        echo "<a href='../login.php'><button class ='btn btn-danger'>volver a login</button></a>";  // Enlace al login
    } else {
        echo "Error al eliminar la cuenta.";
    }
}



if(isset($_GET['idBuscador'])){
    echo Productos::mostrarPro($_GET['idBuscador']);
    

}

if (isset($_GET['recuperar'])) {
    if (isset($_POST['correo'])) {
        if (Usuarios::buscarId($_POST['correo']) == 0) {
            echo "Error: escribiste mal la contraseña o no apareces en el sistema";
        } else {
            $correo = $_POST['correo'];
            $dato = token::creartoken(10);
            echo Correo::enviarCorreo($correo, $dato);
        }
    }
}

if(isset($_GET['ediUser'])) {
    if(isset($_GET['dato'])) {
        $idUser = $_GET['dato'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        if(Productos::actualizarUser($idUser, $nombre, $apellido, $correo)==1) {
            header("location: conBaBus.php?seccion=perfil");
        }
    }
}

if(isset($_GET['cambioCo'])){
    if(isset($_POST['nuevaClave']) && isset($_POST['newPassword'])){
        $contraseñaN = $_POST['nuevaClave'];
        $contraseñaUser = $_POST['newPassword'];
        $doc = EncriptarURl::desencriptar($_GET['codigo']);
        
        if(Usuarios::verificaCon($contraseñaN,$doc)==0){
            echo "la contraseña no coincide";
        }else{
            if( Modelo::sqlCambiarClaveEncrip($contraseñaUser,$doc)){
                header("location:../login.php");
            }
           
        }
        
        // if(Modelo::verficaClave($contraseñaN)){ 
        //     header("location: conBaBus.php");
        //     exit; // Agrega esta línea para evitar problemas con la redirección
        // }
    }
}

if (isset($_GET['like'])) {
    $usuario_id = $_SESSION['id'];
    $producto_id = $_POST['idProducto'];

    // Llama a la función para agregar o quitar like
    $resultado = Productos::agregarLike($usuario_id, $producto_id);
    
    if ($resultado) {
        // Usar la conexión desde cb.php
        include("../method/db_fashion/cb.php");  // Asegúrate de que $conexion esté disponible

        // Consulta actualizada para obtener los likes del producto específico
        $sql = "SELECT COUNT(*) as total_likes FROM tb_likes WHERE producto_id = '$producto_id'";
        $consulta = $conexion->query($sql);
        
        if ($consulta) {
            $fila = $consulta->fetch_assoc();
            echo $fila['total_likes'];  // Retorna el número de 'likes'
        } else {
            echo "Error en la consulta SQL";
        }
    } else {
        echo "Error al procesar el like";
    }
    exit;
}


if (isset($_POST['cambiarfoto']) && $_POST['cambiarfoto'] === 'true') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $fileExtension; // Genera un nombre único
        $uploadFileDir = '../img/';
        $dest_path = $uploadFileDir . $newFileName;

        $id_user = $_SESSION['id'];

        // Obtener la foto actual del usuario
        $consulta = Modelo::sqlPerfil($id_user);
        $fila = $consulta->fetch_assoc();
        $fotoAnterior = $fila['foto'];

        // Eliminar la imagen anterior si existe
        if (!empty($fotoAnterior) && file_exists($uploadFileDir . $fotoAnterior)) {
            unlink($uploadFileDir . $fotoAnterior);
        }

        // Mover la nueva imagen al servidor
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Actualizar la base de datos con la nueva imagen
            if (Modelo::sqlActuFoto($newFileName, $id_user)) {
                echo $uploadFileDir . $newFileName; // Devuelve la ruta de la nueva imagen
            } else {
                echo 'Error al actualizar la base de datos';
            }
        } else {
            echo 'Error al mover el archivo';
        }
    } else {
        echo 'Error en la carga del archivo';
    }
} else {
    echo 'Solicitud no válida';
}


?>