<?php 
    require("./php/conexion.php");
    $conexion = connect();
    
    session_start();
    if(!$conexion){
        echo "Error. Sin conexion a la base de datos";
        echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
    } else {
        $id_asesor = $_SESSION['id_asesor'];
        $id_persona = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];
        $apellido_paterno = $_SESSION['apellido_paterno'];
        $periodo = $_SESSION['periodo'];
        $clubs = mysqli_query($conexion, "SELECT * FROM club c JOIN nivel n JOIN idioma i WHERE  
        c.id_nivel = n.id_nivel AND n.id_idioma = i.id_idioma AND c.cupo > 0 and fecha = curdate() 
        and horario > time(now()) and c.id_periodo = $periodo and c.id_asesor = $id_asesor"); 
        $_SESSION['cuenta'] = 3; 
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
    <link rel="stylesheet" href="css/inicio-asesor.css">
</head>

<body>
    <header>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo active" href="./inicio-asesor.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio-asesor.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li ><a href="./inicio-asesor.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li ><a href="./asesorias-asesor.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li ><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a href="./revision-de-hojas.php"><i class="material-icons right">content_copy</i>Revisión de hojas de trabajo</a></li>
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
                    <a href="#!"><span class="name white-text"> <?php echo $nombre." ".$apellido_paterno; ?></span></a>
                    <a href="#!"><span class="id white-text"> <?php echo $id_persona; ?> </span></a>
                </div>
            </li>
            <li class="active"><a href="./inicio-asesor.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias-asesor.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./revision-de-hojas.php"><i class="material-icons">content_copy</i> Revisión de hojas</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>
    <h5 class="center">Clubes de conversación próximos</h5>

    <div class="container">
    <?php 
        
    while($club = mysqli_fetch_array($clubs)){ ?>
        <ul class="collection">
            <li class="collection-item avatar">
                <i class="material-icons circle red">record_voice_over</i>
                <span class="title">Idioma: <?php echo $club['nombre']; ?> </span>
                <p>Nivel: <?php echo $club['nivel']; ?>
                    <br> Fecha: <?php echo $club['fecha']; ?>
                </p>
                Horario: <?php echo $club['horario']; ?>
            </li>
        </ul>
    <?php } ?>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
</body>

</html>
