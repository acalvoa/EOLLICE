$( document ).ready(function() {
	$(".button-invertir").on('click', function(){
		location.href=$(this).attr('data');
	});
	setInterval(function() {
	   //PARTIMOS CON LOS INITTIME
	    $(".Time").each(function(key,value){
	    	var d = new Date();
	    	var tiempo;
	    	if($(this).hasClass('init')){
	    		tiempo = parseInt($(this).attr('initnumber'));
	    		if((tiempo - (d.getTime()/1000)) <= 0){
	    			$(this).removeClass('init').addClass('dead');
	    			//$(this).parent().parent().parent().children('.btn-inversion').children('button').removeAttr('disabled');
	    			$(this).parent().children('tiempo').html('Plazo para invertir:');
	    		}	
	    		else
	    		{
	    			//$(this).parent().parent().parent().children('.btn-inversion').children('button').attr('disabled','disabled');
	    		}
	    	}else{
	    		tiempo = parseInt($(this).attr('deadnumber'));
	    	}
	    	
	    	var resto = tiempo - (d.getTime()/1000);
	    	if(resto <= 0){
	    		$(this).html("0h:0m:0s");
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