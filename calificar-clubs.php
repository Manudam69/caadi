<?php 
    require("./php/conexion.php");
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
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    } else {
        $id_persona = $_SESSION['id_persona'];
        $nombre = $_SESSION['nombre'];
        $apellido_paterno = $_SESSION['apellido_paterno'];
        $id_club = $_GET['id_club'];
        $_SESSION['id_club'] = $id_club;
        $query = $conexion->query("select persona.nombre from persona, asesor,club where persona.id_persona=asesor.id_persona and asesor.id_asesor=club.id_asesor and id_club=$id_club");
        $asesor = mysqli_fetch_array($query);
        $query = $conexion->query("select date(now()) as fecha");
        $fecha = mysqli_fetch_array($query);
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
    <link rel="stylesheet" href="css/calificar-clubs.css">

</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Configuración de Perfil</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $nombre." ".$apellido_paterno; ?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_persona; ?></span></a>
                </div>
            </li>
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li class="active"><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Configuración de Perfil</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card">

                    <div class="card-content">
                        
                        <div class="row">
                            <div class="col m3 s6">
                                Alumno(a): <b><?php echo $nombre." ".$apellido_paterno; ?></b>
                            </div>
                            <div class="col m3 s6">
                                Asesor(a): <b><?php echo $asesor['nombre']; ?></b>
                            </div>
                            <div class="col m3 s6">
                                ID: <b><?php echo $id_persona;?></b>
                            </div>
                            <div class="col m3 s6">
                                Fecha: <b><?php echo $fecha['fecha']; ?></b>
                            </div>
                        </div>
                        
                        <hr>
                        <p class="center">CALIFICAR CLUB DE CONVESACIÓN</p>
                        <form action = "./php/alta-calificar.php?id_club=<?php echo $id_club;?>" method ="POST">
                            <p class="clasificacion center">
                                <input id="radio1" type="radio" name="estrellas" value="5">
                                <label for="radio1">★</label>
                                <input id="radio2" type="radio" name="estrellas" value="4">
                                <label for="radio2">★</label>
                                <input id="radio3" type="radio" name="estrellas" value="3">
                                <label for="radio3">★</label>
                                <input id="radio4" type="radio" name="estrellas" value="2">
                                <label for="radio4">★</label>
                                <input id="radio5" type="radio" name="estrellas" value="1">
                                <label for="radio5">★</label>
                            </p>

                            <div class="row resp">
                                <div class="col l12">
                                    1. El club me permitió expresarme en el idioma de forma oral:
                                </div>
                            </div>

                            <div class="row resp">
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q1" type="radio" value="1" />
                                        <span>SI</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q1" type="radio" value="0" />
                                        <span>NO</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row resp">
                                <div class="col l12">
                                    2. El club fue adecuado a mi nivel:
                                </div>
                            </div>

                            <div class="row resp">
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q2" type="radio" value ="1" />
                                        <span>SI</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q2" type="radio" value="0"/>
                                        <span>NO</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row resp">
                                <div class="col l12">
                                    3. La actividad me permitió adquirir nuevos conocimientos (gramática, vocubulario,etc)
                                </div>
                            </div>

                            <div class="row resp">
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q3" type="radio" value="1" />
                                        <span>SI</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q3" type="radio" value="2" />
                                        <span>NO</span>
                                    </label>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">art_track</i>
                                <input name="q3e" id="cuales" type="text" class="validate">
                                <label for="cuales">¿Cuáles?</label>
                            </div>


                            <div class="row resp">
                                <div class="col l12">
                                    4. ¿Qué tipo de actividad te gustaría para tu próximo club?
                                </div>
                            </div>

                            <div class="row resp">
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q4" type="radio" value ="Video" />
                                        <span>Video</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q4" type="radio" value="Juego"/>
                                        <span>Juego</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q4" type="radio" value="Canción"/>
                                        <span>Canción</span>
                                    </label>
                                </div>
                                <div class="col m2 s6">
                                    <label>
                                        <input name="q4" type="radio" value="Tema libre" />
                                        <span>Tema libre</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">art_track</i>
                                <input name="otro" id="otro" type="text" class="validate">
                                <label for="otro">¿Otro?</label>
                            </div>


                            <p class="center">Comentarios/Sugerencias:</p>
                            <div class="row">
                                    <div class="row">
                                        <div class="input-field col m6 offset-m3 s12">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <input name="text" type="text" id="icon_prefix2" class="materialize-textarea" cols="50">
                                        </div>
                                    </div>
                            </div>
                            <div class="row center">
                                <input class ="waves-effect waves-light btn-large" type="submit" value="GUARDAR">
                            </div>
                        </form>
                            <div class="row">
                                <div class="col m2 offset-m9 s2 offset-s8"></div>
                                <a class="btn-floating btn-large waves-effect waves-light orange"><i class="material-icons">local_printshop</i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
</body>

</html>
