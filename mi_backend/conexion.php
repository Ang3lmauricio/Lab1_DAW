<?php
$servidor= "localhost";
$usuario="root";
$password="";
$base_de_datos="usuarios_db";
//crear la conexion
$conexion = new mysqli(hostname: $servidor,username: $usuario,password: $password,database: $base_de_datos);

//verificar conexion
if($conexion->connect_error){
    die("Error en la conexion:".$conexion->connect_error);
}else{
    echo"conexion exitosa";
}


?>
