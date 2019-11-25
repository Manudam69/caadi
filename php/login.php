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
    $datos = $conexion->query("SELECT tipo_persona, id_persona,nombre,apellido_paterno FROM persona 
    WHERE id_persona=$id_usuario AND contrasena = '$pass'");
    $usuario = mysqli_fetch_array($datos);
    $tipo_persona = $usuario['tipo_persona'];
    $id_persona = $usuario['id_persona'];
    $nombre = $usuario['nombre'];
    $apellido_paterno = $usuario['apellido_paterno'];

    if($id_persona == "" && $pass == ""){
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
        $_SESSION['tipo_persona'] = $tipo_persona;
        $_SESSION['id_persona'] = $id_persona;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido_paterno'] = $apellido_paterno;

        switch ($tipo_persona){
            case 0:
                $nivel = $conexion->query("SELECT n.nivel AS nivel,a.id_alumno AS id_alumno, i.nombre AS idioma
                FROM nivel n JOIN curso c JOIN curso_alumno ca JOIN alumno a JOIN idioma i
                WHERE a.id_persona = '$id_persona' AND a.id_alumno = ca.id_alumno AND ca.id_curso = c.id_curso 
                AND c.id_nivel = n.id_nivel AND n.id_idioma = i.id_idioma");
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
                $query_profesor = $conexion->query("select id_profesor from profesor where id_persona=$id_persona");
                $profesor = mysqli_fetch_array($query_profesor);
                $_SESSION['id_profesor']= $profesor['id_profesor'];
            break;
            case 3:
                $query_asesor = $conexion->query("select id_asesor from asesor where id_persona=$id_persona");
                $asesor = mysqli_fetch_array($query_asesor);
                $_SESSION['id_asesor']= $asesor['id_asesor'];
            break;
        }

        
    }
    
}
header('Content-Type: application/json');
echo json_encode($json);
?>


