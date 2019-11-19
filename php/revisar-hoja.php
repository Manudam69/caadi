<?php 
    require("conexion.php");
    $conexion = connect();
    if(!$conexion){
        echo "Error. Sin conexion a la base de datos";
        echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
        exit;
    }

    $id_alumno_hoja_trabajo=$_GET['id_revision'];
    $preguntas= $conexion->query("select pregunta.id_pregunta from alumno_hoja_trabajo,hoja_trabajo,pregunta where 
    alumno_hoja_trabajo.id_hoja_trabajo=hoja_trabajo.id_hoja_trabajo and 
    pregunta.id_hoja_trabajo=hoja_trabajo.id_hoja_trabajo and 
    alumno_hoja_trabajo.id_alumno_hoja_trabajo = $id_alumno_hoja_trabajo");
    $id_preguntas = null;
    $i = 1;
    while($pregunta = mysqli_fetch_array($preguntas)){
        $id_preguntas[$i] = $pregunta['id_pregunta'];
        $i++;
    }

    $respuestas_usuario = null;
    $x = 1;
    while($x < 21){
        $respuestas_usuario[$x] =$_POST['grupo'.$x];
        $id_respuesta = $respuestas_usuario[$x];
        echo $id_respuesta."<br>";
        $id_pregunta = $id_preguntas[$x];
        echo $id_pregunta."<br>";
        $insert = $conexion -> query("insert into alumno_hoja_trabajo_pregunta (id_alumno_hoja_trabajo,id_pregunta,id_respuesta) values ($id_alumno_hoja_trabajo,$id_pregunta,$id_respuesta)");
        $x++;
    }

    $query=$conexion->query("select r.id_respuesta from respuesta r,pregunta p, hoja_trabajo ht, alumno_hoja_trabajo aht where 
    r.id_pregunta=p.id_pregunta and p.id_hoja_trabajo=ht.id_hoja_trabajo and ht.id_hoja_trabajo=aht.id_hoja_trabajo 
    and aht.id_alumno_hoja_trabajo=$id_alumno_hoja_trabajo and r.correcta=1");
    $respuestas_correctas = null;
    $i = 1;
        while($correctas = mysqli_fetch_array($query)){
            $correcta=$correctas['id_respuesta'];
            $respuestas_correctas[$i] = $correcta;
            $i++;
        }
    $contador_correctas = 0;
    for ($j = 1; $j < 21; $j++){
        if ($respuestas_usuario[$j] == $respuestas_correctas[$j]){
            $contador_correctas++;
        }
    }

    if($contador_correctas > 15){
        $update = $conexion->query("update alumno_hoja_trabajo set estado=3,calificacion=1 where id_alumno_hoja_trabajo=$id_alumno_hoja_trabajo");
    }else{
        $update = $conexion->query("update alumno_hoja_trabajo set estado=2, calificacion=0 where id_alumno_hoja_trabajo=$id_alumno_hoja_trabajo");   
    }
    header("location:../hojas-de-trabajo.php#tab2");
?>