<?php
require("php/conexion.php");
$conexion = connect();

if(!$conexion){
    echo "Error. Sin conexion a la base de datos".PHP_EOL;
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    echo "Conexion exitosa<br>";
}

if (isset($_POST['enviar'])){
  $file = $_FILES['archivo']['name'];
  $copyF = $_FILES['archivo']['tmp_name'];
  $saveF = "copy_$file";
   echo "$copyF";
   if (copy($copyF,$saveF)) {
     echo "se copio correctamente";
   }else{
     echo "Error";
   }
//--------------Insertar desde archivo--------------------------
   if (file_exists($saveF)) {
     $fp = fopen($saveF,"r");
     while ($datos = fgetcsv($fp,0,";")) {
       $qInsert = "INSERT INTO pregunta (id_pregunta,enunciado,tipo,id_hoja_trabajo) VALUES($datos[0],'$datos[1]',$datos[2],$datos[3])";
       $result = $conexion->query($qInsert);
       if ($result) {
         echo "Se inserto correctamente";
       }else {
         echo "Fallo de insersion de archivo";
       }
     }
   }else {
     echo "<br/>no existe el archivo";
   }
}
mysqli_close($conexion);
 ?>
