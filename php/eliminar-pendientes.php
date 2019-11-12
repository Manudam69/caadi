<?php
require("conexion.php");
session_start();
$connection = connect();
if(!$connection){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $id_alumno_hoja_trabajo = $_GET['id_alumno_hoja_trabajo'];
    $id_alumno = $_SESSION['id'];
    $periodo = $_SESSION['periodo'];
    
    $delete = $connection->query("delete from alumno_hoja_trabajo where id_alumno_hoja_trabajo=$id_alumno_hoja_trabajo");
    header("location:../hojas-de-trabajo.php#tab2");
    // AGREGAR AVISO SI NO SE AGREGA LA HOJA
}

?>