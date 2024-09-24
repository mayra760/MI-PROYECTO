<?php
class Modelo{

    // Función para verificar el acceso de un usuario
    public static function sqlLoguin($documento) {
        // Incluye el archivo que conecta con la base de datos
        include("db_fashion/cb.php");

        // Asegura que el documento ingresado esté limpio
        $documento = $conexion->real_escape_string($documento);

        // Busca la contraseña del usuario con el documento indicado
        $sql = "SELECT contraseña FROM tb_usuarios WHERE documento='$documento'";
        $resultado = $conexion->query($sql);

        // Si encuentra al usuario, devuelve su contraseña
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            // Si no lo encuentra, devuelve falso
            return false;
        }
    }

    // Función para registrar un nuevo usuario
    public static function sqlRegistar($documento, $nombre, $apellido, $correo, $contraseña) {
        // Conectar a la base de datos
        include("db_fashion/cb.php");

        // Inserta un nuevo usuario con los datos que recibe
        $sql = "INSERT INTO tb_usuarios(documento, nombre, apellido, correo, contraseña, rol) ";
        $sql .= "VALUES('$documento', '$nombre', '$apellido', '$correo', '$contraseña', '1')";

        // Ejecuta la consulta y devuelve el resultado
        return $resultado = $conexion->query($sql); 
    }

    // Función para verificar si el documento o el correo ya están registrados
    public static function sqliDuplicados($documento, $correo) {
        include 'db_fashion/cb.php';

        // Cuenta cuántos usuarios tienen el mismo documento o correo
        $sql = "SELECT COUNT(*) as total FROM tb_usuarios WHERE documento = '$documento' OR correo = '$correo'";
        $resultado = $conexion->query($sql);
        $row = $resultado->fetch_assoc();

        // Devuelve el número de coincidencias encontradas
        return $row['total']; 
    }

    // Función para obtener la información del perfil de un usuario por su documento
    public static function sqlPerfil($id) {
        include("db_fashion/cb.php");

        // Selecciona toda la información del usuario con el documento dado
        $sql = "SELECT * FROM tb_usuarios WHERE documento = '$id'";
        return $resultado = $conexion->query($sql); 
    }

    // Función para obtener el rol de un usuario
    public static function sqlRol($id) {
        include("db_fashion/cb.php");

        // Selecciona el rol del usuario con el documento dado
        $sql = "SELECT rol FROM tb_usuarios WHERE documento = '$id'";
        return $resultado = $conexion->query($sql); 
    }

    // Función para agregar un nuevo producto a la base de datos
    public static function sqlAgregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $ruta_img) {
        include("db_fashion/cb.php");

        // Inserta un nuevo producto con la información recibida
        $sql = "INSERT INTO tb_productos (id_categoria, nombre_producto, precio, cantidad, detalles, color, tallas, ruta_img) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            // Vincula los datos y ejecuta la consulta
            $stmt->bind_param("isdissss", $id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $ruta_img);
            $resultado = $stmt->execute();

            // Cierra la consulta y la conexión
            $stmt->close();
            $conexion->close();

            return $resultado;
        } else {
            // Si hay un error, devuelve falso
            return false;
        }
    }

    // Función para mostrar productos, con opción de buscar por nombre
    public static function sqlMostrarPro($buscar = null) {
        include("db_fashion/cb.php");

        // Selecciona todos los productos, pero si se da un valor para buscar, filtra por nombre
        $sql = "SELECT * FROM vista_productos_likes ";
        if ($buscar) {
            $sql .= "WHERE nombre_producto LIKE '%$buscar%';";
        }
        return $resultado = $conexion->query($sql);
    }

    // Función para agregar una nueva categoría
    public static function sqlAgregarCate($categoria) {
        include("db_fashion/cb.php");

        // Inserta la nueva categoría en la base de datos
        $sql = "INSERT INTO tb_categoria(categoria) VALUES ('$categoria')";
        return $resultado = $conexion->query($sql);    
    }

    // Función para ver todas las categorías
    public static function sqlVerCate() {
        include("db_fashion/cb.php");

        // Selecciona todas las categorías de la base de datos
        $sql = "SELECT * FROM tb_categoria";
        return $conexion->query($sql);
    }

    // Función para obtener el ID de la última categoría añadida
    public static function obtenerUltimaCategoria() {
        include("db_fashion/cb.php");

        // Busca la categoría con el número más alto (última añadida)
        $sql = "SELECT id_categoria FROM tb_categoria ORDER BY id_categoria DESC LIMIT 1";
        $resultado = $conexion->query($sql);

        // Si hay resultados, devuelve el ID de la última categoría
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['id_categoria'];
        }
        // Si no hay categorías, devuelve null
        return null;
    }

    // Función para ver una categoría por su ID
    public static function sqlVerCatePorId($id_categoria) {
        include("db_fashion/cb.php");

        // Selecciona la categoría con el ID dado
        $sql = "SELECT * FROM tb_categoria WHERE id_categoria = " . intval($id_categoria);
        return $conexion->query($sql);
    }

    // Función para obtener productos que pertenecen a una categoría específica
    public static function obtenerProductosPorCategoria($id_categoria) {
        include("db_fashion/cb.php");

        // Busca productos que pertenecen a la categoría indicada
        $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();

        // Devuelve el resultado de la búsqueda
        return $stmt->get_result();
    }

    // Función para eliminar un producto y sus "likes" relacionados
    public static function sqlEliminarPro($id) {
        include("db_fashion/cb.php");

        // Borra los likes asociados al producto
        $sqlLikes = "DELETE FROM tb_likes WHERE producto_id = '$id'";
        $conexion->query($sqlLikes);

        // Borra el producto de la base de datos
        $sqlProducto = "DELETE FROM tb_productos WHERE id_producto = '$id'";
        return $resultado = $conexion->query($sqlProducto);
    }


    public static function sqlEliminarCate($id) {
        // Incluye el archivo que conecta con la base de datos
        include("db_fashion/cb.php");
        // Prepara una consulta para eliminar todos los productos que pertenecen a la categoría con el ID dado
        $sqlEliminarProductos = "DELETE FROM tb_productos WHERE id_categoria = '$id'";
        // Ejecuta la consulta para eliminar los productos
        $conexion->query($sqlEliminarProductos);
        // Prepara otra consulta para eliminar la categoría con el ID dado
        $sql = "DELETE FROM tb_categoria WHERE id_categoria = '$id'";
        // Ejecuta la consulta para eliminar la categoría y devuelve el resultado de la operación
        return $conexion->query($sql);
    }
    
    
    

    public static function sqlCategorias($des, $idCate) {
        // Incluye el archivo que conecta con la base de datos
        include("db_fashion/cb.php");
        // Inicializa una variable vacía para almacenar el nombre de la columna
        $dato = "";
        // Si el parámetro $des es igual a 1, asigna "categoria" a la variable $dato
        if ($des == 1) {
            $dato = "categoria";
        }
        // Prepara una consulta SQL para seleccionar la columna especificada
        // de la tabla tb_categoria, filtrando por el id_categoria proporcionado
        $sql = "select $dato from tb_categoria ";
        $sql .= "where id_categoria = '$idCate'";
        // Ejecuta la consulta y devuelve el resultado
        return $resultado = $conexion->query($sql);
    }
    
    public static function sqlEditar($id_categoria, $categoria) {
        // Incluye la clase de productos
        include_once("productos_class.php");
        // Incluye el archivo de la conexion de la base de datos
        include("db_fashion/cb.php");
        // Prepara una consulta para actualizar el nombre de la categoría
        // en la tabla tb_categoria, usando el nuevo nombre proporcionado
        $sql = "update tb_categoria set categoria = '$categoria' ";
        $sql .= "where id_categoria = '$id_categoria' ";
        // Ejecuta la consulta y devuelve el resultado de la operación
        return $resultado = $conexion->query($sql);
    }    
    


    public static function sqlEliminarUser($id) {
        // Incluye el archivo de conexión a la base de datos
        include("db_fashion/cb.php");
    
        // Elimina registros relacionados en tb_likes
        $sqlLikes = "DELETE FROM tb_likes WHERE usuario_id = ?";
        if ($stmtLikes = $conexion->prepare($sqlLikes)) {
            $stmtLikes->bind_param("i", $id);
            $stmtLikes->execute();
            $stmtLikes->close();
        } else {
            return "Error al preparar la consulta para tb_likes: " . $conexion->error;
        }
    
        // Elimina las facturas relacionadas en tb_facturas
        $sqlFacturas = "DELETE FROM tb_facturas WHERE documento = ?";
        if ($stmtFacturas = $conexion->prepare($sqlFacturas)) {
            $stmtFacturas->bind_param("i", $id);
            $stmtFacturas->execute();
            $stmtFacturas->close();
        } else {
            return "Error al preparar la consulta para tb_facturas: " . $conexion->error;
        }
    
        // Elimina el usuario de tb_usuarios
        $sqlUsuarios = "DELETE FROM tb_usuarios WHERE documento = ?";
        if ($stmtUsuarios = $conexion->prepare($sqlUsuarios)) {
            $stmtUsuarios->bind_param("i", $id);
            $stmtUsuarios->execute();
            $stmtUsuarios->close();
        } else {
            return "Error al preparar la consulta para tb_usuarios: " . $conexion->error;
        }
    
        // Verifica si la eliminación fue exitosa
        if ($conexion->affected_rows > 0) {
            return true;  // El usuario y las entradas relacionadas se eliminaron con éxito
        } else {
            return "No se eliminaron registros o el usuario no existía.";  // Mensaje en caso de error
        }
    }

    public static function sqlDatoPro($des, $idPro) {
        // incluyes el archivo de la conexion de la base de datos
        include("db_fashion/cb.php");
        // Inicializa una variable que se usará para almacenar el nombre de la columna
        $dato = 0;
        // Dependiendo del valor de $des, asigna el nombre correspondiente de la columna
        if ($des == 1) $dato = "nombre_producto"; // Nombre del producto
        if ($des == 2) $dato = "precio";         // Precio del producto
        if ($des == 3) $dato = "cantidad";       // Cantidad del producto
        if ($des == 4) $dato = "detalles";       // Detalles del producto
        if ($des == 5) $dato = "color";          // Color del producto
        if ($des == 6) $dato = "tallas";         // Tallas del producto
        if ($des == 7) $dato = "ruta_img";       // Ruta de la imagen del producto
        // Prepara una consulta para seleccionar la columna correspondiente
        // de la tabla tb_productos, buscando por el ID del producto
        $sql = "select $dato from tb_productos ";
        $sql .= "where id_producto = '$idPro'";
        // Ejecuta la consulta y devuelve el resultado
        return $resultado = $conexion->query($sql);
    }
    

    public static function sqlEditarPro($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas) {
        include("db_fashion/cb.php");
    
        $sql = "UPDATE tb_productos 
                SET nombre_producto = '$nombre', 
                    precio = '$precio', 
                    cantidad = '$cantidad', 
                    detalles = '$detalles', 
                    color = '$color', 
                    tallas = '$tallas'
                WHERE id_producto = '$id_producto'";
                    
        return $resultado = $conexion->query($sql);
    }
    
    
    public static function sqlConteoEli() {
        // conexion de la base de datos
        include("db_fashion/cb.php");
        // Prepara una consulta para seleccionar todos los registros de la tabla tb_conteo
        $sql = "select * from tb_conteo ";
        // Ejecuta la consulta y devuelve el resultado
        return $resultado = $conexion->query($sql);
    }
    
    public static function sqlConteoReg(){
        include("db_fashion/cb.php");//incluye la conexion de la base de datos
        $sql = "select * from tb_conteo_reg ";//prepara la consulta para el conte de registros
        return $resultado = $conexion->query($sql);//ejecuta la consulta
    }
    public static function sqlConteoPro(){
        include("db_fashion/cb.php");//conexion de la base de datos
        $sql = "select * from tb_conteo_productos";//prepara la consulta con el conteo de los productos
        return $resultado = $conexion->query($sql);//ejecucion de la consulta
    }
    public static function sqlCambiarClave($nuevaClave, $id) {
        include("db_fashion/cb.php");//conexion de la base de datos
        // Prepara una consulta para actualizar la contraseña de un usuario
        // en la tabla tb_usuarios, usando la nueva contraseña proporcionada
        $sql = "update tb_usuarios set contraseña = '$nuevaClave' ";
        $sql .= "where documento = '$id'"; // Filtra por el documento del usuario
        // Ejecuta la consulta y devuelve el resultado de la operación
        return $resultado = $conexion->query($sql);
    }
    
    public static function sqlCambiarClaveEncrip($nuevaClave,$id){
        include("db_fashion/cb.php");//incluey la conexion de la base de datos
        $cont = [
            "cost" => 12
        ];

        // este es la encriptacion de contraseña
        $contraEncrip = password_hash($nuevaClave, PASSWORD_DEFAULT, $cont);

        $sql = "update tb_usuarios set contraseña = '$contraEncrip' ";
        $sql .= "where documento = '$id'";
        return $resultado = $conexion->query($sql);//ejecuta la consulta y devuelve la operacion
    }
    

    public static function sqlActualizarUser($idUser,$nombre,$apellido,$correo){
        include("db_fashion/cb.php");//conexion de la base de datos
        $sql = "update tb_usuarios set nombre = '$nombre', apellido = '$apellido', correo = '$correo' ";//prepara la consulta
        $sql .= "WHERE documento = '$idUser'";
        return $consulta = $conexion->query($sql);
    }

    public static function verficaClave($contraseñaN, $doc) {
        // conexion de la base de datos
        include("db_fashion/cb.php");
        // Aquí preparamos una consulta que cuenta cuántos usuarios tienen la contraseña que estamos verificando
        $sql = "select count(*) from tb_usuarios ";//se prepara la consulta
        $sql .= "WHERE contraseña = '$contraseñaN' and documento = '$doc'";
        // Finalmente, ejecutamos la consulta y devolvemos el resultado.
        return $resultado = $conexion->query($sql);
    }
    
    public static function sqlBuscarId($email) {
        // Incluimos el archivo para conectar con la base de datos.
        include("db_fashion/cb.php");
        // Preparamos una consulta para buscar a un usuario en la tabla 
        // tb_usuarios utilizando el correo electrónico proporcionado.
        $sql = "select * from tb_usuarios ";//aqui se prepara la consulta
        $sql .= "where correo = '$email'";
        // Ejecutamos la consulta y devolvemos el resultado.
        return $resultado = $conexion->query($sql);
    }
    
    public static function sqlBuscarUser($des, $busqueda) {
        // Nuevamente, incluimos el archivo de conexión a la base de datos.
        include("db_fashion/cb.php");
        // Dependiendo del valor de $des, determinamos qué campo vamos a 
        // utilizar para la búsqueda: puede ser el documento, el nombre 
        // o el correo del usuario.
        if($des == 1) $dato = "documento";
        if($des == 2) $dato = "nombre";
        if($des == 3) $dato = "correo";
        // Ahora preparamos una consulta que busca a un usuario en 
        // tb_usuarios según el campo que elegimos y el valor que 
        // se pasa como $busqueda.
        $sql = "select * from tb_usuarios where $dato = '$busqueda'";
        echo $sql; // Aquí mostramos la consulta por si necesitamos debuggear.
    
        // Finalmente, ejecutamos la consulta y devolvemos el resultado.
        return $resultado = $conexion->query($sql);
    }
    
    public static function buscarDatosUser($des, $id) {
        include("db_fashion/cb.php");
        $salida = "";
        $dato = ""; 
    
        if ($des == 1) $dato = "nombre";
        if ($des == 2) $dato = "apellido";
        if ($des == 3) $dato = "correo";
        if ($des == 4) $dato = "fecha";
    
        $sql = "SELECT $dato FROM tb_usuarios WHERE documento = '$id'";
        $resultado = $conexion->query($sql);
    
        while ($fila = $resultado->fetch_array()) {
            $salida = $fila[0];
        }
        return $salida;
    }
    
    
    public static function sqlMostrarUser($buscaUser = Null) { // Definimos una función para mostrar usuarios
        include("db_fashion/cb.php"); // Incluimos el archivo que conecta a la base de datos
    
        $sql = "select * from tb_usuarios "; // Creamos una consulta para seleccionar todos los usuarios de la tabla tb_usuarios
    
        $sql .= "where documento like '$buscaUser%'"; // Agregamos una condición para buscar usuarios cuyo documento empiece con el valor de $buscaUser
    
        return $resultado = $conexion->query($sql); // Ejecutamos la consulta y devolvemos el resultado
    }
    

    public static function sqlMostrarDaUser($des,$idUser){
        include("db_fashion/cb.php");
        $dato = 0;
        if($des==1) $dato = "nombre";
        if($des==2) $dato = "apellido";
        if($des==3) $dato = "correo";
        if($des==4) $dato = "contraseña";
        if($des==5) $dato = "fecha";
        $sql = "select $dato from tb_usuarios ";
        $sql .= "WHERE documento = $idUser";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlVerificLike($usuario_id, $producto_id) {
        include("db_fashion/cb.php");
    
        // Consulta para verificar el like para un producto específico
        $sql = "SELECT COUNT(*) as count FROM tb_likes WHERE usuario_id = '$usuario_id' AND producto_id = '$producto_id'";
        return $conexion->query($sql);
    }
    
    public static function sqlAgregarLike($usuario_id, $producto_id) {
        include("db_fashion/cb.php"); //se incluye la conexion de la base de datos
        include_once("productos_class.php");
        // Verificar si el like ya existe para ese producto
        $likeExists = Productos::verificLike($usuario_id, $producto_id);
    
        if ($likeExists == 1) {
            // Eliminar el like si ya existe
            $operacion = "DELETE FROM tb_likes WHERE usuario_id = '$usuario_id' AND producto_id = '$producto_id'";
        } else {
            // Insertar un nuevo like
            $operacion = "INSERT INTO tb_likes (producto_id, usuario_id, valor) VALUES ('$producto_id', '$usuario_id', 'like')";
        }
        return $conexion->query($operacion);//ejecuta al consulta
    }
  
    public static function sqlActuFoto($foto, $id_user) {
        include("db_fashion/cb.php");//conexion de la base de datos 
        $sql = "UPDATE tb_usuarios SET foto = '$foto' WHERE documento = '$id_user'";//consulta
        if ($conexion->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error en la consulta SQL: " . $conexion->error;
            return false;
        }
    }

/**mayra */

public static function sqlmostrarCateg($categoria) {
    include 'db_fashion/cb.php';//conexion de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";//se obtiene los resultados de la base de datos
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria);//asumiendo que la categoria es un entero
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        echo "No se encontraron productos para la categoría $categoria.";
        return $result;
    }
}


