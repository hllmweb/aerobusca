$(".opcional").keyup(function(){
	if($(this).val() != "" || $(this).cleanVal() != ""){
		$(this).addClass('preenchido');
	}else{
		$(this).removeClass('preenchido');
	}
});

/*
	      _ _            _       
	  ___| (_) ___ _ __ | |_ ___ 
	 / __| | |/ _ \ '_ \| __/ _ \
	| (__| | |  __/ | | | ||  __/
	\___|_|_|\___|_| |_|\__\___|
	                             
*/
$("#senha_cliente").keyup(function(e){
	if($(this).val() != $("#c_senha_cliente").val()){
		$("#c_senha_cliente").parent().addClass('com-erro');
	}else{
		$("#c_senha_cliente").parent().removeClass('com-erro');
	}
});

$("#c_senha_cliente").keyup(function(e){
	if($(this).val() != $("#senha_cliente").val()){
		$("#c_senha_cliente").parent().addClass('com-erro');
	}else{
		$("#c_senha_cliente").parent().removeClass('com-erro');
	}
});

$("#email_cliente").keyup(function(e){
	if($(this).val() != $("#c_email_cliente").val()){
		$("#c_email_cliente").parent().addClass('com-erro');
	}else{
		$("#c_email_cliente").parent().removeClass('com-erro');
	}
});

$("#c_email_cliente").keyup(function(e){
	if($(this).val() != $("#email_cliente").val()){
		$("#c_email_cliente").parent().addClass('com-erro');
	}else{
		$("#c_email_cliente").parent().removeClass('com-erro');
	}
});

$("#cadastro_cliente").submit(function(e){
	e.preventDefault();
	$(".loading").fadeIn(50);

	dados = $(this).serialize();

	$.ajax({
		url: 'processador.php?registro_cliente',
		type: 'POST',
		data: dados
	}).done(function(data) {
		if(data == "ok"){
			location.href = "index.php";
		}else if(data == "campo_faltando"){
			alert("Preencha todos os campos para continuar.");
		}else if(data == "email_invalido"){
			alert("Insira um email válido");
		}else if(data == "cpf_invalido"){
			alert("Insira um CPF válido");
		}else if(data == "cpf_cadastrado"){
			alert("Este CPF já está cadastrado.");
		}else if(data == "email_cadastrado"){
			alert("Este email já está cadastrado.");
		}else{
			alert(data);
		}

		$(".loading").fadeOut(100);
	});
	
});


/*
	                                          
	  ___ _ __ ___  _ __  _ __ ___  ___  __ _ 
	 / _ \ '_ ` _ \| '_ \| '__/ _ \/ __|/ _` |
	|  __/ | | | | | |_) | | |  __/\__ \ (_| |
	\___|_| |_| |_| .__/|_|  \___||___/\__,_|
	              |_|                        
*/

$("#senha_empresa").keyup(function(e){
	if($(this).val() != $("#c_senha_empresa").val()){
		$("#c_senha_empresa").parent().addClass('com-erro');
	}else{
		$("#c_senha_empresa").parent().removeClass('com-erro');
	}
});

$("#c_senha_empresa").keyup(function(e){
	if($(this).val() != $("#senha_empresa").val()){
		$("#c_senha_empresa").parent().addClass('com-erro');
	}else{
		$("#c_senha_empresa").parent().removeClass('com-erro');
	}
});

$("#email_empresa").keyup(function(e){
	if($(this).val() != $("#c_email_empresa").val()){
		$("#c_email_empresa").parent().addClass('com-erro');
	}else{
		$("#c_email_empresa").parent().removeClass('com-erro');
	}
});

$("#c_email_empresa").keyup(function(e){
	if($(this).val() != $("#email_empresa").val()){
		$("#c_email_empresa").parent().addClass('com-erro');
	}else{
		$("#c_email_empresa").parent().removeClass('com-erro');
	}
});

$("#cadastro_empresa").submit(function(e){
	e.preventDefault();
	$(".loading").fadeIn(50);

	dados = $(this).serialize();

	$.ajax({
		url: 'processador.php?registro_empresa',
		type: 'POST',
		data: dados
	}).done(function(data) {
		if(data == "ok"){
			location.href = "index.php";
		}else if(data == "campo_faltando"){
			alert("Preencha todos os campos para continuar.");
		}else if(data == "email_invalido"){
			alert("Insira um email válido");
		}else if(data == "cnpj_invalido"){
			alert("Insira um CNPJ válido");
		}else if(data == "cnpj_cadastrado"){
			alert("Este CNPJ já está cadastrado.");
		}else if(data == "email_cadastrado"){
			alert("Este email já está cadastrado.");
		}else{
			alert(data);
		}

		$(".loading").fadeOut(100);
	});
	
});

