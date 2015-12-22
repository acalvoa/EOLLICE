<?php
	session_start();
	require_once('db_core.php');
	require_once('webservice.php');
	// require_once('mail.php');
	require_once("../khipu/khipu.php");
	class generic extends webservice{
		var $db;
		function generic(){
			$this->db = new db_core(); 
		}
		function init(){
			
		}
		// public function add_bank($opt){
		// 	$dbo = $this->db;
		// 	$valores['id_user']= $this->get_user($_SESSION['token']);
		// 	$valores['numero_cuenta_banco'] = $opt->ncuenta;
		// 	$valores['banco'] = $this->get_banco($opt->id_banco);
		// 	$valores['tipo_de_cuenta'] = $this->get_banco($opt->tipo_cuenta);
		// 	$dbo->insert('cuentas_bancarias',$valores);
		// 	$retorno['status'] = true;
		// 	$retorno['ncuenta'] = $opt->ncuenta;
		// 	$retorno['banco'] = utf8_encode($valores['banco']);
		// 	$retorno['tipo'] = ($opt->tipo_cuenta == 0)?"Cuenta Corriente":"Cuenta Vista";
		// 	$retorno['id'] = $dbo->last_id();
		// 	$this->returnData($retorno);
		// }
		// private function get_banco($id_banco){
		// 	$dbo = $this->db;
		// 	$banco = $dbo->reg_one("SELECT nombre FROM listado_bancos AS l WHERE l.id_banco='".$id_banco."'");
		// 	return $banco[0];
		// }
		// public function mod_bank($opt){
		// 	$dbo = $this->db;
		// 	$valores['banco'] = $this->get_banco($opt->id_banco);
		// 	$valores['tipo_de_cuenta'] = $opt->tipo_cuenta;
		// 	$valores['numero_cuenta_banco'] = $opt->ncuenta;
		// 	$where['id_cuenta'] = $opt->idcuenta;
		// 	$dbo->update('cuentas_bancarias',$valores, $where);
		// 	$retorno['status'] = true;
		// 	$this->returnData($retorno);
		// }
		// public function invertir($opt){
		// 	$dbo = $this->db;
		// 	$opt->inversion = str_replace(array("$ ","."), array("",""), $opt->inversion);
		// 	$valores['monto_inversion'] = $opt->inversion;
		// 	$valores['id_user'] = $this->get_user($_SESSION['token']);
		// 	$valores['fecha_declaracion_inversion'] = date('Y-m-d h:i:s');
		// 	$valores['id_proyecto'] = $opt->id_proyecto;
		// 	$valores['token_transaccion'] = $this->getToken('inversion_proyecto','token_transaccion',TRUE,TRUE,FALSE,9);
		// 	$dbo->insert('inversion_proyecto',$valores);
		// 	$retorno['status'] = true;
		// 	$retorno['inversion'] = $valores['token_transaccion'];
		// 	$this->returnData($retorno);
		// }
		// public function mod_invertir($opt){
		// 	$dbo = $this->db;
		// 	$opt->inversion = str_replace(array("$ ","."), array("",""), $opt->inversion);
		// 	$valores['monto_inversion'] = $opt->inversion;
		// 	$where['token_transaccion'] = $opt->token;
		// 	$dbo->update('inversion_proyecto',$valores, $where);
		// 	$retorno['status'] = true;
		// 	$this->returnData($retorno);
		// }
		// public function set_bank($opt){
		// 	$dbo = $this->db;
		// 	$valores['id_cuenta_bancaria'] = $opt->id_cuenta;
		// 	$where['token_transaccion'] = $opt->token;
		// 	$dbo->update('inversion_proyecto',$valores, $where);
		// 	$retorno['status'] = true;
		// 	$this->returnData($retorno);
		// }
		public function confirm_founding($opt){
			$dbo = $this->db;
			$valores['monto_inversion'] = $opt->monto;
			$valores['coi'] = $opt->coi;
			$valores['id_user'] = $this->get_user($_SESSION['token_user']);
			$valores['fecha_inversion'] = date('Y-m-d h:i:s');
			$valores['id_proyecto'] = $opt->id_proyecto;
			$valores['preconfirmado'] = 2;
			$valores['confirmado'] = 2;
			$valores['id_cuenta_bancaria'] = $opt->id_banco;
			$valores['token_transaccion'] = $this->getToken('inversion_proyecto','token_transaccion',TRUE,TRUE,FALSE,9);
			$dbo->insert('inversion_proyecto',$valores);
			$consulta = $dbo->reg_one("SELECT * FROM inversion_proyecto INNER JOIN users ON inversion_proyecto.id_user = users.id_user WHERE inversion_proyecto.token_transaccion='".$valores['token_transaccion']."'");
			$khipu = new khipu($valores['token_transaccion']);
			$datos = new stdClass();
			$datos->asunto = "Inversión en Eollice";
			$datos->contenido = "
			Al invertir en este proyecto debes transferir tanto el monto de inversión como el Costo por Opción a Inversión. Una vez que hayas realizado la transferencia estaras dentro del proceso de inversión. 

Cualquier duda puedes contactarnos a contacto@eollice.com.

Francisco Sepúlveda M.
Co-Fundador Eollice";
			$datos->monto = $opt->monto+$opt->coi;
			$datos->email = $consulta['email'];
			$datos->especificacion = "Pago de la inversion y costos asociados";
			$resultado = $khipu->generarpago($datos);
			$result = json_decode($resultado);
			$in['codigo_khipu'] = $result->id;
			$where['token_transaccion'] = $valores['token_transaccion'];
			$dbo->update('inversion_proyecto',$in,$where);
			echo $resultado;
		}
		function get_user($token){
			$db = new db_core();
			$user_id = $db->reg_one("SELECT id_user FROM session_log AS s WHERE s.token='".$token."'");
			return $user_id[0];
		}
		function message_screen($vars){
			echo "<script>alert('".$vars."');</script>";
		}
	}
	include("handler.php");
?>