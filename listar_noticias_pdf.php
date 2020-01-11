<?php


require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;


$servidor = 'localhost';
$bd = 'car_comentarios';
$usuario = 'root';
$contrasena = '';
$puerto = '3306';

//**Conexion a la base de datos**//
$conexion = mysqli_connect($servidor, $usuario, $contrasena);
mysqli_select_db($conexion, $bd) or die ("Ninguna DB seleccionada");


$consulta = "SELECT * FROM posts WHERE id IN ({$_REQUEST['seleccionados']})";
$not_selec = mysqli_query($conexion, $consulta);


$cuerpo = '';


while ($noticias_selec = mysqli_fetch_assoc($not_selec)) {
    $cuerpo .= "
    <style>
<!--
#encabezado {padding:10px 0; border-top: 1px solid; border-bottom: 1px solid; width:100%;}
#encabezado .fila #col_1 {width: 15%}
#encabezado .fila #col_2 {text-align:center; width: 73%}

#encabezado .fila td img {width:200px}
#encabezado .fila #col_2 #span1{font-size: 30px;}
#encabezado .fila #col_2 #span2{font-size: 12px; color: #4d9;}
 
#footer {padding-top:5px 0; border-top: 1px solid; width:100%;}
#footer .fila td {text-align:center; width:100%;}
#footer .fila td span {font-size: 10px; color: #f5a;}
#central {margin-top:60px; width:100%;}
#central tr td {padding: 10px; text-align: justify; width:100%;}
#titulo {text-align: center}
#extracto {text-align: left}
#imag {width: 100px}
-->
</style>

    <page>
      <page_header>
        <table id=\"encabezado\">
            <tr class=\"fila\">
            <td id=\"col_1\" >
                    <img src=\"images/logo_sema.jpg\">
                </td>
          
                <td id=\"col_2\">
                    <span id=\"span1\">INFORME DE VISITAS</span>
                    <br>
           
                </td>
            </tr>
    
        </table>
    </page_header>
        
    <table id='central'>   
    <tr class='fila'>
    <td> 
    <h1 id='titulo'>{$noticias_selec['titulo']}</h1>
    <p id='extracto'>{$noticias_selec['extracto']}</p>
    <img id='imag' src='images/img.jpg'>
    </td>
    </tr>
   </table>
    
    
    
    <page_footer>
        <table id=\"footer\">
            <tr class=\"fila\">
                <td>
                    <span>Este el footer y pueder ir con letra más pequeña por ejemplo poner una
                    dirección o algo así :P</span>
                </td>
            </tr>
        </table>
    </page_footer>
    </page>
    ";
}

$html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', 5);
$html2pdf->writeHTML($cuerpo);
$html2pdf->output();
?>




