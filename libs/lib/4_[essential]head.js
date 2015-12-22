$( document ).ready(function() {
	// Handler for .ready() called.	
	//ASIGNAMOS LOS LINKS
	$("#howitwork-btn").on('click', function(e){
		location.href = "index.php#howitwork";
	});
	$("#howarewe-btn").on('click', function(e){
		location.href = "index.php#howarewe";
	});
	$("#contacto-btn").on('click', function(e){
		location.href = "index.php#contact";
	});
	$("#login-btn-header").on('click', function(){
		$("#login #logincap").show();
		$("#login #regcap").hide();
		$("#login #recoverpasscap").hide();
		$('#login').modal('toggle');
	});
	$("#reg-btn-header").on('click', function(){
		$("#login #logincap").hide();
		$("#login #regcap").show();
		$("#login #recoverpasscap").hide();
		$('#login').modal('toggle');
	});
	$("#logout-btn-header").on('click', function(){
		$(".modal-confirm-title").html("Cerrar Sesion")
		$(".modal-message").html('<center><img src="images/platform/484.gif" /></center><p><br><center>Cerrando Sesion. Espere por Favor...</center></p>');
		$(".confirm-footer button").hide();
		$("#confirm-modal").modal('toggle');
		$.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "user",
	    		method: "logout",
	    		data: JSON.stringify({
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
	    		$(".user_divs").fadeOut(500, function(){
	    			$(".registro_divs").fadeIn();
	    		});
	    		try{
		    		$(".postuserbox").fadeOut(500, function(){
		    			$(".loginbox").fadeIn();
		    			$("#confirm-modal").modal('hide');
		    		});
		    	}
		    	catch(e){
		    		
		    	}
	    		$("#confirm-modal").modal('hide');
	    	}
	    })
	});
	
});