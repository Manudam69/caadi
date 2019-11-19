<?php 
require("./conexion.php");
$conexion = connect();
session_start();
$periodo = $_SESSION['periodo'];
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
}

$hojas = "";
$query = "select hta.id_alumno_hoja_trabajo, hta.id_alumno,hta.id_hoja_trabajo,idioma.nombre,nivel.nivel,ht.tipo,ht.tema,ht.area 
from alumno_hoja_trabajo hta, hoja_trabajo ht,idioma,nivel where hta.id_hoja_trabajo=ht.id_hoja_trabajo 
and ht.id_nivel=nivel.id_nivel and nivel.id_idioma=idioma.id_idioma and hta.estado in (1,2) and hta.id_periodo=$periodo";

$filtro="";
if(isset($_POST['titulo']) && $_POST['titulo'] != ""){
    $filtro.=" and ht.tema='".$_POST['titulo']."' ";  
}
if(isset($_POST['idioma']) && $_POST['idioma'] != ""){
    $filtro.=" and idioma.nombre='".$_POST['idioma']."' ";
}
if(isset($_POST['tipo']) && $_POST['tipo'] != ""){
    $tipo = $_POST['tipo'];
    $filtro .= " and ht.area = '".$tipo."' ";
}
if(isset($_POST['nivel']) && $_POST['nivel'] != ""){
    $filtro .= " and nivel.nivel = '".$_POST['nivel']."' ";
}
if(isset($_POST['id_alumno']) && $_POST['id_alumno'] != ""){
    $filtro .= " and hta.id_alumno=".$_POST['id_alumno'];
}
$query .= $filtro;
$query .= " order by hta.id_alumno_hoja_trabajo";
$hoja_trabajo = mysqli_query($conexion,$query);

while($datos = mysqli_fetch_array($hoja_trabajo)){
    $idioma = $datos["nombre"];
    $nivel = $datos["nivel"];
    $titulo = $datos["tema"];
    $tipo = $datos["area"];
    $id_alumno = $datos["id_alumno"];
    $id_revision = $datos['id_alumno_hoja_trabajo'];
    if ($datos['tipo'] == 1){
        $hojas .= ' 
        <li class="collection-item avatar">
            <i class="material-icons circle red">chrome_reader_mode</i>
            <a href="#modal1" class="right modal-trigger" onclick="enviarRevision('.$id_revision.')"><i class="material-icons contestar z-depth-1">file_upload</i></a>
            <span class="title">Título: '.$titulo.'</span>
                <p>ID revisión: '.$id_revision.' , ID Alumno: '.$id_alumno.'
                    <br> Idioma: '.$idioma.' , Nivel: '.$nivel.' , Tipo: '.$tipo.'
                    <a href="archivos/'.$id_alumno.'/Hoja_rev'.$id_revision.'-al'.$id_alumno.'.docx" class="right"><i class="material-icons descargar z-depth-1">file_download</i></a>
                </p>
        </li>';
    } else{
        $hojas .= ' 
        <li class="collection-item avatar">
            <i class="material-icons circle red">create</i>
            <a href="./hoja-trabajo.php?id_revision='.$id_revision.'" class="right modal-trigger"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
            <span class="title">Título: '.$titulo.'</span>
                <p>ID revisión: '.$id_revision.' , ID Alumno: '.$id_alumno.'
                    <br> Idioma: '.$idioma.' , Nivel: '.$nivel.' , Tipo: '.$tipo.'
                </p>
        </li>';
    }
 
}


echo $hojas;
?>