<?php
if(!class_exists('webservice'))
{
	require_once('webservice.php');
}
if(!class_exists('PHPMailer'))
{
	require_once('class.phpmailer.php');
}
class user extends webservice{
	public function login($data){
		sleep(1);
		$db = new db_core();
		$where['email'] = $data->email;
		$where['password'] = md5($data->password);
		if($db->isExists_multi('users', $where)){
			$token = $this->getToken('session_log','token');
			@$_SESSION['token_user'] = $token;
			$datos = $db->reg_one("SELECT * FROM users WHERE email='".$data->email."'");
			$aux['token'] = $token;
			$aux['id_user'] = $datos['id_user']; 
			$aux['date'] = date('Y-m-d h:i:s');
			$aux['ip'] = $this->getIP();
			$db->insert('session_log', $aux);
			if($data->remember){
				setcookie("eollice_data_token", $token, time()+3600*24*30, "/");
			}
			$this->returnData(array(
				"status"=>0,
				"name" => $datos['nombre']
			));
		}
		else
		{
			$this->returnData(array("status"=>1));
		}
	}
	//METODO PARA REGISTRAR USUARIO 
	public function reguser($data){
		$db = new db_core();
		if(!$db->isExists('users','email',$data->email)){
			$token = $this->getToken('users','opeToken');
			$aux['email'] = $data->email;
			$aux['nombre'] = $data->nombre;
			$aux['opeToken'] = $token;
			$aux['password'] = md5($data->password);
			$db->insert('users', $aux);
			$email = new email();
			$email->regmail($data->nombre,$data->email, $token);
			$this->returnData(array(
				"status"=>0,
				"name" => $data->nombre
			));
		}
		else
		{
			$this->returnData(array(
				"status"=>1
			));
		}
	}
	// METODO PARA RECUPERAR UNA CONTRASEÑA
	public function forgotpassword($data){
		try{
			$db = new db_core();
			$token = $this->getToken('users','recoverToken');
			$where['email'] = $data->email;
			$in['recoverToken'] = $token;
			$info = $db->reg_one("SELECT nombre FROM users WHERE email='".$data->email."'");
			$db->update('users', $in, $where);
			$email = new email();
			$email->forgotmail($data->email,$token, $info[0]);
			$this->returnData(array(
				"status"=>0
			));
		}
		catch(Exception $e){
			$this->returnData(array(
				"status"=>1
			));
		}
		
	}
	//METODO PARA LOGOUT USUARIO
	public function logout($data){
		unset($_SESSION['token_user']);
		setcookie("eollice_data_token", "", time() - 3600, "/");
		session_unset();  
    	session_destroy();
	}
	//METODO PARA OBTENER INFO DEL USUARIO
	public function getinfo($data){
		$db = new db_core();
		$consulta = $db->reg_one("SELECT * FROM session_log INNER JOIN users ON session_log.id_user=users.id_user WHERE session_log.token='".$_SESSION['token_user']."'");
		echo json_encode($consulta);
	}
	//METODO PARA DETERMINAR IP
	private function getIP(){
	    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
	    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
	    else $ip = null ;
	    return $ip;
	}
	public function activeUser($opt){
		// PUEDEN EXISTIR 3 ESTADOS A LA OPERACION (status)
		// 0: TOKEN INVALIDO
		// 1: OPERACION EXITOSA
		// 2: NO SE PUDO EJECUTAR LA CONSULTA SQL
		$dbo = new db_core();
		if($dbo->isExists('users','opeToken',$opt->token))
		{	
			$matriz['active'] = 1;
			$matriz['opeToken'] = '';
			$where['opeToken'] = $opt->token;
			if($dbo->update('users', $matriz, $where))
			{
				$this->returnData(array(
					"status"=>1
				));
			}
			else
			{
				$this->returnData(array(
					"status"=>2
				));
			}
		}
		else
		{
			$this->returnData(array(
				"status"=>0
			));
		}
	}
	public function reDefinePassword($opt){
		// PUEDEN EXISTIR 3 ESTADOS A LA OPERACION (status)
		// 0: OPERACION EXITOSA
		// 1: TOKEN INVALIDO
		// 2: NO SE PUDO EJECUTAR LA CONSULTA SQL
		$dbo = new db_core();
		if($dbo->isExists('users','recoverToken',$opt->token))
		{	
			$matriz['password'] = md5($opt->password);
			$matriz['recoverToken'] = '';
			$where['recoverToken'] = $opt->token;
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
	public function isConected(){
		$db = new db_core();
		if(isset($_SESSION['token_user']) && $db->isExists('session_log','token', $_SESSION['token_user'])){
			$this->returnData(array("status"=>0));
		}
		else
		{
			$this->returnData(array("status"=>1));
		}
	}
	public function complete_account($data){
			$db = new db_core();
			$in['nombre'] = $data->nombre;
			$in['rut'] = $data->rut;
			$in['telefono'] = $data->telefono;
			$in['domicilio'] = $data->domicilio;
			$in['ciudad'] = $data->ciudad;
			$in['complete'] = 1;
			$in['lastname_mother'] = $data->lastname_mother; 
			$in['lastname_father'] = $data->lastname_father;
			$in['numero_domicilio'] = $data->numero_domicilio;
			$in['numero_depto'] = $data->numero_depto;
			$in['edificio'] = $data->edificio;
			$in['comuna'] = $data->comuna;
			$where['id_user'] = $this->get_user($_SESSION['token_user']);
			$db->update('users',$in, $where);
			$this->returnData(array(
				"status"=>0
			));
	}
	public function is_complete_acount(){
		$db = new db_core();
		$where['id_user'] = $this->get_user($_SESSION['token_user']);
		$where['complete'] = 1;
		$datos = $db->reg_one("SELECT * FROM session_log INNER JOIN users ON session_log.id_user=users.id_user WHERE session_log.token='".$_SESSION['token_user']."'");
		if(!$db->isExists_multi('users', $where)){
			$this->returnData(array(
				"status"=>0,
				"name"=>$datos['nombre']
			));
		}
		else
		{
			$this->returnData(array(
				"status"=>1
			));
		}
	}
	public function contacto($data){
		$db = new db_core();
		$in['nombre'] = $data->name;
		$in['mensaje'] = $data->mensaje;
		$in['email'] = $data->email;
		$db->insert('contacto', $in);
		// $this->mail = new PHPMailer();
		//Luego tenemos que iniciar la validación por SMTP:
		// $this->mail->IsSMTP();
		// $this->mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
		// $this->mail->Username = "noreply@eollice.com"; // Cuenta de e-mail
		// $this->mail->Password = "shadowfax"; // Password
		// $this->mail->Host = "eollice.com";
		// $this->mail->From = "noreply@eollice.com";
		// $this->mail->IsHTML(true);
		// $this->mail->CharSet = 'UTF-8';
		// $this->mail->AddAddress("contacto@eollice.com","Eollice");
		// $this->mail->FromName = $data->name;
		// $this->mail->From = $data->email;
		// $this->mail->Subject = "Contacto";
		// $this->mail->WordWrap = 50;
		// $body = $data->mensaje;
		// $this->mail->Body = $body;
		// $this->mail->Send();
		$this->returnData(array(
			"status"=>0,
		));
	}
}
?>