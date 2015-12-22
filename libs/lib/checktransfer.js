// JavaScript Document
$(document).ready(function() {
	$(".modal-title").html("Confirmando Operacion...");
	$(".modal-body").html('<center><img src="khipu/images/484.gif" /></center><p><br><center>Estamos verificando la transacción en nuestro sistema. Espere por Favor...</center></p>');
	$(".modal-footer").html("");
	$("#confirm-modal").modal('toggle');
	function verificar(){
		if(typeof $.getUrlVars()['token'] != "undefined"){
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'transferprotocol',
					method: 'check_transaction',
					data: JSON.stringify({
						token: $.getUrlVars()['token']
					})
				},
				success:function(resultado){
					var result = JSON.parse(resultado);
					if(result.status == 0){
						$(".modal-body").html('<center><img src="khipu/images/484.gif" /></center><p><br><center>Hemos verificado con exito la transacción. Te transferiremos...</center></p>');
						setTimeout(function(){
							location.href="inversion.php?id="+result.id+"&success=true"
						},3000);
					}
					else if(result.status == 1){
						verificar();
					}
					else if(result.status == 2){
						$(".modal-body").html('<center><img src="khipu/images/484.gif" /></center><p><br><center>El token de transacción no existe o ya caduco. Te transferiremos...</center></p>');
						setTimeout(function(){
							location.href="inversion.php?id="+result.id
						},3000);
					}
				}
			});
		}
		else if(typeof $.getUrlVars()['failtoken'] != "undefined")
		{
			$.ajax({
				url: "controller/ajax/handler.php",
				type: "POST",
				data:{
					lib: 'transferprotocol',
					method: 'fail_transaction',
					data: JSON.stringify({
						token: $.getUrlVars()['failtoken']
					})
				},
				success:function(resultado){
					alert(resultado);
					$.check_security(resultado);
					var result = JSON.parse(resultado);
					if(result.status == 0){
						$(".modal-body").html('<center><img src="khipu/images/484.gif" /></center><p><br><center>La transacción ha fracasado o ha sido cancelada. Te transferiremos...</center></p>');
						setTimeout(function(){
							location.href="inversion.php?id="+result.id+"&success=false"
						},3000);
					}
				}
			});
		}
		
	}
	setTimeout(function(){verificar()},3000);

});