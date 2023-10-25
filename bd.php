<?php

$servidor="DESKTOP-USP39LK"; //127.0.0.1
$baseDeDatos="app";
$usuario="Castillob";
$contraseña="Bb1077091759*";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseña);
}catch(Exception $ex){
    echo $ex->getMessage();
}

?>

<!-- INSERT INTO app.tbl_usuarios (nombre, correo, contrasena) VALUES ('NuevoUsuario', 'nuevo_usuario@example.com', 'contrasena123'); -->
