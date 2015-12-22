<?php
if(!class_exists('webservice'))
{
	require_once('webservice.php');
}
class simulacion extends webservice
{
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
	public function indicadores($data){
		$datos = $this->get_info($data->id);
		$indicadores = array();
		$indicadores['tasa'] = $datos['proyecto']['tasa_interes_anual'];
		$indicadores['plazo'] =  $datos['proyecto']['plazo'];
		$indicadores['id'] =  $data->id;
		$indicadores['monto'] =  $datos['proyecto']['monto_total'];
		$indicadores['invertido'] = $datos['inversion'][0];
		echo json_encode((object)$indicadores);
	}
	public function check_disponibilidad($data){
		sleep(1);
		$db =  new db_core();
		$retorno['proyecto'] = $db->reg_one("SELECT * FROM proyecto INNER JOIN resumen ON proyecto.id_proyecto = resumen.id_proyecto INNER JOIN imagenes_proyectos ON imagenes_proyectos.id_proyecto = proyecto.id_proyecto WHERE proyecto.id_proyecto='".$data->id."'");
		$monto = $db->reg_one("SELECT IFNULL(SUM(monto_inversion),0) FROM inversion_proyecto AS p WHERE p.id_proyecto='".$data->id."' AND p.confirmado='1'");
		$this->returnData(array(
			"total"=>$monto[0],
			"monto"=>$retorno['proyecto']['monto_total']
		));
	}
}
?>