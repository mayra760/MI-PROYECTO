<?php
class Modelo{

/**
 * Verifica el acceso de un usuario consultando su contraseña en la base de datos.
 *
 * @param string $documento Documento de identidad del usuario.
 * @return mixed Devuelve un arreglo asociativo con la contraseña del usuario si existe, o `false` si no se encuentra.
 */
public static function sqlLoguin($documento) {
    include("db_fashion/cb.php");  // Incluye la conexión a la base de datos.

    // Limpia el documento para prevenir inyecciones SQL.
    $documento = $conexion->real_escape_string($documento);

    // Consulta para obtener la contraseña del usuario según el documento proporcionado.
    $sql = "SELECT contraseña FROM tb_usuarios WHERE documento='$documento'";
    $resultado = $conexion->query($sql);
    $conexion->close();
    // Si encuentra al usuario, devuelve la contraseña; de lo contrario, devuelve false.
    return ($resultado && $resultado->num_rows > 0) ? $resultado->fetch_assoc() : false;
    
}

 
/**
 * Registra un nuevo usuario en la base de datos si el documento no existe previamente.
 *
 * @param string $documento Documento de identidad del usuario.
 * @param string $nombre Nombre del usuario.
 * @param string $apellido Apellido del usuario.
 * @param string $correo Correo electrónico del usuario.
 * @param string $contraseña Contraseña del usuario.
 * @return mixed Devuelve `true` si el registro fue exitoso, o `false` si el documento ya existe.
 */
public static function sqlRegistar($documento, $nombre, $apellido, $correo, $contraseña) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Verifica si el documento ya existe en la base de datos.
    $check_sql = "SELECT * FROM tb_usuarios WHERE documento = '$documento'";
    $result = $conexion->query($check_sql);

    // Si el documento ya existe, retorna `false` para indicar duplicado.
    if ($result->num_rows > 0) {
        $conexion->close(); //cierra la conexion
        return false;  // El documento ya está registrado.
    } else {
        // Si no existe, inserta un nuevo usuario con los datos proporcionados.
        $sql = "INSERT INTO tb_usuarios(documento, nombre, apellido, correo, contraseña, rol) ";
        $sql .= "VALUES('$documento', '$nombre', '$apellido', '$correo', '$contraseña', '1')";
        $resultado=$conexion->query($sql);
        // Ejecuta la consulta e indica si el registro fue exitoso.
        $conexion->close();
        return $resultado;
    }
}



/**
 * Verifica si el documento o el correo ya están registrados en la base de datos.
 *
 * @param string $documento Documento de identidad del usuario.
 * @param string $correo Correo electrónico del usuario.
 * @return int Devuelve el número de coincidencias encontradas (0 si no existen, >0 si están duplicados).
 */
public static function sqliDuplicados($documento, $correo) {
    include 'db_fashion/cb.php';  // Conecta a la base de datos.

    // Consulta para contar cuántos usuarios tienen el mismo documento o correo.
    $sql = "SELECT COUNT(*) as total FROM tb_usuarios WHERE documento = '$documento' OR correo = '$correo'";
    $resultado = $conexion->query($sql);

    // Obtiene el número de coincidencias encontradas.
    $row = $resultado->fetch_assoc();
 
    $conexion->close();//cierra la conexion de la  base de datos
    // Devuelve el número total de coincidencias.
    return $row['total'];
}


/**
 * Obtiene la información del perfil de un usuario según su documento de identidad.
 *
 * @param string $id Documento de identidad del usuario.
 * @return mixed Devuelve el resultado de la consulta que contiene la información del usuario.
 */
public static function sqlPerfil($id) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Realiza una consulta para seleccionar toda la información del usuario con el documento dado.
    $sql = "SELECT * FROM tb_usuarios WHERE documento = '$id'";
    $resultado = $conexion->query($sql);

    $conexion->close();//cierre de la coexion 

    return $resultado;//devuelve el resultado de la consulta
}


/**
 * Obtiene el rol de un usuario según su documento de identidad.
 *
 * @param string $id Documento de identidad del usuario.
 * @return mixed Devuelve el resultado de la consulta que contiene el rol del usuario.
 */
