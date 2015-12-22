// JavaScript Document
$(document).ready(function() {
	// FORMULAS DE INVERSION
	// COSTO DE OPCION DE INVERSION
	$.coi = function(inversion){
		return (inversion/10000)*100;
	}
	// GASTOS DE ADMINISTRACION
	$.gda = function(inversion,tasa,plazo){
		return $.pago_mensual(inversion,tasa,plazo)*0.008;
	}
	// CUOTA MENSUAL
	$.cmensual = function(inversion,tasa,plazo){
		return $.pago_mensual(inversion,tasa,plazo)*0.992;
	}
	// UTILIDADES DEL CREDITO
	$.uticredi = function(inversion,tasa,plazo){
		return $.cmensual(inversion,tasa,plazo)*plazo-(inversion*1.01);
	}
	// TIEMPO DE RECUPERACION EN MESES
	$.trecupe = function(inversion,tasa,plazo){
		return (inversion/$.cmensual(inversion,tasa,plazo));
	}
	// FUNCION SUMATORIA
	$.sumatoria = function(t,n,r){
		if(t <= n){
			var value = 1/(Math.pow((1+(r/100)),t));
			t++;
			return value + $.sumatoria(t,n,r);
		}
		else
		{
			return 0;
		}
	}
	// FUNCION QUE CALCULA EL PAGO MENSUAL
	$.pago_mensual = function(inversion,tasa,plazo){
		var tasa_m = tasa/12;
		return inversion/$.sumatoria(1,plazo,tasa_m);
	}
	// FIN DE FORULAS DE INVERSION
	//////////////////////////////
	// FORMATEAR RUT
	$.formatear_rut = function(rut)
	{
		rut = rut.replace(".","");
		rut = rut.replace("-","");
		var valor = rut.slice(0,-1);
		var verificador = rut.slice(-1);
		valor = valor.replace(".","");
		var final_rut = $.number_format(valor,0,",",".").concat("-").concat(verificador);
	    //Pasamos al campo el valor formateado
	    return final_rut.toUpperCase();
	 }
	// VALIDAR RUT
	$.validar_rut = function (rutCompleto) {
		rutCompleto = rutCompleto.replace(".","");
		rutCompleto = rutCompleto.replace(".","");
        if (!/^[0-9]+-[0-9kK]{1}$/.test( rutCompleto )) {
           return false;
        }
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1];
        var rut     = tmp[0];
        if ( digv == 'K' ) {
            digv = 'k' ;
        }
        var digesto = $.dv(rut);
        if (digesto == digv ){
            return true;
        } else {
            return false;
        }
    }
    $.dv = function(T){
       var M=0,S=1;
       for(;T;T=Math.floor(T/10)) {
           S=(S+T%10*(9-M++%6))%11;
       }
       return S?S-1:'k';
    }
	// FUNCION NUMBER FORMAT PHP
	$.number_format = function(number, decimals, dec_point, thousands_sep){
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	  	var n = !isFinite(+number) ? 0 : +number,
	    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	    s = '',
	    toFixedFix = function (n, prec) {
	      var k = Math.pow(10, prec);
	      return '' + Math.round(n * k) / k;
	    };
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
		    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
		    s[1] = s[1] || '';
	    	s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
	// FUNCION RECUPERADOR PARAMETROS QUERYSTRING
	$.getUrlVars = function() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
	// FUNCION DE ACTIVACION DE CUENTA
	$.postactivacion = function(){
		var variables = $.getUrlVars();
		if(typeof variables['activeToken'] != "undefined"){
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'user',
					method: 'activeUser',
					data: JSON.stringify({
						token: variables['activeToken']
					})
				},
				success:function(resultado){
					$.check_security(resultado);
					var result = JSON.parse(resultado);
					if(result.status == 1){
						$(".modal-confirm-title").html("Cuenta activada")
						$(".modal-message").html('<center><h1><i class="fa fa-user" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">Hemos verificado tu correo. Tu cuenta ha sido activada de forma exitosa.<br><br><br> <h5 style="text-align:justify;">Ahora puedes ingresar a la plataforma de inversion Eollice.</h5></h5></center>');
						$(".confirm-footer button").show();
						$("#confirm-modal").modal('toggle');
						$("#modal-confirm-btn").on('click', function(){
							$("#confirm-modal").modal('hide');
							$("#login #logincap").show();
							$("#login #regcap").hide();
							$("#login #recoverpasscap").hide();
							$('#login').modal('toggle');
							$(this).unbind();
						});
					}
				}
			});
		}	
	}
	$.changePassword = function(){
		var variables = $.getUrlVars();
		if(typeof variables['recoverToken'] != "undefined"){
			$("#login #logincap").hide();
			$("#login #regcap").hide();
			$("#login #recoverpasscap").hide();
			$("#login #recover-final-cap").show();
			$('#login').modal('toggle');
		}	
	}
	$.check_result_kiphu = function(){
		var bar = $.getUrlVars();
		if(bar['success'] == 'true'){
			$(".modal-confirm-title").html("Inversión Confirmada")
			$(".modal-message").html('<b>¡Felicitaciones por invertir en uno de los proyectos de energías renovables de Eollice!</b><br><br>Tu transacción correspondiente a “Costo por Opción de Inversión” e “Inversión” está lista.<br><br>Cuando se haya reunido todo el financiamiento, se te informará las fechas de pago de la cuota correspondiente a un inversión. Todo esto se informará a través de correo electrónico.<br><br>Si tienes alguna duda, nos puedes contactar a contacto@eollice.com.<br><br>Saludos.<br><br>Equipo Eollice');
			$(".confirm-footer button").show();
			$("#confirm-modal").modal('toggle');
			$("#modal-confirm-close").hide();
			$("#modal-confirm-btn").on('click', function(){
				$("#confirm-modal").modal('hide');
				$(this).unbind();
				$("#modal-confirm-close").show();
			});
		}
		else if(bar['success'] == 'false'){
			$(".modal-confirm-title").html("Inversión no completada.")
			$(".modal-message").html('Hubo un error en el pago de tu inversion o este proceso fue cancelado, por favor intentalo de nuevo o realiza la transacción de forma manual.<br><br>Cualquier pregunta no dudes en escribirnos a contacto@eollice.com');
			$(".confirm-footer button").show();
			$("#confirm-modal").modal('toggle');
			$("#modal-confirm-btn").on('click', function(){
				$("#confirm-modal").modal('hide');
				$(this).unbind();
			});
		}
		else if(bar['success'] == 'manual'){
			$(".modal-confirm-title").html("Confirmacion de inversión completada.")
			$(".modal-message").html('<b>¡Felicitaciones por invertir en uno de los proyectos de energías renovables de Eollice!</b><br><br>El monto de inversión que has ingresado ha sido incluida con éxito.<br><br>Recuerda que tiene 24 horas para hacer la transferencia de dinero correspondiente a “Costo por Opción de Inversión” e “Inversión”. Si en 24 horas no haces la transferencia, eliminaremos tu inversión del fondo del financiamiento para que otros inversionistas puedan participar.<br><br>Si ya realizaste la transferencia, ignora este mensaje.<br><br>Si tienes alguna duda, nos puedes contactar a contacto@eollice.com.<br><br>Saludos.<br><br>Equipo Eollice.');
			$(".confirm-footer button").show();
			$("#confirm-modal").modal('toggle');
			$("#modal-confirm-btn").on('click', function(){
				$("#confirm-modal").modal('hide');
				$(this).unbind();
			});
			
			$("#confirm-modal-2").modal('toggle');
		}
	}
	// FUNCION PARA FORMATEAR DINERO y STRING
	$.format_string = function(valor,money,agregado){
		if(typeof agregado == "undefined"){
			agregado = "";
		}
		if(money){
			return "$"+$.number_format(valor,0,"",".")+agregado;
		}
		else
		{
			return $.number_format(valor,0,"",".")+agregado;
		}
	}
	
	// FUNCION PARA CHECKEAR USUARIOS CONECTADOS
	$.check_security = function(data){
		if(data == "ERROR HANDLER - ERROR DE SEGURIDAD: COD 02")
		{
			alert("La sesion de usuario actual ha expirado. Para utilizar la plataforma vuelva a conectarse");
		}
	}
	//FUNCION QUE RECUPERA LOS INDICADORES Y LOS VUELVE CONSTANTES
	$.indicadores = function(id, callback){
		$.ajax({
			url: "controller/ajax/handler.php",
			type: "POST",
			data:{
				lib: 'simulacion',
				method: 'indicadores',
				data: JSON.stringify({
					id: id
				})
			},
			success:function(resultado){
				$.check_security(resultado);
				var result = JSON.parse(resultado);
				$.eollice = {};
				$.eollice.simulador = {};
				$.eollice.simulador.id = result.id;
				$.eollice.simulador.tasa = result.tasa;
				$.eollice.simulador.plazo = result.plazo;
				$.eollice.simulador.monto = result.monto;
				$.eollice.simulador.invertido = result.invertido;
				callback();
			}
		});
	}
	//FUNCION LEE BARRA
	$.leerurlsection = function(){
		var url = document.location.href;
		url = url.substring(url.lastIndexOf('#')+1);
		return url;
	}
});