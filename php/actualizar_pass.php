<?php 
    require("conexion.php");
    $conexion = connect();
    session_start();
    $cuenta = $_SESSION['cuenta'];
    $id_persona = $_SESSION['id_persona'];
    $contrasena_actual = $_POST['actual'];
    $contrasena_nueva = $_POST['nueva'];
    $conexion->query("update persona set contrasena = $contrasena_nueva where id_persona= $id_persona");

    switch ($cuenta){
        case 0 :
        break;
        case 1:
        break;
        case 2:
            // header("location:../inicio-maestro.php");
        break;
        case 3:
        break;
    }

?>