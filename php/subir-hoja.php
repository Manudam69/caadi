<?php
require("./conexion.php");
$conexion = connect();
session_start();
$varsesion = $_SESSION['usuario'];
$id_alumno = $_SESSION['id'];
$nivelsesion = $_SESSION['tipo_persona'];
$periodo = $_SESSION['periodo'];
$id_alumno_hoja_trabajo = $_GET['id_alumno_hoja_trabajo'];
    if($varsesion == null ||  $varsesion = '' || $nivelsesion != '0'){
        echo 'No tiene autorizacion';
        header("Location:index.php");
    }
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
} else {
    $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
    if ($archivo) {
        // $ruta_destino_archivo = "../archivos/$id_alumno/{$archivo['name']}";
        $ruta_destino_archivo = "../archivos/$id_alumno";
        if(file_exists($ruta_destino_archivo)){
            $archivo_nombre ="../archivos/$id_alumno/{$archivo['name']}";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $archivo_nombre);
            echo "si existe";
        }else{
            mkdir($ruta_destino_archivo,0777,true);
            $archivo_nombre ="../archivos/$id_alumno/{$archivo['name']}";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $archivo_nombre);
            echo "no existe, se creo";
        }
    
    }
     if (isset($archivo)){
        if ($archivo_ok){?>
            <strong> El archivo ha sido subido correctamente. </strong>
     <?php 
            $update=$conexion->query("update alumno_hoja_trabajo set estado=1,fecha=date(now()) where id_alumno_hoja_trabajo=$id_alumno_hoja_trabajo");
        } else{ ?>
            <span style="color: #f00;"> Error al intentar subir el archivo. </span>
      <?php } 
     }
}
header("location:../hojas-de-trabajo.php#tab2");
?>