<?php
require("php/conexion.php");
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $id = $_GET['id_revision'];
    $id_hoja = $conexion->query("SELECT id_hoja_trabajo FROM alumno_hoja_trabajo where id_alumno_hoja_trabajo=$id");
    $hoja = mysqli_fetch_array($id_hoja);
    $id_hoja_trabajo = $hoja['id_hoja_trabajo'];
    $preguntas = $conexion->query("SELECT * from pregunta where id_hoja_trabajo = $id_hoja_trabajo;");
    $encabezado = $conexion->query("SELECT * from hoja_trabajo where id_hoja_trabajo = $id_hoja_trabajo");
    $en = mysqli_fetch_array($encabezado);
    $datos2 = $conexion->query("SELECT idioma.nombre AS nombre, nivel.nivel AS nivel  FROM hoja_trabajo JOIN nivel JOIN idioma 
                                WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma ");
    $datos2 = mysqli_fetch_array($datos2);

    $respuestas = $conexion -> query(" select respuesta.id_respuesta,respuesta.enunciado,pregunta.id_pregunta from 
    respuesta,pregunta,hoja_trabajo,alumno_hoja_trabajo,alumno_hoja_trabajo_pregunta where 
    alumno_hoja_trabajo.id_hoja_trabajo = hoja_trabajo.id_hoja_trabajo and 
    hoja_trabajo.id_hoja_trabajo=pregunta.id_hoja_trabajo and pregunta.id_pregunta=respuesta.id_pregunta and 
    alumno_hoja_trabajo_pregunta.id_respuesta=respuesta.id_respuesta and alumno_hoja_trabajo.id_alumno_hoja_trabajo=$id");
    $i=0;
    $resp_alumno=null;
    while ($resp = mysqli_fetch_array($respuestas)){
        $resp_alumno[$i]=$resp['id_respuesta'];
        $i++; 
    }
    $idioma2 = $datos2["nombre"];
    $nivel = $datos2["nivel"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!--Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/examen.css">

</head>

<body>
    <div class="container" id="contenido">
        <div class="row">
            <div class="col m6 s8">
                Name: <b>  </b>
            </div>
            <div class="col m3 s4">
                ID: 
            </div>
            <div class="col m3 s12">
                Date: 20 de Enero del 9999
            </div>

        </div>
        <div class="row pic">
            <div class="col m10 s12 offset-m1 informacion">
                <h4 class="center">CENTRO DE APRENDIZAJE AUTODIRIGIDO DE IDIOMAS</h4>
            </div>
        </div>
        <div class="row pic">
            <div class="col s6 hide-on-med-and-up">
                <img class="responsive-img" src="images/logo.png">
            </div>
            <div class="col s6 hide-on-med-and-up">
                <img class="responsive-img" src="images/caadi-logo2.png">
            </div>
        </div>
        <div class="row pic">
            <div class="col m2 hide-on-small-only">
                <img class="responsive-img" src="images/logo.png">
            </div>
            <div class="col m2 s4  informacion r">
                <p><b>AREA</b></p>
                <p><b>LANGUAGE</b></p>
                <p><b>LEVEL</b></p>
            </div>
            <div class="col m4 s8 informacion2">
                <p><?php echo $en['area']; ?></p>
                <p> <?php echo $idioma2; ?></p>
                <p><?php echo $nivel; ?></p>
            </div>
        </div>
        <div class="row pic">
            <div class="col m2 hide-on-small-only">
                <img class="responsive-img" src="images/caadi-logo2.png">
            </div>
            <div class="col m2 s4 informacion r">
                <p><b>TOPIC</b></p>
                <p><b>ADAPTED FROM</b></p>
            </div>
            <div class="col m4 s8 informacion2">
                <p><?php echo $en['tema']; ?></p>
                <p><?php echo $en['adaptado']; ?></p>
            </div>
        </div>
        
        <?php
        $i = 0;
        while($pregunta = mysqli_fetch_array($preguntas)){
            $i = $i + 1;
            $idP = $pregunta['id_pregunta'];
            $p = $pregunta['enunciado'];
            $respuestas = $conexion->query("SELECT b.id_respuesta, b.enunciado resp from pregunta a join respuesta b where a.id_pregunta = b.id_pregunta and a.id_pregunta = $idP;");
            ?>
        <ul class="collection">
            <li class="collection-item">
                <p><b><?php echo $i ?></b> <?php echo $p; ?></p>
                <div class="row">
                <?php while($respuesta = mysqli_fetch_array($respuestas)){ ?>
                    <div class="col m4 s12">
                        <label>
                            <input value ="<?php echo $respuesta['id_respuesta'];?>"  name="grupo<?php echo $i; ?>" type="radio" 
                            <?php if($respuesta['id_respuesta'] == $resp_alumno[$i-1]){ echo "checked";} ?> disabled />
                            <span><?php echo $respuesta['resp'];?></span>
                        </label>
                    </div>
                    <?php } ?>
        <form action="./php/comentarios-asesor.php?id=<?php echo $id?>" method="POST">
                    <div class="input-field col m12 s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <input placeholder="Agregar comentario" name="text<?php echo $i; ?>" type="text" id="icon_prefix2" class="materialize-textarea" cols="50">
                    </div>
                </div>
            </li>
        </ul>
        <?php }?>
        <div class="row center">
            <input type="submit" value="FINALIZAR REVISION" class=" waves-light btn-large" id="btn">
        </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
