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
    $reserva = mysqli_query($connection,"INSERT INTO alumno_club(id_alumno,id_club,asistencia) VALUES ($id_alumno,$idC,0)");
    $disminuye = mysqli_query($connection,"UPDATE club SET cupo=cupo-1 WHERE id_club=$idC and cupo > 0");
    header("location:../clubs-de-converscion.php");
    
}

?>