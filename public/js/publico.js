$(function(){
		//Ações para inserção carrinho de compras
		$(".actionAddCarrinho").on("click", function(){	
			var actionIdProduto = $(this).attr("rev");	
			var actionQuant = $(this).parents("#comprar_detalhe, .box_vejaTambem, .lista_categoria_produtos").find('input').val();
			
			$.ajax({
				url: basePatch+"/carrinho/insert",
				type: "post",
				async:false,
				data: {actionAddCart:actionIdProduto,actionQuant:actionQuant},
				success: function(data) {
					$.ajax({
						url: basePatch+"/carrinho/list",
						type: "post",
						async:false,
						success: function(data) {
							
								$("#box_compras").html(data);
								var quantidadeItens = $("#DescricaoPrecoQuatidade li").size();
									$("#Box_Visor_Qtd .Visor_Qtd").html(quantidadeItens);
									if($("#Box_Visor_Qtd").css("display") == "none")
										{
											$("#Box_Visor_Qtd").fadeIn();
										}
									$(".valor_total").slideUp("fast",function(){
										$.ajax({
											url: basePatch+"/carrinho/detalheCarrinho",
											type: "post",
											async:false,
											success: function(data) {
													$(".valor_total").html(data);
													$(".valor_total").slideDown("fast");
												}
											})
									})
								},
						error: function(){}
							});
				},
				error: function(){}
					});	
			return false;
		});
		$(".btn_comprar_detalhe").on("click", function(){	
			var actionIdProduto = $(this).attr("rev");	
			var actionQuant = $(this).parents("#comprar_detalhe, .box_vejaTambem, .lista_categoria_produtos").find('input').val();
			
			$.ajax({
				url: basePatch+"/carrinho/insert",
				type: "post",
				async:false,
				data: {actionAddCart:actionIdProduto,actionQuant:actionQuant},
				success: function(data) {
					$.ajax({
						url: basePatch+"/carrinho/list",
						type: "post",
						async:false,
						success: function(data) {
							
								$("#box_compras").html(data);
								var quantidadeItens = $("#DescricaoPrecoQuatidade li").size();
									$("#Box_Visor_Qtd .Visor_Qtd").html(quantidadeItens);
									if($("#Box_Visor_Qtd").css("display") == "none")
										{
											$("#Box_Visor_Qtd").fadeIn();
										}
									$(".valor_total").slideUp("fast",function(){
										$.ajax({
											url: basePatch+"/carrinho/detalheCarrinho",
											type: "post",
											async:false,
											success: function(data) {
													$(".valor_total").html(data);
													$(".valor_total").slideDown("fast");
												}
											})
									})

									return true;
								},
						error: function(){}
							});
				},
				error: function(){}
					});	
		})
		$(".actionOpenCarrinho").on("click", function(){	
				$("#box_compras").slideToggle("fast", function () {});
				return false;
		});
		$("#header").on( "mouseleave", function() {
			$("#box_compras").slideUp("fast", function () {});
		})
		$("#box_compras").on("click",".actionCloseCarrinho", function(){	
				$("#box_compras").slideToggle("fast", function () {});
			return false;
		});
		$(".qtMais_PC, .qtMais").on("click",function(){
			var id = $(this).parents("#quantidade_produto_categoria, .qtd_produto").find('input').attr("id").split("produto_")[1];
			var valor = $(this).parents("#quantidade_produto_categoria, .qtd_produto").find('input').val();
			var element = $(this);
			$.ajax({
				url: basePatch+"/estoque",
				type: "post",
				async:false,
				data: {actionId:id},
				success: function(data) {
					if($.isNumeric(valor) && data >= (parseInt(valor)+1)) 
						{
						if(data == (parseInt(valor)+1))
							{
								$(element).parents("#quantidade_produto_categoria").find('.smsEstoque').html("Limite maximo estoque!");
								$(element).parents("#quantidade_produto_categoria").find('.smsEstoque').fadeIn("slow");
								
								$("#comprar_detalhe .smsEstoque").html("Limite maximo estoque!");
								$("#comprar_detalhe .smsEstoque").fadeIn("slow");
							}
						$(element).parents("#quantidade_produto_categoria, .qtd_produto").find('input').val(parseInt(valor)+1);
						}
				},
				error: function(){}
					});
				
			return false;
		});
		$(".qtMenos_PC, .qtMenos").on("click",function(){
			var id = $(this).parents("#quantidade_produto_categoria, .qtd_produto").find('input').attr("id").split("produto_")[1];
			var valor = $(this).parents("#quantidade_produto_categoria, .qtd_produto").find('input').val();
			var element = $(this);	
			$.ajax({
				url: basePatch+"/estoque",
				type: "post",
				async:false,
				data: {actionId:id},
				success: function(data) {
					if($.isNumeric(valor) && valor > 1 && data >= (parseInt(valor)-1)) 
						{
						$(element).parents("#quantidade_produto_categoria").find('.smsEstoque').fadeOut("slow");
						$("#comprar_detalhe .smsEstoque").fadeOut("slow");
						$(element).parents("#quantidade_produto_categoria, .qtd_produto").find('input').val(parseInt(valor)-1);
						}
				},
				error: function(){}
					});
			return false;
		});
		$(".MoreItens").on("click",function(){
			var referenceId = $(this).parents(".ListaDaCesta").find(".actionCode").val();
			var valor = $(this).parents("#quantidade_produto_categoria, .qtd_produto, #ProductsFromBasket").find('input').val();
			$.ajax({
				url: basePatch+"/estoque",
				type: "post",
				async:false,
				data: {actionId:referenceId},
				success: function(data) {
			if($.isNumeric(valor) && data >= (parseInt(valor)+1)) 
				{
					if(data == (parseInt(valor)+1))
					{
						alert("Você não pode adicionar acima dessa quantidade deste produto, o nosso limite de estoque foi atingido.");
					}
				var UpdateValor = parseInt(valor)+1;
				$(this).parents("#quantidade_produto_categoria, .qtd_produto, #ProductsFromBasket").find('input').val(UpdateValor);
				$.ajax({
					url: basePatch+"/carrinho/insert",
					type: "post",
					async:false,
					data: {actionAddCart:referenceId,actionQuant:UpdateValor},
					success: function(data) {location.reload();},
					error: function(){}
						});
				}
			}});
			return false;
		});
		$(".LessItens").on("click",function(){
			var referenceId = $(this).parents(".ListaDaCesta").find(".actionCode").val();
			var valor = $(this).parents("#quantidade_produto_categoria, .qtd_produto, #ProductsFromBasket").find('input').val();
			if($.isNumeric(valor) && valor > 1) 
				{
				var UpdateValor = parseInt(valor)-1;
				$(this).parents("#quantidade_produto_categoria, .qtd_produto, #ProductsFromBasket").find('input').val(UpdateValor);
				$.ajax({
					url: basePatch+"/carrinho/insert",
					type: "post",
					async:false,
					data: {actionAddCart:referenceId,actionQuant:UpdateValor},
					success: function(data) {location.reload();},
					error: function(){}
						});
				}
			return false;
		});
		
		$( "#search, #search_footer" ).autocomplete({
    		minLength: 3,
 		    source: basePatch+"/autocomplete/"
    	 });	
		var posicaoAnterior = null;
		var addProdutoSlide = null;
			$(".ContSlider a").hover(function(){
				var leftPosition = $(this).position().left;
				var valor = $(this).attr("rev");
				var titulo =$(this).attr("rel");
				addProdutoSlide = $(this).attr("href");
				
				$("#ProductDescription .txtProductDescription").html(titulo);
				$("#ProductDescription .ValueProductDescription").html(valor);
				
				if($("#ProductDescription").css("display") == "none")
				{
					$("#ProductDescription").css("left",leftPosition+"px");
					$("#ProductDescription").fadeIn();
				}
				else
					{
						$("#ProductDescription").fadeIn();
						$("#ProductDescription").css("left",leftPosition+"px");
					}
				posicaoAnterior = leftPosition;
			},function(){});
			$(".adicionarAcesta").on("click",function(){
				if(addProdutoSlide != null)
					{
					$.ajax({
						url: basePatch+"/carrinho/insert",
						type: "post",
						async:false,
						data: {actionAddCart:addProdutoSlide,actionQuant:1},
						success: function(data) {
							$.ajax({
								url: basePatch+"/carrinho/list",
								type: "post",
								async:false,
								success: function(data) {
									
										$("#box_compras").html(data);
										var quantidadeItens = $("#DescricaoPrecoQuatidade li").size();
											$("#Box_Visor_Qtd .Visor_Qtd").html(quantidadeItens);
											if($("#Box_Visor_Qtd").css("display") == "none")
												{
													$("#Box_Visor_Qtd").fadeIn();
												}
											$(".valor_total").slideUp("fast",function(){
												$.ajax({
													url: basePatch+"/carrinho/detalheCarrinho",
													type: "post",
													async:false,
													success: function(data) {
															$(".valor_total").html(data);
															$(".valor_total").slideDown("fast");
														}
													})
											})

											return true;
										},
								error: function(){}
									});
						},
						error: function(){}
							});	
					}
				return false;
			})
			$( "#SliderProdutosGeral" ).on( "mouseleave", function() {$("#ProductDescription").fadeOut();})
});		