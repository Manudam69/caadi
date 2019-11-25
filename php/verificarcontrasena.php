<?php
header('content-type: aplication/json',true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method != "POST") {
  $response = array('ok' => false);
} else {
  session_start();
  $pass = $_POST['pass'];
  $id_persona = $_SESSION['id_persona'];
  if ($pass == null || $pass == '' || $id_persona == null || $id_persona == '') {
    $response = array('ok' => false);
  } else {
    require("conexion.php");
    $conn = connect();
    $contrasena = $conn->query("select contrasena from persona where id_persona=$id_persona");
    $contrasena = mysqli_fetch_array($contrasena);
    $contrasena = $contrasena['contrasena']; 
    if ($contrasena == $pass) {
      $response = array('ok' => true);
    } else {
      $response = array('ok' => false);
    }
  }
}
echo json_encode($response);
?>