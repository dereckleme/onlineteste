$(function(){
		$(".actionCategoriaGerenciar").on("click",function(){
			$(".gerCategorias").slideToggle();
		});
		$(".actionSubcategoriaGerenciar").on("click",function(){
			$(".gerSubCategorias").slideToggle();
		});
		$('#criaCategorias,#criaSubCategorias,#addProdutos').on('hidden', function () {
			location.reload();
		});
		$("#actionAddCat").on("click",function(){
			var eventCategoria = $("#criaCategorias .tituloCat").val();
			$.ajax({
				url: basePatch+"/administrador/categorias/insert",
				type: "post",
				async:false,
				data: {eventCategoria:eventCategoria},
				success: function(data) {
					if(data == "")
						{
						$("#criaCategorias #message").removeClass('alert-error');
						$("#criaCategorias #message").addClass("alert-success");
						$("#actionAddCat").fadeOut();
						$("#criaCategorias #message").html("- Categoria adicionada com sucesso.");
						
						}
					else
						{
						$("#criaCategorias #message").addClass("alert-error");
						$("#criaCategorias #message").html(data);
						}
					$("#criaCategorias #message").fadeIn();
				}
			});
			
			return false;
		});
		$("#actionAddSubCat").on("click",function(){
			var eventCategoria = $("#criaSubCategorias .categoriaId").val();
			var eventSubcategoria = $("#criaSubCategorias .tituloSubCat").val();
			$.ajax({
				url: basePatch+"/administrador/categorias/insertSub",
				type: "post",
				async:false,
				data: {eventCategoria:eventCategoria,eventSubcategoria:eventSubcategoria},
				success: function(data) {
					if(data == "")
					{
					$("#criaSubCategorias #message").removeClass('alert-error')
					$("#criaSubCategorias #message").addClass("alert-success");
					$("#actionAddSubCat").fadeOut();
					$("#criaSubCategorias #message").html("- SubCategoria adicionada com sucesso.");
					
					}
				else
					{
					$("#criaSubCategorias #message").addClass("alert-error");
					$("#criaSubCategorias #message").html(data);
					}
					$("#criaSubCategorias #message").fadeIn();
				}
			});
			return false;
		});
		
		$("select[name=inputCategoria]").on("change", function(){
			var value = $(this).val();
			
			$.ajax({
				type	:	"post",
				url		:	basePatch+"/administrador/produto/subCategoriaByCategoria",
				data	:	{valor:value},
				beforeSend: function(){
					$('select[name=inputSubCategoria]').empty();
					$('select[name=inputSubCategoria]').append("<option>Caregando.....</option>");
				},
				success	:	function(data){
					$('select[name=inputSubCategoria]').empty();
					$('select[name=inputSubCategoria]').append(data);
				},
				error	:	function(){
					
				}
			});
		});		
		
		$(".input-medium").mask("9?99");
		$("#inputPeso").mask("9.999");
		$('#inputValor').priceFormat({
		    prefix: false,
		    centsSeparator: ',',
		    thousandsSeparator: '.'
		});
		
		$("#actionAddReferencia").on("click", function(){	
			var eventReferencia = $("#criaReferencias .tituloReferencia").val();
			$.ajax({
				url: basePatch+"/administrador/referencia/insert",
				type: "post",
				async:false,
				data: {eventReferencia:eventReferencia},
				success: function(data) {
					if(data == "")
						{
						$("#criaReferencias #message").removeClass('alert-error');
						$("#criaReferencias #message").addClass("alert-success");
						$("#actionAddCat").fadeOut();
						$("#criaReferencias #message").html("- Referencia adicionada com sucesso.");
						
						}
					else
						{
						$("#criaReferencias #message").addClass("alert-error");
						$("#criaReferencias #message").html(data);
						}
					$("#criaReferencias #message").fadeIn();
				}
			});
			return false;
		})
		
});