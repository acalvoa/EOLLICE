$( document ).ready(function() {
$("#modal-confirm-user-btn").on('click', function(){
	$(".user-complete-data").each(function(){
		$(this).parent().removeClass("has-error");
		$(this).parent().children('label').html($(this).parent().children('label').html().replace(" - Debe ser completado", ""))
		$(this).parent().children('label').html($(this).parent().children('label').html().replace(" - El Rut indicado es invalido", ""))
	});
	if($("#namecompleto-data-input").val() != "" && $("#rut-data-input").val() != "" && $("#telefono-data-input").val() != "" && $("#domicilio-data-input").val() != ""){
		if($.validar_rut($("#rut-data-input").val())){
			$.ajax({
		    	url: "controller/ajax/handler.php",
		    	type: "POST",
		    	data: {
		    		lib: "user",
		    		method: "complete_account",
		    		data: JSON.stringify({
		    			nombre: $("#namecompleto-data-input").val(),
		    			rut: $("#rut-data-input").val(),
		    			telefono: $("#telefono-data-input").val(),
		    			domicilio: $("#domicilio-data-input").val(),
		    			ciudad: $("#ciudad-data-input").val(),
		    			lastname_father: $("#father_name-data-input").val(),
		    			lastname_mother: $("#mother_name-data-input").val(),
		    			numero_domicilio: $("#numero-data-input").val(),
		    			numero_depto: $("#depto-data-input").val(),
		    			edificio: $("#edificio-data-input").val(),
		    			comuna: $("#comuna-data-input").val()
		    		})
		    	},
		    	success: function(resultado){
		    		$.check_security(resultado);
					var result = JSON.parse(resultado);
					var callback = $("#user-data-modal").data('callbak');
					$("#user-data-modal").modal('hide');
					callback();
		    	}
		    });
		}
		else
		{
			$("#rut-data-input").parent().addClass("has-error");
			$("#rut-data-input").parent().children('label').html($("#rut-data-input").parent().children('label').html()+" - El Rut indicado es invalido")

		}
	}
	else
	{
		$(".user-complete-data").each(function(){
			if($(this).val() == ""){
				$(this).parent().addClass("has-error");
				$(this).parent().children('label').html($(this).parent().children('label').html()+" - Debe ser completado")
			}
		});
	}
});
$('#rut-data-input').on('change',function(e) {
    $(this).val($.formatear_rut($(this).val()));
});
$("#modal-confirm-bank-btn").on('click', function(){
	if($("#mod-data-bank").val() == "false"){
		$.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "inversion",
	    		method: "add_bank",
	    		data: JSON.stringify({
	    			banco: $("#banco-data-input").val(),
	    			numero: $("#numero-bank-data-input").val(),
	    			tipo: $("#tipo-bank-data-input").val()
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == 0){
					result.data = JSON.parse(result.data);
					$('#cuenta-banco-data-input option').remove();
					$('#cuenta-banco-data-input').append('<option value="default">Selecciona la Cuenta Bancaria</option>');
					$.each(result.data, function(key,value){
						$('#cuenta-banco-data-input').append('<option value="'+value.id_bank+'">'+value.name+'</option>');
						$('#cuenta-banco-data-input option[value="'+value.id_bank+'"]').attr("selected",true);
					});
					$("#bank-data-modal").modal('hide');
				}
				else
				{
					$("#numero-bank-data-input").parent().addClass('has-error');
					$("#numero-bank-data-input").parent().children('label').append(' - Esta cuenta ya se encuentra registrada.')
				}
	    	}
	    });
	}
	else
	{
		$.ajax({
	    	url: "controller/ajax/handler.php",
	    	type: "POST",
	    	data: {
	    		lib: "simulacion",
	    		method: "mod_bank",
	    		data: JSON.stringify({
	    			banco: $("#banco-data-input").val(),
	    			numero: $("#numero-bank-data-input").val(),
	    			tipo: $("#tipo-bank-data-input").val(),
	    			id_cuenta: $("#mod-data-bank").val()
	    		})
	    	},
	    	success: function(resultado){
	    		$.check_security(resultado);
				var result = JSON.parse(resultado);
				if(result.status == 0){
					result.data = JSON.parse(result.data);
					$('#cuenta-banco-data-input option').remove();
					$('#cuenta-banco-data-input').append('<option value="default">Selecciona la Cuenta Bancaria</option>');
					$.each(result.data, function(key,value){
						$('#cuenta-banco-data-input').append('<option value="'+value.id_bank+'">'+value.name+'</option>');
						$('#cuenta-banco-data-input option[value="'+value.id_bank+'"]').attr("selected",true);
					});
					$("#mod-data-bank").val('false');
					$("#bank-data-modal").modal('hide');
				}
	    	}
	    });
	}
	
});
});