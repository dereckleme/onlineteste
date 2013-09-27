$(document).ready(function(){	
	setInterval(function(){
	$(".statusNpedido").each(function( i, val ) {
			var idRecibo = $(val).attr("rel");
					$.ajax({
					url: basePatch+"/painel/status/"+idRecibo,
					async:false,
					success: function(data) {
						if(data != "")
							{
							$("p",val).html(data);
							}
					},
					error: function(){}
						});
		});
	 }, 5000);
})