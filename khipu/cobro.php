<?php
session_start();
include("../model/db_core.php");
include("khipu.php");
$db = new db_core();
$consulta = $db->reg_one("SELECT * FROM inversion_proyecto INNER JOIN users ON inversion_proyecto.id_user = users.id_user WHERE inversion_proyecto.token_transaccion='".$_POST["id_transaccion"]."'");
$khipu = new khipu();
$khipu->set_transaccion_id($_POST["id_transaccion"]);
$datos = new stdClass();
$datos->asunto = "Costo por Opcion a Inversion";
$datos->contenido = "El monto a invertir (".$_POST["monto"]."), asociado a tu cuenta bancaria, el cual se informará a tu correo electrónico. Una vez recibido dicho correo electrónico, <b>tendrás 48 horas para realizar el depósito de tu inversión a la cuenta corriente de Eollice</b>. Si no realizas el depósito, perderás tu opción de inversión y se cobrará una multa equivalente al Costo por Opción de Inversión (".$_POST["monto"]."). Cualquier duda contactarnos a <b>contacto@eollice.com</b>.";
$datos->monto = $_POST["monto"];
$datos->email = $consulta['email'];
$datos->especificacion = "Costo por tener opcion a inversion dentro de la plataforma eollice.";
$khipu->generarpago($datos);
?>