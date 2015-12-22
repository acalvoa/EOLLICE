<?php
if(!class_exists('webservice'))
{
	require_once('webservice.php');
}
require_once("../proyectos.php");
class inversion extends webservice{	
	private function get_info($id){
		//FUNCION DE SEGURIDAD
		if(!is_numeric($id)){
			die('ERROR DE SEGURIDAD');
		}
		//HACEMOS LA CADENA SEGURA
		$db =  new db_core();
		$retorno['proyecto'] = $db->reg_one("SELECT * FROM proyecto INNER JOIN resumen ON proyecto.id_proyecto = resumen.id_proyecto INNER JOIN imagenes_proyectos ON imagenes_proyectos.id_proyecto = proyecto.id_proyecto WHERE proyecto.id_proyecto='".$id."'");
		$retorno['ejecutor'] = $db->reg_one("SELECT * FROM compania_ejecutor AS c WHERE c.id_compania=(SELECT id_compania FROM proyecto as p WHERE p.id_proyecto='".$id."')");
		$retorno['usuario'] = $db->reg_one("SELECT * FROM datos_usuario AS c WHERE c.id_usuario=(SELECT id_usuario FROM proyecto as p WHERE p.id_proyecto='".$id."')");
		$retorno['inversion'] = $db->reg_one("SELECT IFNULL(SUM(monto_inversion),0) FROM inversion_proyecto AS p WHERE p.id_proyecto='".$id."' AND p.confirmado='1'");
		$retorno['inversion'][1] = $db->num_one("SELECT DISTINCT id_user FROM inversion_proyecto AS p WHERE p.id_proyecto='".$id."' AND p.confirmado='1'");
		$retorno['inversion']['porcentaje'] = number_format((($retorno['inversion'][0]/$retorno['proyecto']['monto_total'])*100),0);
		foreach ($retorno as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$retorno[$key][$key2] = utf8_encode($value2);
			}
		}
		return $retorno;
	}
	public function check_disponibilidad_final($data){
		sleep(1);
		$db =  new db_core();
		$retorno['proyecto'] = $db->reg_one("SELECT * FROM proyecto INNER JOIN resumen ON proyecto.id_proyecto = resumen.id_proyecto INNER JOIN imagenes_proyectos ON imagenes_proyectos.id_proyecto = proyecto.id_proyecto WHERE proyecto.id_proyecto='".$data->id."'");
		$monto = $db->reg_one("SELECT IFNULL(SUM(monto_inversion),0) FROM inversion_proyecto AS p WHERE p.id_proyecto='".$data->id."' AND p.confirmado='1'");
		$this->returnData(array(
			"total"=>$monto[0],
			"monto"=>$retorno['proyecto']['monto_total']
		));
	}
	public function lista_espera($data){
		sleep(2);
		$db =  new db_core();
		$valores['fecha'] = date('Y-m-d h:i:s');
		$valores['id_proyecto'] =  $data->id;
		$valores['id_user'] =  $this->get_user($_SESSION['token_user']);
		$db->insert('lista_espera',$valores);
		$this->returnData(array(
			"status"=>0
		));
	}
	public function add_bank($opt){
		$dbo = new db_core();
		$valores['id_user']= $this->get_user($_SESSION['token_user']);
		$valores['numero_cuenta_banco'] = $opt->numero;
		$valores['banco'] = $this->get_banco($opt->banco);
		$valores['tipo_de_cuenta'] = $opt->tipo;
		if(!$dbo->isExists_multi('cuentas_bancarias', $valores)){
			$dbo->insert('cuentas_bancarias',$valores);
			$listado = array();
			$bancos[0] = $dbo->db_query("SELECT * FROM cuentas_bancarias WHERE id_user='".$valores['id_user']."'");
			while($bancos[1] = mysql_fetch_array($bancos[0])){
				$total = $dbo->num_one("SELECT * FROM inversion_proyecto WHERE id_cuenta_bancaria='".$bancos[1]['id_cuenta']."'");
				$item['id_bank'] = $bancos[1]['id_cuenta'];
				$item['name'] = utf8_encode($bancos[1]['banco']." - Cta: ".$bancos[1]['numero_cuenta_banco']." (".$total." Invesiones activas)");
				$listado[] = (object)$item;
			}
			$this->returnData(array(
				"status"=>0,
				"data" =>json_encode($listado)
			));
		}
		else
		{
			$this->returnData(array(
				"status"=>1
			));
		}
		
	}
	public function fetch_banco($data){

		$dbo = new db_core();
		$bancos = $dbo->db_query("SELECT * FROM cuentas_bancarias WHERE id_cuenta='".$data->id_banco."'");
		$bancos = mysql_fetch_array($bancos, MYSQL_ASSOC);
		foreach ($bancos as $key => $value) {
			$bancos[$key] = utf8_encode($value);
		}
		echo json_encode($bancos);
	}
	private function get_banco($id_banco){
		$dbo = new db_core();
		$banco = $dbo->reg_one("SELECT nombre FROM listado_bancos AS l WHERE l.id_banco='".$id_banco."'");
		return $banco[0];
	}
	public function mod_bank($opt){
		$dbo = new db_core();
		$valores['banco'] = $this->get_banco($opt->banco);
		$valores['tipo_de_cuenta'] = $opt->tipo;
		$valores['numero_cuenta_banco'] = $opt->numero;
		$where['id_cuenta'] = $opt->id_cuenta;
		$dbo->update('cuentas_bancarias',$valores, $where);
		$listado = array();
		$bancos[0] = $dbo->db_query("SELECT * FROM cuentas_bancarias WHERE id_user='".$this->get_user($_SESSION['token_user'])."'");
		while($bancos[1] = mysql_fetch_array($bancos[0])){
			$total = $dbo->num_one("SELECT DISTINCT id_proyecto FROM inversion_proyecto WHERE id_cuenta_bancaria='".$bancos[1]['id_cuenta']."' WHERE estado='1'");
			$item['id_bank'] = $bancos[1]['id_cuenta'];
			$item['name'] = utf8_encode($bancos[1]['banco']." - Cta: ".$bancos[1]['numero_cuenta_banco']." (".$total." Invesiones activas)");
			$listado[] = (object)$item;
		}
		$this->returnData(array(
			"status"=>0,
			"data" =>json_encode($listado)
		));
	}
	public function posibleInvertir($opt){
		$db = new db_core();
		if(isset($_SESSION['token_user']) && $db->isExists('session_log','token', $_SESSION['token_user'])){
			$consulta = proyectos::get_info($opt->id);
			if(time() < strtotime($consulta['proyecto']['inicio_date'])){
				$this->returnData(array("status"=>"noinit"));
			}
			elseif(time() > strtotime($consulta['proyecto']['deadline'])){
				$this->returnData(array("status"=>"finish"));
			}
			elseif($consulta['proyecto']['deadline'] == 1){
				$this->returnData(array("status"=>"financiado"));	
			}
			else
			{
				$this->returnData(array("status"=>"ok"));		
			}
			
		}
		else
		{
			$this->returnData(array("status"=>"user"));
		}
	}
}
?>