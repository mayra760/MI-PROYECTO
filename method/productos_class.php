<?php
class Productos{

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
                }
    
                // Agregamos el nombre, precio, cantidad y detalles del producto
                $salida .= "<h3 class='producto-nombre'>" . $fila['nombre_producto'] . "</h3>"; // Nombre del producto
                $salida .= "<p class='producto-precio'>Precio: $" . number_format($fila['precio'], 3) . "</p>"; // Precio formateado
                $salida .= "<p class='producto-cantidad'>Cantidad: " . $fila['cantidad'] . "</p>"; // Cantidad disponible
                $salida .= "<p class='producto-detalles'>" . $fila['detalles'] . "</p>"; // Detalles del producto
    
                if (!empty($fila['ruta_img'])) { // Si la ruta de la imagen no está vacía
                    // Asegúrate de que la ruta sea correcta
                    $rutaImagen = "../img/" . $fila['ruta_img']; // Construimos la ruta de la imagen
                    // Verifica que el archivo existe antes de mostrar la imagen
                    if (file_exists($rutaImagen)) { // Si la imagen existe
                        $salida .= '<div class="imagen-container"><img src="' . $rutaImagen . '" alt="' . $fila['nombre_producto'] . '" class="producto-imagen"></div>'; // Mostramos la imagen
                    } else { // Si la imagen no existe
                        $salida .= "<p class='sin-imagen'>Imagen no disponible</p>"; // Mostramos un mensaje de que no hay imagen
                    }
                } else { // Si no hay ruta de imagen
                    $salida .= "<p class='sin-imagen'>Imagen no disponible</p>"; // Mostramos un mensaje de que no hay imagen
                }
    
                // Mostrar el número de "likes"
                $salida .= "<p class='producto-likes'>Likes: " . $fila['total_likes'] . "</p>"; // Mostramos la cantidad de likes del producto
    
                // Verificar si el usuario actual ya dio like
                $salida .= "<div class='producto-acciones'>"; // Contenedor para las acciones del producto
                if (Loguin::verRol($_SESSION['id']) == 0) { // Si el usuario no tiene un rol especial
                    $salida .= "<a href='ctroBar.php?dato=" . $fila['id_producto'] . "&seccion=editarPro' class='btn btn-editar'>Editar</a>"; // Agregamos un botón para editar el producto
                }
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
    
    public static function obtenerCategorias() {
        include_once("modelo.php");
        $categorias = [];
        $consulta = Modelo::sqlVerCate(); // Asegúrate de que esta función devuelva un objeto con el resultado de la consulta
    
        // Verifica si hay resultados
        if ($consulta->num_rows > 0) {
            while ($fila = $consulta->fetch_assoc()) {
                $categorias[] = [
                    'id' => $fila['id_categoria'],
                    'nombre' => $fila['categoria']
                ];
            }
        }
        return $categorias; // Retorna el array de categorías
    }
    
    

    public static function mostrarCate() {
        include_once("modelo.php");
        $salida = "";
        $consulta = Modelo::sqlVerCate();
    
        // Verifica si hay resultados
        if ($consulta->num_rows > 0) {
            // Muestra las categorías utilizando un ciclo while
            while ($fila = $consulta->fetch_assoc()) {
                $salida .=  "<div class='categoria-item' style='position: relative;'>"; 
                $salida .=  "<div class='categoria-id'>" . $fila['id_categoria'] . "</div>";
                $salida .=  "<div class='categoria-titulo'>" . $fila['categoria'] . "</div>";
                $salida .=  "<a href='ctroBar.php?seccion=editarCate&dato=" .$fila['id_categoria']."'  class='editar-btn top-left' >Editar</a>"; 
                $salida .=  "</div>";
            }
        } else {
            $salida .=  "No se encontraron categorías.";
        }
        return $salida;
    
        $conexion->close(); // Cierra la conexión a la base de datos
    }

