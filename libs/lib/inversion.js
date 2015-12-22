$( document ).ready(function() {
	$(".tabsmenu").on('click', function(){
		$(".tabsmenu").removeClass("active");
		var self = $(this);
		$(".tabsinfo").hide();
		$("."+self.attr('data')).show();
		$(this).addClass("active");

	});
	$.change_to_simulacion = function(){
		$(".proyecto").fadeOut(500, function() {
			// Animation complete.
			$(".simulacion").show();
		});
		$(".suptabs").removeClass("active");
		$(".suptabs").each(function(){
			if($(this).attr('data') == "simulacion"){
				$(this).addClass("active");
			}
		});
	};
	$("#boton-simulacion").on('click', function(){
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'user',
				method: 'isConected',
				data: JSON.stringify({
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == 0){
					$.change_to_simulacion();
				}
				else
				{
					$("#btn-login-final").data('callback', '$.change_to_simulacion();');
					$("#login #logincap").show();
					$("#login #regcap").hide();
					$("#login #recoverpasscap").hide();
					$('#login').modal('toggle');
				}
			}
		});
	});
	$(".suptabs").on('click', function(){
		var self = $(this);
		if($(this).attr('data') == "simulacion"){
			if($.eollice.simulador.monto != $.eollice.simulador.invertido)
			{
				$.ajax({
					url: "controller/ajax/handler.php",
					type: "POST",
					data:{
						lib: 'user',
						method: 'isConected',
						data: JSON.stringify({
						})
					},
					success:function(resultado){
						$.check_security(resultado);
						var result = JSON.parse(resultado);
						if(result.status == 0){
							$.change_to_simulacion();
						}
						else
						{
							$("#btn-login-final").data('callback', '$.change_to_simulacion();');
							$("#login #logincap").show();
							$("#login #regcap").hide();
							$("#login #recoverpasscap").hide();
							$('#login').modal('toggle');
						}
					}
				});
			}
			else
			{
				alert("Se ha alcanzado el financiamiento requerido para el proyecto. Lo invitamos a inscribirse en la lista de espera");
			}
		}
		else
		{
			$(".suptabs").removeClass("active");
			$(".content-tabs").fadeOut(500, function() {
				// Animation complete.
				$("."+self.attr('data')).show();
			});
			$(this).addClass("active");
		}
		
	});
	// SECCION DE SIMULACION
	var querystring = $.getUrlVars();
	$.indicadores(querystring['id'], function(){
		$("#montoinversion_input").trigger("change");
	});
	$("#montoinversion_input").on('change', function(){
		try
		{
			if($.eollice.simulador.monto != $.eollice.simulador.invertido)
			{
				var self = $(this);
				if(typeof $.uticredi(self.val()) == "number" && self.val()%10000 == 0 && self.val() > 0){
					$.ajax({
						url: "controller/ajax/handler.php",
						type: "POST",
						data:{
							lib: 'simulacion',
							method: 'check_disponibilidad',
							data: JSON.stringify({
								id:$.getUrlVars()['id'] 
							})
						},
						success:function(resultado){
							$.check_security(resultado);
							var result = JSON.parse(resultado);
							var maxdisp = (parseInt(result.monto) - parseInt(result.total)); 
							if(maxdisp >= self.val()){
								$("#uticredi_data h3").html($.format_string($.uticredi(self.val(), $.eollice.simulador.tasa, $.eollice.simulador.plazo),true));
								$("#uticredi2_data").html($.format_string($.uticredi(self.val(), $.eollice.simulador.tasa, $.eollice.simulador.plazo),true));
								$("#coi_data h5").html($.format_string($.coi(self.val()),true));
								$("#coi2_data").html($.format_string($.coi(self.val()),true));
								$("#gda_data").html($.format_string($.gda(self.val(), $.eollice.simulador.tasa, $.eollice.simulador.plazo),true));
								$("#trecupe_data").html($.format_string($.trecupe(self.val(), $.eollice.simulador.tasa, $.eollice.simulador.plazo),false," Meses"));
								$("#cmensual_data").html($.format_string($.cmensual(self.val(), $.eollice.simulador.tasa, $.eollice.simulador.plazo),true));
								$.eollice.simulador.monto = self.val();
							}
							else
							{
								self.val(maxdisp);
								self.trigger("change");
								alert("Por disponibilidad del proyecto puedes invertir como maximo, $"+$.number_format(maxdisp,0,",","."));
							}
						}	
					});
				}
				else
				{
					self.val(10000);
					alert("El valor debe ser un numero en multiplos de 10.000");
				}
			}			
		}
		catch(e)
		{
			self.val(10000);
			alert("El valor debe ser un numero en multiplos de 10.000");

		}
	}).keypress(function(e) {
	    if(e.which == 13) {
	        $(this).trigger("change");
	    }
	});
	// MANEJAMOS EL BOTON DE TU INVERSION
	$.changetoinvertir = function(){
		$("#coi_invertir h5").html($.format_string($.coi($.eollice.simulador.monto),true));
		$("#ganaras_invertir h5").html($.format_string($.uticredi($.eollice.simulador.monto, $.eollice.simulador.tasa, $.eollice.simulador.plazo),true));
		$("#monto_invertir h5").html($.format_string($.eollice.simulador.monto,true));
		$(".simulacion").fadeOut(500, function(){
			$(".tuinversion").show();
		});
		$(".suptabs").removeClass("active");
		$(".inversiontab").addClass("active");
	};
	$("#boton-invertir").on('click', function(){
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'inversion',
				method: 'posibleInvertir',
				data: JSON.stringify({
					id: $.getUrlVars()['id']
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == "ok"){
					$.changetoinvertir();
				}
				else if(result.status == "noinit"){
					alert("El proyecto esta pronto a iniciar la fase de inversión, espere por favor.");
				}
				else if(result.status == "finish"){
					alert("El proyecto ya finalizo el plazo de inversión. Te invitamos a revisar otro proyecto de inversión.");	
				}
				else if(result.status == "financiado"){
					alert("El proyecto se encuentra financiado en su totalidad. Te invitamos a revisar otro proyecto de inversión.");
				}
				else
				{
					$("#btn-login-final").data('callback', '$.changetoinvertir();');
					$("#login #logincap").show();
					$("#login #regcap").hide();
					$("#login #recoverpasscap").hide();
					$('#login').modal('toggle');
				}
			}
		});
	});
	$("#boton-otro-proyecto").click(function(){
		location.href= "proyectos.php";
	});
	$("#checkbox-option-box").on('click', function(){
		if($(this).is(":checked")){
			$(".inversion_pago").fadeIn();
		}
		else{
			$(".inversion_pago").fadeOut();
		}
	});
	$("#modal-confirm-manual-btn").on('click', function(){
		$("#transfer-manual-modal").modal('hide');
		$(".modal-message").html('<center><img src="khipu/images/gif-load.gif" height="40"/><br><br>Estamos generando su orden de transacción, Espere un momento por favor...</center>');
		$(".modal-confirm-title").html("Generando Pago");
		$("#confirm-modal").modal('toggle');
		$('#modal-confirm-btn').hide();
		$('#modal-confirm-close').hide();
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'transferprotocol',
				method: 'generar_transfer',
				data: JSON.stringify({
					id_proyecto:$.getUrlVars()['id'],
					monto: parseInt($.eollice.simulador.monto),
					coi:parseInt($.coi($.eollice.simulador.monto)),
					code: $.eollice.simulador.code,
					id_banco: $("#cuenta-banco-data-input").val()
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == 0){
					location.href= "inversion.php?id="+$.getUrlVars()['id']+"&success=manual";
				}
			}
		});
	});
	$.funding = function(){
		$("#transfer-manual-modal").modal('hide');
		$(".modal-message").html('<center><img src="khipu/images/gif-load.gif" height="40"/><br><br>Estamos verificando la disponibilidad de la transacción, Espere un momento por favor...</center>');
		$(".modal-confirm-title").html("Generando Pago");
		$("#confirm-modal").modal('toggle');
		$('#modal-confirm-btn').hide();
		$('#modal-confirm-close').hide();
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'inversion',
				method: 'check_disponibilidad_final',
				data: JSON.stringify({
					id:$.getUrlVars()['id'] 
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				var maxdisp = (parseInt(result.monto) - parseInt(result.total));
				$("#confirm-modal").modal('hide');
				if(maxdisp >= $.eollice.simulador.monto){
					if($(".select_pago:checked").attr("tipo") == "khipu"){
						$(".modal-message").html('<center><img src="khipu/images/gif-load.gif" height="40"/><br><br>Generando pago, Espere un momento por favor...</center>');
						$(".modal-confirm-title").html("Transfiriendo a Khipu");
						$("#confirm-modal").modal('toggle');
						$('#modal-confirm-btn').hide();
						$('#modal-confirm-close').hide();
						$.ajax({
							url:"model/inversiones.php",
							type:"POST",
							data:{
								method:"confirm_founding",
								vars: JSON.stringify({
									id_proyecto:$.getUrlVars()['id'],
									monto: parseInt($.eollice.simulador.monto),
									coi:parseInt($.coi($.eollice.simulador.monto)),
									id_banco: $("#cuenta-banco-data-input").val()
								})
							},
							success:function(resultado){
								$.check_security(resultado);
								var result = JSON.parse(resultado);
								location.href=result.url;
							}
						});
					}
					else if($(".select_pago:checked").attr("tipo") == "manual")
					{
						$.ajax({
							url: "controller/ajax/handler.php",
							type: "POST",
							data:{
								lib: 'transferprotocol',
								method: 'get_code_transfer',
								data: JSON.stringify({
								})
							},
							success:function(resultado){
								$.check_security(resultado);
								var result = JSON.parse(resultado);
								$("#transfer-manual-modal .valor").html("$"+$.number_format((parseInt($.eollice.simulador.monto)+parseInt($.coi($.eollice.simulador.monto))),0,",","."));
								$("#transfer-manual-modal .codigo-transfer-manual").html(result.code);
								$.eollice.simulador.code = result.code;
								$("#transfer-manual-modal").modal('toggle');
							}
						});
					}
				}
				else
				{
					$(".simulacion_tabs_data").trigger('click');
					alert("Por disponibilidad actual del proyecto puedes invertir como maximo, $"+$.number_format(maxdisp,0,",","."));
				}
			}
		});
	};
	$("#confirm_founding").click(function(){
		if($("#cuenta-banco-data-input").val() != "default")
		{
			$("#cuenta-banco-data-input").parent().removeClass('has-error');
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'user',
					method: 'is_complete_acount',
					data: JSON.stringify({
					})
				},
				success:function(resultado){
					$.check_security(resultado);
					var result = JSON.parse(resultado);
					if(result.status == 0){
						$("#namecompleto-data-input").val(result.name)
						$("#user-data-modal").modal('toggle');
						$("#user-data-modal").data('callbak', function(){
							$.funding();
						});
					}
					else
					{
						$.funding();
					}
				}
			});
		}
		else
		{
			$("#cuenta-banco-data-input").parent().addClass('has-error');
			alert("Debe elegir una cuenta bancaria con la que ejecutar la operación de inversión.")
		}
	});
	$.lista_espera = function(){
		$(".modal-message").html('<center><img src="khipu/images/gif-load.gif" height="40"/><br><br>Estamos inscribiendolo en la lista de espera, Espere un momento por favor...</center>');
		$(".modal-confirm-title").html("Lista de Espera");
		$("#confirm-modal").modal('toggle');
		$('#modal-confirm-btn').hide();
		$('#modal-confirm-close').hide();
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'inversion',
				method: 'lista_espera',
				data: JSON.stringify({
					id:$.getUrlVars()['id']
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == 0){
					$(".modal-message").html('Has sido agregado(a) a la lista de espera para invertir. <br><br>Te enviaremos un E-mail cuando se abra un nuevo proyecto de inversión o alguno de los inversionistas actuales para este proyecto se retire.');
					$(".modal-confirm-title").html("Lista de Espera");
					$('#modal-confirm-close').hide();
					$('#modal-confirm-btn').show().on('click', function(){
						$("#confirm-modal").modal('hide');
						$('#modal-confirm-close').show();
					});
				}else{
					$(".modal-message").html('Ha fallado la inscripcion en la lista de espera. <br><br>Te pedimos que envies un E-mail al staff de Eollice para informar del problema.');
					$(".modal-confirm-title").html("Lista de Espera");
					$('#modal-confirm-close').hide();
					$('#modal-confirm-btn').show().on('click', function(){
						$("#confirm-modal").modal('hide');
						$('#modal-confirm-close').show();
					});
				}
			}
		});
	};
	// LISTA DE ESPERA PARA proyecto
	$("#boton-lista-espera").on('click', function(){
		$.lista_espera();
	});
	$("#boton-lista-espera_2").on('click', function(){
		$.lista_espera();
	});
	// MANEJAMOS EL AGREGAR BANCO
	$("#add-cuenta-banco").on('click',function(){
		$('#provincia option[value="default"]').attr("selected",true);
		$('#provincia option[value="Cuenta Corriente"]').attr("selected",true);
		$("#numero-bank-data-input").val('');
		$("#numero-bank-data-input").parent().removeClass("has-error");
		$("#bank-data-modal").modal('toggle');
	});
	$("#mod-cuenta-banco").on('click',function(){
		if($("#cuenta-banco-data-input").val() != "default")
		{
			$('#tipo-bank-data-input option[value="default"]').attr("selected",true);
			$('#banco-data-input option[value="Cuenta Corriente"]').attr("selected",true);
			$("#numero-bank-data-input").val('');
			$("#numero-bank-data-input").parent().removeClass("has-error");
			$("#mod-data-bank").val($("#cuenta-banco-data-input").val());
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'inversion',
					method: 'fetch_banco',
					data: JSON.stringify({
						id_banco:$("#cuenta-banco-data-input").val()
					})
				},
				success:function(resultado){
					$.check_security(resultado);
					var result = JSON.parse(resultado);
					$("#numero-bank-data-input").val(result.numero_cuenta_banco);
					$('#tipo-bank-data-input option[value="'+result.tipo_de_cuenta+'"]').attr("selected",true);
					$('#banco-data-input option').each(function(){
						if($(this).html() == result.banco){
							$(this).attr("selected",true);
						}
					});
				}
			});
			$("#bank-data-modal").modal('toggle');
		}
		else
		{
			alert("Debe elegir la cuenta a modificar.")
		}
	});

	//COMPROBAMOS LA FINALZIACIOND E UNA TRANSACCION
	$.check_result_kiphu();
	//TOOLTIPS
	$(".tooltips-big").tooltip();
	$(".tooltips").tooltip();
	//TIMER RELOJ
	setInterval(function() {
	   //PARTIMOS CON LOS INITTIME
	    $(".timer").each(function(key,value){
	    	var d = new Date();
	    	var tiempo = parseInt($(this).attr('number'));
	    	var resto = tiempo - (d.getTime()/1000);
	    	if(resto < 0){
	    		if($(this).hasClass('btn-inv')){
	    			$("#boton-invertir").html('<h5><b><center>Invierte en este proyecto</center></b></h5><span style"font-size:12px;"></span>').removeAttr('disabled');
	    			$(this).removeClass('timer');
	    		}
	    		else
	    		{
	    			$(".infos-costos").html('<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1"> <h4 style="height:10px;">Costo de Inversión</h4><h2>$100</h2><h6>Por cada $10.000 pesos de inversión.</h6></div>')
	    			$(this).removeClass('timer');
	    		}
	    	}
	    	else
	    	{
	    		var horas = Math.floor(resto/3600);
		    	var minutos = Math.floor(((resto%3600)/60));
		    	var segundos = Math.floor(((resto%3600)%60));
		    	$(this).html(horas+"h:"+minutos+"m:"+segundos+"s");
	    	}
	    });
	}, 1000);
});