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
        $query_idiomas = $conexion->query("select idioma.nombre from idioma,curso,nivel,curso_alumno where 
        curso.id_curso=curso_alumno.id_curso and curso.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma 
        and curso_alumno.id_alumno=$id_alumno and curso.id_periodo=$periodo");
        $dias = [" ","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
        $horarios =[" ","07:00:00","08:00:00","09:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00",
                    "17:00:00","18:00:00","19:00:00"];
        $query_alumno = $conexion->query("select persona.nombre,persona.apellido_paterno
        from alumno,persona where alumno.id_persona=persona.id_persona and alumno.id_alumno=$id_alumno");
        $nombre = mysqli_fetch_array($query_alumno);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="css/asesorias.css">
    <title>Asesorias - CAADI</title>
</head>

<body>
    <header>
        <ul id="clubs" class="dropdown-content">
            <li><a href="./clubs-de-converscion.php"><i class="material-icons right">record_voice_over</i>Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons right">star</i>Calificar Clubs</a></li>
        </ul>
        <ul id="perfil" class="dropdown-content">
            <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo hide-on-med-and-down logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="hide-on-large-only brand-logo" href="./inicio.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                <ul class="right hide-on-med-and-down elementos">
                    <li><a href="./inicio.php"><i class="material-icons right">home</i>Inicio</a></li>
                    <li class="active"><a href="./asesorias.php"><i class="material-icons right">group</i>Asesorias</a></li>
                    <li><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target='clubs'>Clubs<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="./hojas-de-trabajo.php"><i class="material-icons right">content_copy</i>Hojas de trabajo</a></li>
                    <li><a href="./bitacora.php"><i class="material-icons right">book</i>Bitácora</a></li>
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
                    <a href="#!"><span class="name white-text"><?php echo $nombre['nombre']." ".$nombre['apellido_paterno'];?></span></a>
                    <a href="#!"><span class="id white-text"><?php echo $id_alumno; ?></span></a>
                </div>
            </li>
            <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
            <li class="active"><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
            <li><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
            <li><a href="./clubs-de-converscion.php"><i class="material-icons">record_voice_over</i> Clubs de conversación</a></li>
            <li><a href="./clubs-realizados.php"><i class="material-icons">star</i> Calificar Clubs</a></li>
            <li><a href="./hojas-de-trabajo.php"><i class="material-icons">content_copy</i> Hojas de trabajo</a></li>
            <li><a href="./bitacora.php"><i class="material-icons">book</i> Bitácora</a></li>
            <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
        </ul>
    </header>

    <div class="row">
        <div class="col s12 m12 l10">
            <div class="container horarios center-align">
                <h4>Horarios de asesorías</h4>
                <div id="jap" class="section scrollspy">
                </div>
            <?php while($idioma=mysqli_fetch_array($query_idiomas)){
                    $idioma_nombre =$idioma['nombre'];
                    $asesorias = $conexion->query("select idioma.nombre as idioma,asesoria.dia, asesoria.horario,persona.nombre 
                    from asesor,persona,asesoria,idioma where asesoria.id_idioma=idioma.id_idioma and idioma.nombre ='$idioma_nombre' 
                    and asesoria.id_asesor=asesor.id_asesor and asesor.id_persona=persona.id_persona");
                    $asesoria = null;
                    $i=0;
                    while($asesoria_todas = mysqli_fetch_array($asesorias)){
                        $asesoria[$i]=$asesoria_todas;
                        $i++;
                    }
                
                    if($asesoria != null){ ?> 
                        <div id="<?php echo $idioma_nombre;?>" class="section scrollspy">
                            <table class="highlight centered responsive-table">
                                <caption>
                                <h5><?php echo $idioma_nombre; ?></h5></caption>
                                <?php 
                                for($x=0;$x<14;$x++) {
                                    for($y=0;$y<7;$y++){
                                        if( $x==0){echo "<th>".$dias[$y]."</th>";}
                                        elseif($y==0){echo "<tr><td>".$horarios[$x]."</td>";}
                                        elseif($x!=0 and $y==0){ echo "<tr>";}
                                        else{echo "<td>";}
                                        for($j=0;$j<count($asesoria);$j++){
                                            if($asesoria[$j]['horario']==$horarios[$x] and $asesoria[$j]['dia']==$dias[$y]){
                                                echo $asesoria[$j]['nombre']." <br>";
                                            }
                                        }
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                } 
                                ?>
                            </table>
                        </div>
                    <?php } ?>     
                    <div id="<?php echo $idioma_nombre; ?>" class="section scrollspy">
            </div>
            <?php } ?>
        </div>
    </div>
        <?php $query_idiomas = $conexion->query("select idioma.nombre from idioma,curso,nivel,curso_alumno where 
        curso.id_curso=curso_alumno.id_curso and curso.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma 
        and curso_alumno.id_alumno=$id_alumno and curso.id_periodo=$periodo"); 
        ?>

        <div class="col hide-on-med-and-down s0 m0 l2 contenido">
            <ul class="section table-of-contents">
            <?php while($idioma=mysqli_fetch_array($query_idiomas)){ 
                $idioma_nombre =$idioma['nombre'];
                $asesorias = $conexion->query("select idioma.nombre as idioma,asesoria.dia, asesoria.horario,persona.nombre 
                from asesor,persona,asesoria,idioma where asesoria.id_idioma=idioma.id_idioma and idioma.nombre ='$idioma_nombre' 
                and asesoria.id_asesor=asesor.id_asesor and asesor.id_persona=persona.id_persona");
                $asesoria = null;
                $i=0;
                while($asesoria_todas = mysqli_fetch_array($asesorias)){
                    $asesoria[$i]=$asesoria_todas;
                    $i++;
                }
                if ($asesoria != null){ ?>
                    <li><a href="#<?php echo $idioma['nombre'];?>"><?php echo $idioma['nombre']; ?></a></li>
                
               <?php }
            ?>
            <?php } ?>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/scrollspy.js"></script>
</body>

</html>