/*
	   _                    _       
	  /_\   __ _  ___ _ __ | |_ ___ 
	 //_\\ / _` |/ _ \ '_ \| __/ _ \
	/  _  \ (_| |  __/ | | | ||  __/
	\_/ \_/\__, |\___|_| |_|\__\___|
	       |___/                    
*/

$("#senha_agente").keyup(function(e){
	if($(this).val() != $("#c_senha_agente").val()){
		$("#c_senha_agente").parent().addClass('com-erro');
	}else{
		$("#c_senha_agente").parent().removeClass('com-erro');
	}
});

$("#c_senha_agente").keyup(function(e){
	if($(this).val() != $("#senha_agente").val()){
		$("#c_senha_agente").parent().addClass('com-erro');
	}else{
		$("#c_senha_agente").parent().removeClass('com-erro');
	}
});

$("#email_agente").keyup(function(e){
	if($(this).val() != $("#c_email_agente").val()){
		$("#c_email_agente").parent().addClass('com-erro');
	}else{
		$("#c_email_agente").parent().removeClass('com-erro');
	}
});

$("#c_email_agente").keyup(function(e){
	if($(this).val() != $("#email_agente").val()){
		$("#c_email_agente").parent().addClass('com-erro');
	}else{
		$("#c_email_agente").parent().removeClass('com-erro');
	}
});

$("#cadastro_agente").submit(function(e){
	e.preventDefault();
	$(".loading").fadeIn(50);

	dados = $(this).serialize();

	$.ajax({
		url: 'processador.php?registro_agente',
		type: 'POST',
		data: dados
	}).done(function(data) {
		if(data == "ok"){
			location.href = "index.php";
		}else if(data == "campo_faltando"){
			alert("Preencha todos os campos para continuar.");
		}else if(data == "email_invalido"){
			alert("Insira um email válido");
		}else if(data == "cpf_invalido"){
			alert("Insira um CPF válido");
		}else if(data == "cpf_cadastrado"){
			alert("Este CPF já está cadastrado.");
		}else if(data == "email_cadastrado"){
			alert("Este email já está cadastrado.");
		}else{
			alert(data);
		}

		$(".loading").fadeOut(100);
	});
	
});

/*
	 _____           _                      
	/__   \__ ___  _(_) __ _ _ __ ___  ___  
	  / /\/ _` \ \/ / |/ _` | '__/ _ \/ _ \ 
	 / / | (_| |>  <| | (_| | | |  __/ (_) |
	 \/   \__,_/_/\_\_|\__,_|_|  \___|\___/ 
	                                        
*/
$("#senha_taxiaereo").keyup(function(e){
	if($(this).val() != $("#c_senha_taxiaereo").val()){
		$("#c_senha_taxiaereo").parent().addClass('com-erro');
	}else{
		$("#c_senha_taxiaereo").parent().removeClass('com-erro');
	}
});

$("#c_senha_taxiaereo").keyup(function(e){
	if($(this).val() != $("#senha_taxiaereo").val()){
		$("#c_senha_taxiaereo").parent().addClass('com-erro');
	}else{
		$("#c_senha_taxiaereo").parent().removeClass('com-erro');
	}
});

$("#email_taxiaereo").keyup(function(e){
	if($(this).val() != $("#c_email_taxiaereo").val()){
		$("#c_email_taxiaereo").parent().addClass('com-erro');
	}else{
		$("#c_email_taxiaereo").parent().removeClass('com-erro');
	}
});

$("#c_email_taxiaereo").keyup(function(e){
	if($(this).val() != $("#email_taxiaereo").val()){
		$("#c_email_taxiaereo").parent().addClass('com-erro');
	}else{
		$("#c_email_taxiaereo").parent().removeClass('com-erro');
	}
});

$("#cadastro-taxiaereo").submit(function(e){
	e.preventDefault();
	$(".loading").fadeIn(50);

	dados = $(this).serialize();

	$.ajax({
		url: root_url+'/processador.php?registro_taxiaereo',
		type: 'POST',
		data: dados
	}).done(function(data) {
		if(data == "ok"){
			window.location.href = root_url+"/cadastro/taxiaereo/informacoes-adicionais";
		}else if(data == "campo_faltando"){
			alert("Preencha todos os campos para continuar.");
		}else if(data == "email_invalido"){
			alert("Insira um email válido");
		}else if(data == "cnpj_invalido"){
			alert("Insira um CNPJ válido");
		}else if(data == "cnpj_cadastrado"){
			alert("Este CNPJ já está cadastrado.");
		}else if(data == "email_cadastrado"){
			alert("Este email já está cadastrado.");
		}else{
			alert(data);
		}
		$(".loading").fadeOut(100);
	});
	
});

