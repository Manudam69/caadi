<?php 
    require("conexion.php");
    $conexion = connect();
    session_start();
    $nivelsesion = $_SESSION['tipo_persona'];
    $id_persona = $_SESSION['id_persona'];
    $contrasena_actual = $_POST['actual'];
    $contrasena_nueva = $_POST['nueva'];
    $conexion->query("update persona set contrasena = $contrasena_nueva where id_persona= $id_persona");

    switch ($nivelsesion){
        case 0 :
        header("location:../inicio.php");
        break;
        case 1:
            header("location:../inicio-admin.php");
        break;
        case 2:
            header("location:../inicio-maestro.php");
        break;
        case 3:
            header("location:../inicio-asesor.php");
        break;
    }

?>