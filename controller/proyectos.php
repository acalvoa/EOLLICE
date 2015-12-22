<?php
    @include_once("model/db_core.php");
    @include_once("model/webservice.php");
	class proyectos{
		static public function print_proyectos(){
			$db =  new db_core();
			$consulta[0] = $db->select("resumen","*", " ORDER BY id_proyecto DESC");
			while($consulta[1] = mysql_fetch_array($consulta[0])){
				$proyecto = proyectos::get_info($consulta[1]['id_proyecto']);
				$inversion[0] = $db->reg_one("SELECT IFNULL(SUM(monto_inversion),0), COUNT(*) FROM inversion_proyecto AS p WHERE p.id_proyecto='".$consulta[1]['id_proyecto']."'  AND p.confirmado='1'");
				$inversion[0][1] = $db->num_one("SELECT DISTINCT id_user FROM inversion_proyecto AS p WHERE p.id_proyecto='".$consulta[1]['id_proyecto']."'  AND p.confirmado='1'");
				$porcentaje = number_format(((($inversion[0][0])/$consulta[1]['monto_total'])*100),0);
				$text = '<div class="row fichaproyecto">
		            <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
		            	<div class="proyectobox">
		            		<div class="imagen">
		            			<div class="imagen-class"><img src="'.$proyecto['proyecto']['source'].'" class="img-thumbnail" /></div>';
		        if($proyecto['proyecto']['financiado'] == 1){
		        	$text .= '<div class="membrete-class"><img src="images/platform/membrete.png" class="img-thumbnail" /></div>';
		        }
		        $text .=' </div>
		            		<div class="detalles">
		            			<div class="titulo"><h3>'.utf8_encode($consulta[1]['titulo']).'</h3></div>
		            			<div class="bajada1">
		            				<div class="info1">
		            					<div class="titulo">Tasa de Interés:</div>
		            					<div class="detalle">'.utf8_encode($consulta[1]['tasa_interes_anual']).'%</div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Plazo de retorno:</div>
		            					<div class="detalle">'.utf8_encode($consulta[1]['plazo']).' Meses</div>
		            				</div>
		            			</div>
		            			<div class="bajada2">
		            				<div class="info2">
		            					<div class="monto">Monto:</div>
		            					<div class="detalle">$'.number_format($consulta[1]['monto_total'],0,",",".").'</div>
		            				</div>
		            				<div class="info3">
		            					<div class="inversionista">Inversionistas:</div>
		            					<div class="detalle">'.$inversion[0][1].'</div>
		            				</div>';
		        if(strtotime($proyecto['proyecto']['inicio_date']) > time()){
		        	$horas = floor((strtotime($proyecto['proyecto']['inicio_date'])-time())/3600);
		        	$minutos = floor(((strtotime($proyecto['proyecto']['inicio_date'])-time())%3600)/60);
		        	$segundos = ((strtotime($proyecto['proyecto']['inicio_date'])-time())%3600)%60;
		        	$text .= '<div class="info4">
    					<div class="tiempo">Comienza en:</div>
    					<div class="detalle Time init" initnumber="'.strtotime($proyecto['proyecto']['inicio_date']).'" deadnumber="'.strtotime($proyecto['proyecto']['deadline']).'">'.$horas.'h:'.$minutos.'m:'.$segundos.'s</div>
    				</div>';
		        }else{
		        	$horas = floor((strtotime($proyecto['proyecto']['deadline'])-time())/3600);
		        	$horas = ($horas <= 0)?0:$horas;
		        	$minutos = floor(((strtotime($proyecto['proyecto']['deadline'])-time())%3600)/60);
		        	$minutos = ($minutos <= 0)?0:$minutos;
		        	$segundos = ((strtotime($proyecto['proyecto']['deadline'])-time())%3600)%60;
		        	$segundos = ($segundos <= 0)?0:$segundos;
		        	$text .= '<div class="info4">
    					<div class="tiempo d">Plazo para invertir:</div>
    					<div class="detalle Time dead" initnumber="'.strtotime($proyecto['proyecto']['inicio_date']).'" deadnumber="'.strtotime($proyecto['proyecto']['deadline']).'"">'.$horas.'h:'.$minutos.'m:'.$segundos.'s</div>
    				</div>';
		        }    				
		        $text .= '</div>
		            			<div class="barra">
		            				<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="'.$porcentaje.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%;">
									    <span class="sr-only">'.$porcentaje.'% Financiado</span>
									  </div>
									</div>
		            			</div>';
    			if(strtotime($proyecto['proyecto']['inicio_date']) > time()){
			        $text .= '<div class="btn-inversion">
			            				<button type="button" class="btn btn-primary btn-lg button-invertir"  data="inversion.php?id='.$consulta[1]['id_proyecto'].'">Conoce más</button>
			            			</div>
			            		</div>
			            	</div>
			            </div>
			        </div>';
		    	}
		    	else
		    	{
		    		$text .= '<div class="btn-inversion">
			            				<button type="button" class="btn btn-primary btn-lg button-invertir" data="inversion.php?id='.$consulta[1]['id_proyecto'].'">Conoce más</button>
			            			</div>
			            		</div>
			            	</div>
			            </div>
			        </div>';	
		    	}
		        echo $text;
			}
		}
		static public function get_info($id){
			//FUNCION DE SEGURIDAD
			if(!is_numeric($id)){
				die('ERROR DE SEGURIDAD');
			}
			//HACEMOS LA CADENA SEGURA
			$db =  new db_core();
			$retorno['proyecto'] = $db->reg_one("SELECT * FROM proyecto INNER JOIN resumen ON proyecto.id_proyecto = resumen.id_proyecto INNER JOIN imagenes_proyectos ON imagenes_proyectos.id_proyecto = proyecto.id_proyecto WHERE proyecto.id_proyecto='".$id."' ");
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
		static public function get_last_proyect(){
			//HACEMOS LA CADENA SEGURA
			$db =  new db_core();
			$retorno['proyecto'] = $db->reg_one("SELECT * FROM proyecto INNER JOIN resumen ON proyecto.id_proyecto = resumen.id_proyecto INNER JOIN imagenes_proyectos ON imagenes_proyectos.id_proyecto = proyecto.id_proyecto ORDER BY proyecto.id_proyecto DESC");
			$retorno['inversion'] = $db->reg_one("SELECT IFNULL(SUM(monto_inversion),0) FROM inversion_proyecto AS p WHERE p.id_proyecto='".$retorno['proyecto']['id_proyecto']."' AND p.confirmado='1'");
			$retorno['inversion'][1] = $db->num_one("SELECT DISTINCT id_user FROM inversion_proyecto AS p WHERE p.id_proyecto='".$retorno['proyecto']['id_proyecto']."' AND p.confirmado='1'");
			$retorno['inversion']['porcentaje'] = number_format((($retorno['inversion'][1]/$retorno['proyecto']['monto_total'])*100),0);
			foreach ($retorno as $key => $value) {
				foreach ($value as $key2 => $value2) {
					$retorno[$key][$key2] = utf8_encode($value2);
				}
			}
			return $retorno;
		}
		static public function get_bancos(){
			$db =  new db_core();
			$bancos = array();
			$consulta[0] = $db->db_query("SELECT * FROM listado_bancos ORDER BY nombre ASC");
			while($consulta[1] = mysql_fetch_array($consulta[0])){
				$bancos[] = $consulta[1];
			}
			return $bancos;
		}	
		static public function get_cuentas(){
			$db =  new db_core();
			$webservice = new webservice();
			$cuentas = array();
			$consulta[0] = $db->db_query("SELECT * FROM cuentas_bancarias AS c WHERE c.id_user='".$webservice->get_user($_SESSION['token'])."'");
			while($consulta[1] = mysql_fetch_array($consulta[0])){
				$cantidad = $db->reg_one("SELECT COUNT(*) FROM inversion_proyecto AS i WHERE i.id_cuenta_bancaria='".$consulta[1][0]."' AND i.confirmado='1'");
				if($consulta[1]['tipo_de_cuenta'] == 0){
					$consulta[1]['tipo_de_cuenta'] = "Cuenta Corriente";
				}
				elseif($consulta[1]['tipo_de_cuenta'] == 1){
					$consulta[1]['tipo_de_cuenta'] = "Cuenta Vista";
				}
				$consulta[1]['banco'] = utf8_encode($consulta[1]['banco']);
				$consulta[1]['cantidad'] = $cantidad[0];
				$cuentas[] = $consulta[1];

			}
			return $cuentas;
		}
		static public function get_proyecto($inv){
			$db =  new db_core();
			$consulta = $db->reg_one("SELECT id_proyecto FROM inversion_proyecto WHERE inversion_proyecto.token_transaccion='".$inv."'");
			return $consulta[0];
		}
		static public function get_data_inv($inv){
			$db =  new db_core();
			$proyecto = proyectos::get_info(proyectos::get_proyecto($inv));
			$consulta = $db->reg_one("SELECT * FROM inversion_proyecto WHERE inversion_proyecto.token_transaccion='".$inv."'");
			$consulta['coi'] = $consulta['monto_inversion']*0.01;
			$consulta['utilidad'] = (proyectos::pago_mensual($consulta['monto_inversion'],$proyecto['proyecto']['tasa_interes_anual'],$proyecto['proyecto']['plazo'])*0.992)*$proyecto['proyecto']['plazo']-($consulta['monto_inversion']*1.01);
			$cuota_m = proyectos::pago_mensual($proyecto['proyecto']['monto_total'],$proyecto['proyecto']['tasa_interes_anual'],$proyecto['proyecto']['plazo']);
			return $consulta;
		}
		static function sumatoria($t,$n,$r){
			if($t <= $n){
				$value = 1/(pow((1+($r/100)),$t));
				$t++;
				return $value + proyectos::sumatoria($t,$n,$r);
			}
			else
			{
				return 0;
			}
		}
		static function pago_mensual($inversion,$tasa,$plazo){
			$tasa_m = $tasa/12;
			return $inversion/proyectos::sumatoria(1,$plazo,$tasa_m);
		}
	}
?>