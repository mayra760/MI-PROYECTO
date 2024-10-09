<?php
include_once("../method/usuarios_class.php");
include_once("../method/productos_class.php");

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../login.php");
} else if ($_SESSION['id'] == 0) {
    header("location: ../login.php");
}

$seccion = "home";
if (isset($_GET['seccion'])) {
    $seccion = $_GET['seccion'];
}

if ($seccion == "cerrarSe") {
    session_destroy();
    setcookie(session_name(), "", time() - 3600, "/");
    header("location:../login.php");
}

include("navUser.php"); // Este debe estar solo aquí
?>
