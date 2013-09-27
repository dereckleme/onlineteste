$(document).ready(function(){	
	$(".tentarNovamente").on("click",function(){
		$("#form_erro").fadeOut();
		return false;
	})
	$(".status_criar_conta").on("click",function(){
		$("#form_login").fadeOut("slow",function(){
			$("#form_cadastro").fadeIn();
		});
		return false;
	})
	$(".status_entrar").on("click",function(){
		$("#form_cadastro").fadeOut("slow",function(){
			$("#form_login").fadeIn();
		});
		return false;
	})
	
	
	/*
	 * clear form
	 */
	$(".formAction input[type=text],#form_login input[type=text], #form_cadastro input[type=text]").on("click",function(){
		$(this).val("");
	})
	$(".formAction input[type=password],#form_login input[type=password], #form_cadastro input[type=password]").on("click",function(){
		$(this).val("");
	})
	
	
	/*
	 * 
	 * PopUp User
	 */
	$('.eventOpenPopUp').on("click",function(){
		if($("#Login_Cadastro").css("display") != "none")
			{
				$("#Login_Cadastro").animate({left:"+=15"}, 50,function(){
					$(this).animate({left:"-=30"}, 50,function(){
						$(this).animate({left:"+=15"}, 50,function(){});
					});
				});
			}
		else
			{
		$("#Login_Cadastro").toggle("fast");
			}
		return false;
	})
	$('.status_fechar').on("click",function(){
		$("#form_erro").fadeOut();
		$("#Login_Cadastro").fadeOut("fast");
		return false;
	})
	
	/*
	 * Action cadastra-se;
	 */
	$('.Eventcadastrar').on("click",function(){
		var eventLogin = $(".formActionCadastro .login").val();
		var eventEmail = $(".formActionCadastro .email").val();
		var eventPassword = $(".formActionCadastro .Password").val();
		var eventPasswordConfirm = $(".formActionCadastro .PasswordConfirm").val();
		$.ajax({
			url: basePatch+"/actionUser/Usuario/novoUser",
			type: "post",
			async:false,
			data: {eventLogin:eventLogin,eventEmail:eventEmail,eventPassword:eventPassword,eventPasswordConfirm:eventPasswordConfirm},
			success: function(data) {
					if(data == "1")
						{
							$.ajax({
							url: basePatch+"/actionUser/Login/index",
							type: "post",
							async:false,
							data: {eventLogin:eventLogin,eventPassword:eventPassword},
							success: function(data) {
										if(data == "01")
										{
											$("#Login_Cadastro").fadeOut("fast",function(){
												location.reload();
											});
										}
										else
										{
											$("#Login_Cadastro").animate({left:"+=15"}, 50,function(){
												$(this).animate({left:"-=30"}, 50,function(){
													$(this).animate({left:"+=15"}, 50,function(){
														$(".tipo_erro").html(data);
														$("#form_erro").fadeIn();
													});
												});
											});
											
										}
							},
							error: function(){}
						});
						}
					else
						{
							$("#Login_Cadastro").animate({left:"+=15"}, 50,function(){
								$(this).animate({left:"-=30"}, 50,function(){
									$(this).animate({left:"+=15"}, 50,function(){
										$(".tipo_erro").html(data);
										$("#form_erro").fadeIn();
									});
								});
							});
						}
			},
			error: function(){}
		});
			return false;
	})
	$('.EventcadastrarLoginFinaliza').on("click",function(){
		var eventLogin = $("#BoxLogin .formAction .actionLogin").val();
		var eventEmail = $("#BoxLogin .formAction .actionEmail").val();
		var eventPassword = $("#BoxLogin .formAction .actionPassoword").val();
		var eventPasswordConfirm = $("#BoxLogin .formAction .actionPassowordConfirm").val();
		$.ajax({
			url: basePatch+"/actionUser/Usuario/novoUser",
			type: "post",
			async:false,
			data: {eventLogin:eventLogin,eventEmail:eventEmail,eventPassword:eventPassword,eventPasswordConfirm:eventPasswordConfirm},
			success: function(data) {
					if(data == "1")
						{
						$.ajax({
							url: basePatch+"/actionUser/Login/index",
							type: "post",
							async:false,
							data: {eventLogin:eventLogin,eventPassword:eventPassword},
							success: function(data) {
										if(data == "01")
										{
											location.reload();
										}
										else
										{
											$(".return").html(data);
										}
							},
							error: function(){}
						})
						}
					else
						{
							
							$(".return").html(data);
						}
			},
			error: function(){}
		});
			return false;
	})
	/*
	 * Action Login
	 */
	$('.Eventlogin').on("click",function(){
		var eventLogin = $(".formActionLogin .login").val();
		var eventPassword = $(".formActionLogin .Password").val();
		$.ajax({
			url: basePatch+"/actionUser/Login/index",
			type: "post",
			async:false,
			data: {eventLogin:eventLogin,eventPassword:eventPassword},
			success: function(data) {
						if(data == "01")
						{
							$("#Login_Cadastro").fadeOut("fast",function(){
								location.reload();
							});
						}
						else
						{
							$("#Login_Cadastro").animate({left:"+=15"}, 50,function(){
								$(this).animate({left:"-=30"}, 50,function(){
									$(this).animate({left:"+=15"}, 50,function(){
										$(".tipo_erro").html(data);
										$("#form_erro").fadeIn();
									});
								});
							});
							
						}
			},
			error: function(){}
		});
			return false;
	})
	$('.actionConcluirPedido').on("click",function(){
		setTimeout(function(){
			window.location =  basePatch+"/painel";
		},3000)
	})
	$(".formAction").on("click",'.EventcadastrarEndereco',function(){
		var actionNome = $("#BoxEndereco .BoxNome").val();
		var actionCep = $("#BoxEndereco .BoxCEP").val();
		var actionRua = $("#BoxEndereco .BoxEndereco").val();
		var actionNumero = $("#BoxEndereco .BoxNumero").val();
		var actionBairro = $("#BoxEndereco .BoxBairro").val();
		var actionCidade = $("#BoxEndereco .BoxCidade option:selected").val();
		$.ajax({
			url: basePatch+"/actionUser/Usuario/atualiza",
			type: "post",
			async:false,
			data: {actionNome:actionNome,actionCep:actionCep,actionRua:actionRua,actionNumero:actionNumero,actionBairro:actionBairro,actionCidade:actionCidade},
			success: function(data) {
				if(data==1)
					{
					$(".msgCadastrase").css("display","none");
						$(".msgCadastrase").html("Seu cadastro foi atualizado com sucesso.");
						$(".msgCadastrase").fadeIn("slow",function(){
							location.reload();
						});
					}
			},
			error: function(){}
		});	
		return false;
	})
	$('#bottaoAlterarCadastro').on("click",function(){
			$(".formAction input, .formAction select").removeAttr("disabled");
			$(".seletoInt").html('<input type="submit" value="Salvar Endereço" class="EventcadastrarEndereco"><br/><br/><br/>');
		return false;
	})
	$(".BoxCEP").mask("99999-999",{completed:function(){
		var cepSet = this.val();
		$.ajax({
			url: basePatch+"/correios/restCep",
			type: "post",
			beforeSend: function(){
				$(".ajaxMsg").html("Carregando...");
			     $(".ajaxMsg").show();
			   },
			async:false,
			data: {cep:cepSet},
			success: function(data) {
				$(".ajaxMsg").fadeOut();
				obj = JSON.parse(data);
				if(obj.cep == null)
				{
					$(".BoxEndereco").val("");
					$(".BoxBairro").val("");
					$(".BoxEstado option").removeAttr("selected");
					$(".BoxCidade").html('<option value="">Selecione</option>');
					$(".BoxCidade").attr('disabled', true);
					$(".ajaxMsg").html("Endereço não encontrado.");
					$(".ajaxMsg").fadeIn();
				}
				else
					{
						$(".BoxEndereco").val(obj.rua);
						$(".BoxBairro").val(obj.bairro);
						jQuery.each($(".BoxEstado option"), function(i, val) {
								if(obj.uf == $(val).val())	
									{
										$(val).attr('selected', true);
										$.ajax({
											url: basePatch+"/mapeamento-cidades-estados/cidade/nomeclatura/"+obj.uf,
											async:false,
											success: function(data) {
												$(".BoxCidade").html(data);
												$(".BoxCidade").removeAttr("disabled");
												jQuery.each($(".BoxCidade option"), function(ix, value) {
														if($(value).text() == obj.cid)
															{
																$(value).attr('selected', true);
															}
													})
											},
											error: function(){}
										});	
									}
											    });
					}
				//Front Set Front
				$.ajax({
					url: basePatch+"/correios/frete",
					async:false,
					type: "post",
					data: {cep:cepSet},
					success: function(data) {
						$("#despesaFrete").html(data);
						$.ajax({
							url: basePatch+"/correios/frete/total",
							async:false,
							type: "post",
							data: {cep:cepSet},
							success: function(data) {
								$("#valortotalMaisFrete").html(data);
							},
							error: function(){}
						});
					},
					error: function(){}
				});	
			},
			error: function(){alert("Não conseguimos se comunicar com o gateway dos correios, preencha seus dados manualmente.");}
		});	
	}});
	$(".DigCep1").on("click",function(){
		return false;
	})
	$(".DigCep1").mask("99999-999");
	$(".CalcFret").on("click",function(){
		if($(".DigCep1").val().length == 9)
			{
			var cepSet = $(".DigCep1").val();
			 $(".DigCep1").css("background","#ffffff");
			//Front Set Frete
				$.ajax({
					url: basePatch+"/correios/frete",
					async:false,
					type: "post",
					data: {cep:cepSet},
					success: function(data) {
						if(data != "Indisponível")
						{
						$(".txt_TotalFrete").html("Total com frete: ");
						}
					else
						{
						$(".txt_TotalFrete").html("Total: ");
						}
						$(".txt_frete").html("Frete: "+data);
						$.ajax({
							url: basePatch+"/correios/frete/total",
							async:false,
							type: "post",
							data: {cep:cepSet},
							success: function(data) {
								$(".CalcSomaValor").html(data);
							},
							error: function(){}
						});
					},
					error: function(){}
				});	
			}
		else
			{
			$(".DigCep1").css("background","#ff0000");
			}
		return false;
	})
	$(".BoxEstado").change(function() {
		  	var val = $(this).val();
		  	if(val != "")
		  		{
			  		$.ajax({
						url: basePatch+"/mapeamento-cidades-estados/cidade/nomeclatura/"+val,
						async:false,
						success: function(data) {
							$(".BoxCidade").html(data);
							$(".BoxCidade").removeAttr("disabled");
						},
						error: function(){}
					});	
		  		}
		});
	
})