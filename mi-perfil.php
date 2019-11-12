<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configuración de contraseña - CAADI</title>
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
    <link rel="stylesheet" href="css/mi-perfil.css">

</head>

<body>
    <?php 
        session_start();
        $cuenta = $_SESSION['cuenta'];
        switch ($cuenta){
            case 0:
    ?>
                <header>
                    <ul id="clubs" class="dropdown-content">
                        <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
                        <li><a href="./calificar-clubs.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
                    </ul>
                    <ul id="perfil" class="dropdown-content">
                        <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
                        <li><a href="#!"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
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
                                <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li>
                                <li><a href="./hojas-de-trabajo.php"><i class="material-icons right">content_copy</i>Hojas de trabajo</a></li>
                                <li><a href="./bitacora.php"><i class="material-icons right">book</i>Bitácora</a></li>
                                <li class="active"><a class="dropdown-trigger" href="#!" data-target='perfil'>Mi perfil<i class="material-icons right">account_circle</i></a></li>
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
                        <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
                        <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
                        <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
                        <li><a href="./calificar-clubs.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
                        <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
                        <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
                        <li class="active"><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="#!"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                        <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
                    </ul>
                </header>
    <?php
            break;
            case 1:
            break;
            case 2:
    ?>
                <header>
                    <ul id="perfil" class="dropdown-content">
                        <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
                        <li><a href="#!"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
                    </ul>
                    <nav>
                        <div class="nav-wrapper">
                            <a class="brand-logo hide-on-med-and-down logo" href="./inicio-maestro.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                            <a class="hide-on-large-only brand-logo" href="./inicio-maestro.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                            <ul class="right hide-on-med-and-down elementos">
                                <li class="active"><a href="./inicio-maestro.php"><i class="material-icons right">home</i>Inicio</a></li>
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
                        <li class="active"><a href="./inicio-maestro.php"><i class="material-icons">home</i> Inicio</a></li>
                        <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
                        <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="#!"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                        <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
                    </ul>
                </header>
    <?php
            break;
            case 3:
            break;
        }
    ?>
    <div class="center" id="contenedor">
        <form action="./php/actualizar_pass.php" method="post">
            <img class="responsive-img" src="images/caadi-logo3.png" width="150">
            <div class="row">
                <div class="input-field col l12 s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="con" type="password" name="actual">
                    <label for="con">Contraseña</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col l12 s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="con2" type="password" name="nueva">
                    <label for="con2">Nueva contraseña</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col l12 s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="con3" type="password" name="confirma">
                    <label for="con3">Confirmar nueva contraseña</label>
                </div>
            </div>
            <input class="waves-light btn-large" id="btn" type = "button" value="CAMBIAR CONTRASEÑA">
        </form>       
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript">
        $('#btn').click(function(){
            $.post('./php/verificarcontrasena.php', {pass: $('#con').val()}).then(function (res) {
                var enviar = true;
                var mensaje = "Error\n";
                if ($("#con2").val()!==$("#con3").val()){
                    enviar = false;
                    mensaje+="las contraseñas no coinciden\n";
                }
                if ($("#con").val().trim() === "" || $("#con2").val().trim() === "" || $("#con3").val().trim() === ""){
                    enviar = false;
                    mensaje+="espacios vacios\n";
                }
                if (!res.ok) {
                    enviar = false;
                    mensaje += "la contraseña no es correcta"
                }
                if (enviar)
                    $('form').submit();
                else
                    alert(mensaje);
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/datepicker.js"></script>
</body>

</html>
