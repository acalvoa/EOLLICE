<?php
///////////////////////////////
//COMPONENTE : MANEJADOR 
//VERSION : 0.1
//RESPONSABLE: ANGELO CALVO A.
//ULTIMA ACTUALIZACION: 15/02/2012
///////////////////////////////
$_POST['vars'] = stripslashes($_POST['vars']);
if(!isset($_POST['vars']))
{
	$_POST['vars'] = json_encode(array());
}
if(empty($_POST['method']) or !isset($_POST['method'])){
	$generic = new generic();
	$funcion = "init";
	$generic->$funcion((object)json_decode($_POST['vars']));
}
else
{
	$generic = new generic();
	if(method_exists($generic, $_POST['method']))
	{
		$funcion = $_POST['method'];
		$generic->$funcion((object)json_decode($_POST['vars']));
	}
	else
	{
		$funcion = "error_method";
		$generic->$funcion();
	}
}
?>