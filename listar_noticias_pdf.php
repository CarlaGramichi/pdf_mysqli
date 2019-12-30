<?php


require 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;


$servidor = 'localhost';
$bd = 'noticias_pdf';
$usuario = 'root';
$contrasena = '';
$puerto = '3306';

//**Conexion a la base de datos**//
$conexion = mysqli_connect($servidor, $usuario, $contrasena);
mysqli_select_db($conexion, $bd) or die ("Ninguna DB seleccionada");


$consulta = "SELECT * FROM posts WHERE id IN ({$_REQUEST['seleccionados']})";
$not_selec = mysqli_query($conexion, $consulta);


$cuerpo = '';


while($noticias_selec= mysqli_fetch_assoc($not_selec)){
    $cuerpo.="
    <h1>{$noticias_selec['titulo']}</h1>
    <p>{$noticias_selec['cuerpo']}</p>
    ";
}

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($cuerpo);
$html2pdf->output();
?>