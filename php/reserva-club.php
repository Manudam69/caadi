<?php
require("conexion.php");
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $idC = $_GET['id'];
     //---------CAMBIAR EL NUMERO EN LA QUERY POR EL ID DEL USUARIO ACTIVO MEDIANTE SESION.------------
    $reserva = $conexion->query("INSERT INTO alumno_club(id_alumno,id_club) VALUES(2,$idC)");
    $reservado = $conexion->query("SELECT decrementa_cupo($idC)");
    if($reservado == 1){
        header("location:../clubs-de-converscion.php");
    }else{
        echo "fracaso";
    }
}

?>