$( document ).ready(function() {
// Handler for .ready() called.	
	//DISPARADORES DE CAMBIO DE PAGINA
	$(document).on('scroll', function(e){
		if($(document).scrollTop() >= ($(".howitwork").offset().top -500)){
			$("#howitwork").fadeIn();
		}
		else if($(document).scrollTop() < ($(".howitwork").offset().top+500)){
			$("#howitwork").fadeOut();
		}
		//DISPARADORES DE CAMIO DE FONDO
		if(($(document).scrollTop() >= ($(".howarewe").offset().top -200)) && ($(document).scrollTop() <= ($(".contacto").offset().top -200))){
			$(".background_page").css({
				"background-image": 'url("images/platform/landing2.jpg")'
			});
		}
		else if($(document).scrollTop() >= ($(".contacto").offset().top -200))
		{
			$(".background_page").css({
				"background-image": 'url("images/platform/eolico.jpg")'
			});
		}
		else if($(document).scrollTop() <= ($(".howarewe").offset().top -200) && ($(document).scrollTop() <= ($(".howitwork").offset().top -200))){
			$(".background_page").css({
				"background-image": 'url("images/platform/fondo.jpg")'
			});
		}
		else
		{
			$(".background_page").css({
				"background-image": 'url("images/platform/background2.jpg")'
			});
		}
	});
	$("#password-data").keypress(function(e) {
	    if(e.which == 13) {
	        $("#btn-login-final").trigger("click");
	    }
	});
	//ASIGNAMOS LOS LINKS
	$("#howitwork-btn").unbind().on('click', function(e){
		$("html, body").animate({
			scrollTop: $(".howitwork").offset().top +20 + "px"
		}, {
			duration: 1000,
			easing: "swing"
		});
	});
	$("#howarewe-btn").unbind().on('click', function(e){
		$("html, body").animate({
			scrollTop: $(".howarewe").offset().top +20 + "px"
		}, {
			duration: 1000,
			easing: "swing"
		});
	});
	$("#contacto-btn").unbind().on('click', function(e){
		$("html, body").animate({
			scrollTop: $(".contacto").offset().top +20 + "px"
		}, {
			duration: 1000,
			easing: "swing"
		});
	});
	//PRESS ENTER
	$("#password-landing").keypress(function(e) {
	    if(e.which == 13) {
	        $("#login-btn-landing").trigger("click");
	    }
	});
	//LOGIN ACEPT
	$("#login-btn-landing").on('click', function(){
		var btn = $(this);
	    btn.button('loading');
	    $.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "user",
	    		method: "login",
	    		data: JSON.stringify({
	    			email: $("#email-landing").val(),
	    			password: $("#password-landing").val(),
	    			remember: $("#remember-landing").is(':checked')
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
	    		var result = JSON.parse(resultado);
	    		if(result.status == 0){
	    			$(".registro_divs").fadeOut(500, function(){
	    				$(".user_divs").fadeIn();
		    		});
		    		$(".user_divs a .user_divs_data").html(result.name);
		    		$(".loginbox").fadeOut(500, function(){
		    			$(".postuserbox").fadeIn();
		    			$("#login").modal('hide');
		    		});
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
	$("#forgot-landing").on('click', function(){
		$("#login #logincap").hide();
		$("#login #regcap").hide();
		$("#login #recoverpasscap").show();
		$('#login').modal('toggle');
	});
	$(".btn-action-landing").on('click', function(){
		location.href=$(this).attr('data');
	});
	$("#reg-btn-landing").on('click', function(){
		$("#login #logincap").hide();
		$("#login #regcap").show();
		$("#login #recoverpasscap").hide();
		$('#login').modal('toggle');
	});
	//ENVIO DE CONSULTAS
	$("#send-contact-message").on('click', function(){
		if($("#contact-email-landing").val() !=  "" && $("#contact-name-landing").val() != "" && $("#contact-mensaje-landing").val() != ""){
			$(".contact-input").each(function(){
				$(this).parent().removeClass('has-error');
			});
			var btn = $(this);
		    btn.button('loading');
		    $.ajax({
		    	url: "controller/ajax/handler.php",
		    	type: "POST",
		    	data: {
		    		lib: "user",
		    		method: "contacto",
		    		data: JSON.stringify({
		    			email: $("#contact-email-landing").val(),
		    			name: $("#contact-name-landing").val(),
		    			mensaje: $("#contact-mensaje-landing").val()
		    		})
		    	},
		    	success: function(resultado){
		    		var result = JSON.parse(resultado);
		    		if(result.status == 0){
		    			alert("Hemos recibido tu consulta con exito. Pronto te contactaremos.")
		    		}
		    	}
		    }).always(function () {
		      btn.button('reset');
		    });
		}
		else
		{
			$(".contact-input").each(function(){
				if($(this).val() == ""){
					$(this).parent().addClass('has-error');
				}
			});
		}
		
	})
	
});
$(document).ready(function(){
	var variables = $.leerurlsection();
	if(variables == "howitwork")
	{
		$("html, body").animate({
			scrollTop: $(".howitwork").offset().top +20 + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
	}
	else if(variables == "howarewe")
	{
		$("html, body").animate({
			scrollTop: $(".howarewe").offset().top +20 + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
	}
	else if(variables == "contact")
	{
		$("html, body").animate({
			scrollTop: $(".contacto").offset().top +20 + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
	}
});