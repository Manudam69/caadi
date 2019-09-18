<?php 
$server="localhost";
$pass="";
$user="root";
$db="caadi";
$conexion=mysqli_connect($server,$user,$pass,$db);
$json = array();
session_start();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
}


$id_usuario = $_POST["id_usuario"];
$pass = $_POST["pass"];
if($id_usuario == "" || $pass == ""){
    $json['success'] = false;
    $json['message'] = 'Ingresa tus datos completos';
    $json['data'] = null;
} else {
    $datos = mysqli_query($conexion,"SELECT alumno.id_alumno AS id, persona.contrasena AS pass, persona.nombre AS nombre FROM alumno JOIN persona WHERE alumno.id_persona = persona.id_persona 
    AND alumno.id_alumno = '$id_usuario' AND persona.contrasena = '$pass'");
    $usuario = mysqli_fetch_array($datos);
    $id = $usuario['id'];
    $password = $usuario['pass'];
    $nombre = $usuario['nombre'];
    if($id == "" && $password == ""){
        $json['success'] = false;
        $json['message'] = 'No se encontro un usuario con estos datos';
        $json['data'] = null;
    } else {
        $json['success'] = true;
        $json['message'] = 'Bienvenido de nuevo';
        $json['data'] = null;
        $_SESSION['usuario'] = $id_usuario;

    }
}
header('Content-Type: application/json');
echo json_encode($json);
?>