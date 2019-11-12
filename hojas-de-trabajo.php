<?php 
require("./php/conexion.php");
$conexion = connect();
session_start();
$varsesion = $_SESSION['usuario'];
$id_alumno = $_SESSION['id'];
$nivelsesion = $_SESSION['tipo_persona'];
$periodo = $_SESSION['periodo'];
    if($varsesion == null ||  $varsesion = '' || $nivelsesion != '0'){
        echo 'No tiene autorizacion';
        header("Location:index.php");
    }
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
} else {
    $hojas_pendientes = mysqli_query($conexion, "SELECT hoja_trabajo.id_hoja_trabajo,alumno_hoja_trabajo.id_alumno_hoja_trabajo,tema,area,tipo,nombre,nivel,estado FROM alumno_hoja_trabajo, 
    hoja_trabajo, nivel, idioma WHERE alumno_hoja_trabajo.id_hoja_trabajo = hoja_trabajo.id_hoja_trabajo and hoja_trabajo.id_nivel=nivel.id_nivel 
    AND idioma.id_idioma=nivel.id_idioma AND id_alumno=$id_alumno AND estado = 0 AND id_periodo = $periodo");

    $hojas_historial = mysqli_query($conexion, "SELECT hoja_trabajo.id_hoja_trabajo,tema,area,tipo,nombre,nivel,estado FROM alumno_hoja_trabajo, hoja_trabajo, nivel, idioma 
    WHERE alumno_hoja_trabajo.id_hoja_trabajo = hoja_trabajo.id_hoja_trabajo and hoja_trabajo.id_nivel=nivel.id_nivel 
    AND idioma.id_idioma=nivel.id_idioma AND id_alumno=$id_alumno AND estado = 3 AND id_periodo = $periodo");

    $query_alumno = $conexion->query("select persona.nombre,persona.apellido_paterno
    from alumno,persona where alumno.id_persona=persona.id_persona and alumno.id_alumno=$id_alumno");
    $nombre = mysqli_fetch_array($query_alumno);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!--Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/hojas-de-trabajo.css">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/peticionFiltro.js"></script>
</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de
                    conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="./php/loguot.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png"
                        class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png"
                        class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li><a href="./asesorias.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.php"><i
                                class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                    <li class="active"><a href="./hojas-de-trabajo.php"><i
                                class="material-icons right">content_copy</i>Hojas de trabajo</a></li>
                    <li><a href="./bitacora.php"><i class="material-icons right">book</i>Bitácora</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='perfil'>Mi perfil<i
                                class="material-icons right">account_circle</i></a></li>
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
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de
                    Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de
                    conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li class="active"><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de
                    trabajo</a></li>
            <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
        <li class="tab"><a href="#tab1" class="white-text">Libreria</a></li>
        <li class="tab"><a href="#tab2" class="white-text">Pendientes</a></li>
        <li class="tab"><a href="#tab3" class="white-text">Historial</a></li>
    </ul>


    <!-- Libreria -->
    <div id="tab1" class="col s12">
        <div class="container">
                <div class="row">
                    <div class="input-field col l3 m6 s12">
                        <i class="material-icons prefix">book</i>
                        <input id="titulo" type="text" name="titulo" class="validate">
                        <label for="libreria">Titulo</label>
                    </div>

                    <div class="col l3 m6 s12">
                        <label>Tipo</label>
                        <select class="browser-default" id="tipo" name="tipo">
                            <option value=""  selected>Cualquier tipo</option>
                            <option value="AUDIO">Audio</option>
                            <option value="GRAMMAR">Gramática</option>
                            <option value="READING">Lectura</option>
                            <option value="VIDEO">Video</option>
                            <option value="VOCABULARY">Vocabulario</option>
                            <option value="WRITING">Escritura</option>
                        </select>
                    </div>

                    <div class="col l3 m7 s12">
                        <label>Idioma</label>
                        <select class="browser-default" id="idioma" name="idioma">
                            <option value=""  selected>Cualquier idioma</option>
                            <option value="Japonés">Japonés</option>
                            <option value="Inglés">Inglés</option>
                            <option value="Español">Español</option>
                            <option value="Alemán">Alemán</option>
                            <option value="Italiano">Italiano</option>
                            <option value="Francés">Francés</option>
                            <option value="Portugués">Portugués</option>
                            <option value="Ruso">Ruso</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col m12 s12 center">
                        <button class="btn waves-effect waves-light" type="submit" name="busqueda" id="busqueda">Buscar
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </div>

            <ul class="collection" id="filtro_resultado">
                 <!-- AQUI VAN LAS HOJAS POR FILTRO DE BUSQUEDA -->
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

    <!-- Pendientes -->
    <div id="tab2" class="col s12">
            <div class="container">
                <?php while($hoja = mysqli_fetch_array($hojas_pendientes)){?>
                <ul class="collection">
                    <li class="collection-item avatar">
                        <?php if ($hoja['tipo'] == 1){?>
                            <a href="./archivos/hojas-de-trabajo/<?php echo $hoja['id_hoja_trabajo'].'-'.$hoja['tema'];?>.docx" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
                        <?php }else{ ?>
                            <a class="left"><i class="material-icons circle z-depth-1" id="descargar">create</i></a>
                        <?php }?>
                        <span class="title">Título:<?php echo $hoja['tema']; ?> </span>
                        <?php if ($hoja['tipo'] == 1){?>
                            <a href="#modal1" class="right modal-trigger"><i class="material-icons contestar z-depth-1">file_upload</i></a>
                        <?php } else{ ?> 
                            <a href="../caadi/examen.php?id=<?php echo $hoja['id_alumno_hoja_trabajo'];?>" class="right"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
                            <?php } ?>
                            <p>Idioma: <?php echo $hoja['nombre']; ?>, Nivel <?php echo $hoja['nivel'];?>
                            <br> Tipo: <?php echo $hoja['area']?>
                            <a href="./php/eliminar-pendientes.php?id_alumno_hoja_trabajo=<?php echo $hoja['id_alumno_hoja_trabajo'];?>" class="right"><i class="material-icons eliminar z-depth-1">delete</i></a>
                        </p>
                    </li>
                </ul>
                

                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Subir hoja de trabajo resuelta</h4>
                        <div class="container">
                            <form action="./php/subir-hoja.php?id_alumno_hoja_trabajo=<?php echo $hoja['id_alumno_hoja_trabajo'];?>" method="POST" enctype="multipart/form-data">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Archivo</span>
                                        <input type="file" name="archivo" required="required"/>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="modal-close waves-effect waves-green btn-flat" value="ENVIAR">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
                <?php } ?>
            </div>
        </div>

    <!-- Historial -->
    <div id="tab3" class="col s12">
        <div class="container">
            <?php while($hoja = mysqli_fetch_array($hojas_historial)){?>
                <ul class="collection">
                    <li class="collection-item avatar">
                        <?php if ($hoja['tipo'] == 1){?>
                            <a href="./archivos/hojas-de-trabajo/<?php echo $hoja['id_hoja_trabajo'].'-'.$hoja['tema'];?>.docx" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
                        <?php }?>
                        <span class="title">Título:<?php echo $hoja['tema']; ?> </span>
                        <?php if ($hoja['tipo'] == 0){?>
                            <a href="../caadi/examen.php?id=<?php echo $hoja['id_hoja_trabajo'];?>" class="right"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
                            <?php } ?>
                            <p>Idioma: <?php echo $hoja['nombre']; ?>, Nivel <?php echo $hoja['nivel'];?>
                            <br> Tipo: <?php echo $hoja['area']?>
                        </p>
                    </li>
                </ul>
            <?php } ?>
            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/modal.js"></script>

</body>

</html>