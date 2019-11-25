<?php 
    session_start();
    //error_reporting(0);
    $varsesion = $_SESSION['tipo_persona'];
    if($varsesion == null ||  $varsesion = ''){
        echo 'No tiene autorizacion';
        die();
        
    }
    session_destroy();
    header("Location:../index.php");

?>