public static function eliminarPro($id){ // Definimos una función para eliminar un producto, recibiendo su ID
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar productos
    $consulta = Modelo::sqlEliminarPro($id); // Llamamos a la función sqlEliminarPro del modelo, pasando el ID del producto a eliminar
    if($consulta){ // Si la consulta para eliminar fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    }else{ // Si la consulta no fue exitosa
        $salida = 0; // Mantenemos salida en 0
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
} 

public static function eliminarCate($id){ // Definimos una función para eliminar una categoría, recibiendo su ID
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar categorías
    $consulta = Modelo::sqlEliminarCate($id); // Llamamos a la función sqlEliminarCate del modelo, pasando el ID de la categoría a eliminar
    if($consulta){ // Si la consulta para eliminar fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    }else{ // Si la consulta no fue exitosa
        $salida = 0; // Mantenemos salida en 0
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}


 
public static function agregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen){ 
    // Definimos una función para agregar un producto, recibiendo varios parámetros como ID de categoría, nombre, precio, cantidad, descripción, color, tallas e imagen
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para agregar productos
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la adición fallará
    $consulta = Modelo::sqlAgregarPro($id_categoria, $nombre, $precio, $cantidad, $descripcion, $color, $tallas, $imagen); 
    // Llamamos a la función sqlAgregarPro del modelo, pasando todos los parámetros necesarios para agregar el producto
    if($consulta){ // Si la consulta para agregar el producto fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la adición fue exitosa
    } 
    return $salida; // Devolvemos el valor de salida (1 o 0)
}

public static function agregarCate($categoria){ 
    // Definimos una función para agregar una categoría, recibiendo solo el nombre de la categoría
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para agregar categorías
    $consulta = Modelo::sqlAgregarCate($categoria); // Llamamos a la función sqlAgregarCate del modelo, pasando el nombre de la categoría
    if($consulta){ // Si la consulta para agregar la categoría fue exitosa
        header("location:ctroBar.php?seccion=verCate"); // Redirigimos a la página de ver categorías
    }
}

public static function editarCate($des, $categoria){ 
    $salida = ""; // Inicializamos la variable salida como una cadena vacía
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para obtener categorías
    $consulta = Modelo::sqlCategorias($des, $categoria); // Llamamos a la función sqlCategorias del modelo, pasando el descriptor y el nombre de la categoría
    while($fila = $consulta->fetch_array()){ // Mientras haya filas en la consulta
        $salida .= $fila[0]; // Agregamos el primer elemento de cada fila a la variable salida
    }
    return $salida; // Devolvemos el valor de salida que contiene los datos obtenidos
}

    
public static function editarCategoria($id_categoria, $categoria){ 
    // Definimos una función para editar una categoría, recibiendo el ID de la categoría y el nuevo nombre de la categoría
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para editar categorías
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la edición fallará
    $consulta = Modelo::sqlEditar($id_categoria, $categoria); 
    // Llamamos a la función sqlEditar del modelo, pasando el ID de la categoría y el nuevo nombre
    if($consulta){ // Si la consulta para editar la categoría fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la edición fue exitosa
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}

public static function EliminarUser($id){ 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para eliminar usuarios
    $salida = 0; // Inicializamos la variable salida en 0, asumiendo que la eliminación fallará
    $consulta = Modelo::sqlEliminarUser($id); 
    // Llamamos a la función sqlEliminarUser del modelo, pasando el ID del usuario
    if($consulta){ // Si la consulta para eliminar el usuario fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la eliminación fue exitosa
    }
    return $salida;
}

public static function datoPro($des, $idPro){ 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para obtener datos del producto
    $salida = ""; // Inicializamos la variable salida como una cadena vacía
    $consulta = Modelo::sqlDatoPro($des, $idPro); 
    while($fila = $consulta->fetch_array()){ // Mientras haya filas en la consulta
        $salida .= $fila[0]; // Agregamos el primer elemento de cada fila a la variable salida
    }
    return $salida; // Devolvemos el valor de salida que contiene los datos obtenidos
}

public static function editarProducto($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas) { 
    include_once("modelo.php"); // Incluimos el archivo del modelo que contiene la función para editar productos
    $salida = 0;
    $consulta = Modelo::sqlEditarPro($id_producto, $nombre, $precio, $cantidad, $detalles, $color, $tallas); 
    // Llamamos a la función sqlEditarPro del modelo, pasando todos los nuevos datos del producto
    if ($consulta) { // Si la consulta para editar el producto fue exitosa
        $salida = 1; // Cambiamos salida a 1 para indicar que la edición fue exitosa
    }
    return $salida; // Devolvemos el valor de salida (1 o 0)
}

 
public static function mostrarConteoEli() { 
    // Definimos una función para mostrar el conteo de elementos eliminados
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

public static function mostrarConteoReg() { 
    // Definimos una función para mostrar el conteo de registros
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

public static function mostrarConteoProductos() { 
    // Definimos una función para mostrar el conteo de productos
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $salida = ""; // Inicializamos la variable salida
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

public static function buscarUsuario($des, $busqueda) { 
    // Definimos una función para buscar un usuario
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

public static function mostrarUsuarios($buscaUser = null) { 
    // Definimos una función para mostrar usuarios
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

public static function actualizaDatosUser($des, $idUser) { 
    // Definimos una función para actualizar los datos de un usuario
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $consulta = Modelo::sqlMostrarDaUser($des, $idUser); // Llamamos a la función del modelo que obtiene datos del usuario
    while ($fila = $consulta->fetch_array()) { // Iteramos sobre cada fila de resultados
        $salida = $fila[0]; // Almacenamos el primer dato en la variable salida
    }
    return $salida; // Devolvemos el dato obtenido
}

public static function actualizarUser($idUser, $nombre, $apellido, $correo) { 
    // Definimos una función para actualizar los datos de un usuario
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $consulta = Modelo::sqlActualizarUser($idUser, $nombre, $apellido, $correo); // Llamamos a la función del modelo para actualizar
    if ($consulta) { // Si la actualización fue exitosa
        $salida = 1; // Establecemos salida en 1 para indicar éxito
    }
    return $salida; // Devolvemos el resultado de la actualización
}

public static function verificLike($usuario_id, $producto_id) { 
    // Definimos una función para verificar si un usuario ha dado like a un producto
    include_once("modelo.php"); // Incluimos el archivo del modelo
    $consulta = Modelo::sqlVerificLike($usuario_id, $producto_id); // Llamamos a la función del modelo para verificar el like
    if ($consulta && $consulta->num_rows > 0) { // Si la consulta fue exitosa y hay resultados
        $fila = $consulta->fetch_assoc(); // Obtenemos la fila de resultados
        return $fila['count'] > 0 ? 1 : 0; // Devolvemos 1 si hay likes, de lo contrario 0
    }
    return 0; // Si no hubo resultados, devolvemos 0
}

public static function agregarLike($usuario_id, $producto_id) { 
    // Definimos una función para agregar un like a un producto
    include_once("modelo.php"); // Incluimos el archivo del modelo
    return Modelo::sqlAgregarLike($usuario_id, $producto_id); // Llamamos a la función del modelo para agregar el like y devolvemos el resultado
}


/**mayra */

// productos_class.php
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
            $rutaImagen = "../img/" . $fila['ruta_img'];  // Asegúrate de que la ruta sea correcta.
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
                <td data-label='Producto' class='product-name'>{$fila['nombre_produc']}</td>  // Muestra el nombre del producto.
                <td data-label='Cantidad'>
                    <div class='quantity-buttons'>
                        <input type='text' value='{$fila['cantidad_fav']}' class='quantity-input' readonly>  // Muestra la cantidad de este producto en favoritos, como un campo de texto solo lectura.
                    </div>
                </td>
                <td data-label='Eliminar'>
                    <a href='eliminarFavo.php?id={$fila['id_favo']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>  // Botón para eliminar el producto de favoritos, redirige a 'eliminarFavo.php' pasando el ID del favorito.
                </td>
            </tr>";
    }
    
    $salida .= "</tbody></table>";  // Cierra el cuerpo de la tabla y la tabla en sí.

    return $salida;
}

     
    public static function verCarrito() {
        include 'modelo.php';
        $salida = "";
        $consulta = Modelo::sqlverCarrito();
        $salida .= "<table class='table table-hover'>";
        $salida .= "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Eliminar</th></tr></thead><tbody>";
        $subtotal = 0;
        
        while ($fila = $consulta->fetch_assoc()) {
            $total_producto = $fila['precio_pro'] * $fila['cantidad_pro'];
            $subtotal += $total_producto;
            $salida .= "
                <tr>
                    <td data-label='Producto' class='product-name'>{$fila['nombre_producto']}</td>
                    <td data-label='Precio'>\${$fila['precio_pro']}</td> <!-- Corregido aquí -->
                    <td data-label='Cantidad'>
                        <div class='quantity-buttons'>
                            <input type='text' value='{$fila['cantidad_pro']}' class='quantity-input' readonly>
                        </div>
                    </td>
                    <td data-label='Total'>\${$total_producto}</td>
                    <td data-label='Eliminar'>
                        <a href='eliminarCa.php?id={$fila['id_ca']}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>";
        }
        
        $salida .= "</tbody>";
        $salida .= "<tfoot><tr class='total-row'><td colspan='3'>Subtotal</td><td>\${$subtotal}</td><td></td></tr></tfoot>";
        $salida .= "</table>";
        
        return $salida;
    }
    

    public static function buscador() {
        include 'modelo.php';
        $salida = "";
        $resultado = Modelo::sqlBuscador();
    
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $salida .= "<div class='product-container'>";
                $salida .= "<h2>" . htmlspecialchars($fila['nombre_producto']) . "</h2>";
                $salida .= "<p>Precio: $" . htmlspecialchars($fila['precio']) . "</p>";
                $salida .= "<img src='../img/" . $fila['ruta_img'] . "' alt='" . htmlspecialchars($fila['nombre_producto']) . "' class='img-thumbnail'>";
                $salida .= "<p>" . htmlspecialchars($fila['detalles']) . "</p>";
                $salida .= "<div class='carfav'>";
                $salida .= "<button class='btn btn-primary btn-agregar-carrito' data-id='{$fila['id_producto']}'><i class='fa fa-shopping-cart'></i> carrito</button>-";
                $salida .= "<button class='btn btn-primary btn-favoritos' data-id='{$fila['id_producto']}'><i class='fas fa-heart'></i>favoritos</button>";
                $salida .= "</div><br>";
                $salida .= "</div>";
            }
        } else {
            $salida .= "<div class='no-results'>";
            $salida .= "<h2>No se encontraron productos</h2>";
            $salida .= "<p>Intenta con otro término de búsqueda.</p>";
            $salida .= "</div>";
        }
    
        return $salida; // Se devuelve la salida generada
    }
}

