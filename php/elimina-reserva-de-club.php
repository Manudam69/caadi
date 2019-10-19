<?php
require("conexion.php");
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    session_start();
    $idC = $_GET['id'];
    $id_alumno = $_SESSION['id_alumno'];
    $elimina_reserva = $conexion->query("DELETE FROM alumno_club WHERE id_alumno = $id_alumno AND id_club = $idC;");
    $eliminado = $conexion->query("SELECT incrementa_cupo($idC)");
    header("location:../inicio.php");
   
}
?>