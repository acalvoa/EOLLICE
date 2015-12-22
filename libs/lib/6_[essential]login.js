$( document ).ready(function() {
	// Handler for .ready() called.	
	$("#btn-registro").on('click', function(){
		$("#logincap").hide("drop", function(){
			$("#regcap").show("drop");
		});
	});
	$("#btn-login").on('click', function(){
		$("#regcap").hide("drop", function(){
			$("#logincap").show("drop");
		});
	});
	$("#btn-registro-recover").on('click', function(){
		$("#recoverpasscap").hide("drop", function(){
			$("#regcap").show("drop");
		});
	});
	//ACCIONE DE LOS BOTONES DE LOG AND REG
	$("#btn-login-final").on('click', function(){
		var btn = $(this);
	    btn.button('loading');
	    $.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "user",
	    		method: "login",
	    		data: JSON.stringify({
	    			email: $("#email-data").val(),
	    			password: $("#password-data").val(),
	    			remember: $("#remember-data").is(':checked')
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
	    		var result = JSON.parse(resultado);
	    		if(result.status == 0){
	    			if(btn.data('callback') != "" && typeof btn.data('callback') != "undefined"){
		    			eval(btn.data('callback'));
		    		}
		    		$(".registro_divs").fadeOut(500, function(){
		    			$(".user_divs").fadeIn();
		    		});
		    		$(".user_divs a .user_divs_data").html(result.name);
		    		try{
		    			$(".loginbox").fadeOut(500, function(){
			    			$(".postuserbox").fadeIn();
			    			$("#login").modal('hide');
			    		});
		    		}
		    		catch(e){
		    			
		    		}
		    		$("#login").modal('hide');
	    		}
	    		else
	    		{
	    			$(".modal-confirm-title").html("Usuario o Contraseña Incorrecto")
					$(".modal-message").html('<center><h1><i class="fa fa-user" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">El usuario o la contraseña indicada no corresponden.<br><br><br> <h5 style="text-align:justify;">¿Tiene una cuenta creada?, en caso contrario te invitamos a ser parte de la comunidad Eollice.</h5></h5></center>');
					$(".confirm-footer button").show();
					$("#confirm-modal").modal('toggle');
					$("#modal-confirm-btn").on('click', function(){
						$("#confirm-modal").modal('hide');
						$(this).unbind();
					});
	    		}
	    	}
	    }).always(function () {
	      btn.button('reset');
	    });
	});
	// REGISTRO DE USUARIO
	$("#repeat-password-reg-data").keypress(function(e) {
	    if(e.which == 13) {
	        $("#btn-registro-final").trigger("click");
	    }
	});
	$("#btn-registro-final").on('click', function(){
		if($("#password-reg-data").val() == $("#repeat-password-reg-data").val())
		{
			var btn = $(this);
		    btn.button('loading');
		    $.ajax({
		    	url: "controller/ajax/handler.php",
		    	type: "POST",
		    	data: {
		    		lib: "user",
		    		method: "reguser",
		    		data: JSON.stringify({
		    			nombre: $("#name-reg-data").val(),
		    			email: $("#email-reg-data").val(),
		    			password: $("#password-reg-data").val()
		    		})
		    	},
		    	success: function(resultado){
		    		$.check_security(resultado);
		    		var result = JSON.parse(resultado);
		    		if(result.status == 0){
		    			$(".modal-confirm-title").html("Te Hemos enviado un correo con tus datos de activación.")
						$(".modal-message").html('<center><h1><i class="fa fa-envelope-o" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:justify;">Este paso es fundamental para poder operar en la plataforma, ya que gracias a este metodo verificamos y validamos tu correo de forma segura. <br><br><h5>Si no llega en los proximos minutos a tu bandeja de entrada, recuerda revisar tu carpeta de Spam y colocarnos en tu lista de correos seguros. De esta forma aseguraremos la entrega oportuna de información sobre los proyectos disponibles.</h5></center>');
						$(".confirm-footer button").show();
						$("#confirm-modal").modal('toggle');
						$("#modal-confirm-btn").on('click', function(){
							$("#confirm-modal").modal('hide');
							$("#regcap").hide("drop", function(){
								$("#logincap").show("drop");
								$("#login").modal("toggle");
							});
							$(this).unbind();
						});
		    		}
		    		else
		    		{
						$(".modal-confirm-title").html("Creacion de Usuario")
						$(".modal-message").html('<center><h1><i class="fa fa-user" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">El usuario indicado ya existe<br><br><br> <h5 style="text-align:justify;">Prueba con otro email o recupera la contraseña de tu cuenta con la herramienta dispuesta para ello.</h5></h5></center>');
						$(".confirm-footer button").show();
						$("#confirm-modal").modal('toggle');
						$("#modal-confirm-btn").on('click', function(){
							$("#confirm-modal").modal('hide');
							$(this).unbind();
						});
		    		}
		    	}
		    }).always(function () {
		      btn.button('reset');
		    });
		}
		else
		{
			alert("Las contraseñas indicadas deben coincidir");
		}
		
	});
	//FORGOT PASSWORD
	$("#email-forgot-data").keypress(function(e) {
	    if(e.which == 13) {
	        $("#btn-forgot-final").trigger("click");
	    }
	});
	$("#btn-forgot-final").on('click', function(){
		var btn = $(this);
	    btn.button('loading');
	    $.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "user",
	    		method: "forgotpassword",
	    		data: JSON.stringify({
	    			email: $("#email-forgot-data").val()
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
	    		var result = JSON.parse(resultado);
	    		if(result.status == 0){
		    			$(".modal-confirm-title").html("Te Hemos enviado un correo con Instrucciones.")
						$(".modal-message").html('<center><h1><i class="fa fa-envelope-o" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:justify;">Te hemos enviado un correo con instrucciones para recuperar tu contraseña. <br><br><h5>Si no llega en los proximos minutos a tu bandeja de entrada, recuerda revisar tu carpeta de Spam y colocarnos en tu lista de correos seguros. De esta forma aseguraremos la entrega oportuna de informacion sobre los proyectos disponibles.</h5></center>');
						$(".confirm-footer button").show();
						$("#modal-confirm-btn").on('click', function(){
							$("#confirm-modal").modal('hide');
							$("#recoverpasscap").hide("drop", function(){
								$("#logincap").show("drop");
								$("#login").modal("toggle");
							});
							$(this).unbind();
						});
						$("#confirm-modal").modal('toggle');
		    		}
		    		else
		    		{
						$(".modal-confirm-title").html("Recuperacion de Contraseña")
						$(".modal-message").html('<center><h1><i class="fa fa-user" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">No existen usuarios asociados a este E-Mail<br><br><br> <h5 style="text-align:justify;">Prueba con otro email y verifica que este sea correcto.</h5></h5></center>');
						$(".confirm-footer button").show();
						$("#confirm-modal").modal('toggle');
						$("#modal-confirm-btn").on('click', function(){
							$("#confirm-modal").modal('hide');
							$(this).unbind();
						});
		    		}
	    	}
	    }).always(function () {
	      btn.button('reset');
	    });
	});
	$(".recover-password-btn").on('click', function(){
		$("#logincap").hide("drop", function(){
			$("#recoverpasscap").show("drop");
		});
	});
	//CAPA DE RECUPERAR CONTRASEÑA
	$("#btn-recover-final").on('click', function(){
		var variables = $.getUrlVars();
		if($("#password-forgot-data").val() == $("#repeat-password-forgot-data").val())
		{
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'user',
					method: 'reDefinePassword',
					data: JSON.stringify({
						token: variables['recoverToken'],
						password: $("#password-forgot-data").val()
					})
				},
				success:function(resultado){
					$.check_security(resultado);
					var result = JSON.parse(resultado);
					if(result.status == 0){
						$(".modal-confirm-title").html("Contraseña cambiada con exito.")
						$(".modal-message").html('<center><h1><i class="fa fa-key" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">Tu contraseña ha sido restablecida de forma exitosa.<br><br><br> <h5 style="text-align:justify;">Ahora puedes ingresar a la primera plataforma de inversion en energias renovables de latinoamerica, Eollice.</h5></h5></center>');
						$(".confirm-footer button").show();
						$("#modal-confirm-btn").on('click', function(){
							$("#login #logincap").show();
							$("#login #regcap").hide();
							$("#login #recoverpasscap").hide();
							$("#login #recover-final-cap").hide();
							$(this).unbind();
							$("#confirm-modal").modal('hide');
						});
						$("#confirm-modal").modal('toggle');
					}
					else
					{
						$(".modal-confirm-title").html("Problema al cambiar contraseña.")
						$(".modal-message").html('<center><h1><i class="fa fa-key" style="font-size:2.5em;"></i></h1></center><center><br><h5 style="text-align:center;">El token indicado no es valido.<br><br><br> <h5 style="text-align:justify;">Intentelo de nuevo a traves del link entregado a su correo. Si los problemas persisten contacte con el staff Eollice.</h5></h5></center>');
						$(".confirm-footer button").show();
						$("#modal-confirm-btn").on('click', function(){
							$("#login #logincap").show();
							$("#login #regcap").hide();
							$("#login #recoverpasscap").hide();
							$("#login #recover-final-cap").hide();
							$(this).unbind();
							$("#confirm-modal").modal('hide');
						});
						$("#confirm-modal").modal('toggle');
					}
				}
			});
		}
		else
		{
			alert("Las contraseñas indicadas deben coincidir.");
		}
	
	});
	//CORROBORAMOS ACTIVACION DE CUENTA
	$.postactivacion();
	//CORROBORAMOS RECOBRAR CONTRASEÑA
	$.changePassword();
	
});