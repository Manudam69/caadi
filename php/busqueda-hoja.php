<?php 
require("./conexion.php");
$conexion = connect();
session_start();
$idioma = $_SESSION['idioma'];
$nivel = $_SESSION['nivel'];
if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
}

$hojas = "";
$query = mysqli_query($conexion, "SELECT id_hoja_trabajo,tema,area,tipo,nombre,nivel FROM hoja_trabajo, nivel, idioma WHERE hoja_trabajo.id_nivel=nivel.id_nivel 
AND idioma.id_idioma=nivel.id_idioma AND nivel.nivel in $nivel AND idioma.nombre in $idioma");

while($datos = mysqli_fetch_array($query)){
    $idioma = $datos["nombre"];
    $nivel = $datos["nivel"];
    $titulo = $datos["tema"];
    $tipo = $datos["area"];
    $hojas .= ' 
    <li class="collection-item avatar">
        <a href="./php/agregar-a-pendientes.php?id_hoja='.$datos['id_hoja_trabajo'].'" class="left"><i class="large material-icons circle z-depth-1" id="descargar">add_circle</i></a>
        <span class="title"><?php echo $array["tema"] ?></span>
        <p>'.$titulo.'</p>
        <p>'.$idioma.', '.$nivel.'
            <br> '.$tipo.'
        </p>
    </li>';
}

if(isset($_POST['titulo']) || isset($_POST['tipo']) || isset($_POST['idioma'])){
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $idioma = $_POST['idioma'];
    if($titulo || $tipo ||$idioma != ""){
        $hojas = " ";
        if($titulo != "" && $tipo != "" && $idioma != ""){ //todos rellenados
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (hoja_trabajo.tema = '$titulo' AND hoja_trabajo.area = '$tipo' AND idioma.nombre = '$idioma')");
        } 
        elseif($titulo != "" && $tipo != "" && $idioma == ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND hoja_trabajo.tema = '$titulo' AND hoja_trabajo.area = '$tipo'");
        }
        elseif($titulo != "" && $tipo == "" && $idioma != ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (hoja_trabajo.tema = '$titulo' AND idioma.nombre = '$idioma')");
        }//
        elseif($titulo != "" && $tipo == "" && $idioma == ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (hoja_trabajo.tema = '$titulo')");
        }
        elseif($tipo != "" && $titulo == "" && $idioma != ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (hoja_trabajo.area = '$tipo' AND idioma.nombre = '$idioma')");
        }
        elseif($tipo != "" && $titulo == "" && $idioma == ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (hoja_trabajo.area = '$tipo')");
        }
        elseif($idioma != "" && $titulo == "" && $tipo == ""){
            $filtro = mysqli_query($conexion,"SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo FROM hoja_trabajo JOIN nivel JOIN idioma
            WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma AND (idioma.nombre = '$idioma')");
        }
        while($hojas_filtradas = mysqli_fetch_array($filtro)){
            $tituloFiltrado = $hojas_filtradas['titulo'];
            $idiomaFiltrado = $hojas_filtradas['nombre']; 
            $nivelFiltrado = $hojas_filtradas['nivel'];
            $tipoFiltrado = $hojas_filtradas['tipo'];
            $hojas .= '<li class="collection-item avatar">
                <a href="#!" class="left"><i class="large material-icons circle z-depth-1" id="descargar">add_circle</i></a>
                <span class="title">'.$tituloFiltrado.'</span>
                <p>'.$idiomaFiltrado.', '.$nivelFiltrado.'
                    <br> '.$tipoFiltrado.'
                </p>
            </li>';
        }
    }
}
echo $hojas;
?>