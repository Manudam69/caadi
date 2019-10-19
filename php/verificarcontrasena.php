<?php
header('content-type: aplication/json',true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method != "POST") {
  $response = array('ok' => false);
} else {
  session_start();
  $pass = $_POST['pass'];
  $idAlumno = $_SESSION['id'];
  if ($pass == null || $pass == '' || $idAlumno == null || $idAlumno == '') {
    $response = array('ok' => false);
  } else {
    require("conexion.php");
    $conn = connect();
    $contrasena = $conn->query("select contrasena from persona where id_persona=$idAlumno");
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