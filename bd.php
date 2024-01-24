<?php

//CONEXION SERVIDOR
// $servername="192.168.10.13"; //127.0.0.1
// $username="Gordillov";
// $password="Hola2020*";
// $dbname="app";

//CONEXION LOCAL
$servername="localhost"; //127.0.0.1
$username="root";
$password="";
$dbname="app";

try{
    $conexion= new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    //$conexion= new mysqli($servername, $username, $password, $dbname);
    // echo "Conexión exitosa.";
}catch(Exception $ex){
    echo $ex->getMessage();
}
?>

<!-- INSERT INTO app.tbl_usuarios (nombre, correo, contrasena) VALUES ('NuevoUsuario', 'nuevo_usuario@example.com', 'contrasena123'); -->
