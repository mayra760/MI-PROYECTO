<?php
session_start();
include '../method/db_fashion/cb.php';
//verifica si el formulario fue enviaddo y si el id es numerico
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    //convierte el parametro id en entero
    $id_producto = intval($_POST['id']);
    
    // aqui se consulta el id de la base de datos
    $sql = "SELECT nombre_producto, precio FROM tb_productos WHERE id_producto = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param('i', $id_producto);//asocia el parametro con la consulta
        $stmt->execute(); //ejecuta la consulta
        $resultado = $stmt->get_result();//obtiene el valor de la consulta

        if ($producto = $resultado->fetch_assoc()) {//verifca si se obtuvo el producto
            //trae el nombre del producto y el precio
            $nombre_producto = $producto['nombre_producto'];
            $precio_pro = $producto['precio'];

            // Consulta para verificar si el producto ya está en el carrito
            $sql_check = "SELECT id_ca, cantidad_pro FROM tb_carrito WHERE nombre_producto = ?";
            if ($stmt_check = $conexion->prepare($sql_check)) {
                $stmt_check->bind_param('s', $nombre_producto);//parametros de la consulta
                $stmt_check->execute();//ejecuta la consulta
                $result_check = $stmt_check->get_result();//obtiene los resultados de la cosulta
                 
                //verifica la cantidad del carrito, se prepara una nueva consulta
                if ($carrito_item = $result_check->fetch_assoc()) {
                    $nueva_cantidad = $carrito_item['cantidad_pro'] + 1;
                    $sql_update = "UPDATE tb_carrito SET cantidad_pro = ? WHERE id_ca = ?"; // Si el producto ya está en el carrito, actualizar la cantidad
                    if ($stmt_update = $conexion->prepare($sql_update)) {
                        $stmt_update->bind_param('ii', $nueva_cantidad, $carrito_item['id_ca']);//asocia la consulta con los parametros
                        $stmt_update->execute();//ejecuta la consulta
                        echo json_encode(['status' => 'success', 'message' => 'Cantidad del producto actualizada en el carrito']);//sale el mensaje con exito
                    }
                } else { 
                    // Si el producto no está en el carrito, insertarlo
                    $sql_insert = "INSERT INTO tb_carrito (nombre_producto, cantidad_pro, precio_pro) VALUES (?, 1, ?)";
                    if ($stmt_insert = $conexion->prepare($sql_insert)) {
                        $stmt_insert->bind_param('sd', $nombre_producto, $precio_pro);
                        $stmt_insert->execute();
                        echo json_encode(['status' => 'success', 'message' => 'Producto añadido al carrito']);
                    }
                }
            }
        }   
    }
}
?>
