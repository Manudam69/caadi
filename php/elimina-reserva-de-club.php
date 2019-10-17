<?php
require("php/conexion.php");
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $idC = $_GET['id'];
     //---------CAMBIAR EL NUMERO EN LA QUERY POR EL ID DEL USUARIO ACTIVO MEDIANTE SESION.------------
    $elimina_reserva = $conexion->query("DELETE FROM alumno_club WHERE id_alumno = 1 AND id_club = $idC;");
    $eliminado = $conexion->query("SELECT incrementa_cupo($idC)");
    if($eliminado == 1){
        header("location:../inicio.php");
    }else{
        echo "fracaso";
    }
}

?>