public static function sqlRol($id) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Realiza una consulta para seleccionar el rol del usuario con el documento proporcionado.
    $sql = "SELECT rol FROM tb_usuarios WHERE documento = '$id'";
    $resultado = $conexion->query($sql);

    $conexion->close();//cierre de la coexion 

    return $resultado;//devuelve el resultado de la consulta
}


/**
 * Agrega un nuevo producto a la base de datos.
 *
 * @param int $id_categoria ID de la categoría del producto.
 * @param string $nombre Nombre del producto.
 * @param float $precio Precio del producto.
 * @param int $cantidad Cantidad del producto.
 * @param string $descripcion Descripción del producto.
 * @param string $color Color del producto.
 * @param string $tallas Tallas disponibles para el producto.
 * @param string $ruta_img Ruta de la imagen del producto.
 * @return bool Indica si la operación fue exitosa.
 */
public static function sqlAgregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $ruta_img) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Inserta un nuevo producto con la información recibida utilizando una consulta preparada.
    $sql = "INSERT INTO tb_productos (id_categoria, nombre_producto, precio, cantidad, detalles, color, tallas, ruta_img) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        // Vincula los parámetros y ejecuta la consulta.
        $stmt->bind_param("isdissss", $id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $ruta_img);
        $resultado = $stmt->execute();

        // Cierra la declaración y la conexión.
        $stmt->close();
        $conexion->close();

        return $resultado;  // Devuelve el resultado de la ejecución.
    } else {
        return false;  // Devuelve falso si hubo un error.
    }
}

/**
 * Muestra productos, con opción de buscar por nombre.
 *
 * @param string|null $buscar Nombre del producto a buscar.
 * @return mixed Resultado de la consulta de productos.
 */
public static function sqlMostrarPro($buscar = null) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Consulta que une las tablas tb_productos y tb_likes para obtener la información del producto y los likes.
    $sql = "SELECT p.id_producto AS id_producto, 
                   p.nombre_producto AS nombre_producto, 
                   p.precio AS precio, 
                   p.cantidad AS cantidad, 
                   p.detalles AS detalles, 
                   p.color AS color, 
                   p.tallas AS tallas, 
                   p.ruta_img AS ruta_img, 
                   COUNT(l.id_like) AS total_likes 
            FROM tb_productos p 
            LEFT JOIN tb_likes l ON p.id_producto = l.producto_id 
            GROUP BY p.id_producto";

    // Si se proporciona un valor para buscar, filtra por nombre_producto.
    if ($buscar) {
        $sql .= " HAVING nombre_producto LIKE '%$buscar%';";
    }

    $resultado = $conexion->query($sql);//ejecuta y guarda resultados
    $conexion->close(); //cierre
        // Devuelve el resultado de la consulta.
    return $resultado;  
}

/**
 * Agrega una nueva categoría a la base de datos.
 *
 * @param string $categoria Nombre de la categoría a agregar.
 * @return mixed Resultado de la consulta de inserción.
 */
public static function sqlAgregarCate($categoria) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Inserta la nueva categoría en la base de datos.
    $sql = "INSERT INTO tb_categoria(categoria) VALUES ('$categoria')";
    $resultado= $conexion->query($sql);  //ejecuta la conexion
    $conexion->close();
    return $resultado;
}

/**
 * Muestra todas las categorías de la base de datos.
 *
 * @return mixed Resultado de la consulta que contiene todas las categorías.
 */
public static function sqlVerCate() {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Selecciona todas las categorías de la base de datos.
    $sql = "SELECT * FROM tb_categoria";
    $resultado= $conexion->query($sql);  // Devuelve el resultado de la consulta.
    $conexion->close();
    return $resultado;
}

/**
 * Obtiene el ID de la última categoría añadida.
 *
 * @return int|null ID de la última categoría o null si no hay categorías.
 */
public static function obtenerUltimaCategoria() {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    $sql = "SELECT id_categoria FROM tb_categoria ORDER BY id_categoria DESC LIMIT 1";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $conexion->close();  // Cierra la conexión a la base de datos.
        return $fila['id_categoria'];
    }
    $conexion->close();  // Cierra la conexión en caso de no encontrar categorías.
    return null;
}


