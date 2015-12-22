<?php
	session_start();
	require_once("khipu.php");
	$khipu = new khipu();
	$khipu->validar_pago($_POST);
?>