/*
	______     _                _       
	| ___ \   (_)              | |      
	| |_/ / __ ___   ____ _  __| | ___  
	|  __/ '__| \ \ / / _` |/ _` |/ _ \ 
	| |  | |  | |\ V / (_| | (_| | (_) |
	\_|  |_|  |_| \_/ \__,_|\__,_|\___/                                  
                                    
*/
$("#senha_privado").keyup(function(e){
	if($(this).val() != $("#c_senha_privado").val()){
		$("#c_senha_privado").parent().addClass('com-erro');
	}else{
		$("#c_senha_privado").parent().removeClass('com-erro');
	}
});

$("#c_senha_privado").keyup(function(e){
	if($(this).val() != $("#senha_privado").val()){
		$("#c_senha_privado").parent().addClass('com-erro');
	}else{
		$("#c_senha_privado").parent().removeClass('com-erro');
	}
});

$("#email_privado").keyup(function(e){
	if($(this).val() != $("#c_email_privado").val()){
		$("#c_email_privado").parent().addClass('com-erro');
	}else{
		$("#c_email_privado").parent().removeClass('com-erro');
	}
});

$("#c_email_privado").keyup(function(e){
	if($(this).val() != $("#email_privado").val()){
		$("#c_email_privado").parent().addClass('com-erro');
	}else{
		$("#c_email_privado").parent().removeClass('com-erro');
	}
});

/*
	 _____       __                                                           _ _      _                   _     
	|_   _|     / _|                                                         | (_)    (_)                 (_)    
	  | | _ __ | |_ ___  _ __ _ __ ___   __ _  ___ ___   ___  ___    __ _  __| |_  ___ _  ___  _ __   __ _ _ ___ 
	  | || '_ \|  _/ _ \| '__| '_ ` _ \ / _` |/ __/ _ \ / _ \/ __|  / _` |/ _` | |/ __| |/ _ \| '_ \ / _` | / __|
	 _| || | | | || (_) | |  | | | | | | (_| | (_| (_) |  __/\__ \ | (_| | (_| | | (__| | (_) | | | | (_| | \__ \
	 \___/_| |_|_| \___/|_|  |_| |_| |_|\__,_|\___\___/ \___||___/  \__,_|\__,_|_|\___|_|\___/|_| |_|\__,_|_|___/
                                                                                                     
*/

$('#taxiaereo_metodo_pagamento').multipleSelect({
    width: '100%',
    placeholder: "Formas de pagamento por minha empresa",
    selectAll: false
});


$("#taxiaereo_cep").change(function(e){
	$(".loading").fadeIn(50);
	var cep = $(this).val();
	$.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(json){
		$("#taxiaereo_bairro").val(json.bairro);
		$("#taxiaereo_rua").val(json.logradouro);
		$("#taxiaereo_cidade").val(json.localidade);
		$("#taxiaereo_estado").val(json.uf);
		$(".loading").fadeOut(50);
		$("#taxiaereo_numero").focus();
	});
});


$("#cadastro-taxiaereo-infos-adicionais").submit(function(e){
	e.preventDefault();
	$(".loading").fadeIn(50);

	cheta		= $('#taxiaereo_cheta').val();
	cep 		= $('#taxiaereo_cep').val();
	bairro		= $('#taxiaereo_bairro').val();
	rua			= $('#taxiaereo_rua').val();
	cidade		= $('#taxiaereo_cidade').val();
	estado		= $('#taxiaereo_estado').val();
	numero 		= $("#taxiaereo_numero").val();

	descricao 	= $('#taxiaereo_descricao').val();
	metodos	= $('.ms-choice').text();
	if(metodos == "Selecione o metodo de pagamento"){
		metodos = "";
	}

	$.ajax({
		url: root_url+'/processador.php?infos_adicionais_taxiaereo',
		type: 'POST',
		data: {
			taxiaereo_cheta: cheta,
			taxiaereo_cep: cep,
			taxiaereo_bairro: bairro,
			taxiaereo_rua: rua,
			taxiaereo_cidade: cidade,
			taxiaereo_estado: estado,
			taxiaereo_numero: numero,
			taxiaereo_descricao: descricao,
			taxiaereo_metodo_pagamento:  metodos
		}
	}).done(function(data) {
		if(data == "ok"){
			window.location.href = root_url+"/cadastro/taxiaereo/adicionar-aeronaves";
		}else if(data == "campo_faltando"){
			alert("Preencha todos os campos para continuar.");
		}else if(data == "nao_logado"){
			alert("Você precisa estar logado para executar esta ação.");
		}else if(data == "erro"){
			alert("Ocorreu um erro ao atualizar informações.");
		}else{
			alert(data);
		}
		$(".loading").fadeOut(100);
	});
	
});

