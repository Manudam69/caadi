<?php 
$server="localhost";
$pass="";
$user="root";
$db="caadi";
$conexion=mysqli_connect($server,$user,$pass,$db);

if(!$conexion){
    echo "Error. SIn conexion a la base de datos";
    echo "Errno de depuracion ".mysqli_connect_errno().PHP_EOL;
    echo "Error de depuracion ".mysqli_connect_error().PHP_EOL;
}

$hojas = "";
$query = mysqli_query($conexion, "SELECT idioma.nombre AS nombre, nivel.nivel AS nivel, hoja_trabajo.tema AS titulo, hoja_trabajo.area AS tipo  FROM hoja_trabajo JOIN nivel JOIN idioma WHERE hoja_trabajo.id_nivel = nivel.id_nivel AND nivel.id_idioma = idioma.id_idioma ");

while($datos = mysqli_fetch_array($query)){
    $idioma = $datos["nombre"];
    $nivel = $datos["nivel"];
    $titulo = $datos["titulo"];
    $tipo = $datos["tipo"];
    $hojas .= ' 
    <li class="collection-item avatar">
        <form method="post" action="index.php" enctype="multipart/form-data">
            <input type="file" name="archivo" required="required" />
            <a></a><input type="submit" value="Subir" />
        </form>
        <a href="#!" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
        <span class="title"><?php echo $array["tema"] ?></span>
        <a href="#!" class="right"><i class="material-icons contestar z-depth-1">file_upload</i></a>
        <a href="../caadi/examen.html" class="right"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
        <p>'.$titulo.'</p>
        <p>'.$idioma.', '.$nivel.'
            <br> '.$tipo.'
            <a href="#!" class="right"><i class="material-icons eliminar z-depth-1">delete</i></a>
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
                <form method="post" action="index.php" enctype="multipart/form-data">
                    <label> Archivo </label>
                    <input type="file" name="archivo" required="required" />
                    <input type="submit" value="Subir" />
                </form>
                <a href="#!" class="left"><i class="material-icons circle z-depth-1" id="descargar">file_download</i></a>
                <span class="title">'.$tituloFiltrado.'</span>
                <a href="#!" class="right"><i class="material-icons contestar z-depth-1">file_upload</i></a>
                <a href="../caadi/examen.html" class="right"><i class="material-icons contestar z-depth-1">exit_to_app</i></a>
                <p>'.$idiomaFiltrado.', '.$nivelFiltrado.'
                    <br> '.$tipoFiltrado.'
                    <a href="#!" class="right"><i class="material-icons eliminar z-depth-1">delete</i></a>
                </p>
                
            </li>';
        }
    }
}
echo $hojas;
?>