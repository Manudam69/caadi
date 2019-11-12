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
    $datos = $conexion->query("SELECT persona.nombre_usuario AS nombre, persona.tipo_persona AS tipo_persona, 
    persona.id_persona AS id_persona FROM persona WHERE persona.id_persona='$id_usuario' AND persona.contrasena = '$pass'");
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

        $query  = $conexion->query("SELECT id_periodo FROM periodo where date(now()) >= fecha_inicio and date(now()) <= fecha_final");
        $periodo = mysqli_fetch_array($query);
        session_start();
        $_SESSION['periodo'] = $periodo['id_periodo'];
        $_SESSION['usuario'] = $id;
        $_SESSION['tipo_persona'] = $tipo_persona;
        $_SESSION['id'] = $id_persona;
        switch ($tipo_persona){
            case 0:
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
                $niveles = array();
                $idiomas = array();
                $id_alumno = "";
                while($na = mysqli_fetch_array($nivel)){
                    array_push($niveles, $na['nivel']);
                    array_push($idiomas, $na['idioma']);
                    $id_alumno = $na['id_alumno'];
                }
                $_SESSION['id_alumno'] = $id_alumno;
                $_SESSION['nivel'] = '("'.join('","', $niveles).'")';
                $_SESSION['idioma'] = '("'.join('","', $idiomas).'")';
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


