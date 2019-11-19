<?php 
require("php/conexion.php");
$conexion = connect();
session_start();
$id_alumno = $_POST['id_alumno'];
$_SESSION['id_alumno'] = $id_alumno;
$query = "select club.fecha,idioma.nombre as idioma,nivel.nivel,persona.nombre as asesor from club,nivel,idioma,asesor,persona,alumno_club 
          where club.id_club=alumno_club.id_club and nivel.id_nivel=club.id_nivel and idioma.id_idioma=nivel.id_idioma 
          and asesor.id_persona=persona.id_persona and alumno_club.asistencia=2 and alumno_club.id_alumno=$id_alumno";
$clubs = $conexion->query($query);
$query_hojas = "select ht.id_hoja_trabajo,ht.tema,ht.tipo,ht.area,idioma.nombre,nivel.nivel,alumno_hoja_trabajo.id_alumno_hoja_trabajo from hoja_trabajo ht,idioma,nivel,alumno_hoja_trabajo 
                where nivel.id_nivel=ht.id_nivel and idioma.id_idioma=nivel.id_idioma and ht.id_hoja_trabajo = alumno_hoja_trabajo.id_hoja_trabajo 
                and alumno_hoja_trabajo.estado=3 and alumno_hoja_trabajo.id_alumno=$id_alumno";
$hojas = $conexion->query($query_hojas);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actividades - CAADI</title>
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
    <link rel="stylesheet" href="css/actividades.css">
</head>

<body>
    <header>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio-maestro.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='perfil'>Mi perfil<i class="material-icons right">arrow_drop_down</i></a></li>
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
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
        <li class="tab"><a href="#tab1" class="white-text">Clubs de conversación</a></li>
        <li class="tab"><a href="#tab2" class="white-text">Hojas de trabajo</a></li>
    </ul>

    <div id="tab1" class="col s12">
        <?php 
            while ($row = mysqli_fetch_array($clubs)){
        ?>
                <div class="container">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <span class="title"><b>Asesor del club: <?php echo $row['asesor']; ?></b></span>
                            <p>Fecha: <?php echo $row['fecha']; ?>
                                <br>
                            </p>Idioma: <?php echo $row['idioma']; ?> , Nivel: <?php echo $row['nivel']; ?>
                        </li>
                    </ul>
                </div>
        <?php        
            }
        ?>

        
    </div>
    <div id="tab2" class="col s12">
        <?php 
            while($row = mysqli_fetch_array($hojas)){
        ?>
                <div class="container">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <span class="title"><b>Nombre: <?php echo $row['tema']; ?> </b></span>
                            <p>Tipo: <?php echo $row['area']; ?>
                                <br>
                            </p>Idioma: <?php echo $row['nombre']; ?>, Nivel: <?php echo $row['nivel']; ?>
                            <?php 
                                if ($row['tipo'] == 1){ ?>
                                    <a href="./archivos/<?php echo $id_alumno; ?>/Hoja_revisada<?php echo $row['id_alumno_hoja_trabajo'].'-al'.$id_alumno;?>.docx" class="secondary-content"><i class="material-icons">file_download</i></a>
                                    
                                    <?php }else{?>
                                    <a href="examen.php?id=<?php echo $row['id_alumno_hoja_trabajo']; ?>" class="secondary-content"><i class="material-icons">open_in_new</i></a>
                            <?php  }
                            ?>
                        </li>
                    </ul>
                </div>
        <?php
            }
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>