/**
 * Muestra una categoría por su ID.
 *
 * @param int $id_categoria ID de la categoría a buscar.
 * @return mixed Resultado de la consulta que contiene la categoría.
 */
public static function sqlVerCatePorId($id_categoria) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Selecciona la categoría con el ID dado.
    $sql = "SELECT * FROM tb_categoria WHERE id_categoria = " . intval($id_categoria);
    $resultado= $conexion->query($sql);  // resultado de la consulta.
    $conexion->close();
    return $resultado;
}

/**
 * Obtiene productos que pertenecen a una categoría específica.
 *
 * @param int $id_categoria ID de la categoría para buscar productos.
 * @return mysqli_result Resultado de la búsqueda de productos en la categoría especificada.
 */
public static function obtenerProductosPorCategoria($id_categoria) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Busca productos que pertenecen a la categoría indicada.
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();

    $resultado= $stmt->get_result();
    $stmt->close();  // Cierra la declaración preparada.
    $conexion->close();  // Cierra la conexión a la base de datos.
    return $resultado;  // Devuelve el resultado de la búsqueda.
}


/**
 * Elimina un producto y sus "likes" relacionados.
 *
 * @param int $id ID del producto a eliminar.
 * @return bool Resultado de la operación de eliminación del producto.
 */
public static function sqlEliminarPro($id) {
    include("db_fashion/cb.php");  // Conecta a la base de datos.

    // Borra los likes asociados al producto.
    $sqlLikes = "DELETE FROM tb_likes WHERE producto_id = '$id'";
    $conexion->query($sqlLikes);

    $sqlProducto = "DELETE FROM tb_productos WHERE id_producto = '$id'";// Borra el producto de la base de datos.
    $resultado = $conexion->query($sqlProducto);
    
    $conexion->close();// Cierra la conexión a la base de datos.

    return $resultado;  // Devuelve el resultado de la operación de eliminación del producto.
}


/**
 * Elimina una categoría y todos los productos asociados a ella.
 *
 * @param int $id ID de la categoría a eliminar.
 * @return bool Resultado de la operación de eliminación de la categoría.
 */
public static function sqlEliminarCate($id) {
    // Incluye el archivo que conecta con la base de datos.
    include("db_fashion/cb.php");
    
    $sqlEliminarProductos = "DELETE FROM tb_productos WHERE id_categoria = '$id'";

    $conexion->query($sqlEliminarProductos);// Ejecuta la consulta para eliminar los productos.
    $sql = "DELETE FROM tb_categoria WHERE id_categoria = '$id'";
    
    $resultado = $conexion->query($sql);// Ejecuta la consulta para eliminar la categoría.
    
    $conexion->close();// Cierra la conexión a la base de datos.

    return $resultado;  // Devuelve el resultado de la operación de eliminación de la categoría.
}


/**
 * Obtiene una categoría específica por su ID.
 *
 * @param int $des Determina la columna a seleccionar (1 para "categoria").
 * @param int $idCate ID de la categoría a buscar.
 * @return mysqli_result Resultado de la búsqueda de la categoría.
 */
public static function sqlCategorias($des, $idCate) {
    // Incluye el archivo que conecta con la base de datos.
    include("db_fashion/cb.php");
    
    // Inicializa una variable vacía para almacenar el nombre de la columna.
    $dato = "";
    
    // Si el parámetro $des es igual a 1, asigna "categoria" a la variable $dato.
    if ($des == 1) {
        $dato = "categoria";
    }
    
    // Prepara una consulta SQL para seleccionar la columna especificada de la tabla tb_categoria,
    // filtrando por el id_categoria proporcionado.
    $sql = "SELECT $dato FROM tb_categoria WHERE id_categoria = '$idCate'";
    
    // Ejecuta la consulta y devuelve el resultado.
     $resultado = $conexion->query($sql);
     $conexion->close();
     return $resultado;//devuelve el resultado de la consulta
}

/**
 * Actualiza el nombre de una categoría en la base de datos.
 *
 * @param int $id_categoria ID de la categoría a actualizar.
 * @param string $categoria Nuevo nombre de la categoría.
 * @return bool Resultado de la operación de actualización.
 */
