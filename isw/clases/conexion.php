<?php
//$conexion = mysqli_connect("localhost","root","Carrillo7","empresaa_pruebas");
$conexion = mysqli_connect("mysql.face.ubiobio.cl","g5ieci2021","g5ieci2021a","g5bd2021");

if ($conexion->connect_error){
    die("Conexion fallida: " . $conn->connect_error);
}
mysqli_set_charset($conexion,"utf8");
?>