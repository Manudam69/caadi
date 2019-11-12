<?php
include("php/conexion.php");
session_start();
$varsesion = $_SESSION['usuario'];
$nivelsesion = $_SESSION['tipo_persona'];
$periodo = $_SESSION['periodo'];
    if($varsesion == null ||  $varsesion = '' || $nivelsesion != '0'){
        header("Location:index.php");
    }
$conexion = connect();
if(!$conexion){
    echo "Error. Sin conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    exit;
}else{
    $id_alumno = $_SESSION['id_alumno'];
    $query =$conexion->query("select nombre, apellido_paterno from persona where id_persona=$id_alumno");
    $datos = mysqli_fetch_array($query);

    $query ="select club.id_club,club.fecha,club.horario,idioma.nombre as idioma,nivel.nivel,persona.nombre as asesor from club,
    nivel,idioma,asesor,persona,alumno_club where club.id_club=alumno_club.id_club and nivel.id_nivel=club.id_nivel and 
    idioma.id_idioma=nivel.id_idioma and asesor.id_persona=persona.id_persona and club.fecha < curdate() 
    and alumno_club.asistencia=1 and alumno_club.id_alumno=$id_alumno and alumno_club.id_periodo = $periodo";
    $clubs = $conexion->query($query);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio - CAADI</title>
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
    <link rel="stylesheet" href="css/inicio.css">
</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li ><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $datos['nombre']." ". $datos['apellido_paterno'];?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_alumno; ?></span></a>
                </div>
            </li>
            <li class="active"><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <?php while ($club = mysqli_fetch_array($clubs)){ ?>
            <div class="container">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <span class="title"><b>Nombre del Asesor:<?php echo $club['asesor']; ?></b></span>
                        <p>Fecha: <?php echo $club['fecha']; ?> , Horario: <?php echo $club['horario']; ?>
                        <br>
                        </p>Idioma:<?php echo $club['idioma']; ?>, Nivel: <?php echo $club['nivel']; ?>
                        <a href="calificar-clubs.php?id_club=<?php echo $club['id_club']; ?>" class="secondary-content"><i class="material-icons">open_in_new</i></a>
                    </li>
                </ul>
            </div>
        <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
</body>

</html>
