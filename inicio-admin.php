<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="css/inicio-admin.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
                <a class="brand-logo center" href="./inicio.html"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>

                <ul class="right hide-on-med-and-down elementos">
                    <li class="active"><a href="./inicio.html"><i class="material-icons right">home</i>Inicio</a></li>
                </ul>
            </div>
        </nav>

        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="images/fondo-navbar.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="images/usuario-perfil.jpg"></a>
                    <a href="#name"><span class="white-text name">John Doe</span></a>
                    <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
                </div>
            </li>
            <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="#!">Second Link</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>

    </header>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
</body>

</html>
