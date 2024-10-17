<?php
class Productos{
 
/**
 * Muestra los productos, opcionalmente filtrando por un término de búsqueda.
 *
 * Esta función construye un contenedor HTML con los productos obtenidos de la base de datos.
 * Si se proporciona un término de búsqueda, solo se mostrarán los productos que coincidan.
 *
 * @param string|null $buscar Término de búsqueda para filtrar productos (opcional).
 * @return string Devuelve un string HTML con los productos encontrados o un mensaje si no se encuentran productos.
 */
public static function mostrarPro($buscar = null) { // Definimos una función para mostrar productos, opcionalmente filtrando por una búsqueda
    include_once("controler_login.php"); // Incluimos el archivo para manejar el inicio de sesión
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene funciones para acceder a la base de datos

    $salida = ""; // Inicializamos una variable para almacenar el contenido HTML
    $salida .= '<div class="productos-container">'; // Agregamos un contenedor para los productos

    // Llamar a la función del modelo para obtener los productos con sus likes
    $consulta = Modelo::sqlMostrarPro($buscar); // Llamamos a la función sqlMostrarPro del modelo, pasando la búsqueda

    if ($consulta->num_rows > 0) { // Si hay productos en la consulta
        while ($fila = $consulta->fetch_assoc()) { // Iteramos a través de cada producto en la consulta
            $salida .= '<div class="producto">'; // Agregamos un contenedor para cada producto

            if (Loguin::verRol($_SESSION['id']) == 0) { // Si el usuario no tiene un rol especial
                $salida .= "<span class='producto-id'>ID: " . $fila['id_producto'] . "</span>"; // Mostramos el ID del producto
                $salida .= "<p class='producto-cantidad'>Cantidad: " . $fila['cantidad'] . "</p>"; // Cantidad disponible
            }

            // Agregamos el nombre, precio, cantidad y detalles del producto
            $salida .= "<h3 class='producto-nombre'>" . $fila['nombre_producto'] . "</h3>"; // Nombre del producto
            $salida .= "<p class='producto-precio'>Precio: $" . number_format($fila['precio'], 3) . "</p>"; // Precio formateado
            $salida .= "<p class='producto-detalles'>" . $fila['detalles'] . "</p>"; // Detalles del producto
            if (!empty($fila['ruta_img'])) {
                $rutasImagenes = explode(',', $fila['ruta_img']); // Separar las rutas
                foreach ($rutasImagenes as $rutaImagen) {
                    $rutaImagenCompleta = "../img/" . trim($rutaImagen); // Asegúrate de que no haya espacios
                    if (file_exists($rutaImagenCompleta)) {
                        $salida .= '<div class="imagen-container"><img src="' . $rutaImagenCompleta . '" alt="' . $fila['nombre_producto'] . '" class="producto-imagen"></div>';
                    } else {
                        $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";
                    }
                }
            } else {
                $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";
            }

            // Mostrar el número de "likes"
            $salida .= "<p class='producto-likes'>Likes: " . $fila['total_likes'] . "</p>"; // Mostramos la cantidad de likes del producto
            // Verificar si el usuario actual ya dio like
            $salida .= "<div class='producto-acciones'>"; // Contenedor para las acciones del producto
            if (Loguin::verRol($_SESSION['id']) == 0) { // Si el usuario no tiene un rol especial
                $salida .= "<a href='ctroBar.php?dato=" . $fila['id_producto'] . "&seccion=editarPro' class='btn btn-editar'>Editar</a>"; // Agregamos un botón para editar el producto
            }
            $salida .= "<div class='botones-container'>";
            $salida .= "<button class='btn btn-danger btn-agregar-carrito' data-id='" . htmlspecialchars($fila["id_producto"]) . "'><i class='fa fa-shopping-cart'></i> Comprar ahora</button>";
            $salida .= "</div>";
            // Verificamos si el usuario ya dio like y establecemos la clase correspondiente
            $likeClass = self::verificLike($_SESSION['id'], $fila['id_producto']) ? 'fas fa-heart liked' : 'far fa-heart'; // Asignamos la clase del icono de like
            $salida .= "<i class='$likeClass' data-id_producto='" . $fila['id_producto'] . "' onclick='likear(this)'></i>"; // Agregamos el icono de like
            $salida .= '</div>'; // Cierre del div .producto-acciones

            $salida .= '</div>'; // Cierre del div .producto
        }
    } else { // Si no se encontraron productos
        $salida .= "<p>No se encontraron productos.</p>"; // Mostramos un mensaje indicando que no hay productos
    }

    $salida .= '</div>'; // Cierre del div .productos-container

    return $salida; // Devolvemos todo el contenido HTML generado
}

    
/**
 * Obtiene una lista de categorías desde la base de datos.
 *
 * Esta función consulta la base de datos para recuperar todas las categorías
 * y las retorna en un array asociativo.
 *
 * @return array Un array de categorías, donde cada categoría es un array con
 *               'id' y 'nombre'.
 */
public static function obtenerCategorias() {
    include_once("modelo.php"); // Incluye el modelo que contiene las funciones de acceso a la base de datos
    $categorias = []; // Inicializa un array para almacenar las categorías

    // Realiza la consulta para obtener las categorías
    $consulta = Modelo::sqlVerCate();

    // Verifica si la consulta fue exitosa y hay resultados
    if ($consulta && $consulta->num_rows > 0) {
        // Itera sobre cada fila del resultado
        while ($fila = $consulta->fetch_assoc()) {
            // Agrega cada categoría al array
            $categorias[] = [
                'id' => $fila['id_categoria'], // ID de la categoría
                'nombre' => $fila['categoria']  // Nombre de la categoría
            ];
        }
    }
    return $categorias; // Retorna el array de categorías
}

    
    

/**
 * Muestra las categorías en formato HTML.
 *
 * Esta función consulta la base de datos para recuperar las categorías y genera
 * un bloque HTML con cada categoría que incluye el ID y el nombre de la categoría,
 * así como un enlace para editar.
 *
 * @return string Un string que contiene el HTML generado para mostrar las categorías.
 */
public static function mostrarCate() {
    include_once("modelo.php"); // Incluye el modelo que contiene las funciones de acceso a la base de datos
    $salida = ""; // Inicializa una variable para almacenar el HTML generado

    // Realiza la consulta para obtener las categorías
    $consulta = Modelo::sqlVerCate();

    // Verifica si la consulta fue exitosa y hay resultados
    if ($consulta && $consulta->num_rows > 0) {
        // Muestra las categorías utilizando un ciclo while
        while ($fila = $consulta->fetch_assoc()) {
            $salida .= "<div class='categoria-item' style='position: relative;'>"; 
            $salida .= "<div class='categoria-id'>" . $fila['id_categoria'] . "</div>"; // Muestra el ID de la categoría
            $salida .= "<div class='categoria-titulo'>" . $fila['categoria'] . "</div>"; // Muestra el nombre de la categoría
            $salida .= "<a href='ctroBar.php?seccion=editarCate&dato=" .$fila['id_categoria']."'  class='editar-btn top-left'>Editar</a>"; // Enlace para editar
            $salida .= "</div>"; // Cierra el contenedor de la categoría
        }
    } else {
        $salida .= "No se encontraron categorías."; // Mensaje si no hay categorías
    }
    return $salida; // Retorna el HTML generado
}


/**
 * Elimina un producto de la base de datos.
 *
 * Esta función recibe el ID de un producto y lo elimina de la base de datos
 * utilizando una consulta SQL. Devuelve un valor que indica si la eliminación
 * fue exitosa o no.
 *
 * @param int $id El ID del producto a eliminar.
 * @return int Retorna 1 si la eliminación fue exitosa, 0 en caso contrario.
 */
public static function eliminarPro($id) { 
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar productos
    $consulta = Modelo::sqlEliminarPro($id); // Llamamos a la función sqlEliminarPro del modelo, pasando el ID del producto a eliminar
    if ($consulta) { // Si la consulta para eliminar fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    } else { // Si la consulta no fue exitosa
        $salida = 0; // Mantenemos salida en 0
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


/**
 * Elimina una categoría de la base de datos.
 *
 * Esta función recibe el ID de una categoría y la elimina de la base de datos
 * utilizando una consulta SQL. Devuelve un valor que indica si la eliminación
 * fue exitosa o no.
 *
 * @param int $id El ID de la categoría a eliminar.
 * @return int Retorna 1 si la eliminación fue exitosa, 0 en caso contrario.
 */
public static function eliminarCate($id) { 
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar categorías
    $consulta = Modelo::sqlEliminarCate($id); // Llamamos a la función sqlEliminarCate del modelo, pasando el ID de la categoría a eliminar
    if ($consulta) { // Si la consulta para eliminar fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    } else { // Si la consulta no fue exitosa
        $salida = 0; // Mantenemos salida en 0
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


 
 
/**
 * Agrega un nuevo producto a la base de datos.
 *
 * Esta función recibe varios parámetros necesarios para crear un nuevo producto
 * y lo agrega a la base de datos utilizando una consulta SQL. Retorna un valor que
 * indica si la adición fue exitosa o no.
 *
 * @param int $id_categoria El ID de la categoría a la que pertenece el producto.
 * @param string $nombre El nombre del producto.
 * @param float $precio El precio del producto.
 * @param int $cantidad La cantidad del producto disponible.
 * @param string $descripcion La descripción del producto.
 * @param string $color El color del producto.
 * @param string $tallas Las tallas disponibles del producto.
 * @param string $imagen La ruta de la imagen del producto.
 * @return int Retorna 1 si la adición fue exitosa, 0 en caso contrario.
 */
public static function agregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para agregar productos
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la adición fallará
    $consulta = Modelo::sqlAgregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen); 
    // Llamamos a la función sqlAgregarPro del modelo, pasando todos los parámetros necesarios para agregar el producto
    if ($consulta) { // Si la consulta para agregar el producto fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la adición fue exitosa
    } 
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


/**
 * Agrega una nueva categoría a la base de datos.
 *
 * Esta función recibe el nombre de una nueva categoría y la agrega a la base de datos
 * utilizando una consulta SQL. Si la adición es exitosa, redirige a la página de
 * visualización de categorías.
 *
 * @param string $categoria El nombre de la categoría a agregar.
 * @return void No devuelve ningún valor, pero redirige si la adición fue exitosa.
 */
public static function agregarCate($categoria) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para agregar categorías
    $consulta = Modelo::sqlAgregarCate($categoria); // Llamamos a la función sqlAgregarCate del modelo, pasando el nombre de la categoría
    if ($consulta) { // Si la consulta para agregar la categoría fue exitosa
        header("location:ctroBar.php?seccion=verCate"); // Redirigimos a la página de ver categorías
    }
}


/**
 * Edita una categoría en la base de datos.
 *
 * Esta función recibe un descriptor y el nombre de la categoría para editar.
 * Utiliza una consulta SQL para obtener los datos de la categoría y retorna
 * el resultado.
 *
 * @param string $des El descriptor para identificar la categoría a editar.
 * @param string $categoria El nombre de la categoría a editar.
 * @return string Retorna una cadena con los datos obtenidos de la categoría editada.
 */
public static function editarCate($des, $categoria) { 
    $salida = ""; // Inicializamos la variable salida como una cadena vacía
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para obtener categorías
    $consulta = Modelo::sqlCategorias($des, $categoria); // Llamamos a la función sqlCategorias del modelo, pasando el descriptor y el nombre de la categoría
    while ($fila = $consulta->fetch_array()) { // Mientras haya filas en la consulta
        $salida .= $fila[0]; // Agregamos el primer elemento de cada fila a la variable salida
    }
    return $salida; // Devolvemos el valor de salida que contiene los datos obtenidos
}


    
/**
 * Edita una categoría en la base de datos.
 *
 * Esta función recibe el ID de la categoría y el nuevo nombre de la categoría,
 * y utiliza una consulta SQL para actualizar la categoría correspondiente en la base de datos.
 * Retorna un valor que indica si la edición fue exitosa o no.
 *
 * @param int $id_categoria El ID de la categoría a editar.
 * @param string $categoria El nuevo nombre de la categoría.
 * @return int Retorna 1 si la edición fue exitosa, 0 en caso contrario.
 */
public static function editarCategoria($id_categoria, $categoria) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para editar categorías
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la edición fallará
    $consulta = Modelo::sqlEditar($id_categoria, $categoria); 
    // Llamamos a la función sqlEditar del modelo, pasando el ID de la categoría y el nuevo nombre
    if ($consulta) { // Si la consulta para editar la categoría fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la edición fue exitosa
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


/**
 * Elimina un usuario de la base de datos.
 *
 * Esta función recibe el ID del usuario y lo elimina de la base de datos
 * utilizando una consulta SQL. Retorna un valor que indica si la eliminación fue exitosa o no.
 *
 * @param int $id El ID del usuario a eliminar.
 * @return int Retorna 1 si la eliminación fue exitosa, 0 en caso contrario.
 */
public static function EliminarUser($id) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar usuarios
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    $consulta = Modelo::sqlEliminarUser($id); 
    // Llamamos a la función sqlEliminarUser del modelo, pasando el ID del usuario
    if ($consulta) { // Si la consulta para eliminar el usuario fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


/**
 * Obtiene los datos de un producto específico.
 *
 * Esta función recibe un descriptor y el ID del producto,
 * y utiliza una consulta SQL para recuperar los datos del producto correspondiente.
 * Retorna una cadena que contiene los datos obtenidos.
 *
 * @param string $des El descriptor para identificar el tipo de dato a obtener.
 * @param int $idPro El ID del producto del cual se desean obtener los datos.
 * @return string Retorna una cadena con los datos del producto.
 */
public static function datoPro($des, $idPro) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para obtener datos del producto
    $salida = ""; // Inicializamos la variable salida como una cadena vacía
    $consulta = Modelo::sqlDatoPro($des, $idPro); 
    while ($fila = $consulta->fetch_array()) { // Mientras haya filas en la consulta
        $salida .= $fila[0]; // Agregamos el primer elemento de cada fila a la variable salida
    }
    return $salida; // Devolvemos el valor de salida que contiene los datos obtenidos
}


/**
 * Edita un producto en la base de datos.
 *
 * Esta función recibe el ID del producto y los nuevos datos del producto,
 * y utiliza una consulta SQL para actualizar la información del producto correspondiente.
 * Retorna un valor que indica si la edición fue exitosa o no.
 *
 * @param int $id_producto El ID del producto a editar.
 * @param string $nombre El nuevo nombre del producto.
 * @param float $precio El nuevo precio del producto.
 * @param int $cantidad La nueva cantidad del producto disponible.
 * @param string $detalles Nuevos detalles del producto.
 * @param string $color El nuevo color del producto.
 * @param string $tallas Las nuevas tallas disponibles del producto.
 * @return int Retorna 1 si la edición fue exitosa, 0 en caso contrario.
 */
public static function editarProducto($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para editar productos
    $salida = 0; // Inicializamos la variable salida en 0
    $consulta = Modelo::sqlEditarPro($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas); 
    // Llamamos a la función sqlEditarPro del modelo, pasando todos los nuevos datos del producto
    if ($consulta) { // Si la consulta para editar el producto fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la edición fue exitosa
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


 
/**
 * Muestra el conteo de elementos eliminados.
 *
 * @return string El contenido HTML de la tabla con el conteo de elementos eliminados.
 */
public static function mostrarConteoEli() { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = "<br><br><table class='conteo-table'>"; // Iniciamos una tabla HTML para mostrar los resultados
    $consulta = Modelo::sqlConteoEli(); // Llamamos a la función del modelo que obtiene el conteo de eliminados
    while ($fila = $consulta->fetch_assoc()) { // Iteramos sobre cada fila de resultados
        $salida .= "<tr>"; // Iniciamos una nueva fila en la tabla
        $salida .= "<td>" . $fila['id_conteo'] . "</td>"; // Agregamos la columna con el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>"; // Agregamos la columna con la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>"; // Agregamos la columna con el conteo
        $salida .= "<td>" . $fila['fec_eli'] . "</td>"; // Agregamos la columna con la fecha de eliminación
        $salida .= "</tr>"; // Cerramos la fila
    }
    $salida .= "</table>"; // Cerramos la tabla
    return $salida; // Devolvemos el contenido HTML generado
}

/**
 * Muestra el conteo de registros.
 *
 * @return string El contenido HTML de la tabla con el conteo de registros.
 */
public static function mostrarConteoReg() { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = "<br><br><table class='conteo-table'>"; // Iniciamos una tabla HTML
    $consulta = Modelo::sqlConteoReg(); // Llamamos a la función del modelo que obtiene el conteo de registros
    while ($fila = $consulta->fetch_assoc()) { // Iteramos sobre cada fila de resultados
        $salida .= "<tr>"; // Iniciamos una nueva fila en la tabla
        $salida .= "<td>" . $fila['id_conteo'] . "</td>"; // Agregamos la columna con el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>"; // Agregamos la columna con la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>"; // Agregamos la columna con el conteo
        $salida .= "<td>" . $fila['fec_reg'] . "</td>"; // Agregamos la columna con la fecha de registro
        $salida .= "</tr>"; // Cerramos la fila
    }
    $salida .= "</table>"; // Cerramos la tabla
    return $salida; // Devolvemos el contenido HTML generado
}

/**
 * Muestra el conteo de productos.
 *
 * @return string El contenido HTML de la tabla con el conteo de productos.
 */
public static function mostrarConteoProductos() { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = "<br><br><table class='conteo-table'>"; // Iniciamos una tabla HTML
    $consulta = Modelo::sqlConteoPro(); // Llamamos a la función del modelo que obtiene el conteo de productos
    while ($fila = $consulta->fetch_assoc()) { // Iteramos sobre cada fila de resultados
        $salida .= "<tr>"; // Iniciamos una nueva fila en la tabla
        $salida .= "<td>" . $fila['id_conteo'] . "</td>"; // Agregamos la columna con el ID del conteo
        $salida .= "<td>" . $fila['descripcion'] . "</td>"; // Agregamos la columna con la descripción
        $salida .= "<td>" . $fila['conteo'] . "</td>"; // Agregamos la columna con el conteo
        $salida .= "</tr>"; // Cerramos la fila
    }
    $salida .= "</table>"; // Cerramos la tabla
    return $salida; // Devolvemos el contenido HTML generado
}

/**
 * Busca un usuario según los criterios de búsqueda especificados.
 *
 * @param string $des La descripción del campo de búsqueda (por ejemplo, nombre, apellido, etc.).
 * @param string $busqueda El término de búsqueda proporcionado por el usuario.
 *
 * @return string Los detalles del usuario encontrado o un mensaje de error si no se encuentra.
 */
public static function buscarUsuario($des, $busqueda) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = ""; // Inicializamos la variable salida
    $consulta = Modelo::sqlBuscarUser($des, $busqueda); // Llamamos a la función del modelo que busca usuarios
    if ($consulta->num_rows > 0) { // Verificamos si se encontraron resultados
        while ($fila = $consulta->fetch_assoc()) { // Iteramos sobre cada fila de resultados
            $salida .= $fila['nombre'] . " "; // Agregamos el nombre del usuario
            $salida .= $fila['apellido'] . " "; // Agregamos el apellido del usuario
            $salida .= $fila['correo'] . " "; // Agregamos el correo del usuario
            $salida .= $fila['fecha'] . " "; // Agregamos la fecha
        }
    } else {
        $salida .= "No se encontró ningún usuario con esta búsqueda"; // Mensaje si no se encuentra usuario
    }
    return $salida; // Devolvemos el resultado de la búsqueda
}


/**
 * Muestra una lista de usuarios.
 *
 * @param string|null $buscaUser Opcional. Término de búsqueda para filtrar usuarios. Si es null, se muestran todos.
 *
 * @return string El contenido HTML de las tarjetas de usuario.
 */
public static function mostrarUsuarios($buscaUser = null) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = ""; // Inicializamos la variable salida
    $consulta = Modelo::sqlMostrarUser($buscaUser); // Llamamos a la función del modelo que obtiene usuarios
    
    while ($fila = $consulta->fetch_assoc()) { // Iteramos sobre cada fila de resultados
        $salida .= "<div class='col-lg-4 col-md-6 col-sm-12 mb-4'>"; // Iniciamos una columna responsiva
        $salida .= "<div class='card usuario p-3'>"; // Creamos una tarjeta para el usuario
        $salida .= "<div>"; // Iniciamos un contenedor dentro de la tarjeta
        $salida .= "<p><strong>Documento:</strong> " . $fila['documento'] . "</p>"; // Mostramos el documento del usuario
        $salida .= "<p><strong>Nombre:</strong> " . $fila['nombre'] . "</p>"; // Mostramos el nombre del usuario
        $salida .= "<p><strong>Apellido:</strong> " . $fila['apellido'] . "</p>"; // Mostramos el apellido del usuario
        $salida .= "<p><strong>Correo:</strong> " . $fila['correo'] . "</p>"; // Mostramos el correo del usuario
        $salida .= "<p><strong>Rol:</strong> " . $fila['rol'] . "</p>"; // Mostramos el rol del usuario
        $salida .= "</div>"; // Cerramos el contenedor
        $salida .= "</div>"; // Cerramos la tarjeta
        $salida .= "</div>"; // Cerramos la columna
    }
    
    return $salida; // Devolvemos el contenido HTML generado
}

/**
 * Obtiene los datos de un usuario específico.
 *
 * @param string $des La descripción del campo a obtener.
 * @param int $idUser El ID del usuario del que se desean obtener los datos.
 *
 * @return mixed El dato obtenido del usuario.
 */
public static function actualizaDatosUser($des, $idUser) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $consulta = Modelo::sqlMostrarDaUser($des, $idUser); // Llamamos a la función del modelo que obtiene datos del usuario
    while ($fila = $consulta->fetch_array()) { // Iteramos sobre cada fila de resultados
        $salida = $fila[0]; // Almacenamos el primer dato en la variable salida
    }
    return $salida; // Devolvemos el dato obtenido
}

/**
 * Controlador para actualizar los datos del usuario.
 *
 * @param int $idUser El ID del usuario que se desea actualizar.
 * @param string $nombre El nuevo nombre del usuario.
 * @param string $apellido El nuevo apellido del usuario.
 * @param string $correo El nuevo correo del usuario.
 * @return int 1 si la actualización fue exitosa; de lo contrario, 0.
 */
public static function actualizarUser($idUser, $nombre, $apellido, $correo) {
    include_once("modelo.php"); // Incluye el archivo del modelo

    // Limpiar las entradas para prevenir XSS
    $nombre = htmlspecialchars(trim($nombre));
    $apellido = htmlspecialchars(trim($apellido));
    $correo = htmlspecialchars(trim($correo));

    $consulta = Modelo::sqlActualizarUser($idUser, $nombre, $apellido, $correo); // Llama a la función del modelo

    if ($consulta) {
        return 1; // Retorna 1 si fue exitoso
    } else {
        return 0; // Retorna 0 si falló
    }
}




/**
 * Verifica si un usuario ha dado like a un producto específico.
 *
 * @param int $usuario_id El ID del usuario que se desea verificar.
 * @param int $producto_id El ID del producto que se desea verificar.
 *
 * @return int 1 si el usuario ha dado like al producto; 0 en caso contrario.
 */
public static function verificLike($usuario_id, $producto_id) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $consulta = Modelo::sqlVerificLike($usuario_id, $producto_id); // Llamamos a la función del modelo para verificar el like
    if ($consulta && $consulta->num_rows > 0) { // Si la consulta fue exitosa y hay resultados
        $fila = $consulta->fetch_assoc(); // Obtenemos la fila de resultados
        return $fila['count'] > 0 ? 1 : 0; // Devolvemos 1 si hay likes, de lo contrario 0
    }
    return 0; // Si no hubo resultados, devolvemos 0
}

/**
 * Agrega un like a un producto por parte de un usuario.
 *
 * @param int $usuario_id El ID del usuario que da el like.
 * @param int $producto_id El ID del producto al que se desea dar like.
 *
 * @return mixed El resultado de la operación de agregar el like.
 */
public static function agregarLike($usuario_id, $producto_id) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo
    return Modelo::sqlAgregarLike($usuario_id, $producto_id); // Llamamos a la función del modelo para agregar el like y devolvemos el resultado
}




/**
 * Muestra las categorías de productos en formato HTML.
 *
 * Esta función genera un bloque HTML que incluye información sobre las
 * categorías de productos, como nombre, precio, imagen y botones de acción
 * para agregar a carrito o favoritos.
 *
 * @param string $categoria La categoría específica de productos a mostrar.
 *
 * @return string HTML generado que representa las categorías y productos.
 */
public static function mostrarCategorias($categoria) {
    include 'modelo.php';  // Incluir el archivo del modelo que maneja la lógica de la base de datos.
    
    $salida = "";  // Inicializa una variable para almacenar el HTML generado.
    $consulta = Modelo::sqlmostrarCateg($categoria);  // Llama a una función del modelo para obtener las categorías desde la base de datos.

    // Inicia el contenedor principal para las categorías.
    $salida .= "<div class='categorias'>";  
    
    // Itera sobre cada fila de resultados de la consulta.
    while ($fila = $consulta->fetch_assoc()) {  
        // Crea un contenedor para cada categoría, usando datos de color y talla como atributos de datos.
        $salida .= "<div class='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";
        
        // Muestra el nombre del producto y su precio.
        $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
        $salida .= "<strong> $" . $fila['precio'] . "</strong>";  

        // Verifica si hay una ruta de imagen disponible para el producto.
        if (!empty($fila['ruta_img'])) {
            $rutaImagen = $fila['ruta_img'];  // Obtiene la ruta de la imagen.
            // Crea un contenedor para la imagen y la muestra.
            $salida .= '<div class="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" class="img-thumbnail"></div>';  
        } else {
            // Mensaje en caso de que no haya imagen disponible.
            $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";  
        }

        // Contenedor para los botones de agregar al carrito y favoritos.
        $salida .= "<div class='carfav'>";  
        // Botón para agregar el producto al carrito.
        $salida .= "<button class='btn btn-info btn-agregar-carrito' data-id='{$fila['id_producto']}'><i class='fa fa-shopping-cart'></i> carrito</button>-";  
        // Botón para agregar el producto a favoritos.
        $salida .= "<button class='btn btn-info btn-favoritos' data-id='{$fila['id_producto']}'><i class='fas fa-heart'></i> Favoritos</button>";  
        $salida .= "</div><br>";  // Cierra el contenedor de botones.
        $salida .= "</div><br>";  // Cierra el contenedor de la categoría.
    }
    $salida .= "</div>";  // Cierra el contenedor principal de categorías.

    return $salida;  // Devuelve el HTML generado.
}



/**
 * Muestra las categorías de productos para niños en formato HTML.
 *
 * Esta función genera un bloque HTML que incluye información sobre
 * las categorías de productos para niños, como nombre, precio, imagen 
 * y botones de acción para agregar a carrito o favoritos.
 *
 * @param string $categoria La categoría específica de productos para niños a mostrar.
 *
 * @return string HTML generado que representa las categorías y productos para niños.
 */
public static function CateNiños($categoria) {
    include 'modelo.php';  // Incluir el archivo del modelo.
    $salida = "";  // Inicializa el contenedor de salida.
    $consulta = Modelo::sqlCateNiños($categoria);  // Llama a la función del modelo para obtener categorías de niños.
    $salida .= "<div class='categorias'>";  // Inicia el contenedor de categorías.

    // Itera sobre cada fila de la consulta.
    while ($fila = $consulta->fetch_assoc()) {  
        // Contenedor para cada categoría de niño.
        $salida .= "<div class='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";  
        $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
        $salida .= "<strong> $" . $fila['precio'] . "</strong>";  

        // Verifica la disponibilidad de la imagen.
        if (!empty($fila['ruta_img'])) {
            $rutaImagen = "../img/" . $fila['ruta_img'];  // ruta a la base de datos
            $salida .= '<div class="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" class="img-thumbnail"></div>';  
        } else {
            $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";  
        }
        
        // Contenedor para los botones.
        $salida .= "<div class='carfav'>";  
        // Botones de agregar al carrito y favoritos.
        $salida .= "<button class='btn btn-primary btn-agregar-carrito' data-id='{$fila['id_producto']}'><i class='fa fa-shopping-cart'></i> carrito</button>-";  
        $salida .= "<button class='btn btn-primary btn-favoritos' data-id='{$fila['id_producto']}'><i class='fas fa-heart'></i> Favoritos</button>";  
        $salida .= "</div><br>";  // Cierra el contenedor de botones.
        $salida .= "</div><br>";  // Cierra el contenedor de la categoría.
    }
    $salida .= "</div>";  // Cierra el contenedor de categorías.

    return $salida;  // Devuelve el HTML generado.
}

/**
 * Muestra los accesorios en formato HTML.
 *
 * Esta función genera un bloque HTML que incluye información sobre
 * los accesorios, como nombre, precio, imagen y botones de acción
 * para agregar al carrito o a favoritos.
 *
 * @param string $categoria La categoría específica de accesorios a mostrar.
 *
 * @return string HTML generado que representa los accesorios.
 */
public static function verAccesorios($categoria) {
    include 'modelo.php';  // Incluir el archivo del modelo.
    $salida = "";  // Inicializa el contenedor de salida.
    $consulta = Modelo::sqlverAcce($categoria);  // Obtiene los accesorios desde la base de datos.
    $salida .= "<div class='categorias'>";  // Inicia el contenedor de categorías.

    // Itera sobre cada fila de la consulta.
    while ($fila = $consulta->fetch_assoc()) {  
        // Contenedor para cada accesorio.
        $salida .= "<div class='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";
        $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
        $salida .= "<strong> $" . $fila['precio'] . "</strong>";  

        // Verifica la ruta de la imagen.
        if (!empty($fila['ruta_img'])) {
            $rutaImagen = "../img/" . $fila['ruta_img'];
            $salida .= '<div class="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" class="img-thumbnail"></div>';  
        } else {
            $salida .= "<p class='sin-imagen'>Imagen no disponible</p>";  
        }

        // Contenedor para los botones.
        $salida .= "<div class='carfav'>";  
        // Botones para agregar al carrito y a favoritos.
        $salida .= "<button class='btn btn-info btn-agregar-carrito' data-id='{$fila['id_producto']}'><i class='fa fa-shopping-cart'></i> carrito</button>-";  
        $salida .= "<button class='btn btn-info btn-favoritos' data-id='{$fila['id_producto']}'><i class='fas fa-heart'></i> Favoritos</button>";  
        $salida .= "</div><br>";  // Cierra el contenedor de botones.
        $salida .= "</div>";  // Cierra el contenedor de la categoría.
    }
    $salida .= "</div>";  // Cierra el contenedor de categorías.

    return $salida;  // Devuelve el HTML generado.
}




/**
 * Muestra los zapatos en formato HTML.
 *
 * Esta función genera un bloque HTML que incluye información sobre
 * los zapatos, como nombre, precio, imagen y botones de acción
 * para agregar al carrito o a favoritos.
 *
 * @param string $categoria La categoría específica de zapatos a mostrar.
 *
 * @return string HTML generado que representa los zapatos.
 */
public static function verZapatos($categoria) {
    include 'modelo.php';  // Incluir el archivo del modelo.
    $salida = "";  // Inicializa el contenedor de salida.
    $consulta = Modelo::sqlverZapatos($categoria);  // Obtiene los zapatos desde la base de datos.
    $salida .= "<div class='categorias'>";  // Inicia el contenedor de categorías.

    // Itera sobre cada fila de la consulta.
    while ($fila = $consulta->fetch_assoc()) {  
        // Contenedor para cada zapato.
        $salida .= "<div class='categoria' data-color='" . strtolower($fila['color']) . "' data-talla='" . strtolower($fila['tallas']) . "'>";  
        $salida .= "<h5><p><li>" . $fila['nombre_producto'] . "; por solo: </h5></li></p>";
        $salida .= "<strong> $" . $fila['precio'] . "</strong>";  

        // Muestra la imagen del zapato.
        $salida .= "<img src='" . $fila['ruta_img'] . "' alt='" . $fila['nombre_producto'] . "' class='img-thumbnail'><br>";  

        // Contenedor para los botones.
        $salida .= "<div class='carfav'>";  
        // Botones de agregar al carrito y favoritos.
        $salida .= "<button class='btn btn-info btn-agregar-carrito' data-id='{$fila['id_producto']}'><i class='fa fa-shopping-cart'></i> carrito</button>-";  
        $salida .= "<button class='btn btn-info btn-favoritos' data-id='{$fila['id_producto']}'><i class='fas fa-heart'></i> Favoritos</button>";  
        $salida .= "</div><br>";  // Cierra el contenedor de botones.
        $salida .= "</div><br>";  // Cierra el contenedor de la categoría.
    }
    $salida .= "</div>";  // Cierra el contenedor de categorías.

    return $salida;  // Devuelve el HTML generado.
}


    
/**
 * Muestra la lista de productos favoritos en formato HTML.
 *
 * Esta función genera una tabla HTML que contiene los productos
 * favoritos del usuario, incluyendo el nombre del producto,
 * la cantidad y un botón para eliminarlo de la lista de favoritos.
 *
 * @return string HTML generado que representa la lista de favoritos.
 */
public static function verFavoritos() {
    include 'modelo.php';  // Incluir el archivo del modelo que contiene la lógica para interactuar con la base de datos.

    $salida = "";  // Inicializa la variable que contendrá el HTML generado para la vista de favoritos.
    
    $consulta = Modelo::sqlVerFavoritos();  // Llama al método del modelo para obtener los productos favoritos desde la base de datos.

    // Inicia la tabla donde se mostrarán los productos favoritos.
    $salida .= "<table class='table table-hover'>";  
    $salida .= "<thead><tr><th>Producto</th><th>Cantidad</th><th>Eliminar</th></tr></thead><tbody>";  // Define el encabezado de la tabla.

    // Itera sobre cada fila de la consulta, que contiene los productos favoritos.
    while ($fila = $consulta->fetch_assoc()) {  
        // Crea una fila en la tabla para cada producto favorito.
        $salida .= "
            <tr>
                <td data-label='Producto' class='product-name'>{$fila['nombre_produc']}</td>
                <td data-label='Cantidad'>
                    <div class='quantity-buttons'>
                        <input type='text' value='{$fila['cantidad_fav']}' class='quantity-input' readonly> 
                    </div>
                </td>
                <td data-label='Eliminar'>
                    <a href='eliminarFavo.php?id={$fila['id_favo']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }
    
    $salida .= "</tbody></table>";  // Cierra el cuerpo de la tabla y la tabla en sí.

    return $salida;  // Devuelve el HTML generado.
}


     
/**
 * Muestra el contenido del carrito de compras en formato HTML.
 *
 * Esta función genera una tabla HTML que contiene los productos
 * en el carrito de compras del usuario, mostrando el nombre del
 * producto, el precio unitario, la cantidad, el total por producto
 * y un botón para eliminar el producto del carrito. Además, calcula
 * el subtotal de todos los productos en el carrito.
 *
 * @return string HTML generado que representa el contenido del carrito.
 */
public static function verCarrito() {
    include 'modelo.php';  // Incluir el archivo del modelo que contiene la lógica para interactuar con la base de datos.
    
    $salida = "";  // Inicializa la variable que contendrá el HTML generado para la vista del carrito.
    $consulta = Modelo::sqlverCarrito();  // Llama al método del modelo para obtener los productos en el carrito.
    
    // Inicia la tabla donde se mostrarán los productos en el carrito.
    $salida .= "<table class='table table-hover'>";  
    $salida .= "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Eliminar</th></tr></thead><tbody>";  
    $subtotal = 0;  // Inicializa la variable para almacenar el subtotal.

    // Itera sobre cada fila de la consulta, que contiene los productos en el carrito.
    while ($fila = $consulta->fetch_assoc()) {
        $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];  // Calcula el total por producto.
        $subtotal += $total_producto;  // Suma al subtotal.
        
        // Crea una fila en la tabla para cada producto en el carrito.
        $salida .= "
            <tr>
                <td data-label='Producto' class='product-name'>{$fila['nombre_producto']}</td>
                <td data-label='Precio'>\${$fila['precio_pro']}</td> <!-- Precio unitario -->
                <td data-label='Cantidad'>
                    <div class='quantity-buttons'>
                        <input type='text' value='{$fila['cantidad_pro']}' class='quantity-input' readonly>
                    </div>
                </td>
                <td data-label='Total'>\${$total_producto}</td>  <!-- Total por producto -->
                <td data-label='Eliminar'>
                    <a href='eliminarCa.php?id={$fila['id_ca']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                </td>
            </tr>";
    }
    
    $salida .= "</tbody>";
    $salida .= "<tfoot><tr class='total-row'><td colspan='3'>Subtotal</td><td>\${$subtotal}</td><td></td></tr></tfoot>";  // Muestra el subtotal.
    $salida .= "</table>";  // Cierra la tabla.

    return $salida;  // Devuelve el HTML generado.
}

    
}