public static function sqlEditar($id_categoria, $categoria) {
    // Incluye la clase de productos.
    include_once("productos_class.php");
    
    // Incluye el archivo de la conexión de la base de datos.
    include("db_fashion/cb.php");
    
    // Prepara una consulta para actualizar el nombre de la categoría en la tabla tb_categoria,
    // usando el nuevo nombre proporcionado.
    $sql = "UPDATE tb_categoria SET categoria = '$categoria' WHERE id_categoria = '$id_categoria'";
    
    // Ejecuta la consulta y devuelve el resultado de la operación.
    $resultado = $conexion->query($sql);
    $conexion->close();//cierre de la conexion 
    return $resultado;//devuelve el resultado de la consulta
}

/**
 * Elimina un usuario y todos los registros relacionados.
 *
 * @param int $id ID del usuario a eliminar.
 * @return bool|string Resultado de la operación de eliminación o un mensaje de error en caso de fallo.
 */
public static function sqlEliminarUser($id) {
    // Incluye el archivo de conexión a la base de datos.
    include("db_fashion/cb.php");

    // Elimina registros relacionados en tb_likes.
    $sqlLikes = "DELETE FROM tb_likes WHERE usuario_id = ?";
    if ($stmtLikes = $conexion->prepare($sqlLikes)) {
        $stmtLikes->bind_param("i", $id);
        $stmtLikes->execute();
        $stmtLikes->close();
    } else {
        return "Error al preparar la consulta para tb_likes: " . $conexion->error;
    }

    // Elimina las facturas relacionadas en tb_facturas.
    $sqlFacturas = "DELETE FROM tb_facturas WHERE documento = ?";
    if ($stmtFacturas = $conexion->prepare($sqlFacturas)) {
        $stmtFacturas->bind_param("i", $id);
        $stmtFacturas->execute();
        $stmtFacturas->close();
    } else {
        return "Error al preparar la consulta para tb_facturas: " . $conexion->error;
    }

    // Elimina el usuario de tb_usuarios.
    $sqlUsuarios = "DELETE FROM tb_usuarios WHERE documento = ?";
    if ($stmtUsuarios = $conexion->prepare($sqlUsuarios)) {
        $stmtUsuarios->bind_param("i", $id);
        $stmtUsuarios->execute();
        $stmtUsuarios->close();
    } else {
        return "Error al preparar la consulta para tb_usuarios: " . $conexion->error;
    }

    // Verifica si la eliminación fue exitosa.
    if ($conexion->affected_rows > 0) {
        return true;  // El usuario y las entradas relacionadas se eliminaron con éxito.
    } else {
        return "No se eliminaron registros o el usuario no existía.";  // Mensaje en caso de error.
    }
}


/**
 * Obtiene un dato específico de un producto basado en su ID.
 *
 * @param int $des Determina qué dato del producto se debe recuperar (1 para nombre, 2 para precio, etc.).
 * @param int $idPro ID del producto del cual se desea obtener el dato.
 * @return mysqli_result Resultado de la consulta con el dato solicitado del producto.
 */
public static function sqlDatoPro($des, $idPro) {
    // Incluye el archivo de la conexión de la base de datos
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
    $sql = "SELECT $dato FROM tb_productos WHERE id_producto = '$idPro'";

    // Ejecuta la consulta y devuelve el resultado
     $resultado = $conexion->query($sql);
     $conexion->close();
     return $resultado;
}

    

/**
 * Actualiza la información de un producto en la base de datos.
 *
 * @param int $id_producto ID del producto que se desea actualizar.
 * @param string $nombre Nuevo nombre del producto.
 * @param float $precio Nuevo precio del producto.
 * @param int $cantidad Nueva cantidad del producto.
 * @param string $detalles Nuevos detalles del producto.
 * @param string $color Nuevo color del producto.
 * @param string $tallas Nuevas tallas del producto.
 * @return bool Resultado de la operación de actualización (true si tuvo éxito, false si falló).
 */
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

     $resultado = $conexion->query($sql);
     $conexion->close();
     return $resultado;
}

    
    
