<?php
    $server = "localhost";
    $password = "perones107";
    $user = "root";
    $db = "caadi";

    $connection = mysqli_connect($server,$user,$password,$db);
    if(!$connection){
        echo "Error. Sin conexion a la base de datos";
        echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
        exit;
    }else{
       $cons_asesoria = mysqli_query($connection, "SELECT * FROM asesoria");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="css/asesorias.css">
    <title>Asesorias - CAADI</title>
</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./calificar-clubs.html"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.html"><i class="material-icons right">settings</i>Configuración de Perfil</a></li>
            <li><a href="#!"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li class="active"><a href="./asesorias.html"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.html"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>

                    <!-- <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li> 
                    <li><a href="./hojas-de-trabajo.php"><i class="material-icons right">content_copy</i>Hojas de trabajo</a></li> 
                    <li><a href="./bitacora.html"><i class="material-icons right">book</i>Bitácora</a></li>-->

                    <li><a href="../revision-de-hojas.html"><i class="material-icons right">content_copy</i>Revisión de hojas de trabajo</a></li>

                    <li><a class="dropdown-trigger" href="#!" data-target='perfil'>Mi perfil<i class="material-icons right">account_circle</i></a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="images/fondo-navbar.jpg" alt="imagen de perfil">
                    </div>
                    <a href="#" class="center-align"><img src="images/usuario-perfil.jpg" class="circle"></a>
                    <a href="#!"><span class="name white-text">Nombre</span></a>
                    <a href="#!"><span class="id white-text">123456</span></a>
                </div>
            </li>
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li class="active"><a href="./asesorias.html"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.html"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./calificar-clubs.html"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.html"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.html"><i class="material-icons">settings</i> Configuración de Perfil</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="#!"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <div class="row">
        <div class="col s12 m12 l10">
            <div class="container horarios center-align">
                <h4>Horarios de asesorías</h4>
                <div id="jap" class="section scrollspy">
                    <h5>Por ahora solo se cuenta con asesorías del idioma inglés.</h5>
                </div>
                <div id="ing" class="section scrollspy">
                    <table class="highlight centered responsive-table">
                        <caption>
                            <h5>INGLÉS</h5>
                        </caption>
                            <?php
                                $hora = array(0 => "07:00-08:00",1 => "08:00-09:00",2 => "09:00-10:00",3 => "10:00-11:00",4 => "11:00-12:00",5 => "12:00-13:00",6 => "13:00-14:00",7 => "14:00-15:00",8 => "15:00-16:00",9 => "16:00-17:00",10 => "17:00-18:00",11 => "18:00-19:00");

                                $dia = array(0 => "Hora/Dia", 1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado");

                                $n = 0;
                                $asesoria = null;
                                $dia_s = null;

                                while($fila = mysqli_fetch_array($cons_asesoria)){

                                    $fecha = $fila['fecha'];
                                    $asesoria[$n] = $fila;

                                    $row = mysqli_query($connection,"SELECT dayname('$fecha') as fecha;");
                                    $dia_m = mysqli_fetch_assoc($row);
                                    switch ($dia_m['fecha']){
                                        case 'Monday':$dia_s[] = 0;break;
                                        case 'Tuesday':$dia_s[] = 1;break;
                                        case 'Wednesday':$dia_s[] = 2;break;
                                        case 'Thursday':$dia_s[] = 3;break;
                                        case 'Friday':$dia_s[] = 4;break;
                                        case 'Saturday':$dia_s[] = 5;break;
                                        default: 
                                    }
                                    $n++;
                                }
                                echo "<tbody>";
                                for($x = 0; $x <= 11; $x++) {
                                    for($y = 0; $y <= 6; $y++){
                                        if($x == 0){
                                            echo "<th>".$dia[$y]."</th>";
                                        }elseif($y == 0){
                                            echo "<tr><td>".$hora[$x]."</td>";
                                        }elseif($x != 0 and $y == 0){
                                            echo "<tr></thead>";
                                        }else{
                                            echo "<td>";
                                        }
                                        for($j = 0; $j < count($asesoria); $j++){
                                            if($asesoria[$j]['horario'] == $hora[$x] and $dia_s[$j] == $y){
                                                echo "hola"; //echo $asesoria[$j]['idioma']." - ".$asesoria[$j]['asesor']." <br>";
                                            }
                                        }
                                        echo "</td>";
                                    }
                                echo "</tr>";
                                }
                                echo "</tbody>"
                            ?>
                    </table>
                </div>
                <div id="esp" class="section scrollspy">

                </div>
                <div id="ale" class="section scrollspy">

                </div>
                <div id="ita" class="section scrollspy">

                </div>
                <div id="fra" class="section scrollspy">

                </div>
                <div id="por" class="section scrollspy">

                </div>
                <div id="rus" class="section scrollspy">

                </div>
            </div>
        </div>
        <div class="col hide-on-med-and-down s0 m0 l2 contenido">
            <ul class="section table-of-contents">
                <li><a href="#jap">JAPONÉS</a></li>
                <li><a href="#ing">INGLÉS</a></li>
                <li><a href="#esp">ESPAÑOL</a></li>
                <li><a href="#ale">ALEMÁN</a></li>
                <li><a href="#ita">ITALIANO</a></li>
                <li><a href="#fra">FRANCÉS</a></li>
                <li><a href="#por">PORTUGUÉS</a></li>
                <li><a href="#rus">RUSO</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/scrollspy.js"></script>
</body>

</html>
