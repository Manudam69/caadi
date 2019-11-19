<?php
require("./conexion.php");
$conexion = connect();
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
} else {

    $calificacion = $_POST['group1']; 
    echo $calificacion;
    $id_revision = $_POST['id_revision'];
    echo $id_revision;
    $query =$conexion->query("select id_alumno from alumno_hoja_trabajo where id_alumno_hoja_trabajo = $id_revision");
    $datos = mysqli_fetch_array($query);
    $id_alumno = $datos['id_alumno'];

    $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
    if ($archivo) {
        echo "hola";
        $ruta_destino_archivo = "../archivos/$id_alumno";
        if(file_exists($ruta_destino_archivo)){
            $archivo_nombre ="../archivos/$id_alumno/Hoja_revisada".$id_revision."-al".$id_alumno.".docx";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $archivo_nombre);
            echo "si existe";
        }else{
            mkdir($ruta_destino_archivo,0777,true);
            $archivo_nombre ="../archivos/$id_alumno/Hoja_revisada".$id_revision."-al".$id_alumno.".docx";
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $archivo_nombre);
            echo "no existe, se creo";
        }
    
    }else{
        echo "no hay nada";
    }
     if (isset($archivo)){
        if ($archivo_ok){?>
            <strong> El archivo ha sido subido correctamente. </strong>
     <?php 
            if ($calificacion == "aprobada"){
                $update=$conexion->query("update alumno_hoja_trabajo set estado=3,fecha=date(now()), calificacion=1 where id_alumno_hoja_trabajo=$id_revision");
            }
            if ($calificacion =="rechazada"){
                $update=$conexion->query("update alumno_hoja_trabajo set estado=3,fecha=date(now()), calificacion=0 where id_alumno_hoja_trabajo=$id_revision");
            }
        } else{ ?>
            <span style="color: #f00;"> Error al intentar subir el archivo. </span>
      <?php } 
     }
}
header("location:../revision-de-hojas.php");
?>