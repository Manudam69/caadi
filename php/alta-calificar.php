<?php
    
    require("./conexion.php");
    $conexion = connect();

    $estrellas = $_POST['estrellas'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $id_club = $_GET['id_club'];
    
    $query = "update alumno_club set asistencia=2, calificacion=$estrellas, respuesta1 = $q1, respuesta2=$q2, respuesta3=$q3,respuesta4='$q4' where id_club=$id_club";
    $conexion->query($query);

    if ($_POST['q3e'] != null || $_POST['q3e'] != ""){
        $q3e = $_POST['q3e'];
        $query = "update alumno_club set respuesta3_escrita='$q3e' where id_club=$id_club";
        $conexion->query($query);
    } 
    
    if ($_POST['text'] != null || $_POST['text'] != ""){
        $comentario = $_POST['text'];
        $query = "update alumno_club set comentario='$comentario' where id_club=$id_club";
        $conexion->query($query);
    }
    // header("location:../clubs-realizados.php")
 ?>