<?php 
    require("./php/conexion.php");
    $conexion = connect(); 
    session_start();
    $nivelsesion = $_SESSION['tipo_persona'];
    if($nivelsesion == null ||  $nivelsesion = ''){
        echo 'No tiene autorizacion';
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
        $id_persona=$_SESSION['id_persona'];
        $nombre=$_SESSION['nombre'];
        $apellido_paterno = $_SESSION['apellido_paterno'];
        $nivelsesion = $_SESSION['tipo_persona'];

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
    <link rel="stylesheet" href="css/sitios-de-interes.css">
    <title>Sitios de interés - CAADI</title>
</head>

<body>
    <?php 
        switch ($nivelsesion){
            case 0:
    ?>
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
                                <li><a href="./asesorias.php"><i class="material-icons right">group</i>Asesorias</a></li>
                                <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
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
                                <a href="#!"><span class="name white-text"><?php echo $nombre." ".$apellido_paterno; ?></span></a>
                                <a href="#!"><span class="id white-text"><?php echo $id_persona; ?></span></a>
                            </div>
                        </li>
                        <li><a href="./inicio.php"><i class="material-icons">home</i> Inicio</a></li>
                        <li><a href="./asesorias.php"><i class="material-icons">group</i> Asesorias</a></li>
                        <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
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
    <?php
            break;
            case 1:

            break;
            case 2:
    ?>
                <header>
                    <ul id="perfil" class="dropdown-content">
                        <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
                        <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
                    </ul>
                    <nav>
                        <div class="nav-wrapper">
                            <a class="brand-logo hide-on-med-and-down logo" href="./inicio-maestro.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                            <a class="hide-on-large-only brand-logo" href="./inicio-maestro.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                            <ul class="right hide-on-med-and-down elementos">
                                <li ><a href="./inicio-maestro.php"><i class="material-icons right">home</i>Inicio</a></li>
                                <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
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
                                <a href="#!"><span class="name white-text"><?php echo $nombre." ".$apellido_paterno; ?></span></a>
                                <a href="#!"><span class="id white-text"><?php echo $id_persona; ?></span></a>
                            </div>
                        </li>
                        <li ><a href="./inicio-maestro.php"><i class="material-icons">home</i> Inicio</a></li>
                        <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
                        <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                        <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
                    </ul>
                </header>
    <?php
            break;
            case 3: ?>
                <header>
                    <ul id="perfil" class="dropdown-content">
                        <li><a href="./mi-perfil.php"><i class="material-icons right">settings</i>Contraseñas</a></li>
                        <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt right"></i>Cerrar Sesión</a></li>
                    </ul>
                    <nav>
                        <div class="nav-wrapper">
                            <a class="brand-logo hide-on-med-and-down logo" href="./inicio-asesor.php"><img src="images/navbar-logo.png" class="responsive-img" width="85"></a>
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                            <a class="hide-on-large-only brand-logo" href="./inicio-asesor.php"><img src="images/navbar-logo.png" class="responsive-img" width="80"></a>
                            <ul class="right hide-on-med-and-down elementos">
                                <li><a href="./inicio-asesor.php"><i class="material-icons right">home</i>Inicio</a></li>
                                <li ><a href="./asesorias-asesor.php"><i class="material-icons right">group</i>Asesorias</a></li>
                                <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons right">sentiment_very_satisfied</i>Sitios de Interés</a></li>
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
                                <a href="#!"><span class="name white-text"> <?php echo $nombre." ".$apellido_paterno; ?> </span></a>
                                <a href="#!"><span class="id white-text"><?php echo $id_persona; ?></span></a>
                            </div>
                        </li>
                        <li><a href="./inicio-asesor.php"><i class="material-icons">home</i> Inicio</a></li>
                        <li ><a href="./asesorias-asesor.php"><i class="material-icons">group</i> Asesorias</a></li>
                        <li class="active"><a href="./sitios-de-interes.php"><i class="material-icons">sentiment_very_satisfied</i> Sitios de Interés</a></li>
                        <li><a href="./revision-de-hojas.php"><i class="material-icons">content_copy</i> Revision de hojas de trabajo</a></li>
                        <li><a href="./mi-perfil.php"><i class="material-icons">settings</i> Contraseñas</a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                        <li class="center-align"><img src="images/logo.png" class="responsive-img" width="80%;"></li>
                    </ul>
                </header>
    <?php 
            break;
        }

    ?>
    <div class="row">

        <div class="col s12 m12 l10">
            <div class="container sitios">
                <h4 class="center-align">Sitios de interés</h4>
                <div id="app" class="section scrollspy ">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">developer_board</i>
                            <span class="title">APPS CHAT AND SOCIAL</span>
                            <p><a href="https://www.hellotalk.com/">Hello Talk</a></p>
                            <p><a href="https://hinative.com/es-MX">HiNative</a></p>
                        </li>
                    </ul>
                </div>
                <div id="apps" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">description</i>
                            <span class="title">APPS LANGUAGE COURSES</span>
                            <p><a href="https://es.duolingo.com/">Duolingo</a></p>
                            <p><a href="https://www.britishcouncil.org.mx/ingles/adultos">British Council</a></p>
                            <p><a href="http://www.wlingua.com/es/">WLingua</a></p>
                            <p><a href="https://www.redleaf.es/">RedLeaf</a></p>
                            <p><a href="http://lingua.ly/">Lingua.ly</a></p>
                            <p><a href="https://es.babbel.com/">Babbel</a></p>
                            <p><a href="http://www.beelingo.com/">Beelingo</a></p>
                            <p><a href="https://learnenglish.britishcouncil.org/en/apps/johnny-grammars-word-challenge">Johnny Grammar’s Word Challenge</a></p>
                        </li>
                    </ul>
                </div>
                <div id="con" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">hearing</i>
                            <span class="title">CONFERENCES</span>
                            <p><a href="https://www.youtube.com/user/TEDtalksDirector/featured">TED talks</a></p>
                            <p><a href="https://www.youtube.com/channel/UCsooa4yRKGN_zEE8iknghZA">TED-ED</a></p>

                        </li>
                    </ul>
                </div>
                <div id="dic" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">book</i>
                            <span class="title">DICTIONARIES</span>
                            <p><a href="http://www.thesaurus.com/">Thesaurus</a></p>
                            <p><a href="https://www.rhymezone.com/">Rhyme Zone (synonyms, rhymes, etc.)</a></p>
                            <p><a href="https://dictionary.cambridge.org/">Cambridge Dictionary</a></p>
                            <p><a href="https://www.urbandictionary.com/">Urban Dictionary</a></p>
                            <p><a href="https://en.oxforddictionaries.com/">Oxford Dictionaries</a></p>
                            <p><a href="https://www.merriam-webster.com/">Merriam-webster</a></p>
                            <p><a href="https://www.wordreference.com/">WordReference</a></p>
                            <p><a href="http://www.metaglossary.com/">MetaGlossary</a></p>
                            <p><a href="http://learnersdictionary.com/">Learners dictionary</a></p>
                        </li>
                    </ul>
                </div>
                <div id="gra" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">import_contacts</i>
                            <span class="title">GRAMMAR</span>
                            <p><a href="https://www.englishgrammarsecrets.com/">English Grammar Secrets</a></p>
                            <p><a href="https://www.usingenglish.com/handouts/">UsingEnglish</a></p>
                            <p><a href="https://www.khanacademy.org/humanities/grammar">Khan Academy</a></p>
                            <p><a href="http://learnenglish.britishcouncil.org/en/english-grammar">English grammar by British Council</a></p>
                            <p><a href="https://www.englishclub.com/grammar/">English Club</a></p>
                            <p><a href="https://www.perfect-english-grammar.com/">Perfect English Grammar</a></p>
                            <p><a href="http://easyworldofenglish.com/Grammar/Grammar.aspx?c=86794645427a1b3e">Easy World of English</a></p>
                        </li>
                    </ul>
                </div>
                <div id="int" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">playlist_add_check</i>
                            <span class="title">INTEGRATED SKILLS</span>
                            <p><a href="https://www.ego4u.com/">Ego4u</a></p>
                            <p><a href="https://www.rong-chang.com/">ESL: English as a Second Language</a></p>
                            <p><a href="https://www.esolcourses.com/">ESOL Courses</a></p>
                            <p><a href="https://learnenglish.britishcouncil.org/en/">British Council</a></p>
                            <p><a href="http://www.englishmaven.org/">English Maven</a></p>
                            <p><a href="https://www.myenglishpages.com/">My English pages</a></p>
                            <p><a href="http://www.dailygrammar.com/archive.html">Daily grammar</a></p>
                        </li>
                    </ul>
                </div>
                <div id="lis" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">headset</i>
                            <span class="title">LISTENING</span>
                            <p><a href="https://www.lyricsgaps.com/exercises/filter/language/en/English">Lyricsgaps</a></p>
                            <p><a href="http://www.esl-lab.com/">Randall’s ESL Cyber Listening Lab</a></p>
                            <p><a href="https://es.lyricstraining.com/">Lyrics training</a></p>
                            <p><a href="http://www.manythings.org/e/listening.html">ManyThings</a></p>
                        </li>
                    </ul>
                </div>
                <div id="new" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">radio</i>
                            <span class="title">NEWS</span>
                            <p><a href="https://www.youtube.com/user/bbcnews">BBC News</a></p>
                            <p><a href="https://www.youtube.com/user/CNN">CNN</a></p>
                            <p><a href="https://www.youtube.com/user/ABCNews">ABC News</a></p>
                            <p><a href="https://www.youtube.com/user/FoxNewsChannel">Fox News</a></p>
                            <p><a href="https://www.youtube.com/user/CBSNewsOnline">CBS News</a></p>
                        </li>
                    </ul>
                </div>
                <div id="pro" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">keyboard_voice</i>
                            <span class="title">PRONUNCIATION</span>
                            <p><a href="http://easyworldofenglish.com/pronunciation/pronunciation.aspx?c=2c21d1bcc5bb2345">Easy World of English</a></p>
                            <p><a href="http://www.manythings.org/e/pronunciation.html">ManyThings - Pronunciation</a></p>
                            <p><a href="http://www.manythings.org/e/hearing.html">ManyThings - Hearing</a></p>
                        </li>
                    </ul>
                </div>
                <div id="rea" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">local_library</i>
                            <span class="title">READING</span>
                            <p><a href="http://easyworldofenglish.com/readings/readings.aspx?c=2f1dbe126863ea88">Easy World of English</a></p>
                            <p><a href="http://dreamreader.net/">Dreamreader</a></p>
                            <p><a href="http://learnenglishteens.britishcouncil.org/skills/reading">British Council</a></p>
                        </li>
                    </ul>
                </div>
                <div id="spe" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">mic</i>
                            <span class="title">SPEAKING</span>
                            <p><a href="http://learnenglishteens.britishcouncil.org/skills/speaking">British Council</a></p>

                        </li>
                    </ul>
                </div>
                <div id="tal" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">star</i>
                            <span class="title">TALK SHOWS</span>
                            <p><a href="https://www.youtube.com/user/TheEllenShow">The Ellen Show</a></p>
                            <p><a href="https://www.youtube.com/channel/UC8-Th83bH_thdKZDJCrn88g">The Tonight Show Starring Jimmy Fallon</a></p>
                            <p><a href="https://www.youtube.com/user/TheLateLateShow">The Late Late Show with James Corden</a></p>
                        </li>
                    </ul>
                </div>
                <div id="toe" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">chrome_reader_mode</i>
                            <span class="title">TOEFL</span>
                            <p><a href="">Plataforma online con simulaciones del examen TOEFL</a></p>
                        </li>
                    </ul>
                </div>
                <div id="tra" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">g_translate</i>
                            <span class="title">TRANSLATORS</span>
                            <p><a href="https://translate.google.com/">Google Translator</a></p>
                            <p><a href="https://www.itranslate.com/">iTranslate</a></p>
                            <p><a href="http://www.wordreference.com/">Wordreference</a></p>
                            <p><a href="https://www.linguee.es/">Linguee</a></p>
                        </li>
                    </ul>
                </div>
                <div id="tv" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">tv</i>
                            <span class="title">TV SHOWS</span>
                            <p><a href="https://www.youtube.com/user/NBCTheVoice">The Voice</a></p>
                            <p><a href="https://www.youtube.com/user/americanidol">American Idol</a></p>
                            <p><a href="https://www.youtube.com/user/comedycentral">Comedy Central</a></p>
                            <p><a href="https://www.youtube.com/user/TLC">TLC</a></p>

                        </li>
                    </ul>
                </div>
                <div id="voc" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">sort_by_alpha</i>
                            <span class="title">VOCABULARY</span>
                            <p><a href="http://www.bbc.co.uk/learningenglish">BBC Learning English</a></p>
                            <p><a href="http://learnenglish.britishcouncil.org/en/vocabulary">British Council</a></p>
                            <p><a href="http://easyworldofenglish.com/picdic/picdic.aspx?c=8589b881363b670c">Easy World of English</a></p>
                            <p><a href="http://www.manythings.org/e/vocabulary.html">ManyThings</a></p>
                            <p><a href="http://www.languageguide.org/english/vocabulary/">LanguageGuide</a></p>
                        </li>
                    </ul>
                </div>
                <div id="wri" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">spellcheck</i>
                            <span class="title">WRITING</span>
                            <p><a href="http://learnenglishteens.britishcouncil.org/skills/writing">British Council</a></p>
                            <p><a href="http://www.manythings.org/e/spelling.html">ManyThings</a></p>
                            <p><a href="http://grammar.ccc.commnet.edu/grammar/index.htm">Guide to grammar and writing</a></p>

                        </li>
                    </ul>
                </div>
                <div id="you" class="section scrollspy">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">subscriptions</i>
                            <span class="title">YOUTUBE LEARNING ENGLISH</span>
                            <p><a href="https://www.youtube.com/user/rachelsenglish">Rachel´s English</a></p>
                            <p><a href="https://www.youtube.com/channel/UC2vTY_9dyOFOHQZvBFMteHg">Freeenglishlessons</a></p>
                            <p><a href="https://www.youtube.com/channel/UCFMWTWWPgA2QAC-R5_IuxKA">Go English</a></p>
                            <p><a href="https://www.youtube.com/user/bbclearningenglish">BBC Learning English</a></p>
                            <p><a href="https://www.youtube.com/channel/UCddhCpo99TYiSiRhmzVVSEg">Real English with Real Teachers</a></p>
                            <p><a href="https://www.youtube.com/channel/UCz4tgANd4yy8Oe0iXCdSWfA">English with Lucy</a></p>

                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col hide-on-med-and-down s0 m0 l2 contenido">
            <ul class="section table-of-contents">
                <li><a href="#app">APPS CHAT AND SOCIAL</a></li>
                <li><a href="#apps">APPS LANGUAGE COURSES</a></li>
                <li><a href="#con">CONFERENCES</a></li>
                <li><a href="#dic">DICTIONARIES</a></li>
                <li><a href="#gra">GRAMMAR</a></li>
                <li><a href="#int">INTEGRATED SKILLS</a></li>
                <li><a href="#lis">LISTENING</a></li>
                <li><a href="#new">NEWS</a></li>
                <li><a href="#pro">PRONUNCIATION</a></li>
                <li><a href="#rea">READING</a></li>
                <li><a href="#spe">SPEAKING</a></li>
                <li><a href="#tal">TALK SHOWS</a></li>
                <li><a href="#toe">TOEFL</a></li>
                <li><a href="#tra">TRANSLATORS</a></li>
                <li><a href="#tv">TV SHOWS</a></li>
                <li><a href="#voc">VOCABULARY</a></li>
                <li><a href="#wri">WRITING</a></li>
                <li><a href="#you">YOUTUBE LEARNING ENGLISH</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Funcionamiento Navbar -->
    <script src="js/navbar.js"></script>
    <script src="js/scrollspy.js"></script>
</body>

</html>
