<?php 
    require("./conexion.php");
    $conexion = connect();
    $id_revision = $_GET['id'];
    $respuestas = $conexion -> query(" select respuesta.id_respuesta,respuesta.enunciado,pregunta.id_pregunta from 
    respuesta,pregunta,hoja_trabajo,alumno_hoja_trabajo,alumno_hoja_trabajo_pregunta where 
    alumno_hoja_trabajo.id_hoja_trabajo = hoja_trabajo.id_hoja_trabajo and 
    hoja_trabajo.id_hoja_trabajo=pregunta.id_hoja_trabajo and pregunta.id_pregunta=respuesta.id_pregunta and 
    alumno_hoja_trabajo_pregunta.id_respuesta=respuesta.id_respuesta and alumno_hoja_trabajo.id_alumno_hoja_trabajo=$id_revision");
    $i=0;
    $resp_alumno=null;
    while ($resp = mysqli_fetch_array($respuestas)){
        $resp_alumno[$i]=$resp['id_respuesta'];
        $preguntas[$i] = $resp['id_pregunta'];
        $i++; 
    }
    
    $comentarios = null;
    $x = 1;
    while($x < 21){
        if (isset($_POST['text'.$x])){
            $comentarios[$x] =$_POST['text'.$x];
        }else{
            $comentario[$x] = "";
        }
        $comentario = $comentarios[$x];
        $id_respuesta = $resp_alumno[$x-1];
        $id_pregunta = $preguntas[$x-1];
        $query = "update alumno_hoja_trabajo_pregunta set comentario = '$comentario' 
        where id_alumno_hoja_trabajo=$id_revision and id_pregunta=$id_pregunta and id_respuesta=$id_respuesta";
        $conexion -> query($query);  
        $x++;
    }
    $conexion -> query("update alumno_hoja_trabajo set estado=0 where id_alumno_hoja_trabajo=$id_revision");
    header("location:../revision-de-hojas.php");
?>