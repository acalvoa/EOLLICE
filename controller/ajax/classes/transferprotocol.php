<?php
if(!class_exists('webservice'))
{
	require_once('webservice.php');
}
class transferprotocol extends webservice{
	public function check_transaction($data){
		$db = new db_core();
		$where['token_transaccion'] = $data->token;
		$where['preconfirmado'] = 1;
		$where['confirmado'] = 1;
		$where['estado'] = 1;
		$consulta = $db->reg_one("SELECT * FROM inversion_proyecto WHERE token_transaccion='".$data->token."'");
		if($db->isExists_multi('inversion_proyecto', $where))
		{
			$mail = new email();
			$correo = $db->reg_one("SELECT email,nombre FROM session_log INNER JOIN users ON session_log.id_user=users.id_user WHERE session_log.token='".$_SESSION['token_user']."'");
			$mail->mail_inversion($correo[0],$correo[1]);
			$this->returnData(array(
				"status"=>0,
				"id"=>$consulta['id_proyecto']
			));
		}
		else
		{
			$whe['token_transaccion'] = $data->token;
			$whe['preconfirmado'] = 2;
			$whe['confirmado'] = 2;
			if($db->isExists_multi('inversion_proyecto', $whe)){
				$this->returnData(array(
					"status"=>1
				));
			}
			else
			{
				$whe['token_transaccion'] = $data->token;
				if(!$db->isExists_multi('inversion_proyecto', $whe)){
					$this->returnData(array(
						"status"=>2,
						"id"=>$consulta['id_proyecto']
					));
				}
			}
		}
	}
	public function fail_transaction($data){
		$db = new db_core();
		$db->delete('inversion_proyecto','token_transaccion', $data->token);
		if(!$db->isExists('inversion_proyecto', 'token_transaccion', $data->token))
		{
			$this->returnData(array(
				"status"=>0
			));
		}
	}
	public function get_code_transfer(){
		$db = new db_core();
		$token = "";
		while(true){
			$token = $this->getToken_transfer(4,true,false,false)."-".$this->getToken_transfer(8,false,true,false);
			if(!$db->isExists('inversion_proyecto','codigo_transfer',$token))
	        {
	        	break;
	        }
		}
		$this->returnData(array(
			"code"=>$token
		));
	}
	public function generar_transfer($opt){
		$dbo = new db_core();
		$valores['monto_inversion'] = $opt->monto;
		$valores['coi'] = $opt->coi;
		$valores['codigo_transfer'] = $opt->code;
		$valores['id_user'] = $this->get_user($_SESSION['token_user']);
		$valores['fecha_inversion'] = date('Y-m-d h:i:s');
		$valores['id_proyecto'] = $opt->id_proyecto;
		$valores['id_cuenta_bancaria'] = $opt->id_banco;
		$valores['preconfirmado'] = 1;
		$valores['confirmado'] = 1;
		$valores['estado'] = 0;
		$valores['token_transaccion'] = $this->getToken('inversion_proyecto','token_transaccion',TRUE,TRUE,FALSE,9);
		$dbo->insert('inversion_proyecto',$valores);
		$correo = $dbo->reg_one("SELECT email,nombre FROM session_log INNER JOIN users ON session_log.id_user=users.id_user WHERE session_log.token='".$_SESSION['token_user']."'");
		$email = new email();
		$email->transfer_mail(($opt->monto+$opt->coi),$correo[0], $opt->code,$correo[1]);
		$this->returnData(array(
			"status"=>0
		));
	}
	public function getToken_transfer($nume,$uc=TRUE,$n=TRUE,$sc=TRUE)
	{
		$db = new db_core();
	    $source = '';
	    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    if($n==1) $source .= '1234567890';
	    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    	$rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$nume; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
	    return $rstr;
	}
	function get_user($token){
		$db = new db_core();
		$user_id = $db->reg_one("SELECT id_user FROM session_log AS s WHERE s.token='".$token."'");
		return $user_id[0];
	}
}
?>