<?php 
$server="localhost";
$pass="12345";
$user="root";
$db="caadi";

$conexion=mysqli_connect($server,$user,$pass,$db);
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
} else {
    $datos = mysqli_query($conexion, "SELECT * FROM hoja_trabajo");
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
    <link rel="stylesheet" href="css/hojas-de-trabajo.css">

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
                    <li><a href="./asesorias.html"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.html"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li class="active"><a href="./hojas-de-trabajo.html"><i class="material-icons right">content_copy</i>Hojas de trabajo</a></li>
                    <li><a href="./bitacora.html"><i class="material-icons right">book</i>Bitácora</a></li>
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
            <li><a href="./asesorias.html"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.html"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./calificar-clubs.html"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li class="active"><a href="./hojas-de-trabajo.html"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.html"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.html"><i class="material-icons">settings</i> Configuración de Perfil</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="#!"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
        <li class="tab"><a href="#tab2" class="white-text">Libreria</a></li>
        <li class="tab"><a href="#tab3" class="white-text">Historial</a></li>
    </ul>

    

    <div id="tab2" class="col s12">
        <div class="container">
        <form action="php/busqueda-hoja.php" method="POST">
        <div class="row">
                <div class="input-field col l3 m6 s12">
                    <i class="material-icons prefix">book</i>
                    <input id="libreria" type="text" name="titulo" class="validate">
                    <label for="libreria">Titulo</label>
                </div>

                <div class="col l3 m6 s12">
                    <label>Tipo</label>
                    <select class="browser-default" name="tipo">
                        <option value="" disabled selected>Cualquier tipo</option>
                        <option value="audio">Audio</option>
                        <option value="gramatica">Gramática</option>
                        <option value="lectura">Lectura</option>
                        <option value="video">Video</option>
                        <option value="vocabulario">Vocabulario</option>
                        <option value="escritura">Escritura</option>
                    </select>
                </div>

                <div class="col l3 m7 s12">
                    <label>Idioma</label>
                    <select class="browser-default" name="idioma">
                        <option value="" disabled selected>Cualquier idioma</option>
                        <option value="japones">Japonés</option>
                        <option value="ingles">Inglés</option>
                        <option value="español">Español</option>
                        <option value="aleman">Alemán</option>
                        <option value="italiano">Italiano</option>
                        <option value="frances">Francés</option>
                        <option value="portuges">Portugués</option>
                        <option value="ruso">Ruso</option>
                    </select>
                </div>

                <div class="col l3 m5 s12">
                    <label>Nivel</label>
                    <select class="browser-default" name="nivel">
                        <option value="" disabled selected>Cualquier nivel</option>
                        <option value="1">1-2</option>
                        <option value="2">3-4</option>
                        <option value="3">5 +</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col m12 s12 center">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Buscar
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </form>
            
           <ul class="collection">
                <!-- Repetir los li para agregar un nuevo elemento -->
                <?php while($array = mysqli_fetch_array($datos)){ 
                    //afasdfasdfasdfasdfasdf
                    $curso = $array["id_curso"];
                    //echo $curso;
                    $datos2 = mysqli_query($conexion, "SELECT idioma.nombre AS nombre, nivel.nivel AS nivel  FROM hoja_trabajo JOIN nivel JOIN idioma WHERE hoja_trabajo.id_curso = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma ");
                    $datos2 = mysqli_fetch_array($datos2);
                    $idioma2 = $datos2["nombre"];
                    $nivel = $datos2["nivel"];
                ?>
                <li class="collection-item avatar">
                    <a href="#!" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
                    <span class="title"><?php echo $array["tema"] ?></span>
                    <a href="#!" class="right"><i class="material-icons contestar z-depth-1">file_upload</i></a>
                    <?php $id = $array['id_hoja_trabajo'];?>
                    <a href="../caadi/examen.php?id=<?php echo $id; ?>" class="right"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
                    <p><?php echo $idioma2 ?>, <?php echo $nivel ?>
                        <br> Tipo
                        <a href="#!" class="right"><i class="material-icons eliminar z-depth-1">delete</i></a>
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

    <div id="tab3" class="col s12">
        <div class="container">
            <div class="row">
                <div class="input-field col l3 m6 s12">
                    <i class="material-icons prefix">book</i>
                    <input id="historial" type="text" class="validate">
                    <label for="historial">Titulo</label>
                </div>

                <div class="col l3 m6 s12">
                    <label>Tipo</label>
                    <select class="browser-default">
                        <option value="" disabled selected>Cualquier tipo</option>
                        <option value="1">Audio</option>
                        <option value="2">Gramática</option>
                        <option value="3">Lectura</option>
                        <option value="4">Video</option>
                        <option value="5">Vocabulario</option>
                        <option value="6">Escritura</option>
                    </select>
                </div>

                <div class="col l3 m7 s12">
                    <label>Idioma</label>
                    <select class="browser-default">
                        <option value="" disabled selected>Cualquier idioma</option>
                        <option value="1">Japonés</option>
                        <option value="2">Inglés</option>
                        <option value="3">Español</option>
                        <option value="4">Alemán</option>
                        <option value="5">Italiano</option>
                        <option value="6">Francés</option>
                        <option value="7">Portugués</option>
                        <option value="8">Ruso</option>
                    </select>
                </div>

                <div class="col l3 m5 s12">
                    <label>Nivel</label>
                    <select class="browser-default">
                        <option value="" disabled selected>Cualquier nivel</option>
                        <option value="1">1-2</option>
                        <option value="2">3-4</option>
                        <option value="3">5 +</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col m12 s12 center">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Buscar
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>
