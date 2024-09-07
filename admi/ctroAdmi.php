<?php
include_once("../method/productos_class.php");
include_once('../method/usuarios_class.php');
include_once('../method/login_class.php');
include_once('../method/modelo.php');
if(!isset($_SESSION))session_start();

//esto es para crear un producto
if(isset($_POST['crear'])){
    // Recibir los datos del formulario
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $tallas = $_POST['tallas'];
    $imagen = $_FILES['imagen'];

    // Definir el directorio de destino
    $target_dir = "../img/"; // Ajusta esta ruta según donde desees guardar la imagen
    $target_file = $target_dir . basename($imagen["name"]);
    
    // Verificar si la imagen se subió correctamente
    if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
        // Llama a la función para agregar el producto, pasando el nombre de la imagen
        if(Productos::agregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $target_file) == 1){
            header("location:ctroBar.php?seccion=verPro");
        }
    } else {
        echo "Lo siento, hubo un error al subir la imagen.";
    }
}


//esto es para agregar una categoria
if(isset($_GET['agreCate'])){
    $id_categoria = $_POST['id_categoria'];
    $categoria = $_POST['categoria'];
    Productos::agregarCate($id_categoria,$categoria);
} 

//esto es para eliminar categoria
if(isset($_GET['idCateEliminar'])){
    if(Productos::eliminarCate($_GET['idCateEliminar'])==1){
        echo Productos::mostrarCate(); 
    }else{
        echo 0;
    }
}

//Elimina producto
if(isset($_GET['idProEliminar'])){
    // echo $_GET['idProEliminar'];
    if(Productos::eliminarPro($_GET['idProEliminar'])==1){
        echo Productos::mostrarPro(); 
    }else{
        echo 0;
    }
}

//Actualizar categoria
if(isset($_GET['ediCate'])){
    $categoria = $_POST['categoria'];
    $id_categoria = $_GET['dato'];
    if(Productos::editarCategoria($id_categoria,$categoria)==1){
        header("location:ctroBar.php?seccion=verCate");
    }
} 

if(isset($_GET['bou'])){
    $id = $_POST['documento'];
    if(Productos::eliminarUser($id)==1){
        header("location:login.php");
    }
}

if (isset($_GET['ediPro'])) {
    $id_producto = $_GET['dato'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $detalles = $_POST['detalles'];
    $color = $_POST['color'];
    $tallas = $_POST['tallas'];
    $imagen = '';

    // Verifica si se ha subido una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $upload_dir = '../imagenes/'; // Cambia esto a tu directorio de carga
        $upload_file = $upload_dir . basename($imagen);

        // Mueve el archivo subido al directorio de destino
        if (move_uploaded_file($tmp_name, $upload_file)) {
            // Imagen subida correctamente
        } else {
            echo 'Error al subir la imagen.';
        }
    } else {
        // Si no se ha subido una nueva imagen, mantiene la imagen actual
        $imagen = Productos::datoPro(5, $id_producto);
    }

    // Actualiza el producto en la base de datos
    if (Productos::editarProducto($id_producto, $nombre, $precio, $cantidad, $detalles,$color,$tallas, $imagen) == 1) {
        header("Location: ctroBar.php?seccion=verPro");
        exit();
    } else {
        echo 'Error al actualizar el producto.';
    }
}

if(isset($_GET['eli'])){
    header("location:ctroBar.php?seccion=verConteoEli");
        
}

if(isset($_GET['reg'])){
    header("location:ctroBar.php?seccion=verConteoReg");
}
if(isset($_GET['producto'])){
    header("location:ctroBar.php?seccion=verConteoProductos");
}
if (isset($_GET['buscarU']) && $_GET['buscarU'] == 'true') {
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
        echo Productos::buscarUsuario(1, $busqueda);
    } else {
        echo "Parámetro de búsqueda no proporcionado.";
    }
}

if(isset($_GET['IDbuscar'])){
    echo Productos::mostrarUsuarios($_GET['IDbuscar']);
    
}

if(isset($_GET['eliCuenta'])){
    if(Usuarios::eliminarCuentaUser($_SESSION['id'])){
        header("location:../index.php");
    }
}

if(isset($_GET['ediUser'])) {
    if(isset($_GET['dato'])) {
        $idUser = $_GET['dato'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        if(Productos::actualizarUser($idUser, $nombre, $apellido, $correo)==1) {
            header("location: ctroBar.php?seccion=perfilAdmi");
        }
    }
}


if (isset($_POST['cambiarfoto']) && $_POST['cambiarfoto'] === 'true') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $fileExtension; // Genera un nombre único para evitar conflictos
        $uploadFileDir = '../imagenes/';
        $dest_path = $uploadFileDir . $newFileName;

        $id_admin = $_SESSION['id'];

        // Obtener la foto actual del usuario
        $consulta = Modelo::sqlPerfil($id_admin);
        $fila = $consulta->fetch_assoc();
        $fotoAnterior = $fila['foto'];

        // Eliminar la imagen anterior si existe
        if (!empty($fotoAnterior) && file_exists($uploadFileDir . $fotoAnterior)) {
            unlink($uploadFileDir . $fotoAnterior);
        }

        // Mover la nueva imagen al servidor
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Actualizar la base de datos con la nueva imagen
            if (Modelo::sqlActuFoto($newFileName, $id_admin)) {
                // Devuelve la ruta completa para actualizar la imagen en la interfaz
                echo $uploadFileDir . $newFileName;  
            } else {
                echo 'Error al actualizar la base de datos';
            }
        } else {
            echo 'Error al mover el archivo';
        }
    } else {
        echo 'Error en la carga del archivo';
    }
}
   


    

