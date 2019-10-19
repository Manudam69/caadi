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
    $idC = $_GET['id'];
    $id_alumno = $_SESSION['id_alumno'];
        //Validar cupo del club y si el usuario ya esta en el club
    $reserva = mysqli_query($connection,"INSERT INTO alumno_club(id_alumno,id_club) VALUES ($id_alumno,$idC)");
    header("location:../clubs-de-converscion.php");
    
}

?>