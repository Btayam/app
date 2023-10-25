<?php
$servername="DESKTOP-USP39LK"; //127.0.0.1
$username="Castillob";
$password="Bb1077091759*";
$dbname="app";

try{
    //$conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseña);
    $conexion= new mysqli($servername, $username, $password, $dbname);
    echo "Conexión exitosa.";
}catch(Exception $ex){
    echo $ex->getMessage();
}


?>

<!-- INSERT INTO app.tbl_usuarios (nombre, correo, contrasena) VALUES ('NuevoUsuario', 'nuevo_usuario@example.com', 'contrasena123'); -->
