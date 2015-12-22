<?php
	session_start();
	$dir = "classes/";
	//LEEMOS LAS LIBRERIAS INTERNAS
	if (is_dir($dir)) {
	    if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {
	            if(!is_dir($dir.$file)){
	            	if(!class_exists(substr($file,0,-4)))
					{
						require_once($dir.$file);
					}
	            }
	        }
	        closedir($dh);
	    }
	}
	//VERIFICAMOS TOKEN DE SEGURIDAD
	$db = new db_core();
	if(($_POST['lib'] != "user") && ($_POST['lib'] != "simulacion") && !$db->isExists('session_log', 'token', $_SESSION['token_user']))
	{
		die('ERROR HANDLER - ERROR DE SEGURIDAD: COD 02');
	}
	else
	{
		// LEEMOS LA LIBRERIA QUE SE REQUIERE
		if(isset($_POST['lib']) && $_POST['method'] && class_exists($_POST['lib'])){
			$clase = $_POST['lib'];
			$objeto = new $clase();
			$methodo = $_POST['method'];
			$clases = new reflectionClass($clase);
			if($clases->hasMethod($methodo)){
				$data = ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1")?json_decode(stripslashes($_POST['data'])):json_decode($_POST['data']);
				$objeto->$methodo($data);
			}
			else
			{
				die("ERROR HANDLER - LLAMADA INVALIDA: COD 03");
			}
		}
		else
		{
			die("ERROR HANDLER - LLAMADA INVALIDA: COD 01");
		}
	}
?>