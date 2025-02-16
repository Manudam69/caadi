<?php 
    session_start();
        if(isset($_SESSION['usuario'])){
            //case para regresar dependiendo el tipo de usuario
            switch($_SESSION['tipo_persona']){
                case '0': header("Location:inicio.php"); break; 
                case '1': header("Location:inicio-admin.php"); break;
                case '2': header("Location:inicio-maestro.php"); break;
                case '3': header("Location:inicio-asesor.php"); break;
                default: break;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a CAADI</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <!--Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/index.css">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/login.js"></script>


</head>

<body>
    <div class="pimg1 ">
        <div class="row animated fadeInLeft">
            <div class="col l5 titulo">
                <img src="./images/caadi-logo3.png" class="responsive-img" width="150">
                <p>Bienvenido al inicio de sesión de CAADI</p>
            </div>
        </div>
        <div class="ptext">
            <div class="container">
                <form class="col s12" id="loginForm">
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="input-field col l5 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" name="id_usuario" type="text" style="color: white;">
                            <label for="icon_prefix">id de usuario</label>
                        </div>
                        <div class="input-field col l5 s12">
                            <i class="material-icons prefix">https</i>
                            <input id="icon_telephone" name="pass" type="password" style="color: white;">
                            <label for="icon_telephone">Contraseña</label>
                        </div>
                        <div class="col l2 s12">
                            <button class="waves-effect waves-light btn-large" type="submit" id="btn">ingresar</button>
                        </div>
                    </div>
                </form>
                <div class="row ayuda">
                    <p><a href="https://www.youtube.com/watch?v=pUEpPfSf2JM&list=PLkdhc7hzqPFCOQBscOPZo12-WOY7pGnql"
                            target="_blank">Necesitas ayuda <i class="fas fa-question-circle"></i> </a></p>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12 center-align">
                    <img class="responsive-img " src="./images/logo.png" width="65%">
                    <h5> Universidad Autónoma de Aguascalientes</h5>
                    <p>Antes de ingresar, realiza tu pago y acude a CAADI para registrarte.</p>
                    <div class="social-share fb">
                        <span class="fb-inner"></span>
                        <a class="cta fb" href="https://www.facebook.com/CAADI-UAA-1550200165209620"
                            target="_blank">Visitar</a>
                    </div>

                </div>
                <div class="col l4 offset-l2 s12" id="contacto">
                    <h5>C.A.A.D.I.</h5>
                    <ul>
                        <li>
                            <p>Centro de Aprendizaje Autodirigido de Idiomas
                                <br> Edificio 211, Módulo I, Tercer Piso.
                                <br>Teléfono: 910-7400 Ext. 306</p>
                        </li>
                        <h5>DEPARTAMENTO DE IDIOMAS</h5>
                        <li>
                            <p>Edificio 211, Módulo I, Primer Piso.
                                <br>Teléfono: 910-8489</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container grey-text">
                <p class="left">© 2015- 2019</p>
                <a class="right" href="https://www.uaa.mx/" target="_blank"><img src="./images/logo-uaa2.png"
                        class="responsive-img" width="40px"></a>
            </div>
        </div>
    </footer>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>