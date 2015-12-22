// JavaScript Document
$(document).ready(function() {
	$(".modal-title").html("Confirmando Operacion...");
	$(".modal-body").html('<center><img src="images/484.gif" /></center><p><br><center>Estamos verificando la transacción en nuestro sistema. Espere por Favor...</center></p>');
	$(".modal-footer").html("");
	$("#confirm-modal").modal('toggle');
	function verificar(){
		$.ajax({
			url: "checktransfer_protocol.php",
			type: "POST",
			async: false,
			data:{

			},
			success: function(resultado){
				if(resultado == "VERIFICADO"){
						
				}
				
			}
		});
	}
	setTimeout(function(){verificar()},3000);

});