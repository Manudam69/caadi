<?php
require("./php/conexion.php");
$conexion = connect();
if (!$conexion) {
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
}
$query_idiomas_txt = "SELECT UPPER(nombre) AS idioma FROM asesoria ase JOIN idioma idi ON ase.id_idioma = idi.id_idioma GROUP BY idioma";
$query_idiomas = mysqli_query($conexion, $query_idiomas_txt);
$horario_mostrar = array("7:00-8:00", "8:00-9:00", "9:00-10:00", "10:00-11:00", "11:00-12:00", "12:00-13:00",
    "13:00-14:00", "14:00-15:00", "15:00-16:00", "16:00-17:00", "17:00-18:00", "18:00-19:00", "19:00-20:00");
$horario = array("07:00:00", "08:00:00", "09:00:00", "10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00",
    "15:00:00", "16:00:00", "17:00:00", "18:00:00", "19:00:00");
$dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asesorias - CAADI</title>
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
    <link rel="stylesheet" href="css/control-asesorias.css">
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
            <li><a href="inicio-admin.html"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="activacion.html"><i class="material-icons">verified_user</i>Activación de CAADI</a></li>
            <li class="active"><a href="control-asesorias.php"><i class="material-icons">group</i>Asesorias</a></li>
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
        <h4 class="center">CONTROL DE ASESORIAS DE CAADI</h4>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large orange darken-1">
                <i class="large material-icons ">settings</i>
            </a>
            <ul>
                <li title="EDITAR ASESORIAS"><a class="btn-floating red darken-2" href="editar-asesorias.php"><i class="material-icons">edit</i></a></li>
                <li title="AGREGAR ASEORÍA"><a class="btn-floating blue darken-4 modal-trigger" href="#agregar"><i class="material-icons">add</i></a></li>
            </ul>
        </div>
        <div id="agregar" class="modal">
            <form action="">
                <div class="modal-content">
                    <h4>AGREGAR ASESORÍA</h4>
                    <div class="container">
                        <div class="row">
                            <div class="col m6 s12">
                                <label>ASESOR</label>
                                <select class="browser-default">
                                    <option value="" selected disabled>SELECCIONAR</option>
                                    <option value="1">Asesor 1</option>
                                    <option value="2">Asesor 2</option>
                                    <option value="3">Asesor 3</option>
                                    <option value="4">Asesor 4</option>
                                    <option value="5">Asesor 5</option>
                                </select>
                            </div>
                            <div class="col m6 s12">
                                <label>HORARIO</label>
                                <select class="browser-default">
                                    <option value="1" selected disabled>SELECCIONAR</option>
                                    <option value="1">7:00 AM - 8:00 AM</option>
                                    <option value="2">8:00 AM - 9:00 AM</option>
                                    <option value="3">9:00 AM - 10:00 AM</option>
                                    <option value="4">10:00 AM - 11:00 AM</option>
                                    <option value="5">11:00 AM - 12:00 PM</option>
                                    <option value="6">12:00 PM - 1:00 PM</option>
                                    <option value="7">1:00 PM - 2:00 PM</option>
                                    <option value="8">2:00 PM - 3:00 PM</option>
                                    <option value="9">3:00 PM - 4:00 PM</option>
                                    <option value="10">4:00 PM - 5:00 PM</option>
                                    <option value="11">5:00 PM - 6:00 PM</option>
                                    <option value="12">6:00 PM - 7:00 PM</option>
                                    <option value="13">7:00 PM - 8:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m6 s12 offset-m3">
                                <label>DIA</label>
                                <select class="browser-default">
                                    <option value="1" selected disabled>SELECCIONAR</option>
                                    <option value="1">LUNES</option>
                                    <option value="2">MARTES</option>
                                    <option value="3">MIÉRCOLES</option>
                                    <option value="4">JUEVES</option>
                                    <option value="5">VIERNES</option>
                                    <option value="6">SÁBADO</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">CONFIRMAR</a>
                </div>
            </form>
        </div>
        <?php 
        while ($idioma = mysqli_fetch_array($query_idiomas)) { 
            $nombre_idioma = $idioma['idioma'];
            $query_asesorias_txt = "SELECT CONCAT(per.nombre, ' ', per.apellido_paterno) AS nombre, 
            UPPER(idi.nombre) as idioma, dia, horario FROM asesoria ase JOIN idioma idi ON ase.id_idioma = idi.id_idioma 
            JOIN asesor ON ase.id_asesor = asesor.id_asesor JOIN persona per ON asesor.id_persona = per.id_persona 
            WHERE UPPER(idi.nombre) = '$nombre_idioma'";
            $query_asesorias = $conexion->query($query_asesorias_txt);
            $asesorias = array();
            while ($asesoria = mysqli_fetch_array($query_asesorias))
                $asesorias[] = array("nombre"=>$asesoria['nombre'], "idioma"=>$asesoria['idioma'], "dia"=>$asesoria['dia'], "horario"=>$asesoria['horario']);
        ?>
        <table class="highlight centered responsive-table">
            <caption>
                <h5><?php echo $nombre_idioma; ?></h5>
            </caption>
            <thead>
                <tr>
                    <th>Hora/Día</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                for ($i = 0; $i < count($horario_mostrar); $i++) {
                ?>
                <tr>
                    <td><?php echo $horario_mostrar[$i]; ?></td>
                    <?php 
                    for ($j = 0; $j < count($dias); $j++) {
                        $asesoria = array_filter($asesorias, function ($as) use ($nombre_idioma, $horario, $i, $dias, $j) {
                            return $as['idioma'] == $nombre_idioma && $as['horario'] == $horario[$i] && $as['dia']== $dias[$j];
                        });
                        if (count($asesoria) == 0) echo "<td></td>";
                        else {
                            $k = 0;
                            echo "<td>";
                            foreach ($asesoria as $key => $value) {
                                if ($k != 0) echo "<br>";
                                echo $value['nombre'];
                                $k++;
                            }
                            echo "</td>";
                        }
                    }
                    ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/action-buton.js"></script>
</body>

</html>