public static function sqlCateNiños($categoria) {
    include 'db_fashion/cb.php';//conexion de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";//se prepara la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // la i representa que la categoria es un entero
    $stmt->execute();
    return $stmt->get_result(); // Devuelve el resultado de la consulta
}


public static function sqlverAcce($categoria) {
    include 'db_fashion/cb.php';//conecion de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";//consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // asume que la categoria es un entero
    $stmt->execute();

    return $stmt->get_result(); // Devuelve el resultado de la consulta
}


public static function sqlverZapatos($categoria) {
    include 'db_fashion/cb.php';
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // asume que la categoria es un entero
    $stmt->execute();

    return $stmt->get_result(); // Devuelve el resultado de la consulta
}

    public static function sqlVerFavoritos(){
        include 'db_fashion/cb.php';//inlcuye la conexion de la base de datos
        $salida = "";
        $sql = "SELECT * FROM tb_favoritos";//selecciona la tabla de la base de datos
        return $consulta = $conexion->query($sql);
    }

    public static function sqlverCarrito(){
        include 'db_fashion/cb.php';//inlcuye la conexion de la base de datos
        $salida = "";
        $sql = "SELECT * FROM tb_carrito";//selecciona la tabla de la base de datos
        return $consulta = $conexion->query($sql);
    } 

    public static function sqlBuscador() {
        include 'db_fashion/cb.php'; // Conexión a la base de datos
    
        $query = isset($_GET['query']) ? $_GET['query'] : ''; // Se obtiene el término de la búsqueda
    
        // Consulta a la base de datos
        $sql = "SELECT * FROM tb_productos WHERE nombre_producto LIKE ?";
        $fila = $conexion->prepare($sql);
        $searchTerm = "%" . $query . "%";
        $fila->bind_param('s', $searchTerm);
        $fila->execute();
    
        $resultado = $fila->get_result();
        $fila->close(); // Cerramos la consulta preparada
        $conexion->close(); // Cerramos la conexión
    
        return $resultado;
    }

}
