<?php 
    session_start();
    $id_persona = $_SESSION['id'];
    $nombre = $_SESSION['nombre'];
    $apellido_paterno = $_SESSION['apellido_paterno'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revisión de hojas de trabajo - CAADI</title>
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
    <link rel="stylesheet" href="css/revision-de-hojas.css">
    
</head>

<body>
    <header>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio-asesor.html"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio-asesor.html"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio-asesor.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li><a href="./asesorias-asesor.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li class="active"><a href="./revision-de-hojas.php"><i class="material-icons right">content_copy</i>Revisión de hojas de trabajo</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $nombre." ".$apellido_paterno;?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_persona; ?></span></a>
                </div>
            </li>
            <li><a href="./inicio-asesor.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias-asesor.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li class="active"><a href="./revision-de-hojas.php"><i class="material-icons">content_copy</i> Revisión de hojas</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>
    <div class="container">
        <div class="row">
            <div class="input-field col l3 m6 s12">
                <i class="material-icons prefix">book</i>
                <input id="titulo" name="titulo" type="text" class="validate">
                <label for="libreria">Titulo</label>
            </div>

            <div class="col l3 m6 s12">
                <label>Tipo</label>
                <select id="tipo" name="tipo" class="browser-default">
                    <option value="" selected>Cualquier tipo</option>
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
                <select id="idioma" name="idioma" class="browser-default">
                    <option value="" selected>Cualquier idioma</option>
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

            <div class="col l3 m5 s12">
                <label>Nivel</label>
                <select id="nivel" name="nivel" class="browser-default">
                    <option value="" selected>Cualquier nivel</option>
                    <option value="1-2">1-2</option>
                    <option value="3-4">3-4</option>
                    <option value="5-6">5-6</option>
                    <option value="7-8">7-8</option>

                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l4 m6 s12 offset-l4">
                <i class="material-icons prefix">person</i>
                <input id="id_alumno" name="id_alumno" type="number" class="validate">
                <label for="id">ID ALUMNO</label>
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
            
        </ul>

        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Subir revisión de hoja de trabajo</h4>
                <div class="container">
                    <div class="row center">
                    <form action="./php/subir-revision.php" method="POST" id="formRevision" enctype="multipart/form-data">
                        <div class="col l6">
                            <p>
                                <label>
                                    <input name="group1" value="aprobada" type="radio" checked />
                                    <span>Aprobada</span>
                                </label>
                            </p>
                        </div>
                        <div class="col l6">
                            <p>
                                <label>
                                    <input name="group1" value="rechazada" type="radio" checked />
                                    <span>Rechazada</span>
                                </label>
                            </p>
                        </div>
                    </div>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Archivo</span>
                                <input type="file" name="archivo" required="required">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a id="botonRev" class="modal-close waves-effect waves-green btn-flat">ENVIAR</a>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/peticionFiltroAsesor.js"></script>
    <script src="js/revision.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/modal.js"></script>

</body>

</html>
