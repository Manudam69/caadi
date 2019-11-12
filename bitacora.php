<?php 
require("php/conexion.php");
session_start();
$varsesion = $_SESSION['usuario'];
$nivelsesion = $_SESSION['tipo_persona'];
$id_alumno = $_SESSION['id'];
$nivel = $_SESSION['nivel'];
$periodo = $_SESSION['periodo'];
    if($varsesion == null ||  $varsesion = '' || $nivelsesion != '0'){
        echo 'No tiene autorizacion';
        header("Location:index.php");
    }
$conexion=connect();
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
} else {

    //Alumno Activo o no
    $activacion = $conexion->query("Select * from alumno_periodo where id_alumno = $id_alumno and id_periodo = $periodo");
    $activo = mysqli_fetch_array($activacion);

    //datos del alumno
    $query = $conexion->query("SELECT alumno.id_alumno,persona.nombre, persona.apellido_paterno, persona.telefono 
    FROM persona, alumno WHERE alumno.id_persona = persona.id_persona AND alumno.id_persona =  $id_alumno");
    $datos_alumno = mysqli_fetch_array($query);
    
    //clubs de conversación realizados
    $query_club = $conexion->query("SELECT COUNT(alumno_club.id_club) AS numero_clubs FROM alumno_club JOIN alumno 
    WHERE alumno_club.id_alumno=alumno.id_alumno and alumno_club.asistencia=2 and alumno_club.id_periodo=$periodo and alumno_club.id_alumno = $id_alumno");
    $datos = mysqli_fetch_array($query_club);
    $num_clubs = $datos['numero_clubs'];
    $porcentaje_clubs = $num_clubs * 16.5;
    if ($porcentaje_clubs>33) $porcentaje_clubs = 33;

    $query ="select club.fecha,club.horario,alumno_club.asistencia,idioma.nombre as idioma,nivel.nivel,persona.nombre as asesor from club,
    nivel,idioma,asesor,persona,alumno_club where club.id_club=alumno_club.id_club and nivel.id_nivel=club.id_nivel and 
    idioma.id_idioma=nivel.id_idioma and asesor.id_persona=persona.id_persona and club.fecha < curdate() and alumno_club.id_alumno=$id_alumno 
    and alumno_club.id_periodo=$periodo";
    $clubs = $conexion->query($query);

    //hojas de trabajo realizadas
    $query_hojas = "SELECT ht.id_hoja_trabajo,ht.tema,ht.area,idioma.nombre,nivel.nivel FROM hoja_trabajo ht,idioma,nivel,alumno_hoja_trabajo 
    WHERE nivel.id_nivel=ht.id_nivel AND idioma.id_idioma=nivel.id_idioma AND ht.id_hoja_trabajo = alumno_hoja_trabajo.id_hoja_trabajo 
    AND alumno_hoja_trabajo.estado=3 AND alumno_hoja_trabajo.id_alumno=$id_alumno AND alumno_hoja_trabajo.id_periodo = $periodo";
    $hojas_total = $conexion->query($query_hojas);
    $num =$conexion->query("SELECT COUNT(id_alumno_hoja_trabajo) as num_hojas from alumno_hoja_trabajo where estado = 3 and id_alumno = $id_alumno and alumno_hoja_trabajo.id_periodo=$periodo");
    $num_hojas = mysqli_fetch_array($num);
    $num_hojas = $num_hojas['num_hojas'];
    $porcentaje_hojas = $num_hojas * 16.5;
    if($porcentaje_hojas > 33) $porcentaje_hojas = 33;

    //Visitas al CAADI
    $registros = $conexion->query("SELECT fecha,entrada,salida, TIMEDIFF(salida,entrada) as tiempo FROM registro WHERE id_alumno = $id_alumno AND salida is not null AND id_periodo = $periodo order by fecha desc");
    $horas = $conexion->query("SELECT CONCAT( HOUR(SUM(TIMEDIFF(salida, entrada))), ':', MINUTE(SUM(TIMEDIFF(salida, entrada)))) as horas FROM registro");
    $horas = mysqli_fetch_array($horas);
    $query = $conexion->query("select sum(ceil((UNIX_TIMESTAMP(salida)-UNIX_TIMESTAMP(entrada))/3600)) as numhora from registro");
    $num_horas = mysqli_fetch_array($query);
    $num_horas = $num_horas['numhora'];
    $porcentaje_horas = $num_horas * 8.5;    
    if($porcentaje_horas > 34) $porcentaje_horas = 34;

    $total = $porcentaje_clubs + $porcentaje_hojas + $porcentaje_horas;
    if($total > 100) $total = 100;
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
    <link rel="stylesheet" href="css/bitacora.css">
    <style>
        input[type=submit]{
        border: none; 
        background: none;
        }
        input[type=submit]:hover{
            cursor: pointer;
        }
    </style>

</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
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
                    <li class="active"><a href="./bitacora.php"><i class="material-icons right">book</i>Bitácora</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $datos_alumno['nombre']," ",$datos_alumno['apellido_paterno']; ?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $datos_alumno['id_alumno']; ?></span></a>
                </div>
            </li>
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php?cuenta=0"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li class="active"><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <div class="container">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="images/usuario-perfil.jpg" alt="" class="circle responsive-img">
                    </div>
                    <div class="col s10">
                        <p><b><?php echo $datos_alumno['nombre']," ",$datos_alumno['apellido_paterno'];?></b></p>
                        <p>Telefono: <?php echo $datos_alumno['telefono']; ?> </p>
                        <p>Tipo de usuario: <?php switch($nivelsesion){ case 0: echo "Alumno";
                                                                            break;
                                                                        case 1: echo "Administrador";
                                                                            break;
                                                                        case 2: echo "Profesor";
                                                                            break;
                                                                        case 3: echo "Asesor";
                                                                            break;
                                                                         } ?> </p>
                        <p>Tiempo en CAADI: <?php echo $horas['horas']; ?> horas</p>
                        <?php 
                            if ($activo['id_alumno'] == null){
                                echo "<p class='red-text'>Usuario no activado</p>";
                            }else {
                                echo "<p class='green-text'>Usuario activado</p>";
                            }
                        ?>
                    </div>
                </div>
                <a class="right modal-trigger" href="#modal1">Editar mis datos</a>
            </div>
        </div>
    </div>

    <div id="modal1" class="modal">
        <form action = "./php/actualizar-datos.php" method = "post">    
            <div class="modal-content">
                <h4>Datos personales</h4>
                <div class="container">
                    <div class="row">
                        <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Nombre" name="nombre" id="name" type="text" class="validate">
                            <label for="name">Nombre</label>
                        </div>
                    </div>
                    <div class="row">
                    
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Apellido Paterno" name="apellido" id="lastname" type="text" class="validate">
                            <label for="lastname">Apellidos</label>
                        </div>
                    </div>
                    <div class="row">
                    
                        <div class="input-field col s12">
                        <i class="material-icons prefix">phone</i>
                            <input placeholder="Teléfono" name="telefono" id="tel" type="text" class="validate" onChange = "validarNumero(this.value);">
                            <label for="tel">Teléfono</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input id="btn" type = "submit" value="CONFIRMAR">
            </div>
        </form>
    </div>

    <div class="container center">
        <h4>ACTIVIDADES EN CAADI</h4>
        <table class="striped">
            <thead>
                <tr>
                    <th>CLUBS DE CONVERSACIÓN</th>
                    <th>HOJAS DE TRABAJO</th>
                    <th>TIEMPO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?php echo  $num_clubs." -> ".$porcentaje_clubs; ?>%</td>
                    <td><?php echo $num_hojas." -> ".$porcentaje_hojas; ?>%</td>
                    <td> <?php echo $num_horas." -> ".$porcentaje_horas; ?>%</td>
                    <td><?php echo $total;?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container center">
        <h4>CLUBS REALIZADOS</h4>
            <table class="striped">
                <thead>
                <tr>
                    <th>FECHA - HORARIO</th>
                    <th>IDIOMA - NIVEL</th>
                    <th>ASESOR</th>
                    <th>ASISTENCIA</th>
                </tr> 
                </thead>   
                <tbody>                                                     
                <?php while ($club = mysqli_fetch_array($clubs)){ 
                    ?>
                    <tr>
                        <td><?php echo $club['fecha']," ",$club['horario'];?> </td>
                        <td> <?php echo $club['idioma']," ",$club['nivel']?> </td>
                        <td> <?php echo $club['asesor']?> </td>
                        <td> <?php if($club['asistencia'] == 2) echo "Asistió"; else echo "Faltó"; ?> </td>
                    </tr>   
                <?php }
                if ($club < 0){
                    echo "No has asistido a ningun club de conversación";
                }?>
                <tbody>
            </table>
    </div>
    <div class="container center">
        <h4>HOJAS DE TRABAJO</h4>
            <table class="striped">
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                        <th>TIPO</th>
                        <th>IDIOMA</th>
                        <th>NIVEL</th>
                    </tr> 
                </thead>   
                <?php while ($hojas = mysqli_fetch_array($hojas_total)){ 
                    ?>
                     <tr>
                        <td> <?php echo $hojas['tema']?> </td>
                        <td> <?php echo $hojas['area']?></td>
                        <td> <?php echo $hojas['nombre']?></td>
                        <td> <?php echo $hojas['nivel']?></td>
                    </tr>   
                <?php }
                if ($hojas = 0){
                    echo "No has realizado hojas de trabajo";
                }?>
            </table>
    </div>
    <div class="container center">
        <h4>VISITAS A CAADI</h4>
        <table class="striped">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>HORA DE ENTRADA</th>
                    <th>HORA DE SALIDA</th>
                    <th>TIEMPO</th>
                </tr> 
            </thead> 
        <?php while ($registro = mysqli_fetch_array($registros)){ ?>
            <tr>
                <td> <?php echo $registro['fecha']; ?> </td>
                <td> <?php echo $registro['entrada']; ?></td>
                <td> <?php echo $registro['salida']; ?></td>
                <td> <?php echo $registro['tiempo']; ?> </td>
            </tr>   
        <?php }
        if ($hojas = 0){
            echo "No has realizado hojas de trabajo";
        }?>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        function validarNumero(numero){
            if (!/^([0-9])*$/.test(numero))
                alert ("Solo puedes ingresar números");
        }
    </script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/modal.js"></script>

</body>

</html>
