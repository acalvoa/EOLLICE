// JavaScript Document
$(document).ready(function() {
	$.ajax({
		url:"https://khipu.com/api/1.1/receiverStatus",
		type:"POST",
		dataType: "jsonp",
		crossDomain: true,
		data:{
			hash:"803ec9ce0d9cdb28a577f5c86399f2e65dff2763",
			receiver_id: "4530"
		}
	});
});