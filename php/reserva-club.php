<?php
$server = "localhost";
$password = "12345";
$user = "root";
$db = "caadi";

$connection = mysqli_connect($server,$user,$password,$db);
if(!$connection){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $idC = $_GET['id'];
     //---------CAMBIAR EL NUMERO EN LA QUERY POR EL ID DEL USUARIO ACTIVO MEDIANTE SESION.------------
    $reserva = mysqli_query($connection,"INSERT INTO alumno_club(id_alumno,id_club) VALUES(2,$idC)");
    $reservado = mysqli_query($connection,"SELECT decrementa_cupo($idC)");
    if($reservado == 1){
        header("location:../clubs-de-converscion.php");
    }else{
        echo "fracaso";
    }
}

?>