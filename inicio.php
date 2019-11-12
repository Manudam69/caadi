<?php
    include("php/conexion.php");
    session_start();
    $varsesion = $_SESSION['usuario'];
    $nivelsesion = $_SESSION['tipo_persona'];
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
        $query_alumno = $conexion->query("select persona.nombre,persona.apellido_paterno
        from alumno,persona where alumno.id_persona=persona.id_persona and alumno.id_alumno=$id_alumno");
        $nombre = mysqli_fetch_array($query_alumno);
        $query = "SELECT a.id_club, d.nombre as asesor, b.fecha, b.horario, f.nombre as idioma 
        from alumno_club a join club b join asesor c join persona d join nivel e join idioma f 
        where a.id_alumno = '$id_alumno' and a.id_club = b.id_club and b.id_asesor = c.id_asesor 
        and c.id_persona = d.id_persona and b.id_nivel = e.id_nivel and e.id_idioma = f.id_idioma 
        and b.horario > time(now()) and b.fecha >= curdate() and a.asistencia = 0";
        $clubs_reservados = $conexion->query($query);

        $query_hojas = "select ht.id_hoja_trabajo,ht.tema,ht.area,idioma.nombre,nivel.nivel from 
        hoja_trabajo ht,idioma,nivel,alumno_hoja_trabajo where nivel.id_nivel=ht.id_nivel and 
        idioma.id_idioma=nivel.id_idioma and ht.id_hoja_trabajo = alumno_hoja_trabajo.id_hoja_trabajo 
        and alumno_hoja_trabajo.estado=0 and alumno_hoja_trabajo.id_alumno=$id_alumno";
        $hojass = $conexion->query($query_hojas);
        $_SESSION['cuenta'] = 0;
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
                    <li class="active"><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li><a href="./asesorias.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $nombre['nombre']." ".$nombre['apellido_paterno'];?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_alumno;?></span></a>
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

    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
        <li class="tab"><a href="#tab1" class="white-text">Clubes de Conversación Reservados</a></li>
        <li class="tab"><a href="#tab2" class="white-text">Hojas de Trabajo Pendientes</a></li>
    </ul>
    <div id="tab1" class="col s12">
        <div class="container">
            <ul class="collection">
            
                <!-- Repetir los li para agregar un nuevo elemento -->
                <?php while($club_reservado = mysqli_fetch_array($clubs_reservados)){
                    $idC = $club_reservado['id_club'];
                    $fecha = $club_reservado['fecha'];
                    $row = $conexion->query("SELECT dayname('$fecha') as fecha;");
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
                    $row = $conexion->query("SELECT date_format('$fecha','%d-%m-%Y') as fecha;");
                    $fecha = mysqli_fetch_assoc($row);
                ?>
                <li class="collection-item avatar">
                <i class="material-icons circle red">chrome_reader_mode</i>
                    <span class="title">Asesor: <?php echo $club_reservado['asesor']; ?> </span>
                    <a href="./php/elimina-reserva-de-club.php?id=<?php echo $idC; ?>" class="secondary-content">
                        <i class="material-icons borrar z-depth-1 small">clear</i>
                    </a>
                    <p><?php echo $dia, " ", $fecha['fecha'], ",   Horario: ",$club_reservado['horario']; ?>
                        <br> <?php echo $club_reservado['idioma']; ?>
                    </p>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div id="tab2" class="col s12">
        <div class="container">
            <ul class="collection">
                <?php while ($hojas = mysqli_fetch_array($hojass)){?>                    
                    <li class="collection-item avatar">
                        <a href="#!" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
                        <span class="title">Título: <?php echo $hojas['tema']; ?></span>
                        <p>Idioma: <?php echo $hojas['nombre']; ?>, Nivel <?php echo $hojas['nivel']; ?>
                            <br> Tipo: <?php echo $hojas['area'];?>
                        </p>
                    </li>
                <?php } ?>
            </ul>

            <ul class="pagination center">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>