/**
 * Obtiene todos los registros de la tabla tb_conteo.
 *
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
public static function sqlConteoEli() {
    // conexión de la base de datos
    include("db_fashion/cb.php");
    $sql = "SELECT * FROM tb_conteo ";
    // Ejecuta la consulta y devuelve el resultado
     $resultado = $conexion->query($sql);
     $conexion->close();
     return $resultado;
}

/**
 * Obtiene todos los registros de la tabla tb_conteo_reg.
 *
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
public static function sqlConteoReg() {
    include("db_fashion/cb.php"); // incluye la conexión de la base de datos
    $sql = "SELECT * FROM tb_conteo_reg "; // prepara la consulta para el conteo de registros
    $resultado = $conexion->query($sql);
    $conexion->close();
    return $resultado;

}

/**
 * Obtiene todos los registros de la tabla tb_conteo_productos.
 *
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
public static function sqlConteoPro() {
    include("db_fashion/cb.php"); // conexión de la base de datos
    $sql = "SELECT * FROM tb_conteo_productos"; // prepara la consulta con el conteo de los productos
    $resultado = $conexion->query($sql); // ejecución de la consulta
    $conexion->close();
    return $resultado;
}

/**
 * Cambia la contraseña de un usuario en la base de datos.
 *
 * @param string $nuevaClave Nueva contraseña que se desea establecer.
 * @param string $id Documento del usuario cuya contraseña se va a cambiar.
 * @return bool Resultado de la operación de actualización (true si tuvo éxito, false si falló).
 */
public static function sqlCambiarClave($nuevaClave, $id) {
    include("db_fashion/cb.php"); // conexión de la base de datos
    // Prepara una consulta para actualizar la contraseña de un usuario
    // en la tabla tb_usuarios, usando la nueva contraseña proporcionada
    $sql = "UPDATE tb_usuarios SET contraseña = '$nuevaClave' ";
    $sql .= "WHERE documento = '$id'"; // Filtra por el documento del usuario
    // Ejecuta la consulta y devuelve el resultado de la operación
     $resultado = $conexion->query($sql);
     $conexion->close();
     return $resultado;
}

/**
 * Cambia la contraseña de un usuario en la base de datos, encriptándola.
 *
 * @param string $nuevaClave Nueva contraseña que se desea establecer.
 * @param string $id Documento del usuario cuya contraseña se va a cambiar.
 * @return bool Resultado de la operación de actualización (true si tuvo éxito, false si falló).
 */
public static function sqlCambiarClaveEncrip($nuevaClave, $id) {
    include("db_fashion/cb.php"); // incluye la conexión de la base de datos
    $cont = [
        "cost" => 12
    ];

    // Este es la encriptación de contraseña
    $contraEncrip = password_hash($nuevaClave, PASSWORD_DEFAULT, $cont);

    $sql = "UPDATE tb_usuarios SET contraseña = '$contraEncrip' ";
    $sql .= "WHERE documento = '$id'";
    $resultado = $conexion->query($sql); // ejecuta la consulta y devuelve la operación
    $conexion->close();
    return $resultado;
}

/**
 * Actualiza los datos de un usuario en la base de datos de forma segura.
 *
 * @param int $idUser El ID del usuario que se desea actualizar.
 * @param string $nombre El nuevo nombre del usuario.
 * @param string $apellido El nuevo apellido del usuario.
 * @param string $correo El nuevo correo del usuario.
 * @return bool Devuelve true si la actualización fue exitosa; de lo contrario, false.
 */
public static function sqlActualizarUser($idUser, $nombre, $apellido, $correo) {
    include("db_fashion/cb.php"); // conexión de la base de datos

    $sql = "UPDATE tb_usuarios SET nombre = ?, apellido = ?, correo = ? WHERE documento = ?";

    if ($stmt = $conexion->prepare($sql)) {
        // Asegúrate de que el ID sea un entero para evitar SQL Injection
        $stmt->bind_param("sssi", $nombre, $apellido, $correo, $idUser);
        $result = $stmt->execute();
        $stmt->close(); // Cierra el statement
        $conexion->close(); // Cierra la conexión
        return $result;
    } else {
        $conexion->close(); // Asegura que la conexión se cierre en caso de error
        return false;
    }
}




