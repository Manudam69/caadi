<?php
require("./php/conexion.php");
$conexion = connect();
if (!$conexion) {
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
}
$query_txt = "SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) AS nombre,
    reg.id_alumno, entrada FROM registro reg JOIN alumno al ON reg.id_alumno = al.id_alumno 
    JOIN persona per ON al.id_persona = per.id_persona WHERE salida IS NULL";
$query = mysqli_query($conexion, $query_txt);
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
    <link rel="stylesheet" href="css/inicio-admin.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper row">
                <div class="nav-wrapper col l9 s2">
                    <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
                    <a class="brand-logo center hide-on-med-and-down" href="./inicio-admin.html"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                </div>
                <form>
                    <div class="input-field col l3 s10">
                        <form action="">
                            <input id="search" type="search" required autocomplete="off">
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </form>
                    </div>
                </form>
            </div>
        </nav>

        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="images/fondo-navbar.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="images/usuario-perfil.jpg"></a>
                    <a href="#name"><span class="white-text name">Administrador</span></a>
                    <a href="#email"><span class="white-text email">Nombre o algún otro dato</span></a>
                </div>
            </li>
            <li class="active"><a href="inicio-admin.html"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="activacion.html"><i class="material-icons">verified_user</i>Activación de CAADI</a></li>
            <li><a href="control-asesorias.php"><i class="material-icons">group</i>Asesorias</a></li>
            <li><a href="control-de-clubs.html"><i class="material-icons">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="cursos-de-idiomas.html"><i class="material-icons">assignment</i>Cursos de idiomas</a></li>
            <li><a href="entrada-salida.html"><i class="material-icons">compare_arrows</i>Registro Entrada/Salida</a></li>
            <li><a href="control-hojas-de-trabajo.html"><i class="material-icons">content_copy</i>Hojas de trabajo</a></li>
            <li><a href="estadisticas.html"><i class="material-icons">insert_chart</i>Estadisticas</a></li>
            <li><a href="nuevo-periodo.html"><i class="material-icons">today</i>Nuevo periodo</a></li>
            <li><a href="sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i>Sitios de interés</a></li>
            <li><a href="agregar-usuario.html"><i class="material-icons">person</i>Agregar usuario</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a class="waves-effect" href="#!"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></li>
        </ul>

    </header>
    <div class="container">
        <h4 class="center">ALUMNOS EN CAADI</h4>
        <ul class="collection">
            <?php
            $i = 0;
            while ($registro = mysqli_fetch_array($query)) {
            ?>
            <li class="collection-item avatar pagina pagina-<?php echo intdiv($i, 10) + 1; ?>">
                <i class="material-icons circle red">person</i>
                <span class="title">Nombre: <?php echo $registro['nombre']; ?></span>
                <p>
                    ID: <?php echo $registro['id_alumno']; ?>
                    <br>
                    Hora de entrada: <?php echo $registro['entrada']; ?>
                </p>
            </li>
            <?php
            $i++;
            }
            ?>
        </ul>

        <ul class="pagination center">
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
            <?php
            $j = 0;
            while ($j < ceil($i/10)) {
            ?>
            <li class="waves-effect <?php if ($j == 0) echo "active"; ?>"><a class="page-link" href="#!"><?php echo $j + 1; ?></a></li>
            <?php
            $j++;
            }
            ?>
            <li class="waves-effect"><a class="page-link" href="#!"><i class="material-icons">chevron_right</i></a></li>
        </ul>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/paginacion.js"></script>
</body>

</html>
