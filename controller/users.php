<?php
include("model/db_core.php");
class users {
	function users(){
		if(isset($_COOKIE["eollice_data_token"])){
			$this->refresh_login($_COOKIE['eollice_data_token']);
		}
	}
	public function refresh_login($tok){
		$db = new db_core();
		if($db->isExists('session_log','token',$tok) && !isset($_SESSION['token_user'])){
			$token = $this->getToken('session_log','token');
			@$_SESSION['token_user'] = $tok;
			$datos = $this->getinfo("");
			@$_SESSION['token_user'] = $token;
			$aux['token'] = $token;
			$aux['id_user'] = $datos['id_user']; 
			$aux['date'] = date('Y-m-d h:i:s');
			$aux['ip'] = $this->getIP();
			$db->insert('session_log', $aux);
			setcookie ("eollice_data_token", $token, time()+3600*24*30, "/");
		}
	}
	public function isConected(){
		$db = new db_core();
		if(isset($_SESSION['token_user']) && $db->isExists('session_log','token', $_SESSION['token_user'])){
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getinfo($data){
		$db = new db_core();
		$consulta = $db->reg_one("SELECT * FROM session_log INNER JOIN users ON session_log.id_user=users.id_user WHERE session_log.token='".$_SESSION['token_user']."'");
		return $consulta;
	}
	public function getToken($table,$campo,$uc=TRUE,$n=TRUE,$sc=TRUE)
	{
		$db = new db_core();
	    $source = 'abcdefghijklmnopqrstuvwxyz';
	    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    if($n==1) $source .= '1234567890';
	    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	    $rstr = "";
    	while(true)
    	{
	        $rstr = "";
	        $source = str_split($source,1);
	        for($i=1; $i<=15; $i++){
	            mt_srand((double)microtime() * 1000000);
	            $num = mt_rand(1,count($source));
	            $rstr .= $source[$num-1];
	        }
	        if(!$db->isExists($table,$campo,$rstr))
	        {
	        	break;
	        }
    	}
	    return sha1($rstr);
	}
	private function getIP(){
	    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
	    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
	    else $ip = null ;
	    return $ip;
	}
	function activeUser($opt){
		// PUEDEN EXISTIR 3 ESTADOS A LA OPERACION (status)
		// 0: TOKEN INVALIDO
		// 1: OPERACION EXITOSA
		// 2: NO SE PUDO EJECUTAR LA CONSULTA SQL
		$dbo = $this->db;
		if($dbo->isExists('users','opeToken',$opt->token))
		{	
			$matriz['active'] = 1;
			$matriz['opeToken'] = '';
			$where['opeToken'] = $opt->token;
			if($dbo->update('users', $matriz, $where))
			{
				header('Location: ../index.php?active=1');
			}
			else
			{
				header('Location: ../index.php?active=2');
			}
		}
		else
		{
			header('Location: ../index.php?active=0');
		}
	}
	function reDefinePassword($opt){
			// PUEDEN EXISTIR 3 ESTADOS A LA OPERACION (status)
			// 0: OPERACION EXITOSA
			// 1: TOKEN INVALIDO
			// 2: NO SE PUDO EJECUTAR LA CONSULTA SQL
			$dbo = $this->db;
			if($dbo->isExists('users','opeToken',$opt->token))
			{	
				$matriz['password'] = md5($opt->password);
				$matriz['opeToken'] = '';
				$where['opeToken'] = $opt->token;
				if($dbo->update('users', $matriz, $where))
				{
					$this->returnData(array("status"=>0));
				}
				else
				{
					$this->returnData(array("status"=>2));
				}
			}
			else
			{
				$this->returnData(array("status"=>1));
			}
		}
	}
?>