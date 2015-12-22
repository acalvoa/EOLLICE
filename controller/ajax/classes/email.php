<?php
if(!class_exists('webservice'))
{
	require_once('webservice.php');
}
if(!class_exists('PHPMailer'))
{
	require_once('class.phpmailer.php');
}
class email extends webservice{
	var $mail;
	function email(){
		$this->mail = new PHPMailer();
		//Luego tenemos que iniciar la validación por SMTP:
		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
		$this->mail->Username = "noreply@eollice.com"; // Cuenta de e-mail
		$this->mail->Password = "shadowfax"; // Password
		$this->mail->Host = "eollice.com";
		$this->mail->From = "noreply@eollice.com";
		$this->mail->IsHTML(true);
		$this->mail->CharSet = 'UTF-8';
	}
	public function regmail($name, $email, $token){
		$this->mail->AddAddress($email,$name);
		$this->mail->FromName = "Eollice";
		$this->mail->Subject = "Registro en Eollice - Bienvenida y Activacion de Cuenta";
		$this->mail->WordWrap = 50;
		$body  = '<html>
		<body>
			<div style="padding:10px 15% 10px 15%; background:#329BD8; height:490px;">
				<img src="http://www.eollice.com/images/blue_white_logo.png" height="90" />
				<div style="position:relative; background:white; height:310px; padding:10px 20px 10px 20px; font-family:Helvetica; font-size:14px;">
					<div style="position:relative; height:35px; font-size:16px;">Hola,</div>
					<div style="position:relative; color:#3ca9ec; height:45px; font-size:24px;">¡Bienvenido a la comunidad Eollice!</div>
					<div style="position:relative;">Ya perteneces a la primera red de financiamiento colectivo para proyectos de energías renovables en Latinoamérica. Valida tu registro para finalizar el proceso.</div>
					<div style="position:relative; height:50px; padding-top:20px; padding-bottom:20px;">
						<div style="border: 1px #3ca9ec solid; border-radius:5px; background:#3ca9ec; color:white; height:40px; line-height:40px; vertical-align:middle; width:200px; text-align:center;"><a style="color:#FFF;" href="http://www.eollice.com/index.php?activeToken='.$token.'">Confirma tu registro >></a></div>
					</div>
					<div style="height:100px; background:#EEE; font-family:Helvetica;">
						<div style="float:left; width:60px; padding: 35px 0px 0px 20px; font-size:12px; height:20px; line-height:20px; vertical-align:middle;"><a href="http://www.facebook.com/eollice"><img src="http://www.eollice.com/images/otros/facebook.png" height="30" /></a><a href="http://www.twitter.com/eollice"><img src="http://www.eollice.com/images/otros/twitter.png" height="30" /></a></div>
						<div style="float:left; width:50px; padding: 35px 20px 0px 5px; font-size:13px; height:30px; line-height:30px; vertical-align:middle;">Siguenos</div>
						<div style="float:right; width:250px; padding: 35px 20px 0px 0px; font-size:12px;">Si tienes alguna duda responde este correo o escríbenos a: <span style="color:#3ca9ec;">contacto@eollice.com</span></div>
					</div>
				</div>
				<div link="#FFF" vlink="#FFF" alink="#FFF" style="position:relative; font-family:Helvetica; text-align:center; color:#FFF; height:30px; line-height:30px; vertical-align:middle; padding:15px 0px 0px 0px;"><a href="#" style="color:#FFF;">Terminos y Condiciones</a>&nbsp;&nbsp;<a href="#" style="color:#FFF;">Privacidad</a></div>
			</div>
		</body>
		</html>';
		$this->mail->Body = $body;
		$this->mail->Send();
	}
	public function forgotmail($email,$token, $name){
		$this->mail->AddAddress($email,$name);
		$this->mail->FromName = "Eollice";
		$this->mail->Subject = "Soporte Eollice - Recuperacion de contraseña";
		$this->mail->WordWrap = 50;
		$body  = '<html>
		<body>
			<div style="padding:10px 20% 10px 20%; background:#329BD8; height:490px;  ">
				<img src="http://www.eollice.com/images/blue_white_logo.png" height="90" />
				<div style="position:relative; background:white; height:310px; padding:10px 20px 10px 20px; font-family:Helvetica; font-size:14px;">
					<div style="position:relative; height:35px; font-size:12px;">Hola, '.$name.'</div>
					<div style="position:relative; color:#333; height:45px; font-size:16px;">Recupera tu contraseña:</div><br>
					<div style="position:relative;">Recientemente has solicitado un cambio de contraseña para tu cuenta.<br></div>
					<div style="position:relative;">Para poder efectuar los cambios, haz click en el enlace a continuación para de esta forma redefinir tu contraseña.<br></div>
					<div style="position:relative;">Al efectuar los cambios en la plataforma, la nueva contraseña pasará a ser tu nueva credencial de ingreso.</div>
					<div style="position:relative; height:50px; padding-top:20px; padding-bottom:20px;">
						<div style="border: 1px #3ca9ec solid; border-radius:5px; background:#3ca9ec; color:white; height:40px; line-height:40px; vertical-align:middle; width:200px; text-align:center;"><a style="color:#FFF;" href="http://www.eollice.com/index.php?recoverToken='.$token.'">Recupera tu Contraseña >></a></div>
					</div>
					<div style="position:relative;">ATTE</div>
					<div style="position:relative;">Equipo Eollice<br><br></div>
					<div style="height:100px; background:#EEE; font-family:Helvetica;">
						<div style="float:left; width:60px; padding: 35px 0px 0px 20px; font-size:12px; height:20px; line-height:20px; vertical-align:middle;"><a href="http://www.facebook.com/eollice"><img src="http://www.eollice.com/images/otros/facebook.png" height="30" /></a><a href="http://www.twitter.com/eollice"><img src="http://www.eollice.com/images/otros/twitter.png" height="30" /></a></div>
						<div style="float:left; width:50px; padding: 35px 20px 0px 5px; font-size:13px; height:30px; line-height:30px; vertical-align:middle;">Siguenos</div>
						<div style="float:right; width:250px; padding: 35px 20px 0px 0px; font-size:12px;">Si tienes alguna duda responde este correo o escríbenos a: <span style="color:#3ca9ec;">contacto@eollice.com</span></div>
					</div>
				</div>
				<div style="position:relative; font-family:Helvetica; text-align:center; color:#000; font-size:10px;"><br>Estás recibiendo este email porque te eres parte de la comunidad Eollice http://www.eollice.com o eres uno de sus clientes activos. Recibes este correo debido a que solicitaste el servicio de cambio de contraseña o creaste cuenta nueva. Este correo es seguro, unico y personal.</div>
			</div>
		</body>
		</html>';
		$this->mail->Body = $body;
		$this->mail->Send();
	}
	public function transfer_mail($valor, $email, $codigo,$name){
		$this->mail->AddAddress($email,$name);
		$this->mail->FromName = "Eollice";
		$this->mail->Subject = "Confirmacion de Inversion - Instrucciones para transferencia bancaria";
		$this->mail->WordWrap = 50;
		$body  = '<html>
		<body>
			<div style="padding:10px 15% 10px 15%; background:#329BD8; height:490px;">
				<img src="http://www.eollice.com/images/blue_white_logo.png" height="90" />
				<div style="position:relative; background:white; height:310px; padding:10px 20px 10px 20px; font-family:Helvetica; font-size:14px;">
					<div style="position:relative; height:35px; font-size:16px;">Hola, '.$name.'</div>
					<div style="position:relative;">¡Felicitaciones por invertir en uno de los proyectos de energías renovables de Eollice!<br>
					<br>
					El monto de inversión que has ingresado ha sido incluida con éxito.<br>
					<br>
					Recuerda que tiene 24 horas para hacer la transferencia de dinero correspondiente a “Costo por Opción de Inversión” e “Inversión” por el valor de $'.number_format($valor,0,",",".").'. Si en 24 horas no haces la transferencia, eliminaremos tu inversión del fondo del financiamiento para que otros inversionistas puedan participar.<br>
					<br>
					Recuerda incluir el siguiente codigo '.$codigo.' en el asunto del mail de confirmacion que nos envies a contacto@eollice.com.<br>
					<br>
					Ademas los datos para la transferencia son los siguiente<br>
					<br>
					<b>Datos de la cuenta Eollice</b><br>
					<b>N° de Cuenta:</b> 44132150<br>
					<b>Banco:</b> Corpbanca<br>
					<b>Rut:</b> 76.321.252-1<br>
					<b>Tipo de Cuenta:</b> Corriente<br>
					<b>Razón Social:</b> Eollice SpA<br>
					<b>Mail:</b> contacto@eollice.com<br>
					<br>
					Cuando se haya reunido todo el financiamiento, se te informará las fechas de pago de la cuota correspondiente a un inversión. Todo esto se informará a través de correo electrónico.<br>
					<br>
					Si tienes alguna duda, nos puedes contactar a contacto@eollice.com.<br>
					<br>
					Saludos.<br>
					<br>
					Equipo Eollice.</div>
					<div style="height:100px; background:#EEE; font-family:Helvetica;">
						<div style="float:left; width:60px; padding: 35px 0px 0px 20px; font-size:12px; height:20px; line-height:20px; vertical-align:middle;"><a href="http://www.facebook.com/eollice"><img src="http://www.eollice.com/images/otros/facebook.png" height="30" /></a><a href="http://www.twitter.com/eollice"><img src="http://www.eollice.com/images/otros/twitter.png" height="30" /></a></div>
						<div style="float:left; width:50px; padding: 35px 20px 0px 5px; font-size:13px; height:30px; line-height:30px; vertical-align:middle;">Siguenos</div>
						<div style="float:right; width:250px; padding: 35px 20px 0px 0px; font-size:12px;">Si tienes alguna duda responde este correo o escríbenos a: <span style="color:#3ca9ec;">contacto@eollice.com</span></div>
					</div>
				</div>
				<div link="#FFF" vlink="#FFF" alink="#FFF" style="position:relative; font-family:Helvetica; text-align:center; color:#FFF; height:30px; line-height:30px; vertical-align:middle; padding:15px 0px 0px 0px;"><a href="#" style="color:#FFF;">Terminos y Condiciones</a>&nbsp;&nbsp;<a href="#" style="color:#FFF;">Privacidad</a></div>
			</div>
		</body>
		</html>';
		$this->mail->Body = $body;
		$this->mail->Send();
	}
	public function mail_inversion($email, $name){
		$this->mail->AddAddress($email,$name);
		$this->mail->FromName = "Eollice";
		$this->mail->Subject = "Confirmacion de Inversion - Instrucciones para transferencia bancaria";
		$this->mail->WordWrap = 50;
		$body  = '<html>
		<body>
			<div style="padding:10px 15% 10px 15%; background:#329BD8; height:490px;">
				<img src="http://www.eollice.com/images/blue_white_logo.png" height="90" />
				<div style="position:relative; background:white; height:310px; padding:10px 20px 10px 20px; font-family:Helvetica; font-size:14px;">
					<div style="position:relative; height:35px; font-size:16px;">Hola, '.$name.'</div>
					<div style="position:relative; color:#3ca9ec; height:45px; font-size:24px;">Confirmación de inversión.</div>
					<div style="position:relative;">¡Felicitaciones por invertir en uno de los proyectos de energías renovables de Eollice!<br>
					<br>
					Cuando se haya reunido todo el financiamiento, se te informará las fechas de pago de la cuota correspondiente a tu inversión. <br>
					Todo esto se informará a través de correo electrónico.<br>
					<br>
					Si tienes alguna duda, nos puedes contactar a contacto@eollice.com.<br>
					<br>
					Saludos.
					<br>
					Equipo Eollice.</div>
					<div style="height:100px; background:#EEE; font-family:Helvetica;">
						<div style="float:left; width:60px; padding: 35px 0px 0px 20px; font-size:12px; height:20px; line-height:20px; vertical-align:middle;"><a href="http://www.facebook.com/eollice"><img src="http://www.eollice.com/images/otros/facebook.png" height="30" /></a><a href="http://www.twitter.com/eollice"><img src="http://www.eollice.com/images/otros/twitter.png" height="30" /></a></div>
						<div style="float:left; width:50px; padding: 35px 20px 0px 5px; font-size:13px; height:30px; line-height:30px; vertical-align:middle;">Siguenos</div>
						<div style="float:right; width:250px; padding: 35px 20px 0px 0px; font-size:12px;">Si tienes alguna duda responde este correo o escríbenos a: <span style="color:#3ca9ec;">contacto@eollice.com</span></div>
					</div>
				</div>
				<div link="#FFF" vlink="#FFF" alink="#FFF" style="position:relative; font-family:Helvetica; text-align:center; color:#FFF; height:30px; line-height:30px; vertical-align:middle; padding:15px 0px 0px 0px;"><a href="#" style="color:#FFF;">Terminos y Condiciones</a>&nbsp;&nbsp;<a href="#" style="color:#FFF;">Privacidad</a></div>
			</div>
		</body>
		</html>';
		$this->mail->Body = $body;
		$this->mail->Send();
	}
}
?>