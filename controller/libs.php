<?php
// LIBS PHP
echo "ddfdf";
$directorio = opendir("lib"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if(!is_dir($archivo) and strpos($archivo, "[essential]") => 0)//verificamos si es o no un directorio
    {
        echo "archivos esenciales";
    }
}
?>