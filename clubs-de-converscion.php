<?php
require("php/conexion.php");
session_start();
$nivelsesion = $_SESSION['tipo_persona'];
if($nivelsesion == null ||  $nivelsesion = '' || $nivelsesion != '0'){
    echo 'No tiene autorizacion';
    session_destroy();
    header("Location:index.php");
}
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    exit;
}else{
   $periodo = $_SESSION['periodo'];
   $idioma = $_SESSION['idioma'];
   $nivel = $_SESSION['nivel'];
   $id_alumno = $_SESSION['id_alumno'];
   $id_persona= $_SESSION['id_persona'];
   $nombre = $_SESSION['nombre'];
   $apellido_paterno = $_SESSION['apellido_paterno'];
   $clubs = mysqli_query($conexion, "SELECT * FROM club c JOIN nivel n JOIN idioma i WHERE  
   c.id_nivel = n.id_nivel AND n.id_idioma = i.id_idioma AND n.nivel IN $nivel AND i.nombre IN $idioma 
   AND c.cupo > 0 and fecha >= curdate() and horario > time(now()) and c.id_periodo = $periodo
   and c.id_club not in (select id_club from alumno_club where id_alumno = $id_alumno)");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clubs de conversación - CAADI</title>
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
    <!-- css -->
    <link rel="stylesheet" href="css/clubs-de-conversacion.css">
</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.html"><i class="material-icons right">settings</i>Configuración de Perfil</a></li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li><a href="./asesorias.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li class="active"><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="./hojas-de-trabajo.php"><i class="material-icons right">content_copy</i>Hojas de trabajo</a></li>
                    <li><a href="./bitacora.php"><i class="material-icons right">book</i>Bitácora</a></li>
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
                    <a href="#!"><span class="name white-text"> <?php echo $nombre." ".$apellido_paterno; ?> </span></a>
                    <a href="#!"><span class="id white-text"> <?php echo $id_persona; ?> </span></a>
                </div>
            </li>
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li class="active"><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <div class="container contenido">
        <?php 
        while($club = mysqli_fetch_array($clubs)){
            $fecha = $club['fecha'];
            $row = mysqli_query($conexion,"SELECT dayname('$fecha') as fecha;");
            $dia = mysqli_fetch_assoc($row);
            switch ($dia['fecha']){
                case 'Monday': $dia = 'Lunes';break;
                case 'Tuesday': $dia = 'Martes';break;
                case 'Wednesday': $dia = 'Miercoles';break;
                case 'Thursday': $dia = 'Jueves';break;
                case 'Friday': $dia = 'Viernes';break;
                case 'Saturday': $dia = 'Sabado';break;
                case 'Sunday': $dia = 'Domingo';break;
                default: $dia = '';
            }
            $row = mysqli_query($conexion,"SELECT date_format('$fecha','%d-%m-%Y') as fecha;");
            $fecha = mysqli_fetch_assoc($row);
            $idC = $club['id_club'];

            $idioma = mysqli_query($conexion,"SELECT a.nivel, b.nombre as idioma from club c join nivel a join idioma b where c.id_nivel = a.id_nivel and a.id_idioma = b.id_idioma and c.id_club = $idC;");
            $idioma = mysqli_fetch_assoc($idioma);
            $asesor = mysqli_query($conexion,"SELECT * from persona a join asesor b join club c where c.id_asesor = b.id_asesor and b.id_persona = a.id_persona and c.id_club = $idC;");
            $asesor = mysqli_fetch_assoc($asesor);

        ?>
                <ul class="collection">
                    <li class="collection-item avatar">
                        <i class="material-icons circle red">chrome_reader_mode</i>

                        <span class="title">Asesor: <?php echo $asesor['nombre'], " " ?></span>
                        <p><?php 
                            echo $dia, " ";
                            echo $fecha['fecha'], ". Horario: ", $club['horario']; ?>
                            <br> <?php echo $idioma['idioma'], " ", $idioma['nivel'] ?>
                            <br> Cupo <?php echo $club['cupo']; ?>
                        </p>
                        <a href="./php/reserva-club.php?id=<?php echo $idC; ?>" class="secondary-content"><i class="small material-icons">add_circle</i></a>
                    </li>
                </ul>   
        <?php
        }
        ?>
    </div>
    <script src=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/navbar.js"></script>
</body>

</html>