/**
 * Verifica si la contraseña proporcionada es correcta para un usuario dado.
 *
 * @param string $contraseñaN Contraseña que se desea verificar.
 * @param string $doc Documento del usuario cuya contraseña se está verificando.
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
public static function verficaClave($contraseñaN, $doc) {
    // conexión de la base de datos
    include("db_fashion/cb.php");
    // Aquí preparamos una consulta que cuenta cuántos usuarios tienen la contraseña que estamos verificando
    $sql = "SELECT count(*) FROM tb_usuarios "; // se prepara la consulta
    $sql .= "WHERE contraseña = '$contraseñaN' AND documento = '$doc'";
    // Finalmente, ejecutamos la consulta y devolvemos el resultado.
    $resultado = $conexion->query($sql);
    $conexion->close();
    return $resultado;
}

    
/**
 * Busca un usuario en la tabla tb_usuarios utilizando el correo electrónico proporcionado.
 *
 * @param string $email Correo electrónico del usuario que se desea buscar.
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
public static function sqlBuscarId($email) {
    // Incluimos el archivo para conectar con la base de datos.
    include("db_fashion/cb.php");
    // Preparamos una consulta para buscar a un usuario en la tabla 
    // tb_usuarios utilizando el correo electrónico proporcionado.
    $sql = "SELECT * FROM tb_usuarios "; // aquí se prepara la consulta
    $sql .= "WHERE correo = '$email'";
    // Ejecutamos la consulta y devolvemos el resultado.
    $resultado = $conexion->query($sql);
    $conexion->close();
    return $resultado;
}

    
/**
 * Busca un usuario en la tabla tb_usuarios según un campo específico (documento, nombre o correo).
 *
 * @param int $des Indica el campo a buscar: 1 para documento, 2 para nombre, 3 para correo.
 * @param string $busqueda El valor a buscar en el campo seleccionado.
 * @return mysqli_result|bool Resultado de la consulta (mysqli_result si tiene éxito, false si falla).
 */
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
    $sql = "SELECT * FROM tb_usuarios WHERE $dato = '$busqueda'";
    echo $sql; // Aquí mostramos la consulta por si necesitamos debuggear.

    // Finalmente, ejecutamos la consulta y devolvemos el resultado.
    $resultado = $conexion->query($sql);
    $conexion->close();
    return $resultado;
}

    
/**
 * Busca un dato específico de un usuario en la tabla tb_usuarios según el campo indicado.
 *
 * @param int $des Indica el campo a buscar: 1 para nombre, 2 para apellido, 3 para correo, 4 para fecha.
 * @param string $id El documento del usuario a buscar.
 * @return string El dato buscado del usuario, o una cadena vacía si no se encuentra.
 */
public static function buscarDatosUser($des, $id) {
    include("db_fashion/cb.php");
    $salida = "";
    $dato = ""; 

    // Determina el campo a buscar según el valor de $des.
    if ($des == 1) $dato = "nombre";
    if ($des == 2) $dato = "apellido";
    if ($des == 3) $dato = "correo";
    if ($des == 4) $dato = "fecha";

    // Prepara la consulta para buscar el dato del usuario.
    $sql = "SELECT $dato FROM tb_usuarios WHERE documento = '$id'";
    $resultado = $conexion->query($sql);

    // Obtiene el dato del resultado de la consulta.
    while ($fila = $resultado->fetch_array()) {
        $salida = $fila[0];
    }
    return $salida; // Retorna el dato buscado.
}

    
    
/**
 * Muestra los usuarios de la tabla tb_usuarios, filtrando por el documento si se proporciona.
 *
 * @param string|null $buscaUser El valor con el que se filtrará el documento de los usuarios. 
 *                               Si es null, se mostrarán todos los usuarios.
 * @return mysqli_result Resultado de la consulta que contiene los usuarios filtrados.
 */
