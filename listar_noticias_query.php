<?php

//**variables para la conexion**//
$servidor = 'localhost';
$bd = 'noticias_pdf';
$usuario = 'root';
$contrasena = '';
$puerto = '3306';

//**Conexion a la base de datos**//
$conexion = mysqli_connect($servidor, $usuario, $contrasena);
mysqli_select_db($conexion, $bd) or die ("Ninguna DB seleccionada");


//**CONSULTA A LA BASE DE DATOS- seleccion de todas las noticias**//
$consulta = "SELECT * FROM posts ";
$noticias = mysqli_query($conexion, $consulta);
$total = "SELECT count(*) as total_n FROM posts";
$total_noticias = mysqli_query($conexion, $total);
//var_dump($datos);
//var_dump($noticias);

while($noticia = mysqli_fetch_assoc($noticias)){
    $resultado[] = $noticia;
}

$total_not= mysqli_fetch_assoc($total_noticias);

echo json_encode(
    [
        'data' => $resultado,
        'recordsFiltered'=>$total_not,

    ]);
?>