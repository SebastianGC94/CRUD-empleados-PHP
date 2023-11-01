<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "app_empleados_db";

try {
    //PDO --> PHP Data Object
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $contrasena);
} catch (Exception $ex) {
    echo $ex->getMessage();
    //$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

?>