<?php
$server = "localhost";
$password = "12345";
$user = "root";
$db = "caadi";

$connection = mysqli_connect($server,$user,$password,$db);
if(!$connection){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $id = $_GET['id'];
    $preguntas = mysqli_query($connection,"SELECT * from pregunta where id_hoja_trabajo = $id;");
    $encabezado = mysqli_query($connection, "SELECT * from hoja_trabajo where id_hoja_trabajo = $id");
    $en = mysqli_fetch_array($encabezado);
    $datos2 = mysqli_query($connection,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel  FROM hoja_trabajo JOIN nivel JOIN idioma WHERE hoja_trabajo.id_curso = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma ");
    $datos2 = mysqli_fetch_array($datos2);
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
                Name: <b>Jhon Doe</b>
            </div>
            <div class="col m3 s4">
                ID: 123456
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
            <div class="right">
                  <a href="#!"><i class="material-icons z-depth-1 waves-effect waves-light" id="descargar">file_download</i></a>
            </div>
        </div>
        <?php
        $i = 0;
        while($pregunta = mysqli_fetch_array($preguntas)){
            $i = $i + 1;
            $idP = $pregunta['id_pregunta'];
            $p = $pregunta['enunciado'];
            $respuestas = mysqli_query($connection,"SELECT b.enunciado resp from pregunta a join respuesta b where a.id_pregunta = b.id_pregunta and a.id_pregunta = $idP;");
        ?>
        <ul class="collection">
            <li class="collection-item">
                <p><b><?php echo $i ?></b> <?php echo $p; ?></p>
                <div class="row">
                <?php while($respuesta = mysqli_fetch_array($respuestas)){ ?>
                    <div class="col m4 s12">
                        <label>
                            <input name="group1" type="radio" />
                            <span><?php echo $respuesta['resp'];?></span>
                        </label>
                    </div>
                    <?php } ?>
                </div>
            </li>
        </ul>
        <?php } ?>
        <div class="row center">
            <a class="waves-effect waves-light btn-large" id="btn">FINALIZAR</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
