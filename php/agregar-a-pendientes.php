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
    $id_hoja_trabajo = $_GET['id_hoja'];
    $id_alumno = $_SESSION['id_alumno'];
    $periodo = $_SESSION['periodo'];
    $pendiente = mysqli_query($connection,"INSERT INTO alumno_hoja_trabajo (id_alumno,id_hoja_trabajo,id_periodo,estado) 
    VALUES ($id_alumno,$id_hoja_trabajo,$periodo,0)");
    header("location:../hojas-de-trabajo.php");
    // AGREGAR AVISO SI NO SE AGREGA LA HOJA
}

?>