public static function sqlMostrarUser($buscaUser = null) {
    include("db_fashion/cb.php"); // Incluimos el archivo que conecta a la base de datos

    // Creamos una consulta para seleccionar todos los usuarios de la tabla tb_usuarios
    $sql = "SELECT * FROM tb_usuarios "; 

    // Agregamos una condición para buscar usuarios cuyo documento empiece con el valor de $buscaUser
    if ($buscaUser !== null) {
        $sql .= "WHERE documento LIKE '$buscaUser%'";
    }

    // Ejecutamos la consulta y devolvemos el resultado
      $resultado = $conexion->query($sql);
      $conexion->close();//cierre de la conexion
      return $resultado;//se devuelve el resultado
}

    

/**
 * Muestra un dato específico de un usuario en la tabla tb_usuarios según el identificador proporcionado.
 *
 * @param int $des El tipo de dato que se desea obtener:
 *                 1 - Nombre,
 *                 2 - Apellido,
 *                 3 - Correo,
 *                 4 - Contraseña,
 *                 5 - Fecha.
 * @param string $idUser El documento del usuario cuyo dato se desea mostrar.
 * @return mysqli_result Resultado de la consulta que contiene el dato solicitado.
 */
public static function sqlMostrarDaUser($des, $idUser) {
    include("db_fashion/cb.php"); // Incluimos el archivo que conecta a la base de datos
    
    $dato = 0;
    // Determinamos qué dato se va a seleccionar según el valor de $des
    if ($des == 1) $dato = "nombre";
    if ($des == 2) $dato = "apellido";
    if ($des == 3) $dato = "correo";
    if ($des == 4) $dato = "contraseña";
    if ($des == 5) $dato = "fecha";

    // Preparamos la consulta para seleccionar el dato correspondiente
    $sql = "SELECT $dato FROM tb_usuarios ";
    $sql .= "WHERE documento = '$idUser'"; // Usamos comillas simples para el valor de $idUser

    // Ejecutamos la consulta y devolvemos el resultado
    $resultado = $conexion->query($sql);
    $conexion->close();
    return $resultado;
}


/**
 * Verifica si un usuario ha dado like a un producto específico.
 *
 * @param int $usuario_id El ID del usuario que se desea verificar.
 * @param int $producto_id El ID del producto para el cual se desea verificar el like.
 * @return mysqli_result Resultado de la consulta que contiene el conteo de likes.
 */
public static function sqlVerificLike($usuario_id, $producto_id) {
    include("db_fashion/cb.php"); // Incluimos el archivo que conecta a la base de datos

    // Consulta para verificar el like para un producto específico
    $sql = "SELECT COUNT(*) as count FROM tb_likes WHERE usuario_id = '$usuario_id' AND producto_id = '$producto_id'";
    $resultado= $conexion->query($sql); // Ejecutamos la consulta y devolvemos el resultado
    $conexion->close();
    return $resultado;
}

/**
 * Agrega o elimina un like para un producto específico de un usuario.
 *
 * @param int $usuario_id El ID del usuario que da el like.
 * @param int $producto_id El ID del producto que se está liked.
 * @return mysqli_result Resultado de la operación de inserción o eliminación.
 */
public static function sqlAgregarLike($usuario_id, $producto_id) {
    include("db_fashion/cb.php"); // Se incluye la conexión a la base de datos
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

    $resultado = $conexion->query($operacion); 
    
    // Cierra la conexión a la base de datos
    $conexion->close();
    
    // Devuelve el resultado de la operación
    return $resultado;
}


/**
 * Actualiza la foto de un usuario en la base de datos.
 *
 * @param string $foto La nueva URL o ruta de la foto del usuario.
 * @param string $id_user El ID del usuario cuya foto se desea actualizar.
 * @return bool True si la operación fue exitosa, de lo contrario, False.
 */
public static function sqlActuFoto($foto, $id_user) {
    include("db_fashion/cb.php"); // Conexión de la base de datos
    $sql = "UPDATE tb_usuarios SET foto = '$foto' WHERE documento = '$id_user'"; // Consulta
    
    if ($conexion->query($sql) === TRUE) {
        $conexion->close(); // Cierra la conexión a la base de datos
        return true; // Retorna true si la consulta fue exitosa
    } else {
        echo "Error en la consulta SQL: " . $conexion->error; // Muestra el error si falla
        $conexion->close(); // Cierra la conexión a la base de datos
        return false; // Retorna false si hubo un error
    }
}




