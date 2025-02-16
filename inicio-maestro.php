<?php 
    require("php/conexion.php");
    session_start();
    $nivelsesion = $_SESSION['tipo_persona'];
    if( $nivelsesion== "" || $nivelsesion == null || $nivelsesion != 2){
        session_destroy();
        header("Location:index.php");
    }
    $conexion = connect();
    if(!$conexion){
        echo "Error. Sin conexion a la base de datos";
        echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
        exit;
    }else{
        $id_persona = $_SESSION['id_persona'];
        $nombre = $_SESSION['nombre'];
        $apellido_parterno = $_SESSION['apellido_paterno'];
        $id_profesor = $_SESSION['id_profesor'];
        $datos = $conexion->query("select curso.id_curso,curso.nombre as curso,curso.id_nivel, idioma.nombre as idioma from curso,nivel,idioma where curso.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma and curso.id_profesor=$id_profesor");
        $periodo =$_SESSION['periodo'];
    }
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio Maestro - CAADI</title>
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
    <link rel="stylesheet" href="css/inicio-maestro.css">
    <style>
        button{
            border: none; 
            background: none;
        }
        button:hover{
            cursor: pointer;
            text-decoration: underline;
        }
        .act{
            color: rgb(241, 166, 49);
        }
        .act:hover{
            color: rgb(241, 166, 49); 
        }
    </style>
</head>

<body>
    <header>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $nombre." ".$apellido_parterno;?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_persona;?></span></a>
                </div>
            </li>
            <li class="active"><a href="./inicio-maestro.php"><i class="material-icons">home</i> Inicio</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>
    <div class="row">
        <div class="col s12 m12 l10">
            <div class="container">
                <h5 class="center">CURSOS DEL PROFESOR <?php echo $nombre;?> </h5>
                <?php 
                    while($row = mysqli_fetch_array($datos)){
                ?>
                        <div id="<?php echo $row['id_curso'];?>" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">assignment_ind</i>
                            <span class="title"> <?php echo $row['curso']."  ".$row['idioma']; ?></span>
                            <form action="actividades.php?id_nivel=<?php echo $row['id_nivel'];?>" method="POST">
                            
                                <?php 
                                    $id_curso = $row['id_curso'];
                                    $id_nivel = $row['id_nivel'];
                                    $query_alumnos = " select persona.nombre as alumno,persona.apellido_paterno as apellido, alumno.id_alumno,curso.nombre from persona, alumno, curso, curso_alumno where persona.id_persona=alumno.id_persona and curso.id_curso=curso_alumno.id_curso and alumno.id_alumno=curso_alumno.id_alumno and curso.id_curso=$id_curso";
                                    $alumnos = $conexion->query($query_alumnos);
                                    while($fila = mysqli_fetch_array($alumnos)){ 
                                        $idalumno = $fila['id_alumno'];
                                        //clubs de conversación realizados
                                        $query_club = $conexion->query("select count(club.id_club) as numero_clubs, idioma.nombre from alumno_club,club,nivel,idioma where alumno_club.id_club = club.id_club and club.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma and club.id_nivel=$id_nivel and alumno_club.id_alumno=$idalumno and club.id_periodo = $periodo  and asistencia=2 group by idioma.nombre;");
                                        $datosclub = mysqli_fetch_array($query_club);
                                        $num_clubs = $datosclub['numero_clubs'];
                                        //hojas de trabajo realizadas
                                        $num =$conexion->query("SELECT COUNT(id_alumno_hoja_trabajo) as num_hojas from alumno_hoja_trabajo where estado = 3 and id_alumno = $idalumno and alumno_hoja_trabajo.id_periodo=$periodo");
                                        $num_hojas = mysqli_fetch_array($num);
                                        $num_hojas = $num_hojas['num_hojas'];
                                        //horas realizadas
                                        $queryhoras = $conexion->query("select sum(ceil((UNIX_TIMESTAMP(salida)-UNIX_TIMESTAMP(entrada))/3600)) as numhora from registro where id_alumno=$idalumno and id_periodo=$periodo");
                                        $num_horas = mysqli_fetch_array($queryhoras);
                                        $num_horas = $num_horas['numhora'];
                                         
                                        ?>
                                        <div class="row">
                                            <div class="col l2 s6">
                                                ID: <?php echo $fila['id_alumno']; ?>
                                            </div>
                                            <div class="col l4 s6">
                                                Nombre: <?php echo $fila['alumno']." ".$fila['apellido']; ?>
                                            </div>
                                            <div class="col l3 s6">
                                                <?php 
                                                    if($num_clubs >=1 && $num_hojas >=2 && $num_horas >= 2){
                                                        if($num_clubs >=2 && $num_hojas >=4 && $num_horas >= 4){
                                                            echo "CAADI: Terminado";
                                                        }else{
                                                            echo "CAADI: Cumplido";
                                                        }   
                                                    }
                                                    else{
                                                        echo "CAADI: En proceso";
                                                    }
                                                ?>
                                            </div>
                                            <div class="col l3 s6">
                                                <button class="act" onclick = "actividad('<?php echo $fila['id_alumno'];?>')">Actividades</button>
                                            </div>
                                        </div>
                                        <hr>
                                <?php
                                    }                          
                                    ?>
                            
                            </form>
                        </li>
                    </ul>
                </div>
                <hr>
                <?php        
                    }
                ?>
            </div>
        </div>


        <div class="col hide-on-med-and-down s0 m0 l2 contenido">
            <ul class="section table-of-contents">
                <?php 
                    $datos = $conexion->query("select curso.id_curso,curso.nombre as curso,curso.id_nivel, idioma.nombre as idioma from curso,nivel,idioma where curso.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma and curso.id_profesor=$id_profesor");
                    while($row = mysqli_fetch_array($datos)){
                ?>
                        <li><a href="#<?php echo $row['id_curso'];?>"><?php echo $row['curso'];?></a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/scrollspy.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type = "text/javascript">
        function actividad(id_alumno){
            var input = $("<input>").attr("type","hidden").attr("name","id_alumno").val(id_alumno);
            $('form').append(input);
            $('form').submit();
        }
    </script>
</body>

</html>
