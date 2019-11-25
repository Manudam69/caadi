<?php
require("./conexion.php");
    $conexion = connect();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    session_start();
    $id_persona = $_SESSION['id_persona'];
    if ($nombre != null)
        $conexion->query("update persona set nombre='$nombre' where id_persona=$id_persona");
    if ($apellido != null)
        $conexion->query("update persona set apellido_paterno='$apellido' where id_persona=$id_persona");
    if ($telefono != null)
        $conexion->query("update persona set telefono='$telefono' where id_persona=$id_persona");
    header("location:../bitacora.php");
?>