/*
              _ _      _                                                                     
     /\      | (_)    (_)                                                                    
    /  \   __| |_  ___ _  ___  _ __   __ _ _ __    __ _  ___ _ __ ___  _ __   __ ___   _____ 
   / /\ \ / _` | |/ __| |/ _ \| '_ \ / _` | '__|  / _` |/ _ \ '__/ _ \| '_ \ / _` \ \ / / _ \
  / ____ \ (_| | | (__| | (_) | | | | (_| | |    | (_| |  __/ | | (_) | | | | (_| |\ V /  __/
 /_/    \_\__,_|_|\___|_|\___/|_| |_|\__,_|_|     \__,_|\___|_|  \___/|_| |_|\__,_| \_/ \___|
                                                                                             
                                                                                                                                                                             
*/

$("#aeronave_fabricante").change(function(e){
	var fabricante = $(this).val();

	$("#aeronave_modelo").prop("disabled", true);

	$.ajax({
		url: root_url+'/processador.php',
		type: 'GET',
		data: {
			pega_modelos: 'ok',
			fabricante: fabricante
		},
	}).done(function(data){
		var modelos = data.split("|");

		$("#aeronave_modelo").find('option').not(":disabled").each(function(index, elemento){
			$(elemento).remove();
		});

		for(var i = 0; i < modelos.length; ++i){
		    $("<option value='"+modelos[i]+"'>"+modelos[i]+"</option>").appendTo("#aeronave_modelo");
		}

		$("#msg-selecione-fabricante").remove();
		$("#aeronave_modelo").prop("disabled", false);
	});
	
});

$('#aeronave_categoria').multipleSelect({
    width: '100%',
    placeholder: "",
    selectAll: false,
    maxHeight: 400
});

$('#aeronave_operacao').multipleSelect({
    width: '100%',
    placeholder: "",
    selectAll: false,
    maxHeight: 400
});

$('#aeronave_tipo_servicos').multipleSelect({
    width: '100%',
    placeholder: "",
    selectAll: false,
    maxHeight: 400
});

continua_adicionando = false;

$("#add-mais-aeronaves").click(function(e){
	$("<input name='add-mais' value='ok' />").appendTo('#cadastro-add-aeronave');
	continua_adicionando = true;
	$("#cadastro-add-aeronave").submit();
});


$("#cadastro-add-aeronave").submit(function(e){
	e.preventDefault();
	
	imgs_faltando = 4 - $(".campo-add-img").not(":empty").length;

	if(imgs_faltando == 0){

		elemento_faltando = false;
		$(this).find("[name]").each(function(i, elemento){
			if($(elemento).val() == "" || $(elemento).val() == null){
				elemento_faltando = true;
			}
		});

		if(elemento_faltando == false){
			$(".loading").fadeIn(50);

			dados = "none=none";
			$(this).find("[name]").each(function(i, elemento){
				nome_input = $(elemento).attr("name");
				valor_input = escape($(elemento).val());

				dados += "&"+nome_input+"="+valor_input;
			});

			$.ajax({
				url: root_url+'/processador.php?adicionar_aeronave',
				type: 'POST',
				data: dados
			}).done(function(data) {
				alert(data);
				if(data == "ok"){
					if(continua_adicionando == true){
						window.location.href = root_url+"/cadastro/taxiaereo/adicionar-aeronaves";
					}else{
						window.location.href = root_url+"/cadastro/taxiaereo/concluido";
					}
				}else if(data == "campo_faltando"){
					alert("Preencha todos os campos corretamente.");
				}else if(data == "nao_logado"){
					alert("Você precisa estar logado para executar esta ação.");
				}else if(data == "erro"){
					alert("Ocorreu um erro ao atualizar informações.");
				}else{
					alert(data);
				}
				$(".loading").fadeOut(100);
			});
		}else{
			alert("Preencha todos os campos para continuar.");
		}

	}else{
		alert("Adicione mais "+ imgs_faltando +" imagens de sua aeronave.");
	}
	
});