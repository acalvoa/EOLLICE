<?php
// LIBS PHP
$directorio = opendir("libs/lib"); //ruta actual
$archivos = array();
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
	$archivos[] = $archivo;
}
sort($archivos);
foreach ($archivos as $key => $value) {
	if(!is_dir($value) and strpos($value, "[essential]") and strpos($value, "[essential]") >= 0)//verificamos si es o no un directorio
    {
        echo '<script src="libs/lib/'.$value.'"></script>';
    }
    elseif(!is_dir($value) and $value == strtolower(SECTION).".js")
    {
    	echo '<script src="libs/lib/'.$value.'"></script>';
    }
}
?>