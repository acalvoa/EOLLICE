<?php
// LIBS PHP
$directorio = opendir("css/csslayer"); //ruta actual
$archivos = array();
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
	$archivos[] = $archivo;
}
sort($archivos);
foreach ($archivos as $key => $value) {
	if(!is_dir($value) and strpos($value, "[essential]") and strpos($value, "[essential]") >= 0)//verificamos si es o no un directorio
    {
        echo '<link rel="stylesheet" href="css/csslayer/'.$value.'">';
    }
    elseif(!is_dir($value) and $value == strtolower(SECTION).".css")
    {
    	echo '<link rel="stylesheet" href="css/csslayer/'.$value.'">';
    }
}
?>