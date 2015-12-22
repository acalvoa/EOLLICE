<?php
require_once('khipuconfig.php');
require_once('../model/db_core.php');
class khipu extends khipuconfig{
	var $transaccion_id;
	// ATRIBUTOS
	function khipu($token){
		$this->transaccion_id = $token; 
	}
	// PRIVADOS
	private function generateHash($array){
		if(is_array($array)){
			$cadena = "";
			foreach($array as $key => $value){
				$cadena .= $key."=".$value."&";
			}
			$cadena = substr($cadena, 0,-1);
			return hash_hmac('sha256', $cadena, $this->secret);
		}
		die("Error de seguridad al generar el hash");
	}
	//PUBLICOS
	public function set_transaccion_id($transaccion_id){
		$this->transaccion_id = $transaccion_id;
	}
	public function generarpago($opt){
		$datos = array(
			"receiver_id" => $this->id,
			"subject"=> $opt->asunto,
			"body"=> $opt->contenido,
			"amount"=> $opt->monto,
			"payer_email"=> $opt->email,
			"bank_id"=> $this->bank_id,
			"transaction_id"=> $this->transaccion_id,
			"custom"=> $opt->especificacion,
			"notify_url"=> $this->url_notify,
			"return_url"=> $this->url_exito."?token=".$this->transaccion_id,
			"cancel_url"=> $this->url_cancel."?failtoken=".$this->transaccion_id,
			"picture_url"=> $this->image,
		);
		$datos["hash"] = $this->generateHash($datos);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->khipu_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	public function print_vars(){
		foreach($this as $key => $value){
			echo $key."->".$value."<br>";
		}
	}
	public function validar_pago($array){
		if(is_array($array)){
			$datos['api_version'] = $array['api_version'];
			$datos['receiver_id'] = $array['receiver_id'];
			$datos['notification_id'] = $array['notification_id'];
			$datos['subject'] = $array['subject'];
			$datos['amount'] = $array['amount'];
			$datos['currency'] = $array['currency'];
			$datos['custom'] = $array['custom'];
			$datos['transaction_id'] = $array['transaction_id'];
			$datos['payer_email'] = $array['payer_email'];
			$datos['notification_signature'] = $array['notification_signature'];
			//HACEMOS LA CADENA DE VERIFICACION
			$cadena = "";
			foreach($array as $key => $value){
				$cadena .= $key."=".urlencode($value)."&";
			}
			$cadena = substr($cadena, 0,-1);
			// Usamos CURL para hacer POST HTTP
			$ch = curl_init("https://khipu.com/api/1.2/verifyPaymentNotification");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $cadena);
			$response = curl_exec($ch);
			curl_close($ch);
			if ($response == 'VERIFIED') {
				$db = new db_core();
				$in['confirmado'] = 1;
				$in['preconfirmado'] = 1;
				$in['estado'] = 1;
				$in['codigo_khipu'] = $array['notification_id'];
				$where['token_transaccion'] = $array['transaction_id'];
				$db->update('inversion_proyecto',$in,$where);
			}
		}
	}
}
?>