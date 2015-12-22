<?php
	include("controller/proyectos.php");
	$info_proyecto = proyectos::get_info($_GET['id']);
	date_timezone_set("America/Santiago");
	$GMT = 4;
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=479830965428140";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<section class="background_page">&nbsp;</section>
<section class="inversion">
	<div class="container">
        <div class="row visible-lg visible-md">
            <div class="col-md-11 col-lg-11 titulo seguidor">
            	<a href="index.php">Inicio > </a> <a href="proyectos.php">Proyectos de Inversion > </a>
            </div>
            <div class="col-md-12 col-lg-12 col-padding tabulado">
            	<div class="col-md-12 col-lg-12 tabs" style="padding:0 0 0 0;">
	            	<div class="col-md-4 col-lg-4 active suptabs" data="proyecto"><numero><div>1</div></numero> <tabtitle> El Proyecto</tabtitle></div>
	            	<div class="col-md-4 col-lg-4 suptabs simulacion_tabs_data" data="simulacion"><numero><div>2</div></numero> <tabtitle> Simulación</tabtitle></div>
	            	<div class="col-md-4 col-lg-4 inversiontab" data="tuinversion"><numero><div>3</div></numero> <tabtitle> Tu Inversión</tabtitle></div>
	            </div>
	            <div class="col-md-12 col-lg-12  proyecto content-tabs" style="padding:0 0 0 0;">
	            	<div class="col-md-12 col-lg-12 titulos"><h4><?php echo $info_proyecto['proyecto']['titulo']; ?></h4></div>
	            	<div class="row col-padding">
		            	<div class="col-md-3 col-lg-3">
		            		<div class="col-md-12 col-lg-12" style="padding:0 0 0 0; margin-bottom:20px;">
		            			<div class="foto-proyecto">
		            				<div class="imagen-class"><img src="<?php echo $info_proyecto['proyecto']['source'];?>" class="img-thumbnail"/></div>
		            				<?php
		            				if($info_proyecto['proyecto']['financiado'] == 1){
		            					echo '<div class="membrete-class"><img src="images/platform/membrete.png" class="img-thumbnail" /></div>';
		            				}
		            				?>
		            			</div>
		            		</div>
		            		<div class="col-md-5 col-lg-5">
		            			<div class="fb-like" data-href="http://www.eollice.com/inversion.php?id=<?php echo $info_proyecto['proyecto']['id_proyecto']; ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div>
		            		</div>
		            		<div class="col-md-7 col-lg-7">
		            			    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="es" data-size="large">Twittear</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		            				<a href="https://twitter.com/Eollice" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="large">Seguir a @Eollice</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		            		</div>
		            	</div>
		            	<div class="col-md-9 col-lg-9">
		            		<div class="col-md-12 col-lg-12 descripcion"> 
		            			<h5><?php echo $info_proyecto['proyecto']['breve_descripcion']; ?></h5>
		            		</div>
		            		<div class="col-md-8 col-lg-8">
		            			<div class="row">
			            			<div class="col-md-3 col-lg-3 border-right" style="padding:0 10px 0 0;"><center><h2><?php echo number_format($info_proyecto['proyecto']['tasa_interes_anual'],0,",","."); ?>%</h2></center><span class="tooltips-big" data-toggle="tooltip" data-placement="bottom" title="Tasa de Interes: Es la tasa que se le cobrará al usuario del proyecto en el préstamo que accede a través de Eollice"><i class="fa fa-question"></i></span><h5><center>Tasa de Interés Anual</center></h5></div>
			            			<div class="col-md-3 col-lg-3 border-right"><center><h2><?php echo number_format($info_proyecto['proyecto']['plazo'],0,",","."); ?> </h2></center><span class="tooltips-big" data-toggle="tooltip" data-placement="bottom" title="Meses de Plazo: Es el plazo en que el usuario pagará el préstamo que obtiene a través de Ellice. El pago es mensual."><i class="fa fa-question"></i></span><h5><center>Meses de Plazo</center></h5></div>
			            			<div class="col-md-6 col-lg-6" id="montototal-proyecto"><center><h2>$<?php echo number_format($info_proyecto['proyecto']['monto_total'],0,",","."); ?></h2></center><h5><center>Monto Total</center></h5></div>
		            			</div>
		            			<div class="row progressbar">
		            				<div class="col-md-12 col-lg-12"> 
		            					<div class="progress">
										  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $info_proyecto['inversion']['porcentaje']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $info_proyecto['inversion']['porcentaje']; ?>%;">
										    <span class="sr-only">60% Completado</span>
										  </div>
										</div>
		            				</div>
		            			</div>
		            			<div class="row progressbar">
		            				<div class="col-md-12 col-lg-12"> 
		            					<div class="col-md-2 col-lg-2"><h6><center><?php echo number_format($info_proyecto['inversion']['porcentaje'],0,",","."); ?> %</center></h6><h7><center>Financiado</center></h7></div>
				            			<div class="col-md-2 col-lg-2"><h6><center><?php echo number_format($info_proyecto['proyecto']['tir'],0,",","."); ?>% </center></h6><span class="tooltips-big" data-toggle="tooltip" data-placement="bottom" title="TIR: (Tasa Interna de Retorno) Es la tasa que ve el inversionista al invertir su dinero en Eollice."><i class="fa fa-question"></i></span><h7><center>TIR</center></h7></div>
				            			<div class="col-md-3 col-lg-3"><h6><center><?php echo number_format($info_proyecto['inversion'][1],0,",","."); ?></center></h6><h7><center>Inversionistas</center></h7></div>
				            			<div class="col-md-3 col-lg-3" id="invertido-proyecto"><h6><center>$<?php echo number_format($info_proyecto['inversion'][0],0,",","."); ?></center></h6><h7><center>Financiado</center></h7></div>
				            			<div class="col-md-2 col-lg-2 " style="padding:0 0 0 0;"><h6><center><?php
				            				//DEFINIMOS EL CONTADOR 
				            				if((date("z",strtotime($info_proyecto['proyecto']['deadline']))-date("z",time())) < 0)
				            				{
				            					echo " 0 días";
				            				}
				            				elseif((date("z",strtotime($info_proyecto['proyecto']['deadline']))-date("z",time())) == 0)
				            				{	
				            					$inicial = date_create($info_proyecto['proyecto']['deadline']);
				            					echo (date("G",strtotime($info_proyecto['proyecto']['deadline'])) - date("g",time()))." horas";
				            				}				            				
				            				else
				            				{
				            					echo (date("z",strtotime($info_proyecto['proyecto']['deadline']))+1-date("z",time()))." días";
				            				}
				            			?></center></h6><h7><center>Restantes</center></h7></div>
		            				</div>
		            			</div>
		            		</div>
		            		<div class="col-md-4 col-lg-4">
		            			<?php 

		            			if($info_proyecto['proyecto']['financiado'] == 1){
		            				echo '<div class="row">
		            				<center><button class="btn btn-primary btn-lg" id="boton-otro-proyecto"><h5><b>Buscar otro proyecto</b></h5><span style="font-size:12px;"></span></button></center>
			            			</div>
			            			<div class="row costo infos-costos">
			            				<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> 
				            				<h4 style="height:10px;"><b>Proyecto Financiado</b></h4>
											<div style="font-size:1em; margin-top:20px;">Te invitamos a invertir en otro proyecto.</div>
										</div>
			            			</div>';
		            			}
		            			elseif($info_proyecto['inversion'][0] == $info_proyecto['proyecto']['monto_total']){
		            				echo '<div class="row">
		            				<center><button class="btn btn-primary btn-lg" id="boton-lista-espera"><h5><b>Lista de Espera</b></h5><span style="font-size:12px;"></span></button></center>
			            			</div>
			            			<div class="row costo infos-costos">
			            				<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> 
				            				<h4 style="height:10px;"><b>Inversión Alcanzada</b></h4>
											<div style="font-size:1em; margin-top:20px;">Te avisaremos cuando se abra un cupo para invertir.</div>
										</div>
			            			</div>';
		            			}
		            			elseif((strtotime($info_proyecto['proyecto']['deadline'])-time()) <= 0){
		            				echo '<div class="row">
		            				<center><button class="btn btn-primary btn-lg" id="boton-lista-espera"><h5><b>Lista de Espera</b></h5><span style="font-size:12px;"></span></button></center>
			            			</div>
			            			<div class="row costo infos-costos">
			            				<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> 
				            				<h4 style="height:10px;"><b>Plazo Alcanzado</b></h4>
											<div style="font-size:1em; margin-top:20px;">Te avisaremos si se extiende el plazo de inversión.</div>
										</div>
			            			</div>';
		            			}
		            			elseif(strtotime($info_proyecto['proyecto']['inicio_date']) > time()){
		            				$horas = floor((strtotime($info_proyecto['proyecto']['inicio_date'])-time())/3600);
						        	$minutos = floor(((strtotime($info_proyecto['proyecto']['inicio_date'])-time())%3600)/60);
						        	$segundos = ((strtotime($info_proyecto['proyecto']['inicio_date'])-time())%3600)%60;
		            				echo '<div class="row">
		            				<center><button class="btn btn-primary btn-md" id="boton-simulacion" style="width:200px; "><h4 style="margin-top:5px; margin-bottom:5px;"><b><center>Siguiente</center></b></h4><span style="font-size:16px;">Simula tu inversión</span></button></center>
			            			</div>
			            			<div class="row costo infos-costos">
			            				<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> 
				            				<h4 style="height:10px;"><b>Pronto a Comenzar</b></h4>
											<div style="font-size:1em; margin-top:20px;">Quedan: <span class="timer counter-central" number="'.strtotime($info_proyecto['proyecto']['inicio_date']).'">'.$horas.'h:'.$minutos.'m:'.$segundos.'s</span></div>
											<div style="font-size:1em; margin-top:0px;">Para comenzar a invertir.</div>
										</div>
			            			</div>';
		            			}
		            			elseif($info_proyecto['inversion'][0] < $info_proyecto['proyecto']['monto_total']){
		            				echo '<div class="row">
		            				<center><button class="btn btn-primary btn-md" id="boton-simulacion" style="width:200px; "><h4 style="margin-top:5px; margin-bottom:5px;"><b><center>Siguiente</center></b></h4><span style="font-size:16px;">Simula tu inversión</span></button></center>
			            			</div>
			            			<div class="row costo infos-costos">
			            				<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> 
				            				<h4 style="height:10px;">Costo de Inversión</h4>
											<h2>$100</h2>
											<h6 style="font-size:1.2em;">Por cada $10.000 pesos de inversión.</h6>
										</div>
			            			</div>';
		            			}
		            			?>
		            		</div>
		            	</div>
		            </div>
	            	<div class="row resumen col-padding	">
	            		<div class="col-md-10 col-lg-10" style="padding-right:2px;">
	            			<div class="col-md-3 tab">
	            				<ul>
		            				<li class="active tabsmenu" data="resumen_info">Proyecto</li>
		            				<li class="tabsmenu" data="usuario_info">Usuario del Proyecto</li>
		            				<li class="tabsmenu" data="empresa_info">Empresa Ejecutora</li>
		            				<li class="tabsmenu" data="pagos_info">Pagos</li>
		            			</ul>
	            			</div>
	            			<div class="col-md-9 content" style="padding:0 0 0 0;">
	            				<div class="resumen_info tabsinfo">
	            					<div class="info1">
		            					<div class="titulo">Tecnología:</div>
		            					<div class="valor"><?php echo $info_proyecto['proyecto']['tecnologia']; ?></div>
		            					<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Tecnología: Es el equipo que hará la conversión desde una fuente renovable a energía eléctrica útil (Solar Fotovoltaica, Eólico, entre otros)."><i class="fa fa-question"></i></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Tamaño:</div>
		            					<div class="valor"><?php echo number_format($info_proyecto['proyecto']['tamano'],0,",","."); ?> kW</div>
		            					<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Tamaño: Es la cantidad de potencia instalada que el proyecto es capaz de entregar en condiciones ideales de construcción de los equipos."><i class="fa fa-question"></i></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Energía Anual Estimada:</div>
		            					<div class="valor"><?php echo number_format($info_proyecto['proyecto']['energia_anual'],0,",","."); ?> kWh</div>
		            					<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Energía anual estimada: Es la energía que el proyecto inyectará al usuario durante todo el año."><i class="fa fa-question"></i></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Toneladas Anuales de CO2 Evitadas:</div>
		            					<div class="valor"><?php echo number_format($info_proyecto['proyecto']['toneladas_co2'],0,",","."); ?> Ton.</div>
		            					<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Toneladas anuales de CO2 evitadas: Es la cantidad de contaminantes que el proyecto evitará que se emitan a nuestro medio ambiente."><i class="fa fa-question"></i></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Marca del Equipo:</div>
		            					<div class="valor"><?php echo $info_proyecto['proyecto']['marca_equipo']; ?></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Garantias de los Equipos (Años):</div>
		            					<div class="valor"><?php echo $info_proyecto['proyecto']['garantia_equipo']; ?> Años</div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Marca del Inversor:</div>
		            					<div class="valor"><?php echo $info_proyecto['proyecto']['marca_inversor']; ?></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Garantia del Inversor:</div>
		            					<div class="valor"><?php echo $info_proyecto['proyecto']['garantia_inversor']; ?></div>
		            				</div>
	            				</div>
	            				<div class="usuario_info tabsinfo">
	            					<div class="info1">
		            					<div class="titulo">Nombre:</div>
		            					<div class="valor"><?php echo $info_proyecto['usuario']['nombre']; ?></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Ubicacion:</div>
		            					<div class="valor"><?php echo $info_proyecto['usuario']['ubicacion']; ?></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Tipo de Usuario:</div>
		            					<div class="valor">
		            						<?php 
			    								if($info_proyecto['usuario']['tipo_usuario'] == 0){
			    									echo "Autoconsumo";
			    								}
			    								elseif($info_proyecto['usuario']['tipo_usuario'] == 1){
			    									echo "PMGD";
			    								}
			    								elseif($info_proyecto['usuario']['tipo_usuario'] == 2){
			    									echo "Comunidad Aislada";
			    								}
			    							?>
		            					</div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Breve Descripción:</div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="infobrevedescripcion">
		            				<?php echo $info_proyecto['usuario']['breve_descripcion']; ?>
		            				</div>
	            				</div>
	            				<div class="empresa_info tabsinfo">
	            					<div class="info1">
		            					<div class="titulo">Nombre:</div>
		            					<div class="valor"><?php echo $info_proyecto['ejecutor']['nombre']; ?></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Proyectos Realizados:</div>
		            					<div class="valor"><?php echo $info_proyecto['ejecutor']['proyectos_realizados']; ?></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo">Potencia Instalada a la Fecha:</div>
		            					<div class="valor"><?php echo number_format($info_proyecto['ejecutor']['potencia_instalada'],0,",","."); ?> kW</div>
		            					<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Potencia instalada a la fecha: Es la cantidad de potencia que el desarrollador del proyecto ha instalado tanto en Chile como en otros lados del mundo."><i class="fa fa-question"></i></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo">Página Web:</div>
		            					<div class="valor"><a href="<?php echo $info_proyecto['ejecutor']['pagina_web']; ?>"><?php echo $info_proyecto['ejecutor']['pagina_web']; ?></a></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
	            				</div>
	            				<div class="pagos_info tabsinfo">
	            					<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info1">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
		            				<div class="info2">
		            					<div class="titulo"></div>
		            					<div class="valor"></div>
		            				</div>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-2 col-lg-2" style="padding:0 3px 0 0; ">
	            			<div class="info-detallada">
	            			<a href="<?php echo $info_proyecto['proyecto']['info_detail']; ?>" target="_blank"><img src="images/platform/pdf-icon.png" height="50" /></a>
	            			<h6>Oferta de Inversión Detallada</h6>
	            			</div>
	            			<br>
	            			<div class="info-detallada">
	            			<a href="<?php echo $info_proyecto['proyecto']['contrato']; ?>" target="_blank"><img src="images/platform/pdf-icon.png" height="50"/></a>
	            			<h6>Ver el contrato</h6>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div class="col-md-12 col-lg-12 simulacion content-tabs" >
	            	<div class="row col-marging-20 detalles">
	            		<div class="row">
	            			<div class="col-md-12 col-lg-12"><h4>Detalles de la Simulación</h4></div>
	            		</div>
	            		<div class="row">
	            			<div class="col-md-3 col-lg-3"><h3>Monto a Invertir*</h3><h5>(Mínimo $10.000)</h5></div>
	            			<div class="col-md-8 col-lg-8">
	            				<div class="input-group" id="montoinversion">
								  <span class="input-group-addon">$</span>
								  <input type="text" class="form-control input-lg" placeholder="Monto a Invertir" id="montoinversion_input" value="10000">
								</div>
							</div>
	            		</div>
	            		<div class="row infodetalles">
		            		<div class="col-md-3 col-lg-3">
		            			<div class="titulo"><h4>Tasa de Interés</h4></div>
			            		<div class="valor"><h4><?php echo number_format($info_proyecto['proyecto']['tasa_interes_anual'],0,",","."); ?>%</h4></div>
			            	</div>
			            	<div class="col-md-2 col-lg-2">
		            			<div class="titulo"><h4>TIR</h4></div>
			            		<div class="valor"><h4><?php echo number_format($info_proyecto['proyecto']['tir'],0,",","."); ?>%</h4></div>
			            	</div>
			            	<div class="col-md-4 col-lg-4" style="padding-top:2px;">
		            			<h5>*El monto debe ser múltiplo de 10.000</h5>
			            	</div>
	            		</div>
	            		<div class="row simulacion_box">
	            			<div class="row">
		            			<div class="col-md-5 col-lg-5">
		            				<div class="row">
		            					<div class="col-md-7 col-lg-7">
		            						<h3>Tú ganarás:</h3>
		            					</div>
		            					<div class="col-md-5 col-lg-5" id="uticredi_data">
		            						<h3>$0</h3>
		            					</div>
		            				</div>
		            				<div class="row" style="height:10px;">
		            					<div class="col-md-7 col-lg-7">
		            						<h5>Costo Opción de Inversión</h5>
		            					</div>
		            					<div class="col-md-5 col-lg-5" id="coi_data">
		            						<h5>$0</h5>
		            					</div>
		            				</div>	
		            			</div>
		            			<div class="col-md-5 col-lg-5 botondeinvertir">
		            				<?php
		            					if(date("z",(strtotime($info_proyecto['proyecto']['deadline'])-time())) == 0){
				            				echo '<button class="btn btn-primary btn-lg" id="boton-lista-espera_2"><h5><b>Lista de Espera</b></h5><span style="font-size:12px;"></span></button>';
				            			}
				            			elseif(strtotime($info_proyecto['proyecto']['inicio_date']) > time()){
				            				$horas = floor((strtotime($info_proyecto['proyecto']['inicio_date'])-time())/3600);
								        	$minutos = floor(((strtotime($info_proyecto['proyecto']['inicio_date'])-time())%3600)/60);
								        	$segundos = ((strtotime($info_proyecto['proyecto']['inicio_date'])-time())%3600)%60;
				            				echo '<button class="btn btn-primary btn-lg" id="boton-invertir" disabled="disabled"><h5><b><center>Empieza en : <span class="timer btn-inv" number="'.strtotime($info_proyecto['proyecto']['inicio_date']).'">'.$horas.'h:'.$minutos.'m:'.$segundos.'s</span></center></b></h5><span style="font-size:12px;"></span></button>';
				            			}
				            			else{
				            				echo '<button class="btn btn-primary btn-lg" id="boton-invertir"><h5><b><center>Invierte en este proyecto</center></b></h5><span style"font-size:12px;"></span></button>';
				            			}
		            				?>
		            			</div>
	            			</div>
	            			<div class="row">
	            				<div class="col-md-12 col-lg-12">
	            				<h6>El Costo por opción de inversión sera pagado junto con la transferencia de dinero que deseas invertir.</h6>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row col-marging-20 titulos"><h4>Costo de la Inversión</h4></div>
	            	<div class="row col-marging-20 costo">
	            		<div class="col-md-12 col-lg-12 info1">
	            			<div class="titulo">Costo por Opción de Inversión:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Costo por Opción de Inversión: Es el cobro que hace Eollice al inversionista por acceder a invertir en este proyecto."><i class="fa fa-question" ></i></div></div>
		           			<div class="valor" id="coi2_data">$0</div>
	            		</div>
	            		<div class="col-md-12 col-lg-12 info2">
	            			<div class="titulo">Gastos de Administración Mensual:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Gastos de Administración: cobro que se realiza por el servicio de cobro de cuota al dueño del proyecto renovable y de transferencia a tu cuenta de banco asociada a la inversión."><i class="fa fa-question"></i></div></div>
		           			<div class="valor" id="gda_data">$0</div>
		           		</div>
	            	</div>
	            	<div class="row col-marging-20 titulos"><h4>Retornos de la Inversión</h4></div>
	            	<div class="row col-marging-20 retornos">
	            		<div class="col-md-12 col-lg-12 info1">
	            			<div class="titulo">Tasa Interna de Retorno Anual:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="TIR: (Tasa Interna de Retorno) Es la tasa que ve el inversionista al invertir su dinero en Eollice."><i class="fa fa-question"></i></div></div>
		           			<div class="valor"><?php echo number_format($info_proyecto['proyecto']['tir'],0,",","."); ?>%</div>
	            		</div>
	            		<div class="col-md-12 col-lg-12 info2">
	            			<div class="titulo">Plazo para Recuperar la Inversión:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Plazo para Recuperar la Inversión: Tiempo, en meses, que tardas en recuperar el dinero invertido. Por ejemplo si el tiempo de recuperación es 40 meses, es porque en el 40° mes se te habrá depositado el equivalente a tú inversión."><i class="fa fa-question"></i></div></div>
		           			<div class="valor" id="trecupe_data">0 Meses</div>
		           		</div>
	            		<div class="col-md-12 col-lg-12 info1">
	            			<div class="titulo">Cuota Mensual:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Cuota Mensual: es el dinero que se te depositará mes a mes por haber invertido en el proyecto. Este valor ya considera el descuento por Gastos de Administración."><i class="fa fa-question"></i></div></div>
		           			<div class="valor" id="cmensual_data">$0</div>
		           		</div>
	            		<div class="col-md-12 col-lg-12 info2">
	            			<div class="titulo">Utilidades al Final del Credito:<div class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Utilidades al Final del Crédito: Es la ganancia obtenida en el proceso de inversión al final del periodo de dicha inversión."><i class="fa fa-question"></i></div></div>
		           			<div class="valor" id="uticredi2_data">$0</div>
		           		</div>
	            	</div>
	            </div>
	            <div class="col-md-12 col-lg-12 tuinversion content-tabs">
	            	<div class="row resumen col-padding">
	            		<div class="col-md-6 col-lg-6 col-padding-20">
	            			<div class="inversion_resumen">
	            				<div class="row" style="height:45px;">
	            					<div class="col-md-12 col-lg-12 col-padding-20 cabecera-inv">
	            						<h5>Tu Inversión</h5>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-md-12 col-lg-12 datos-resumen col-padding-20" >
	            						<div class="titulo"><h5>Monto a Invertir: </h5></div><div class="valor" id="monto_invertir"><h5><?php echo number_format($info_proyecto['proyecto']['tasa_interes_anual'],0,",","."); ?>%</h5></div>
	            						<div class="titulo"><h5>Tasa de Interes Anual: </h5></div><div class="valor" ><h5><?php echo number_format($info_proyecto['proyecto']['tasa_interes_anual'],0,",","."); ?>%</h5></div>
	            						<div class="titulo"><h5>Tasa de Retorno Interno: </h5></div><div class="valor"><h5><?php echo number_format($info_proyecto['proyecto']['tir'],0,",","."); ?>%</h5></div>
	            						<div class="titulo"><h5>Tú Ganarás: </h5></div><div class="valor" id="ganaras_invertir"><h5>100%</h5></div>
	            						<div class="titulo"><h5>Costo de Inversión: </h5></div><div class="valor" id="coi_invertir"><h5>100%</h5></div>
	            					</div>
	            				</div>
	            			</div>
	            		</div>
	            		<div class="col-md-6 col-lg-6 col-padding">
	            			<div class="inversion_proyecto">
	            				<div class="row " style="height:45px;">
	            					<div class="col-md-12 col-lg-12 col-padding-20 cabecera-resu">
	            						<h5><?php echo $info_proyecto['proyecto']['titulo']; ?></h5>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-md-6 col-lg-6 col-padding-20">
	            						<img src="<?php echo $info_proyecto['proyecto']['source'];?>" class="img-thumbnail"/>
	            					</div>
	            					<div class="col-md-6 col-lg-6 datos-resumen" style="padding:0 0 0 0;">
	            						<div class="titulo"><h5>Tasa de Interes: </h5></div><div class="valor"><h5><?php echo number_format($info_proyecto['proyecto']['tasa_interes_anual'],0,",","."); ?>%</h5></div>
	            						<div class="titulo"><h5>Meses de Plazo: </h5></div><div class="valor"><h5><?php echo number_format($info_proyecto['proyecto']['plazo'],0,",","."); ?></h5></div>
	            						<div class="titulo"><h5>Monto Total: </h5></div><div class="valor"><h5>$<?php echo number_format($info_proyecto['proyecto']['monto_total'],0,",","."); ?></h5></div>
	            					</div>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row cuenta_bancaria">
	            		<div class="col-md-12 col-lg-12 col-padding-20 cabecera-banco">
	            			Seleccionar cuenta bancaria en la cual te depositaremos cada pago.
	            		</div>
	            		<div class="col-md-9 col-lg-9 col-padding-20 cuerpo-banco">
	            			<select class="form-control input-lg" id="cuenta-banco-data-input">
	            				<option value="default">Selecciona la Cuenta Bancaria</option>
	            				<?php 
	            				//ERROR SI NO ESTA LOGEADO
						            $db = new db_core();
						            $id_user = $db->reg_one("SELECT id_user FROM session_log WHERE token='".$_SESSION['token_user']."'");
						            $consulta[0] = $db->db_query("SELECT * FROM cuentas_bancarias WHERE id_user='".$id_user[0]."'");
						            while($consulta[1] = mysql_fetch_array($consulta[0])){
						            	$total = $db->num_one("SELECT * FROM inversion_proyecto WHERE id_cuenta_bancaria='".$consulta[1]['id_cuenta']."'");
						                echo '<option value="'.$consulta[1]['id_cuenta'].'">'.utf8_encode($consulta[1]['banco']).' - Cta: '.$consulta[1]['numero_cuenta_banco'].'  -  ['.$total.' Invesiones Activas]</option>';
						            }
					         	?>
	            			</select>
	            		</div>
	            		<div class="col-md-3 col-lg-3 col-padding-20 cuerpo-banco">
	            		<button type="button" class="btn btn-success btn-lg" id="add-cuenta-banco"><i class="fa fa-plus"></i> Agregar </button>
	            		<button type="button" class="btn btn-primary btn-lg" id="mod-cuenta-banco"><i class="fa fa-edit"></i> Editar </button>
	            		</div>
	            		<div class="clearfix"></div>
	            	</div>
	            	<div class="row inversion_contrato">
	            		<div class="col-md-12 col-lg-12 col-padding-20 cabecera-contrato">
	            			Contrato de Términos y condiciones del inversionista.
	            		</div>
	            		<div class="col-md-12 col-lg-12 col-padding-20 cuerpo-contrato">
	            			<div class="contrato-texto"><b>TÉRMINOS Y CONDICIONES DEL INVERSIONISTA</b>
							<p>
							El presente contrato entre la Empresa (en adelante “Eollice”) por una parte, y por la otra, el usuario, establece y regula el uso de la Plataforma www.eollice.com (en adelante la “Plataforma”) y los servicios que Eollice provee a los Inversionistas que participan en la Plataforma. Estos Términos y Condiciones han sido creados en atención a la legislación vigente de la República de Chile y en especial a la ley 19.628 sobre protección de datos de carácter personal y sus respectivas modificaciones a la fecha.
							</p>
							<p>
							<b>1. DEFINICIONES</b><br>
							<ol>
							<li>"Beneficiario(s)": significa la empresa que desea obtener un crédito a través de Eollice y su Plataforma, y cuyo crédito será financiado por los Inversionistas de Eollice que previamente hayan estado registrados en la Plataforma;</li>
							<li>"Costo por Opción de Inversión": es el monto que cobra Eollice por participar en un proceso de inversión, y deberán ser depositados a la cuenta de Eollice por el inversionista posterior a su intención de inversión. Si el crédito no puede concretarse por causa atribuible al inversionista (i.e. no transferir el monto comprometido dentro del plazo) se le aplicará una multa del 100% de Costo por Opción de Inversión;</li>
							<li>“Crédito”: es un préstamo de dinero que el inversionista otorga a uno o varios Beneficiarios, para financiar un proyecto, con el compromiso de que en el futuro el o los Beneficiarios restituyan dicho préstamo en las condiciones que se establecen en el proceso de inversión;</li>
							<li>"Crédito Activo": es el Crédito  que se encuentra en proceso de pago; "Crédito Adjudicado": es el  Crédito generado al finalizar un  proceso de inversión exitoso. El cual ha sido concedido a uno o varios  inversionistas que realizaron ofertas, y que cumplen con las condiciones de adjudicación del proceso de inversión;</li>
							<li>“Intención de Inversión”: es el deseo de un inversionista de invertir en un proyecto;</li>
							<li>"Inversionista": es el usuario registrado en Eollice.com con la finalidad de invertir en proyectos publicados en la Plataforma;</li>
							<li>“Inversionista Ganador“: Se refiere a él o los Inversionistas que se adjudican el Crédito, de acuerdo con las condiciones del proceso de inversión;</li>
							<li>"Oferta": monto de dinero que el Inversionista ingresa y ofrece para financiar una solicitud de financiamiento participante en Eollice. El monto corresponde a la cantidad de dinero que el Inversionista se compromete a prestar al Beneficiario en caso que el proceso de inversión finalice exitosamente y sea aceptado por el Beneficiario;</li>
							<li>“Proceso de Inversión”: conjunto de fases, requerimientos y condiciones mediante los cuales un Inversionista postula para el financiamiento de un proyecto;</li>
							<li>"Proceso de Inversión Exitoso": es aquel Proceso de Inversión que ha finalizado satisfactoriamente, de acuerdo a las condiciones establecidas por ambas partes participantes, obteniéndose todo o parte del financiamiento;</li>
							<li>“Proceso de Inversión No Exitoso”: Es aquel Proceso de Inversión que no consiguió financiamiento o que no fue aceptado por el Beneficiario;</li>
							<li>"Solicitud de Financiamiento": necesidad de Crédito para la financiación de un proyecto publicada en la Plataforma;</li>
							<li>"Tasa Efectiva": también denominada CAE, o "Carga Anual Equivalente", corresponde a la tasa de interés definitiva del crédito, reflejando el costo financiero total para el Beneficiario, ya que considera todos los costos asociados al crédito en que debe incurrir el Beneficiario, tales como los derechos y gastos que se pagan a Eollice por los servicios prestados, el impuesto de Timbres y Estampillas (DL 3475), los gastos notariales y los seguros solicitados (opcionales para los Beneficiarios), entre otros;</li>
							<li>“Tasa Máxima Convencional”  Es la tasa de interés máxima. Esta tasa no puede exceder en más de un 50% el interés corriente que rige al momento de la convención;</li>
							<li>“Términos y Condiciones”: Significan los presentes términos y condiciones;</li>
							<li>“Usuario(s)”: persona o empresa que usa el y/o se registra en el Sitio, incluidos los Inversionistas y los Beneficiarios;</li>
							</ol>
							</p>
							<p>
							<b>2. ACEPTACIÓN TÉRMINOS Y CONDICIONES</b>
							<br>
							El ingreso al Sitio, así como el registro de los Usuarios, significa la aceptación de los presentes Términos y Condiciones por parte de los Usuarios. 
							El registro a nombre de una persona jurídica, debe ser efectuado por su representante legal o por cualquier persona facultada para obligar a dicha persona jurídica.
							Eollice se reserva el derecho a modificar estos Términos y Condiciones en cualquier momento. Se entenderán por notificados los cambios por el sólo hecho de actualizar la publicación de los presentes Términos y Condiciones. En consecuencia, el Usuario reconoce y acepta que es de su responsabilidad revisar periódicamente los Términos y Condiciones publicados en la Plataforma. El sólo hecho de que un Usuario realice cualquier acto en la Plataforma luego de efectuadas tales modificaciones, valdrá como reconocimiento y aceptación tácita de los Términos y Condiciones reformados.
							</p>
							<p>
							<b>3. DESCRIPCION DE SITIO Y LOS SERVICIOS</b> 
							<br>
							<p>
							<b>3.1 Rol de Eollice</b>
							<br>
							El rol de Eollice es proporcionar a sus Inversionistas un espacio de encuentro entre aquellas personas que desean prestar su dinero a los Beneficiarios que lo soliciten, bajo la forma de un crédito, para poder financiar proyectos de energías renovables no convencionales (“Proyectos ERNC”). 
							3.2 Descripción del sitio y los servicios 
							En la Plataforma, Eollice provee funcionalidades y suministra servicios al Inversionista para que éste pueda realizar las siguientes acciones:
							<ol type=A>
							<li> Visualizar las Solicitudes de Financiamiento publicadas por Eollice en la Plataforma, con toda la información necesaria de los Beneficiarios para que el Inversionista pueda o no realizar una oferta;</li>
							<li> Acceder a información de los proyectos y sus empresas que participen como Beneficiarios en la Plataforma. </li>
							<li> Participar en los Procesos de Inversión, realizando Ofertas en una o más Solicitudes de Financiamiento que participen en un Proceso de Inversión de Eollice.</li>
							<li> Adjudicarse Créditos según las condiciones establecidas en el Proceso de Inversión de Eollice, lo que se traduce en la obligación de prestar su dinero a los Beneficiarios, concretándose así el crédito entre Inversionista y Beneficiarios;</li>
							<li> Delegar en Eollice la consolidación del monto del Crédito invertido por los distintos Inversionistas para el solo efecto de ser entregado al Beneficiario respectivo, y el cobro de las cuotas a los Beneficiarios, para su consolidación y división a prorrata entre los diversos Inversionistas;</li>
							<li> Delegar en Eollice la cobranza extra judicial y judicial, lo que incluye la selección de la empresa o abogados de cobranza, en caso que fuese necesario. El Inversionista ha designado a Eollice diputado para el cobro, mediante mandato electrónico aceptado por el Inversionista en la Plataforma, en virtud del cual Eollice recolectará el pago de las cuotas del Beneficiario, para luego transferir dichos fondos al Inversionista. En caso de ser necesario iniciar acciones judiciales para el cobro del crédito, el Inversionista se obliga a otorgar por escritura pública un mandato judicial suficiente a Eollice, a su propio costo;</li>
							<li> Tener acceso a información de su perfil, de sus Créditos Activos, de calendarios de pago de cuotas de créditos, de créditos y/o inversiones pasadas, de documentos legales firmados y aceptados en Eollice, entre otra información que Eollice considere relevante entregar a sus Inversionistas;</li>
							<li> Otras funcionalidades que Eollice podrá desarrollar para proveer un mejor servicio a los Usuarios.</li>
							</ol>
							</p>
							<p>
							<b>4. REGISTRO Y SEGURIDAD</b> 
							<br>
							<p>
							<b>4.1 Registro.</b> 
							<br>
							Para registrarse como Inversionista, el Usuario debe completar un formulario con la información mínima requerida, incluyendo entre otros, nombre completo, RUT, sexo, fecha de nacimiento, email, contraseña, nombre de fantasía, dirección, teléfono de contacto y antecedentes financieros, entre los que se encuentra entregar información de una cuenta bancaria que tenga a su nombre, incluyendo el nombre del Banco, el tipo y número de cuenta. Esta última información será  requerida para poder facilitar la transferencia electrónica de fondos desde y hacia Eollice y hacia los Beneficiarios Dicha información siempre se mantendrá como privada y nunca será publicada en la web de Eollice.
							El inversionista autoriza a Eollice para utilizar los datos proporcionados por éste para poder suministrar adecuadamente los servicios que se ofrecen en la plataforma en los términos permitidos por la ley 19.628, sobre protección de datos de carácter personal.
							El Usuario se compromete a proporcionar información verdadera, exacta y completa cuando se le solicite en el formulario de registro y en cualquier otra instancia en que el Eollice le solicite nueva información o actualización de la ya proporcionada, a fin de que esta siempre sea integra, exacta y veraz. 
							</p>
							<p>
							<b>4.2 Verificación de la identidad, datos personales y propósito.</b>
							<br>
							El Usuario autoriza a la Empresa a realizar, ya sea directamente o a través de terceros, todo tipo de solicitudes y/o preguntas que considere necesarias para verificar la identidad de los Usuarios. 
							Eollice se reserva el derecho de cerrar, suspender o limitar el acceso a su cuenta de Usuario en el caso de que no sea posible obtener o verificar la información requerida de acuerdo a los presentes Términos y Condiciones.
							</p>
							</p>
							<br>
							<p>
							<b>5. CONDICIONES GENERALES DE LOS CRÉDITOS</b>
							<br>
							El Inversionista tiene el deber de informarse de las características de los Créditos. A su vez, el Inversionista comprende las obligaciones que emanan de las características de los Créditos enumeradas a continuación:
							<ol type=A>
							<li> Los Créditos se pactan exclusivamente entre un Beneficiario y uno o más Inversionistas, que se encuentran a través de la Plataforma, a través del sistema de Proceso de Inversión, que permite que uno o más Inversionistas financien el crédito de un Beneficiario.</li>
							<li> Los Créditos cuentan con el respaldo de un pagaré, el cual tiene mérito ejecutivo en caso de no pago por parte del Beneficiario. Eollice proveerá el texto del pagaré incluyendo las condiciones pactadas en el Proceso de Inversión y facilitará los trámites para cumplir con las formalidades del mismo.</li>
							<li> El Inversionista, previa firma de un mandato específico a Eollice, podrá transferir electrónicamente los fondos comprometidos para ser entregados al Beneficiario contra firma del pagaré que respalda su crédito.</li>
							<li> Los gastos notariales de la firma del pagaré, el costo del impuesto de Timbre y Estampillas (DL 3475) derivado del respectivo crédito, así como de cualquier seguro y garantía ofrecido por el Beneficiario, serán de cargo de cada Beneficiario y serán recolectados y enterados por Eollice.</li>
							<li> El Crédito comienza el día en que el Beneficiario suscribe el respectivo pagaré, luego de haber aceptado las condiciones del crédito en la Plataforma.</li>
							<li> Eollice entregará al Beneficiario y al Inversionista el calendario con las fechas de pagos de cuotas, el cual se genera en el momento en que se emite el pagaré por parte de Eollice, y cuya fecha de emisión no necesariamente coincide con la fecha del mismo. El Beneficiario no podrá cambiar la fecha de vencimiento de las cuotas, salvo con el acuerdo de todos los inversionistas del Crédito. Si el Beneficiario realiza pagos anticipados de cuotas a Eollice, él o los Inversionistas recibirán estos pagos de cuotas anticipados desde Eollice.</li>
							<li> Las condiciones de los Créditos, tales como monto, tasa de interés, plazo, valor de las cuotas, entre otras, se generan a partir del Proceso de Inversión de Eollice.</li>

							<li> El Beneficiario fija el plazo a la cual está dispuesto a endeudarse, la que no podrá superar las 180 cuotas, que Eollice ha definido el plazo máximo permitida para los Créditos generados en la Plataforma.</li> 

							<li> En ningún caso la tasa fijada puede superar la Tasa Máxima Convencional.</li>

							<li> Los Créditos no se encuentran en caso alguno garantizados por Eollice y de ninguna manera deberá entenderse que su rol de facilitador implica de forma alguna asumir responsabilidad por el no pago de los Beneficiarios.</li>

							<li> De acuerdo a las leyes vigentes, los Beneficiarios de Créditos menores a 5.000UF siempre tendrán derecho a prepagar sus Créditos en cualquier momento. En caso de ejercer esta opción, el Beneficiario deberá pagar en su totalidad el capital insoluto de la deuda, más los intereses pactados calculados hasta la fecha de pago efectivo. Además deberá adicionar una comisión de prepago equivalente a un mes de intereses pactados calculados sobre el capital que se prepaga. El Beneficiario podrá prepagar el Crédito a través de la Plataforma, donde se le entregará el cálculo final para liquidar su deuda. El total del monto de prepago (capital insoluto, sumado intereses y comisión de prepago) será de beneficio de los Inversionistas del crédito.</li>

							<li> Para asignar a los Inversionistas Ganadores de cada Proceso de Inversión, los criterios de adjudicación serán por orden de llegada.</li>
							<li> El Beneficiario siempre podrá aceptar un Proceso de Inversión al término de éste o anticipadamente, contando con el 100% del financiamiento o con un porcentaje de financiamiento menor. Para aceptar el Proceso de Inversión deberá contar con al menos un 70% del monto solicitado financiado.</li>
							</ol>
							</p>
							<p>
							<b>6. CONDICIONES, OBLIGACIONES Y PROHIBICIONES DEL INVERSIONISTA</b>
							<br>
							<p>
							<b>6.1 Condiciones</b>
							<br>
							<ol type=A>
							<li>Costo Opción de Inversión<br>
							Para que un Inversionista realice una Intención de Inversión, el Inversionista debe pagar los Costos por Opción de Inversión antes de que se cierre el Proceso de Inversión y antes de que pague el dinero a invertir. El Costo por Opción de Inversión tiene un valor del 1% de lo que el inversionista desee invertir. El monto mínimo a invertir es del $10.000 y puede incrementar su monto en múltiplos de $10.000 pesos (por ejemplo $10.000, $20.000, $30.000, $40.000, etc.).El Costo por Opción de Inversión se consumirá a título de derechos de adjudicación del Proceso de Inversión; y serán liberados en caso que el crédito no llegue a concretarse. Sin embargo, en caso que el Inversionista no haga entrega de los montos comprometidos (la Oferta) dentro de plazo, se le aplicará además una multa equivalente al 100% del Costo por Opción de Inversión.</li>
							<li>Oferta.<br>
							La Oferta corresponde al monto que el Inversionista ingresa en una Solicitud de Financiamiento participante de un Proceso de Inversión en Eollice. El monto corresponde a la cantidad de dinero que el Inversionista se compromete a prestar al Beneficiario en caso que el Proceso de Inversión finalice exitosamente y sea aceptado por el Beneficiario. El Inversionista decidirá el monto de la Oferta para cada Solicitud de Financiamiento, el cual deberá ser igual o mayor a $10.000 en tramos de montos fijos de $10.000, a excepción de aquellos créditos en los que se acepta un solo Inversionista, en los cuales la inversión deberá ser igual al monto total del crédito. En caso de ser un monto mayor a $10.000, el Inversionista deberá ingresar montos en tramos de montos fijos de $10.000, por ejemplo, $10.000, $20.000, $30.000 etc. El monto máximo de la Oferta por Proceso de Inversión corresponderá al monto total solicitado por el Beneficiario.<br>
							El inversionista comprende y acepta que al momento de realizar una oferta en cualquier proceso de inversión, está asumiendo la obligación de transferir los fondos en caso de que el proceso de inversión finalice con éxito y el inversionista se adjudique el todo o parte del crédito.</li>
							<li>Proceso de Inversión en Curso.<br>
							Mientras el Proceso de Inversión se encuentre en curso, el Inversionista podrá ingresar una Oferta y/o modificar su Oferta anterior. El Proceso de Inversión es dinámico, por lo que se mostrará, siempre y públicamente, la información de los montos que han sido ingresados a través de las Ofertas de los diferentes Inversionistas participantes.</li>
							<li>Modificaciones de las Ofertas.<br>
							Los Inversionistas podrán ingresar varias Ofertas durante el transcurso de un mismo Proceso de Inversión, contándose cada inversión como individual, a pesar de que el Inversionista vea en la Plataforma la inversión total realizada. Si el Inversionista quisiera modificar una Oferta, sólo podrá hacerlo si el Proceso de Inversión en que participa no ha sido cerrado.</li>
							<li>Proceso de Inversión Múltiples.<br>
							El Inversionista podrá participar en tantos Proceso de Inversión como lo desee.</li> 
							</ol>
							</p>
							<p>
							<b>6.2 Obligaciones</b>
							<br>
							<ol type=A>
							<li> Pagaré. <br>
							Inversionista tiene la obligación de conocer las condiciones genéricas del pagaré, disponibles en la Plataforma, entre las que se detallan el monto del Crédito, número y valor de las cuotas, tasa de interés, vencimiento de cuotas, forma de pago de cuotas, condiciones en caso de mora, cláusulas de aceleración del crédito, condiciones en caso de cobranza judicial y extrajudicial, entre otras.
							Los fondos del crédito se entregarán al Beneficiario una vez firmado el pagaré. La copia del pagaré firmado estará disponible en caso que el Inversionista la requiera y la podrá solicitar a Eollice a través del medio de contacto habilitado para este fin.</li>
							<li> Firma electrónica de mandatos. <br>
							Para acceder a los servicios que Eollice ofrece a los Inversionistas, el Inversionista, además de aceptar el presente acuerdo, debe leer y aceptar las condiciones del mandato específico del Inversionista, disponible en la Plataforma.</li>
							<li> Declaración de impuesto a la renta.<br>
							El Inversionista se hace responsable de realizar su declaración de Impuesto a la Renta de acuerdo a las leyes chilenas y a los procedimientos y fechas estipulados por el SII, en especial por concepto de la renta obtenida por intereses provenientes de los créditos otorgados a través de la Plataforma. Eollice asistirá al Inversionista, entregando la información que éste requiera para realizar su declaración de renta anual.</li> 
							</ol>
							</p>
							<p>
							<b>6.3 Prohibiciones</b>
							<br>
							El Inversionista declara conocer y aceptar que no podrá realizar las siguientes acciones al participar en Eollice.com, 
							<br>
							<ol type=A>
							<li> Suplantación de identidad, creando un registro de Inversionista o de Inversionista en Eollice bajo la identidad de un tercero;</li>
							<li> Cobrar o intentar cobrar a los Beneficiarios que participan en Eollice algún cargo adicional a los establecidos en Eollice, para participar en la Solicitud de Financiamiento publicada por el Beneficiario en Eollice.com;</li>
							<li> Incurrir en acciones para cobrar las cuotas al Beneficiario en forma directa, ya sea por sus propios medios o utilizando servicios de terceros;</li>
							<li> Interponer acciones judiciales en contra de algún Beneficiario al cual el Inversionista haya otorgado un crédito a través de Eollice.com, </li>
							<li> Contratar por cuenta propia a empresas de cobranza o servicios legales para realizar acciones de cobranza contra Beneficiarios de Eollice.com, a menos que actúe conjuntamente con los todos los demás Inversionistas de un crédito determinado y que hayan designado un procurador común, previa notificación a Eollice;</li>
							<li> Publicar información personal de cualquier Inversionista Registrado en Eollice </li>
							</ol>
							</p>
							<p>
							<b>7. RESPONSABILIDADES </b>
							<br>
							<ol type=A>
							<li> El Inversionista acepta que al participar en la Plataforma, es él quien toma sus propias decisiones de inversión, de acuerdo a su propio análisis de riesgo y bajo su única responsabilidad. Al participar en la Plataforma, el Inversionista tiene la obligación de hacer su propio análisis de riesgo, previo a la realización de cualquier oferta en los Procesos de Inversión, ya que las Ofertas comprometen al Inversionista a prestar su dinero al Beneficiario respectivo en caso de adjudicarse el proceso de inversión, pudiendo ser multado en caso de incumplimiento.</li>
							<li> El Inversionista comprende y acepta que los Créditos generados en la Plataforma no se encuentran garantizados por Eollice, no siendo éste responsable de las decisiones de inversión del Inversionista ni de sus consecuencias.</li>
							<li> La Oferta es de carácter irrevocable y vinculante, de manera tal que una vez que el Inversionista ingrese su Oferta en un Proceso de Inversión, éste no puede anular dicha Oferta ni desistir de entregar los fondos al Beneficiario una vez adjudicado el Crédito, bajo ninguna circunstancia.</li>
							</ol>
							</p>
							</p>
							<p>
							<b>8. CÁLCULO, RECAUDACIÓN Y PAGO DE CUOTAS A LOS INVERSIONISTAS</b>
							<br>
							<p>
							<b>8.1 Cálculo de cuotas del Inversionista. </b>
							<br>
							Para cada Proceso de Inversión, se calculará un porcentaje de prorrateo del Crédito, de acuerdo a los montos adjudicados a cada uno de los Inversionistas que han financiado cada Crédito. De esta manera cada Inversionista será dueño de un porcentaje de la deuda.
							</p>
							<p>
							<b>8.2 Cobro de cuotas. </b>
							<br>
							El Inversionista autorizará, mediante un mandato específico para el cobro otorgado por el Inversionista a Eollice en la Plataforma, que Eollice cobre y perciba las cuotas de los Créditos otorgados con sus intereses correspondientes. Eollice deberá dividir las cuotas entre los Inversionistas que han participado en cada Crédito, en proporción a los montos aportados al mismo y transferir dichos fondos al Inversionista. 
							Eollice sólo realizará pagos de cuotas a los inversionistas si dichos pagos han sido efectuados por el Beneficiario a Eollice. 
							Eollice no se hace responsable de pagar al Inversionista cuotas que el Beneficiario no haya pagado íntegras a Eollice. Eollice no acepta pagos de cuotas parciales.
							</p>
							<p>
							<b>8.3 Recepción de cuotas. </b>
							<br>
							El Inversionista recibirá el pago de las cuotas efectuado por el Beneficiario, mediante transferencia electrónica a la cuenta bancaria registrada en su perfil.
							</p>
							<p>
							<b>8.4 Entrega de fondos a través de Eollice.</b>
							<br>
							El Inversionista, previa firma de un mandato específico a Eollice, podrá transferir electrónicamente los fondos comprometidos para ser entregados al Beneficiario contra firma del pagaré que respalda su crédito. Eollice se encargará de consolidar los aportes de los distintos Inversionistas, para ser entregados en un solo acto al Beneficiario.
							</p>
							<p>
							<b>8.5 Cobro por Opción de Inversión </b>
							<br>
							El uso de la Plataforma será gratuito en caso de no concretarse un Crédito a través de la misma. Los servicios que se cobrarán al Inversionista por opción de inversión y que sólo se devengarán al concretarse un Crédito a través de la Plataforma, son los siguientes:
							Cobro por Opción de Inversión. Como parte de su labor de facilitación, coordinación y estructuración de los créditos, Eollice cobrará al Inversionista un equivalente al 1% de lo que el inversionista desee invertir, el que se cobra durante el Proceso de Inversión. Por ejemplo, en una inversión de $500.000.-, el Costo por Opción de Inversión equivaldría a $5.000.-. Dicho cobro se hará efectivo posterior a la oferta realizada en una Solicitud de Financiamiento.
							8.6 Costo de Administración
							Eollice le cobrará al Inversionista 0,8% (IVA incluido) de la cuota correspondiente a dicho inversionista por concepto de administración de las cuotas. Eollice se encarga de recaudar cada cuota al Beneficiario y entregar a prorrata la cuota correspondiente a cada inversionista. Este costo se aplica para cada cuota que el Inversionista reciba.
							Eollice podrá cambiar los montos descritos en las secciones anteriores. En cualquier momento, los que serán válidos para futuros créditos en los que participe el Inversionista, no así para Créditos que se encuentran activos o publicados al momento del cambio en dichos cobros. Eollice notificará de los cambios en su web y a través de unos nuevos "Términos y Condiciones del Inversionista" que actualizará en la Plataforma, notificando debidamente a los Inversionistas de este cambio.
							</p>
							<p>
							<b>9. TRATAMIENTO DE CRÉDITOS MOROSOS</b>
							<p>
							<b>9.1 Aspectos generales.</b> <br>
							En caso de mora, y dado que el Inversionista ha otorgado un mandato específico para el cobro a Eollice, Eollice será el encargado de la cobranza extrajudicial y judicial de aquellos Créditos generados en la Plataforma que se encuentren morosos o con cuotas impagas. Eollice se encuentra facultado para delegar en terceros dichas acciones de cobranza, en caso que Eollice así lo requiera.
							</p>
							<p>
							<b>9.2 Burós de crédito.</b> <br>
							Los Inversionistas facultan a Eollice para: (a) Luego de 40 días corridos de mora de una cuota, ingresar los datos del Beneficiario a empresas de servicios de información comercial; (b) Solicitar a estas empresas que regularicen la situación del Beneficiario moroso, una vez que éste haya pagado las cuotas impagadas y, por tanto, regularizado la situación de su crédito.
							</p>
							<p>
							<b>9.3 Intereses por retraso en pago de cuotas.</b><br>
							En caso de mora o simple retardo en el pago de todo o parte del capital e intereses, se capitalizarán los intereses devengados y el crédito moroso devengará por todo el lapso de la mora o retardo, el interés máximo convencional que la ley permite estipular para operaciones de crédito de dinero no reajustables.
							</p>
							<p>
							<b>9.4 Ejecución del pagaré.</b><br>
							En caso de que el Beneficiario no pague el monto adeudado en un plazo de 90 días después del vencimiento de la cuota, se ejecutará en forma inapelable el pagaré suscrito por el Beneficiario. Se enviará carta certificada al domicilio del Beneficiario dando aviso de que en un plazo de 10 días se iniciarán las acciones de cobranza judicial. A su vez, la falta de pago íntegro y oportuno, de todo o parte de lo adeudado, facultará a Eollice, como diputado para el pago de los Inversionistas, para hacer exigible al Beneficiario moroso el pago total de las cuotas adeudadas, en capital e intereses, las que para el evento se considerarán de plazo vencido para todos los efectos legales.
							<br>
							Eollice realizará su mejor esfuerzo a través de diferentes acciones comerciales y judiciales, para cobrar y percibir el pago de las cuotas por parte de los beneficiarios, utilizando prácticas de acuerdo al estándar de la industria y respetando las leyes vigentes de la República de Chile. Sin perjuicio de lo anterior, existe la posibilidad de que ciertos créditos nunca lleguen a cobrarse en su totalidad, eventualidad que el Inversionista debe conocer y aceptar sus consecuencias, asumiendo los riesgos que esto implica.
							</p>
							<p>
							<b>9.5 Garantías</b>
							<br>
							Eollice garantiza que nunca hará entrega de las inversiones al Beneficiario sin mandato específico del Inversionista, del Beneficiario y la firma del pagaré por parte de este último reconociendo la deuda a los Inversionistas. Eollice actúa como custodio de todos los pagarés que respaldan los créditos generados en Eollice.com, función que podrá delegar en empresas especializadas.
							</p>
							</p>
							<p>
							<b>10. MODIFICACIONES Y TÉRMINO DEL CONTRATO DEL INVERSIONISTA</b>
							<br>
							<p>10.1 Modificaciones.</b>
							Eollice podrá en cualquier momento y de tiempo en tiempo, corregir, modificar, agregar, eliminar y actualizar estos Términos y Condiciones, previa aceptación prestada al efecto por el Inversionista.
							Para dichos efectos, Eollice notificará oportunamente al Inversionista de las modificaciones que se desee efectuar a los presentes Términos y Condiciones a través de la publicación de una notificación dirigida al mismo cuando éste ingrese a su cuenta. Los cambios se harán efectivos a partir del momento en que el Inversionista acepte las referidas modificaciones.
							</p>
							<p>
							<b>10.2 Término de un Proceso de Inversión</b>
							<br>
							<ol type=A>
							<li> Por tiempo: una vez finalizado el tiempo de duración del Proceso de Inversión.</li>

							<li> Por retiro del Beneficiario: el Beneficiario de una Solicitud de Financiamiento podrá, en cualquier momento del tiempo de duración del Proceso de Inversión, poner fin a éste.</li>

							<li> Por aceptación anticipada del Beneficiario: si el Crédito se ha financiado en al menos el 70% del monto solicitado, el Beneficiario podrá aceptar anticipadamente las condiciones del Proceso de Inversión.</li>

							<li> Cierre del Proceso de Inversión por parte de Eollice: Eollice se reserva el derecho de cancelar un Proceso de Inversión en cualquier momento de la duración de éste, a su sólo arbitrio, por razones justificadas.</li>
							</ol>
							</p>
							<p>
							<b>10.3 Término</b>
							<br>
							Estos Términos y Condiciones se encontrarán vigentes y será efectivo mientras Eollice mantenga en operación la Plataforma. Eollice se reserva el derecho de terminar de ofrecer la Plataforma, sus contenidos y los servicios que se proveen a través de la Plataforma en cualquier momento del tiempo. Sin perjuicio de lo anterior, Eollice podrá poner término inmediato al presente contrato en caso de decidir, a su sola discreción, desactivar la cuenta de un Usuario en cualquiera de los siguientes casos:
							<ol type=A>
							<li> En caso de comprobar que alguna de las informaciones suministradas por el Inversionista fuese falsa, incompleta, inexacta, errónea, y/o de cualquier forma poco fidedigna;</li>
							<li> En el evento de incurrir el Inversionista en un uso no autorizado del Contenido de la Plataforma contemplado en los Términos y Condiciones de Uso de la Plataforma, previamente aceptado por el Inversionista, disponible en www.eollice.com;</li>
							<li> En el evento de incurrir el Inversionista en alguna conducta u omisión que vulnere las disposiciones antispam contenidas en los  de Términos y Condiciones de Uso de la Plataforma previamente aceptado por el Inversionista y disponibles en www.eollice.com; y en general,</li>
							<li> En el evento de incurrir el Inversionista en alguna infracción grave de sus obligaciones bajo el Contrato de Términos y Condiciones de Uso de la Plataforma y/o los Acuerdos Específicos aceptados en la Plataforma.</li>
							</ol>
							En tales casos, se entenderá que el presente contrato ha expirado desde el momento en que Eollice así lo notifique al Inversionista mediante el envío de correo electrónico dirigido a la dirección registrada por éste en eollice.com.
							</p>
							<p>
							<b>10.4 Retractación</b>
							<br>
							Se deja expresa constancia que el Inversionista no podrá retractarse del presente contrato, de conformidad con lo dispuesto en la letra b) del artículo 3 bis de la Ley de Protección al Consumidor.
							</p>
							</p>
							<p>
							<b>11. LEY APLICABLE Y TRIBUNAL COMPETENTE</b>
							<br>
							Los presentes Términos y Condiciones se encuentran sujetos y regidos por las leyes vigentes en la República de Chile.
							Cualquier conflicto o controversia surgida entre uno o más usuarios y la Empresa en relación con los presentes Términos y Condiciones, se resolverá mediante arbitraje de acuerdo con el Reglamento de Arbitraje Comercial Internacional del Centro de Arbitraje y Mediación de la Cámara de Comercio de Santiago, vigente al momento de su inicio. El arbitraje será realizado por un solo árbitro que tendrá la calidad de árbitro arbitrador en cuanto al procedimiento pero deberá fallar como árbitro de derecho de acuerdo a la ley aplicable. La sede del arbitraje será Santiago de Chile. El idioma del arbitraje será el español.
							El árbitro dirimirá la controversia mediante sentencia de única instancia. En contra de dicha sentencia, no procederá recurso alguno, por lo cual los Usuarios involucrados en la controversia renuncian expresamente a ellos. La notificación de la sentencia será efectuada vía correo electrónico y dirigida a las direcciones de correo electrónico declaradas por los usuarios involucrados al momento de registrase en la Plataforma, las cuales se entienden, para todos los efectos legales como notificaciones válidamente efectuadas a los Usuarios.
							Sin perjuicio de lo anterior, ante cualquier reclamo o disputa concerniente o relativa a la Plataforma y a los servicios provistos en el mismo y antes de comenzar cualquier acción legal en contra de la Empresa, los Usuarios se obligan a notificar a la Empresa de manera escrita al correo electrónico contacto@eollice.com. La Empresa contará con un plazo de 30 días hábiles para responder al usuario a la misma dirección de correo electrónico mediante la cual recibió la notificación mencionada en este párrafo.
							</p>
							<p>
							<b>12. CONTACTO</b>
							<br>
							Las comunicaciones que el Inversionista deba o quiera dirigir a Eollice, se efectuarán por correo electrónico dirigido a contacto@eollice.com o bien a través de la sección Contacto de www.eollice.com.
							Las comunicaciones que Eollice deba o quiera dirigir al Inversionista, se efectuarán por correo electrónico dirigido a la dirección electrónica designada por el Inversionista en el Proceso de Registro.
							</p>
							<p>
							<b>DECLARACIÓN</b>
							<br>
							En este acto y por el presente, el Inversionista reconoce haber leído por vía electrónica y comprendido el contenido íntegro de los Terminos y Condiciones Inversionista, y que al checkeo de la opción "He leído y aceptado el Contrato de Términos y Condiciones Del Inversionista", ubicado al final del presente Contrato, acepta expresa, inequívoca e irrevocablemente el presente Contrato. El documento electrónico en que se formalice el presente Contrato será archivado en la base de datos de Eollice y será accesible al Inversionista en su Perfil de Inversionista. En caso que el Inversionista necesite identificar y corregir errores en el envío o en sus datos, podrá contactar a Eollice por los medios indicados en la cláusula anterior. Se deja constancia que verificada la aceptación del presente Contrato en los términos antes referidos, Eollice enviará una confirmación del perfeccionamiento del presente Contrato por correo electrónico, conteniendo una copia íntegra, clara y legible del mismo.
							</p>
							</div>
	            		</div>
	            		<div class="chechbox-contrato">
	            			<div class="checkbox">
							  <label>
							    <input type="checkbox" value="" id="checkbox-option-box">
							   <b>Acepto el Contrato de Términos y Condiciones del Inversionista</b>
							  </label>
							</div>
	            		</div>
	            	</div>
	            	<div class="row inversion_pago">
	            		<div class="col-md-12 col-lg-12 col-padding-20 cabecera-contrato">
	            			Forma de Pago
	            		</div>
	            		<div class="col-md-12 col-lg-12 col-padding-20 cuerpo-contrato">
	            			<div class="medios_pago">
	            				<div class="manual_option">
									<label>
								      <input type="radio" name="select_pago" class="select_pago" tipo="manual" />
								    </label>
								</div>
								<div class="manual_logo"><img src="khipu/images/logo_manual.png"></div>
								<div class="manual_description">
									<h1><b>Tranferencia Bancaria Manual</b></h1>
									<p><h2><b>(Opción Recomendada)</b> Paga haciendo una transferencia bancaria a Eollice. Para validar tu pago deberás seguir las instrucciones que te daremos.</h2></p>
								</div>
								<div class="khipu_option">
									<label>
								      <input type="radio" name="select_pago" class="select_pago" tipo="khipu" checked />
								    </label>
								</div>
								<div class="khipu_logo"><img src="https://s3.amazonaws.com/static.khipu.com/buttons/200x75.png"></div>
								<div class="khipu_description">
									<h1><b>Paga con Khipu</b></h1>
									<p><h2>Al pagar con khipu el proceso de verificación es automático, 100% seguro y confiable. No requiere pasos adicionales.</h2></p>
								</div>
								
							</div>
							<div class="pago-accion-confirmar">
								<button type="button" class="btn btn-success btn-lg btn-finals" id="confirm_founding"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;Confirmar Pago</button>
							</div> 
	            		</div>
	            	</div>
	            </div>
	        </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="transfer-manual-modal">