/**
 * Muestra los productos de una categoría específica.
 *
 * @param int $categoria ID de la categoría de productos a mostrar.
 * @return mysqli_result|void Resultados de la consulta de productos, o un mensaje si no se encontraron productos.
 */
public static function sqlmostrarCateg($categoria) {
    include 'db_fashion/cb.php'; // conexión de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?"; // se obtiene los resultados de la base de datos
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // asumiendo que la categoría es un entero
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close(); // Cierra la declaración preparada
        $conexion->close(); // Cierra la conexión a la base de datos
        return $result; // Retorna los resultados de la consulta
    } else {
        echo "No se encontraron productos para la categoría $categoria.";
        $stmt->close(); // Cierra la declaración preparada
        $conexion->close(); // Cierra la conexión a la base de datos
        return null; // Retorna null si no se encontraron productos
    }
}


/**
 * Obtiene los productos de la categoría de niños.
 *
 * @param int $categoria ID de la categoría de niños.
 * @return mysqli_result Resultado de la consulta con los productos de la categoría.
 */
public static function sqlCateNiños($categoria) {
    include 'db_fashion/cb.php'; // conexión de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?"; // se prepara la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // la i representa que la categoría es un entero
    $stmt->execute();
    $result = $stmt->get_result(); // Devuelve el resultado de la consulta

    $stmt->close(); //cierre de la conexion preparada 
    $conexion->close();//cierre de la conexion
    return $result; //retorna el resultado de la consulta
}

/**
 * Verifica los productos de una categoría específica (accesorios).
 *
 * @param int $categoria ID de la categoría de accesorios.
 * @return mysqli_result|void Resultado de la consulta con los productos de la categoría, o un mensaje si no se encontraron productos.
 */
public static function sqlverAcce($categoria) {
    include 'db_fashion/cb.php'; // conexión de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?"; // consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // asume que la categoría es un entero
    $stmt->execute();

    $result = $stmt->get_result(); // Devuelve el resultado de la consulta

    // Cierra la declaración y la conexión
    $stmt->close(); // Cierra la declaración preparada
    $conexion->close(); // Cierra la conexión a la base de datos
    return $result; // Retorna el resultado de la consulta
}

/**
 * Verifica los productos de la categoría de zapatos.
 *
 * @param int $categoria ID de la categoría de zapatos.
 * @return mysqli_result|void Resultado de la consulta con los productos de la categoría, o un mensaje si no se encontraron productos.
 */
public static function sqlverZapatos($categoria) {
    include 'db_fashion/cb.php'; // conexión de la base de datos
    $sql = "SELECT * FROM tb_productos WHERE id_categoria = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoria); // asume que la categoría es un entero
    $stmt->execute();
    $result = $stmt->get_result(); // Devuelve el resultado de la consulta
    $stmt->close(); // Cierra la declaración preparada
    $conexion->close(); // Cierra la conexión a la base de datos

    return $result; // Retorna el resultado de la consulta
}


/**
 * Obtiene la lista de productos favoritos de los usuarios.
 *
 * @return mysqli_result Resultado de la consulta con los productos favoritos.
 */
public static function sqlVerFavoritos() {
    include 'db_fashion/cb.php'; // incluye la conexión de la base de datos
    $salida = "";
    $sql = "SELECT * FROM tb_favoritos"; // selecciona la tabla de la base de datos
    $consulta = $conexion->query($sql);
    $conexion->close();
    return $consulta;
}

/**
 * Obtiene la lista de productos en el carrito de compras.
 *
 * @return mysqli_result Resultado de la consulta con los productos del carrito.
 */
public static function sqlverCarrito() {
    include 'db_fashion/cb.php'; // incluye la conexión de la base de datos
    $salida = "";
    $sql = "SELECT * FROM tb_carrito"; // selecciona la tabla de la base de datos
    $consulta = $conexion->query($sql);
    $conexion->close();
    return $consulta;
}



}
