<?php
require("conexion.php");
$conexion=connect();
$json = array();

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
    $datos = $conexion->query(
        "SELECT persona.nombre_usuario AS nombre, persona.tipo_persona AS tipo_persona, persona.id_persona AS id_persona FROM persona
         WHERE persona.id_persona='$id_usuario' AND persona.contrasena = '$pass'");
    $usuario = mysqli_fetch_array($datos);
    $id = $usuario['nombre'];
    $tipo_persona = $usuario['tipo_persona'];
    $id_persona = $usuario['id_persona'];

  
    if($id == "" && $password == ""){
        $json['success'] = false;
        $json['message'] = 'No se encontro un usuario con estos datos';
        $json['data'] = null;
      
    } else {
        $json['success'] = true;
        $json['message'] = 'Bienvenido de nuevo';
        $json['data'] = $tipo_persona;
        session_start();
        $_SESSION['usuario'] = $id;
        $_SESSION['tipo_persona'] = $tipo_persona;
        $_SESSION['id'] = $id_persona;
        switch ($tipo_persona){
            case 0:
                 //Nivel del alumno
            $nivel = $conexion->query("SELECT n.nivel AS nivel,
            a.id_alumno AS id_alumno, i.nombre AS idioma
            FROM nivel n JOIN curso c 
            JOIN curso_alumno ca JOIN alumno a 
            JOIN idioma i
            WHERE a.id_persona = '$id_persona'
            AND a.id_alumno = ca.id_alumno 
            AND ca.id_curso = c.id_curso 
            AND c.id_nivel = n.id_nivel
            AND n.id_idioma = i.id_idioma");
            $na = mysqli_fetch_array($nivel);
            $id_alumno = $na['id_alumno'];
            $_SESSION['id_alumno'] = $na['id_alumno'];
            $_SESSION['nivel'] = $na['nivel'];
            $_SESSION['idioma'] = $na['idioma'];

            //Idioma del alumno
            /*$idioma = mysqli_query($conexion, "SELECT i.nombre AS idioma
            FROM idioma i JOIN idioma_alumno ia 
            WHERE ia.id_alumno ='$id_alumno' AND 
            ia.id_alumno = '$id_alumno' AND ia.id_idioma = i.id_idioma");
            $ia = mysqli_fetch_array($idioma);
            $_SESSION['idioma'] = $ia['idioma'];*/
            break;
            case 1:
            break;
            case 2:
            
            break;
            case 3:
            break;
        }

        
    }
    
}
header('Content-Type: application/json');
echo json_encode($json);
?>