<div class="modal-dialog" style="width:800px;">
  <div class="modal-content" >
    <div class="modal-header" style="background:rgba(50, 118, 177,1); color:#FFF;">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; opacity:1;">&times;</button>
      <h4 class="modal-title modal-confirm-title-transfer">Paga con transferencia electrónica</h4>
    </div>
    <div class="modal-body modal-message-transfer">
    	<div class="row">
    		<div class="col-md-12 col-lg-12">
    			<h5>Serás considerado de forma definitiva en el proceso de inversión una vez que tu pago por la inversión total declarada más costo por opción a inversión sean aprobados.</h5>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-12 col-lg-12">
    			<div class="titulos">Transfiere</div><div class="valor">$4.000</div><div class="titulos"> a la siguiente cuenta.</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-12 col-lg-12" style="margin-top:15px; margin-left:5px;">
    			<b>Datos de la cuenta Eollice</b><br>
				<b>N° de Cuenta:</b> 44132150<br>
				<b>Banco:</b> Corpbanca<br>
				<b>Rut:</b> 76.321.252-1<br>
				<b>Tipo de Cuenta:</b> Corriente<br>
				<b>Razón Social:</b> Eollice SpA<br>
				<b>Mail:</b> contacto@eollice.com<br>
    		</div>
    	</div>
    	<div class="row">
    		<hr>
    		<div class="col-md-9 col-lg-9">
    		Reenvía el correo de confirmación de transferencia a contacto@eollice.com con este código en el asunto: 
    		</div>
    		<div class="col-md-3 col-lg-3 codigo-transfer-manual"></div>
    		<div class="clearfix"></div>
 			<hr>   		
 			<div class="col-md-12 col-lg-12" style="margin-top:15px; margin-left:5px;">
 			Para confirmar el proceso y continuar, apreta el botón Confirmar Transferencia.
    		</div>
    	</div>
    </div>
    <div class="modal-footer confirm-footer">
      <button type="button" id="modal-confirm-manual-btn" class="btn btn-success">Confirmar</button>
      <button type="button" id="modal-confirm-close" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

