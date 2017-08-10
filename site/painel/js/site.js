if($(this).width() < 700){
	$("#sidebar_menu").removeClass("oppened");
}

$("a[data-color-link]").each(function(i){
	$(this).css("color", $(this).data("color-link"));
	var atual_link_color = $("#sidebar_menu li.atual a").data("color-link")
	$("#sidebar_menu li.atual .menu_icon").css("border", "2px solid "+ atual_link_color);
});

$("#open_menu").click(function(){
	$("#sidebar_menu").toggleClass("oppened");
});

$(".open_notifications").click(function(){
	var notifications_box = $(".notifications");
	if(notifications_box.hasClass("already_viewed")){
		$(".notifications ul li").each(function(){
			$(this).addClass("visualized");
		});
	}

	$(this).find("i").toggleClass("fa-rotate-25");
	notifications_box.toggleClass("notifications_oppened");
	$(".notifications_counter").fadeOut(400);
	notifications_box.addClass("already_viewed");

	
});
$("notifications").click(function(e){
	e.stopPropagation();
});

$("[data-link]").click(function(){
	window.location.href = $(this).data("link");
});

$(document).click(function(e) { 
    if(!$(e.target).closest('.notifications').length &&
    	!$(event.target).is('.notifications') &&
    	!$(e.target).closest('.open_notifications').length){

        var notifications_box = $(".notifications");

		$(".open_notifications i").removeClass("fa-rotate-25");
		notifications_box.removeClass("notifications_oppened");
    }        
});

var notifications_counter=0;
$(".notifications li").not(".visualized").each(function(){
	notifications_counter++;
});

if(notifications_counter > 0){
	if(notifications_counter  > 5){
		$(".notifications_counter").text("+5");
	}else{
		$(".notifications_counter").text(notifications_counter);
	}
	$(".notifications_counter").show();
}

$("#wrapper").css("min-height", $(document).height());


$(window).resize(function(){
	if($(this).width() < 700){
		$("#sidebar_menu").removeClass("oppened");
	}
});


$(document).ready(function(){
    $('a[href]:not(.sem-ajax)').click(function(e){
        var arr = ['.bx-prev', '.bx-next', '.bx-pager-link'];
		$(this).filter(arr.join()).addClass('sem-ajax');
     
     	if($(this).hasClass('sem-ajax')){}else{
        	e.preventDefault();
        	var href = $(this).attr("href");

	        $(".loading").fadeIn(100);


	        // $.get(href, function(data){
	        //     document.open();
	        //     document.write(data);
	        //     document.close();
	        //     window.history.pushState(null, null, href);
	        //     $(".loading").fadeOut(100);
	        // }).error(function(data, textStatus, xhr){
	        // 	alert("erro");
	        // }); 


	        $.ajax({
	        	url: href,
	        	type: 'GET',
	        	headers: {
	        		'ajax': 'ok'
	        	}
	        }).done(function(data) {
	        		document.open();
	            document.write(data);
	            document.close();
	            window.history.pushState(null, null, href);
	            $(".loading").fadeOut(100);
	        });

	    }    

    });	

    $(".loading").fadeOut(0);
});


window.addEventListener('popstate', function(e){
	$(".loading").fadeIn(100);

	var url = location.href;

	$.get(url, function(data){
	    document.open();
	    document.write(data);
	    document.close();
	    window.history.pushState(null, null, url);
	    $(".loading").fadeOut(100);
	});

	e.preventDefault();
	return false;
});

$("#img-perfil").change(function(event) {
	$("#form-img-perfil").submit();
});
$("#form-img-perfil").submit(function(e){
	e.preventDefault();
		$.ajax({
			url: root_url+'/processador.php?add-perfil',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false
		})
		.done(function(texto) {
			console.log(texto);
			if(texto != "falha"){
				$(".logo-circle img").attr('src', root_url+"/../arquivo/"+texto);						
			}

		});
});
$(".painel-nome-perfil h2").hover(function(){
	 $(".editar-perfil").addClass('fomartando-editar-perfil');
});



$("[data-token]").click(function(){
	var token = $(this).data("token");

	$.ajax({
		url: root_url+'/processador.php?info_token',
		type: 'POST',
		data: {token: token},
	})
	.done(function(data) {
		$("#info_token .widget_body").html(data);
		$("#info_token .widget_title").html("Visualizando: "+token);
	});
	
});


$(document).on("click", "[data-status-dados]", function(){
	var status = $(this).data("status-dados");
	var id_cotacao = $(this).data("id-cotacao");


	$.ajax({
		url: root_url+'/processador.php?muda_statusCotacao',
		type: 'POST',
		data: {
			status: status,
			id_cotacao: id_cotacao
		},
	})
	.done(function(data) {
		if(data == "ok"){
			// alert("Status Atualizado com sucesso!");
			$(this).html(data);
		}else{
			alert(data);
		}
	});
	
});

$(document).on("click", ".info_cotacao,.ver-detalhe-cotacao", function(){
	$(".detalhe_cotacao").slideUp(100);
	$(this).find(".detalhe_cotacao").slideDown(100);
});


$("#add_mensagem").submit(function(e){
	$(".loading").fadeIn(100);
	e.preventDefault();
	tinymce.triggerSave();

	dados = "none=none";
	$(this).find("[name]").each(function(i, elemento){
		nome_input = $(elemento).attr("name");
		valor_input = escape($(elemento).val());

		dados += "&"+nome_input+"="+valor_input;

	});	

	// var dados = new FormData(this);
	// var dados = $(this).serialize();
	$.ajax({
		url: root_url+'/processador.php?add_mensagem',
		type: 'POST',
		data: dados,
		// processData: false,
		// contentType: false

	}).done(function(data) {

		if(data == "ok"){
			$(".sucesso").html("Mensagem adicionada com sucesso!");
			$(".sucesso").show();
			$("#add_mensagem")[0].reset();
		}else{
			$(".erro").html("Ocorreu um erro ao criar mensagem. "+data);
			$(".erro").show();
		}

		$('html, body').animate({ scrollTop: 0 }, 200);
		$(".loading").fadeOut(100);
	});	



});


// $("#codigo").keyup(function(e){
// 	$("input[name=cod_produto]").val($(this).val());
// });

// $("#add_anexo").change(function(e){
// 	$("#anexo_form").submit();
// });
// $('#anexo_form').submit(function(e){
// 	$(".loading").fadeIn(100);
//     $.ajax({
//       	url: 'upload.php?up_anexos',
//       	type: 'POST',
//       	data: new FormData(this),
//       	processData: false,
//       	contentType: false
//     }).done(function(nome_anexo){
//     	if(nome_anexo != "falha"){
//     		var antigos_anexos = $("#anexos_produto").val();
// 	    	$("#anexos_produto").val(nome_anexo);
// 	    	$(".loading").fadeOut(100);
// 	    	var timestamp = Math.floor(Date.now() / 1000);
// 	    	var span = $("<span></span>").attr("class", "anexo-span");
// 	    	var img = $('<img />', {
// 			  src: "../arquivo/"+nome_anexo+"?versao="+timestamp
// 			}).attr("class", "fade");
			
// 			img.appendTo(span);
// 			span.appendTo(".anexos");
//     	}else{
//     		$(".loading").fadeOut(100);
//     		alert("Ocorreu um erro ao enviar o anexo. Tente novamente.");
//     	}
//     });

//     $('#anexo_form')[0].reset();
//    	e.preventDefault();
// });

// $(".anexos").on("click", ".anexo-span", function(e){
// 	$(".loading").fadeIn(100);
// 	var elemento = $(this);
//     var img = $(this).find('img').attr("src");
//     img = img.replace("../arquivo/", "");

//     $.get("removeIMG.php?remove_anexo="+img, function(data) {
//     	if(data == "ok"){
//     		$(".loading").fadeOut(100);
//     		var antigos_anexos = $("#anexos_produto").val();
// 		    antigos_anexos = antigos_anexos.replace(img+",", "");
// 		    $("#anexos_produto").val(antigos_anexos);
// 		    elemento.remove();
//     	}else{
//     		$(".loading").fadeOut(100);
//     		var antigos_anexos = $("#anexos_produto").val();
// 		    antigos_anexos = antigos_anexos.replace(img+",", "");
// 		    $("#anexos_produto").val(antigos_anexos);
// 		    elemento.remove();
//     		alert("Ocorreu um erro ao remover imagem. \nErro: "+data);
//     	}
//     });

    
// });



// $(".input_money").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
// $(".input_data").datepicker({ 
// 	dateFormat: 'dd/mm/yy',
// 	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
//     dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
//     dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
//     monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
//     monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
//     nextText: 'Próximo',
//     prevText: 'Anterior'
// }).val();


//Editar usuário
$("#edit_usuario").submit(function(e){
	$(".loading").fadeIn(100);
	e.preventDefault();
	tinymce.triggerSave();

	dados = "none=none";
	$(this).find("[name]").each(function(i, elemento){
		nome_input = $(elemento).attr("name");
		valor_input = escape($(elemento).val());

		dados += "&"+nome_input+"="+valor_input;

	});	

	$.ajax({
		url: root_url+'/processador.php?edit_usuario',
		type: 'POST',
		data: dados,

	}).done(function(data) {
		if(data == "ok"){
			$(".sucesso").html("Usuário editada com sucesso!");
			$(".sucesso").show();
			console.log(data);
		}else{
			$(".erro").html("Ocorreu um erro ao editar usuário." + data);
			$(".erro").show();
			console.log(data);
		}

		$('html, body').animate({ scrollTop: 0 }, 200);
		$(".loading").fadeOut(100);
	});
});


//Apagar usuario
$(".apagar_usuario").click(function(e){
	e.preventDefault();
	var id = $(this).data("id");

	if(confirm("Deseja apagar o usuário "+id+"?")){
		$(".loading").fadeIn(100);
		$.ajax({
			url: root_url+'/processador.php?apagar_usuario',
			type: 'GET',
			data: {
				id: id
			},

		}).done(function(data) {
			$(".loading").fadeOut(100);
			if(data == "ok"){
				$("[data-usuario-id=usuario"+id+"]").remove();
			}else{
				alert(data);
			}
		});
	}
	e.stopPropagation();
});



// ABRIR POPUP
function abrirpopup(pagina,modal_corpo_tamanho){
	$.get(pagina, function(data) {
		if(modal_corpo_tamanho == 'modal_corpo_pequeno'){
			$('#modal_tamanho').addClass(modal_corpo_tamanho);
			$('.'+modal_corpo_tamanho).html(data);					
		}

		if(modal_corpo_tamanho == 'modal_corpo_medio'){
			$('#modal_tamanho').addClass(modal_corpo_tamanho);
			$('.'+modal_corpo_tamanho).html(data);										
		}
		if(modal_corpo_tamanho == 'modal_corpo_grande'){	
			$('#modal_tamanho').addClass(modal_corpo_tamanho);
			$('.'+modal_corpo_tamanho).html(data);										
		}

		$("#modal").fadeIn(100);
			
	});
}

// FECHAR POPUP
function fecharpopup(){
	$("#modal").fadeOut(0);
	$('#modal_tamanho').removeClass('modal_corpo_pequeno');
	$('#modal_tamanho').removeClass('modal_corpo_medio');	
	$('#modal_tamanho').removeClass('modal_corpo_grande');
}
$(document).click(function(e) {
	// $(".modal_geral").hide();
	fecharpopup();
});


$("#modal_tamanho").click(function(e) {
	e.stopPropagation();
});
$(document).keydown(function(e) {
	if(e.keyCode == 27){
		//$(".modal_geral").hide();
		fecharpopup();
	}
});




/*Escondendo campos do tipo text no form modelo*/
$("#novofabricante").hide();
$("#novomodelo").hide();
$("#novocategoria").hide();

/*Exibindo campos do tipo text no form modelo, caso queira adicionar novos*/
$("[data-novo-campo]").click(function(e){
	e.preventDefault();
	e.stopPropagation();
	var novo_campo = $(this).data("novo-campo");
	var campo_original = novo_campo.replace("novo", "");
	$("."+campo_original).hide();

	//$("#fabricante").hide();
	$("#"+novo_campo).show();
	$(this).hide();

});



/*Lista filtro dos fabricantes e modelos*/
$("#fabricante").change(function(){
	var fabricante = $(this).val();
	$("#modelo").prop("disabled", true);
	
	$.ajax({
		url: root_url+'/processador.php',
		type: 'GET',
		data: {
			pega_modelos: 'ok',
			fabricante: fabricante
		},
	})
	.done(function(data) {
		var modelos = data.split("|");

		$("#modelo").find('option').not(":disabled").each(function(index, elemento){
			$(elemento).remove();
		});

		for(var i=0; i<modelos.length; ++i){
			$("<option value='"+modelos[i]+"'>"+modelos[i]+"</option>").appendTo("#modelo");
		}

		$("#msg-selecione-fabricante").remove();
		$("#modelo").prop("disabled", false);

	});
	
});


/*Add modelo*/
$("#add_modelo").submit(function(e){
	$(".loading").fadeIn(100);
	e.preventDefault();
	// tinymce.triggerSave();

	dados = "none=none";
	$(this).find("[name]").each(function(i, elemento){
		nome_input = $(elemento).attr("name");
		valor_input = escape($(elemento).val());

		dados += "&"+nome_input+"="+valor_input;

	});	

	// var dados = new FormData(this);
	// var dados = $(this).serialize();
	$.ajax({
		url: root_url+'/processador.php?add_modelo',
		type: 'POST',
		data: dados,
		// processData: false,
		// contentType: false

	}).done(function(data) {

		if(data == "ok"){
			$(".sucesso").html("Modelo adicionado com sucesso!");
			$(".sucesso").show();
			$("#add_modelo,#add_aeronave")[0].reset();
			$("#categoria").multipleSelect("refresh");
			// $("#add_modelo")[0].reset();
			// $(".anexos img").remove();
			// $("#anexos_produto").val("");
		}else{
			$(".erro").html("Ocorreu um erro ao criar modelo. "+data);
			$(".erro").show();
		}

		$('html, body').animate({ scrollTop: 0 }, 200);
		$(".loading").fadeOut(100);
	});	

});

//Status do usuário
$("[data-usuario-status]").click(function(e){
	e.stopPropagation();
	that = this;

	status_usuario 	= $(this).data("usuario-status");
	id_usuario = $(this).data("usuario");
 
 	$(that).html("<i class='fa fa-refresh fa-spin'></i>");
	
	$.ajax({
		url: root_url+'/processador.php?atualiza_status_usuario',
		type: 'POST',
		data: {
			status_usuario: status_usuario,
			id_usuario: id_usuario
		},
	})
	.done(function(data) {
		if(data == "ok"){
			if(status_usuario == "1"){
				$(that).removeClass('vermelho');
				$(that).addClass('verde');
				$(that).data("usuario-status","0");
				$(that).text("ATIVO");
			}else{
				$(that).addClass('vermelho');
				$(that).removeClass('verde');
				$(that).data("usuario-status","1");
				$(that).text("INATIVO");
			}
		}else{
			$(".sucesso").html("Status do Usuário atualizado com sucesso!");
			$(".sucesso").show();
			
			if($(that).data("usuario-status") == "1"){
				status_atual = "<a href='#' id='status-atual-"+id_usuario+"' data-usuario-status='0' data-usuario-id='"+id_usuario+"' class='btn-f-small verde sem-ajax'>ATIVO</a>";
			}else{
				status_atual = "<a href='#' id='status-atual-"+id_usuario+"' data-usuario-status='1' data-usuario-id='"+id_usuario+"' class='btn-f-small vermelho sem-ajax'>INATIVO</a>";
			}
			$("#status-atual-"+id_usuario).html(status_atual);
		}
	});
	e.preventDefault();
});





//Atualiza status
$("[data-status]").click(function(e){
	e.stopPropagation();
	that = this;

	id_status 	= $(this).data("status");
	id_aeronave = $(this).data("aeronave");
 	
// 	alert(id_aeronave);
// 	var status_atual = $("#status-atual-"+id_aeronave).text();
//  	alert(status_atual);
	
	$(that).html("<i class='fa fa-refresh fa-spin'></i>");
	
	$.ajax({
		url: root_url+'/processador.php?atualiza_status',
		type: 'POST',
		data: {
			id_status: id_status,
			id_aeronave: id_aeronave
		},
	})
	.done(function(data) {
		if(data == "ok"){
			if(id_status == "1"){
				$(that).removeClass('vermelho');
				$(that).addClass('verde');
				$(that).data("status","0");
				$(that).text("ATIVO");
			}else{
				$(that).addClass('vermelho');
				$(that).removeClass('verde');
				$(that).data("status","1");
				$(that).text("INATIVO");
			}
		}else{
			// alert("Ocorreu um erro ao atualizar o status da aeronave");
// 			 alert(data);
			$(".sucesso").html("Status da Aeronave atualizado com sucesso!");
			$(".sucesso").show();
			if($(that).data("status") == "1"){
// 				$(this).attr("id","teste");
				status_atual = "<a href='#' id='status-atual-"+id_aeronave+"' data-status='0' data-aeronave='"+id_aeronave+"' class='btn-f-small verde sem-ajax'>ATIVO</a>";
			}else{
// 				$(this).attr("id","teste");
				status_atual = "<a href='#' id='status-atual-"+id_aeronave+"' data-status='1' data-aeronave='"+id_aeronave+"' class='btn-f-small vermelho sem-ajax'>INATIVO</a>";
			}
			//retornando o id na hora da troca do status
			$("#status-atual-"+id_aeronave).html(status_atual);
		}
	});
	e.preventDefault();
});


//Apagar aeronave
$(".apagar_aeronave").click(function(e){
	e.preventDefault();
	var id = $(this).data("id");

	if(confirm("Deseja apagar o aeronave "+id+"?")){
		$(".loading").fadeIn(100);
		$.ajax({
			url: root_url+'/processador.php?apagar_aeronave',
			type: 'GET',
			data: {
				id: id
			},

		}).done(function(data) {
			$(".loading").fadeOut(100);
			if(data == "ok"){
				$("[data-aeronave-id=aeronave"+id+"]").remove();
			}else{
				alert(data);
			}
		});
	}
	e.stopPropagation();
});


/*Add Categoria*/
$(document).on("submit", "#add_categoria", function(e) {
	$(".loading").fadeIn(100);
	e.preventDefault();

	var nome_categoria = $("#nome_categoria").val();



	$.post(root_url+'/processador.php?add_categoria', {nome_categoria: nome_categoria}, 
		function(data) {
		if(data == "ok"){
			alert("Categoria adicionada com sucesso");

			$("<option value='"+nome_categoria+"' selected>"+nome_categoria+"</option>").appendTo('#categoria');
			$("#categoria").multipleSelect("refresh");
			console.log(data);

			// $(".sucesso").html("Categoria adicionada com sucesso!");
			// $(".sucesso").show();
		}else{
			alert("Ocorreu um erro ao criar categoria"+data);
			console.log(data);
			// $(".erro").html("Ocorreu um erro ao criar categoria. "+data);
			// $(".erro").show();		
		}

		// $('html, body').animate({ scrollTop: 0 }, 200);
		$("#modal").fadeOut(100);
		$(".loading").fadeOut(100);

	});
});


/*Add aeronave*/
$("#add_aeronave").submit(function(e){
	$(".loading").fadeIn(100);
	e.preventDefault();
	// tinymce.triggerSave();

	dados = "none=none";
	$(this).find("[name]").each(function(i, elemento){
		nome_input = $(elemento).attr("name");
		valor_input = escape($(elemento).val());

		dados += "&"+nome_input+"="+valor_input;

	});	

	// var dados = new FormData(this);
	// var dados = $(this).serialize();
	$.ajax({
		url: root_url+'/processador.php?add_aeronave',
		type: 'POST',
		data: dados,
		// processData: false,
		// contentType: false

	}).done(function(data) {

		if(data == "ok"){
			$(".sucesso").html("Aeronave adicionado com sucesso!");
			$(".sucesso").show();
			// $("#add_modelo")[0].reset();
			// $(".anexos img").remove();
			// $("#anexos_produto").val("");
		}else{
			$(".erro").html("Ocorreu um erro ao criar aeronave. "+data);
			$(".erro").show();
		}

		$('html, body').animate({ scrollTop: 0 }, 200);
		$(".loading").fadeOut(100);
	});	

});

$("#edit_aeronave").submit(function(e){
	$(".loading").fadeIn(100);
	e.preventDefault();
	tinymce.triggerSave();

	dados = "none=none";
	$(this).find("[name]").each(function(i, elemento){
		nome_input = $(elemento).attr("name");
		valor_input = escape($(elemento).val());

		dados += "&"+nome_input+"="+valor_input;

	});	
	// var dados = $(this).serialize();
	// var dados = new FormData(this);
	$.ajax({
		url: root_url+'/processador.php?edit_aeronave',
		type: 'POST',
		data: dados,
		// processData: false,
		// contentType: false

	}).done(function(data) {
		if(data == "ok"){
			$(".sucesso").html("Aeronave editada com sucesso!");
			$(".sucesso").show();
			// $("#editar_imovel")[0].reset();
			// $("#caracteristicas").multipleSelect("refresh");
			// $(".anexos img").remove();
			// $("[name=img1]").val("");
			// $("[name=img2]").val("");
			// $("[name=img3]").val("");
			// $("[name=img4]").val("");
			// $("[name=img5]").val("");
			// $("[name=img6]").val("");
		}else{
			$(".erro").html("Ocorreu um erro ao editar aeronave." + data);
			$(".erro").show();
		}

		$('html, body').animate({ scrollTop: 0 }, 200);
		$(".loading").fadeOut(100);
	});


});
$('#prefixo').mask('AA-AAAA');
$("#prefixo").keyup(function(){
    $(this).val($(this).val().toUpperCase());
});

/*Função para editar no banco*/
// $("#edit_aeronave").submit(function(e){
// 	$(".loading").fadeIn(100);
// 	e.preventDefault();


// });



//Atualiza status

/*Fazer função que atualiza qualquer status de qualquer tabela*/
// $("[data-status]").click(function(e){
// 	e.stopPropagation();
// 	that = this;

// 	id_status 	= $(this).data("status");
// 	id_aeronave = $(this).data("aeronave");
 	
// 	alert(id_aeronave);
// 	var status_atual = $("#status-atual-"+id_aeronave).text();
// 	alert(status_atual);
	
// 	$(that).html("<i class='fa fa-refresh fa-spin'></i>");
	
// 	$.ajax({
// 		url: root_url+'/processador.php?atualiza_status',
// 		type: 'POST',
// 		data: {
// 			id_status: id_status,
// 			id_aeronave: id_aeronave
// 		},
// 	})
// 	.done(function(data) {
// 		if(data == "ok"){
// 			if(id_status == "1"){
// 				$(that).removeClass('vermelho');
// 				$(that).addClass('verde');
// 				$(that).data("status","0");
// 				$(that).text("ATIVO");
// 			}else{
// 				$(that).addClass('vermelho');
// 				$(that).removeClass('verde');
// 				$(that).data("status","1");
// 				$(that).text("INATIVO");
// 			}
// 		}else{
// 			// alert("Ocorreu um erro ao atualizar o status da aeronave");
// 			 //alert(data);
// 			$(".sucesso").html("Status da Aeronave atualizado com sucesso!");
// 			$(".sucesso").show();
// 			$("#status-atual-"+id_aeronave).html(status_atual);
// 		}
// 	});
// 	e.preventDefault();
// });










/*Funções para adicionar no banco*/

// $("#add_produto").submit(function(e){
// 	$(".loading").fadeIn(100);
// 	e.preventDefault();
// 	// tinymce.triggerSave();

// 	var dados = new FormData(this);
// 	$.ajax({
// 		url: 'manipulador.php?add_produto',
// 		type: 'POST',
// 		data: dados,
// 		processData: false,
// 		contentType: false

// 	}).done(function(data) {

// 		if(data == "ok"){
// 			$(".sucesso").html("Produto adicionado com sucesso!");
// 			$(".sucesso").show();
// 			$("#add_produto")[0].reset();
// 			$(".anexos img").remove();
// 			$("#anexos_produto").val("");
// 		}else{
// 			$(".erro").html("Ocorreu um erro ao criar produto. "+data);
// 			$(".erro").show();
// 		}

// 		$('html, body').animate({ scrollTop: 0 }, 200);
// 		$(".loading").fadeOut(100);
// 	});	

// });


// $("#add-bloco").click(function(e){
// 	e.preventDefault();
// 	var div_block = $("<div></div>").addClass('column-block');
// 	var tag1 = $("<label>Anexo</label>");
// 	var tag2 = $("<label>Codigo</label>");
// 	var tag3 = $("<label>Cor</label>");
// 	var div_inline1 = $("<div></div>").addClass('column-inline');
// 	var div_inline2 = $("<div></div>").addClass('column-inline');
// 	var div_inline3 = $("<div></div>").addClass('column-inline');

// 	var campo1 = $("<input>").attr({
// 		type: 'file',
// 		name: 'produto[anexo][]',
// 		class: 'pequeno-anexo'
// 	});

// 	var campo2 = $("<input>").attr({
// 		type: 'text',
// 		name: 'produto[codigo][]',
// 		class: 'pequeno'
// 	});

// 	var campo3 = $("<input>").attr({
// 		type: 'text',
// 		name: 'produto[cor][]',
// 		class: 'pequeno'
// 	});	

// 	tag1.appendTo(div_inline1);
// 	tag2.appendTo(div_inline2);
// 	tag3.appendTo(div_inline3);

// 	campo1.appendTo(div_inline1);
// 	campo2.appendTo(div_inline2);
// 	campo3.appendTo(div_inline3);

// 	div_inline1.appendTo(div_block);
// 	div_inline2.appendTo(div_block);
// 	div_inline3.appendTo(div_block);


// 	div_block.appendTo('#sim_cores');
// });


// $("#sim_cor").change(function() {
// 	$("#sim_cores").toggle();
// });
// if($("#sim_cor").length == 0){
// 	$("#sim_cores").toggle();
// }



// $("#editar_produto").submit(function(e){
// 	$(".loading").fadeIn(100);
// 	e.preventDefault();
// 	tinymce.triggerSave();

// 	// var dados = $(this).serialize();
// 	var dados = new FormData(this);
// 	$.ajax({
// 		url: 'manipulador.php?editar_produto',
// 		type: 'POST',
// 		data: dados,
// 		processData: false,
// 		contentType: false

// 	}).done(function(data) {

// 		if(data == "ok"){
// 			$(".sucesso").html("Produto editado com sucesso!");
// 			$("<a href='index.php'>Voltar</a>").appendTo('.sucesso');
// 			$(".sucesso").show();
// 			$(".anexos img").remove();
// 			$("#anexos_leilao").val("");
// 		}else{
// 			$(".erro").html("Ocorreu um erro ao editar produto. "+data);
// 			$(".erro").show();
// 		}

// 		$('html, body').animate({ scrollTop: 0 }, 200);
// 		$(".loading").fadeOut(100);
// 	});

// });

// $(".removerCor").click(function(e){
// 	e.preventDefault();
// 	var codigo = $(this).parent().find(".input_codigo").val();
// 	var img = "p"+codigo+".jpg";
// 	alert(img);

// 	var elemento = $(this).parent();
	
// 	$.get("removeIMG.php?remove_anexo="+img, function(data) {
//     	if(data == "ok"){
//     		$(".loading").fadeOut(100);
// 		    elemento.remove();
//     	}else{
//     		$(".loading").fadeOut(100);
//     		alert("Ocorreu um erro ao remover imagem. \nErro: "+data);
//     	}
//     });
// });


// $(".status_produto").click(function(e){
// 	e.stopPropagation();

// 	var this_link = $(this);

// 	var id = $(this).data("id");
// 	var status = $(this).data("status");

// 	var texto_atual = $("#produto_status_texto-"+id).text();
// 	$("#produto_status_texto-"+id).html("<i class='fa fa-refresh fa-pulse'></i>");

// 	$.ajax({
// 		url: 'manipulador.php?status_produto',
// 		type: 'GET',
// 		data: {
// 			id: id,
// 			status: status
// 		},

// 	}).done(function(data) {

// 		if(data == "ok"){
// 			if($("#produto_status_texto-"+id).hasClass('ativo')){
// 				$("#produto_status_texto-"+id).removeClass('ativo');
// 				$("#produto_status_texto-"+id).addClass('inativo');
// 				$("#produto_status_texto-"+id).text('DESATIVADO');
// 				this_link.text("ATIVAR");
// 				this_link.data("status", "ativo");
// 			}else{
// 				$("#produto_status_texto-"+id).removeClass('inativo');
// 				$("#produto_status_texto-"+id).addClass('ativo');
// 				$("#produto_status_texto-"+id).text('ATIVO');
// 				this_link.text("DESATIVAR");
// 				this_link.data("status", "inativo");
// 			}



// 		}else{
// 			alert("Ocorreu um erro ao alterar status do produto.");
// 			$("#produto_status_texto-"+id).html(texto_atual);
// 		}
// 	});

// 	e.preventDefault();
	
// });

// $(".apagar_produto").click(function(e){
// 	e.preventDefault();
// 	var id = $(this).data("id");

// 	if(confirm("Deseja apagar o produto "+id+"?")){
// 		$(".loading").fadeIn(100);
// 		$.ajax({
// 			url: 'manipulador.php?apagar_produto',
// 			type: 'GET',
// 			data: {
// 				id: id
// 			},

// 		}).done(function(data) {
// 			$(".loading").fadeOut(100);
// 			if(data == "ok"){
// 				$("[data-produto-id=produto"+id+"]").remove();
// 			}else{
// 				alert(data);
// 			}
// 		});
// 	}
// });

// $("[data-token]").click(function(e){
// 	e.preventDefault();
// 	var token = $(this).data("token");
// 	var status = $(this).data("status");
// 	var elemento = $(this);

// 	$.ajax({
// 		url: 'manipulador.php?statusReserva',
// 		type: 'GET',
// 		data: {token: token, status: status},
// 	})
// 	.done(function(data) {
// 		if(data == "ok"){
			
// 			elemento.toggleClass('vermelho');
// 			if(status=='aberto'){
// 				elemento.data('status', 'fechado');
// 				elemento.html("Encerrar");
// 			}else{
// 				elemento.data('status', 'aberto');
// 				elemento.html("Abrir");
// 			}
// 			$(".sucesso").html("Status da reserva foi atualizado com sucesso!");
// 			$("<a href='reserva.php'>Voltar</a>").appendTo('.sucesso');
// 			$(".sucesso").show();
// 		}else{
// 			$(".erro").html("Erro ao atualizar o status da reserva!");
// 			$(".erro").show();
// 		}

// 	});
	
// });


// $("[data-id]").click(function(e){
// 	e.preventDefault();
// 	var id = $(this).data("id");
// 	var status = $(this).data("status-usuario");
// 	var elemento = $(this);
// 	var texto_atual = $(".usuario-nivel-"+id).text();
// 	$(".usuario-nivel-"+id).html("<i class='fa fa-refresh fa-pulse'></i>");

// 	$.ajax({
// 		url: 'manipulador.php?statusUsuario',
// 		type: 'GET',
// 		data: {id: id, status: status},
// 	})
// 	.done(function(data) {
// 		if(data == "ok"){

// 			if(status=='admin'){
// 				elemento.data('status-usuario', 'usuario');
// 				elemento.addClass('vermelho');
// 				elemento.html("Tornar Usuário");
// 				$(".usuario-nivel-"+id).html("Administrador");
				
// 			}else{
// 				elemento.data('status-usuario', 'admin');
// 				elemento.removeClass('vermelho');
// 				elemento.html("Tornar Admin");
// 				$(".usuario-nivel-"+id).html("Usuário");
// 			}
// 			$(".sucesso").html("Status do usuário foi atualizado com sucesso!");
// 			$(".sucesso").show();
// 		}else{
// 			$(".erro").html("Erro ao atualizar!"+data);
// 			$(".usuario-nivel-"+id).html(texto_atual);
// 			$(".erro").show();
// 		}
// 	});
	
// });





// //Adicionar slides
// $("#add_slide").change(function(e){
// 	$("#slide_form").submit();
// });
// $('#slide_form').submit(function(e){
// 	$(".loading").fadeIn(100);
//     $.ajax({
//       	url: 'upload.php?up_slides',
//       	type: 'POST',
//       	data: new FormData(this),
//       	processData: false,
//       	contentType: false
//     }).done(function(nome_anexo){
//     	if(nome_anexo != "falha"){
// 	    	$(".loading").fadeOut(100);
// 	    	var span = $("<span></span>").attr("class", "slide-span");
// 	    	var img = $('<img />', {
// 			  src: "../img/slide/"+nome_anexo
// 			}).attr("class", "fade");

// 			var li = $("<li></li>").addClass(nome_anexo.replace(".", ""));
			
// 			img.appendTo(span);
// 			span.appendTo(li);
// 			li.appendTo("#slides_bx");
// 			$(".divslidebx").show();
// 			slide.reloadSlider({
// 			    auto: true,
// 				pager:true,
// 				controls:true,
// 				infinityloop: true
// 			});
//     	}else{
//     		$(".loading").fadeOut(100);
//     		alert("Ocorreu um erro ao enviar o anexo. Tente novamente.");
//     	}
//     });

//     $('#slide_form')[0].reset();
//    	e.preventDefault();
// });

// $(".slides").on("click", ".slide-span", function(e){
// 	$(".loading").fadeIn(100);
//     var img = $(this).find('img').attr("src");
//     img = img.replace("../img/slide/", "");

//     var elemento = $("."+img.replace(".", ""));

//     $.get("removeIMG.php?slide&remove_img="+img, function(data) {
//     	if(data == "ok"){
//     		$(".loading").fadeOut(100);
// 		    elemento.remove();

// 		    if($(".divslidebx img").length == 0){
// 		    	$(".divslidebx").hide();
// 		    }
// 		    slide.reloadSlider({
// 			    auto: true,
// 				pager:true,
// 				controls:true,
// 				infinityloop: true
// 			});
//     	}else{
//     		$(".loading").fadeOut(100);
// 		    elemento.remove();
//     		//alert("Ocorreu um erro ao remover imagem. \nErro: "+data);
//     		if($(".divslidebx img").length == 0){
// 		    	$(".divslidebx").hide();
// 		    }
// 		    slide.reloadSlider({
// 			    auto: true,
// 				pager:true,
// 				controls:true,
// 				infinityloop: true
// 			});

//     	}
//     });

    
// });








// //Adicionar parceiros
// $("#add_parceiro").change(function(e){
// 	$("#parceiro_form").submit();
// });
// $('#parceiro_form').submit(function(e){
// 	$(".loading").fadeIn(100);
//     $.ajax({
//       	url: 'upload.php?up_parceiros',
//       	type: 'POST',
//       	data: new FormData(this),
//       	processData: false,
//       	contentType: false
//     }).done(function(nome_anexo){
//     	if(nome_anexo != "falha"){
// 	    	$(".loading").fadeOut(100);
// 	    	var span = $("<span></span>").attr("class", "parceiro-span");
// 	    	var middle = $("<div></div>").attr("class", "middle");
// 	    	var img = $('<img />', {
// 			  src: "../img/parceiro/"+nome_anexo
// 			}).attr("class", "fade");

// 			middle.appendTo(span);
// 			img.appendTo(span);
// 			span.appendTo(".divparceirobx");
			
//     	}else{
//     		$(".loading").fadeOut(100);
//     		alert("Ocorreu um erro ao enviar o anexo. Tente novamente.");
//     	}
//     });

//     $('#parceiro_form')[0].reset();
//    	e.preventDefault();
// });

// $(".parceiros").on("click", ".parceiro-span", function(e){
// 	$(".loading").fadeIn(100);
//     var img = $(this).find('img').attr("src");
//     img = img.replace("../img/parceiro/", "");

//     var elemento = $(this);

//     $.get("removeIMG.php?parceiro&remove_img="+img, function(data) {
//     	if(data == "ok"){
//     		$(".loading").fadeOut(100);
// 		    elemento.remove();

// 		    if($(".divparceirobx img").length == 0){
// 		    	$(".divparceirobx").hide();
// 		    }
		  
//     	}else{
//     		$(".loading").fadeOut(100);
// 		    elemento.remove();
//     		//alert("Ocorreu um erro ao remover imagem. \nErro: "+data);
//     		if($(".divparceirobx img").length == 0){
// 		    	$(".divparceirobx").hide();
// 		    }
		
//     	}
//     });
// });

global_lat = 0;
global_lng = 0;

function googleReady(elemento){
    elemento.removeClass('google-maps');
    elemento.attr("placeholder", "");
}
autocompletes = new Array();
function setupAutocomplete(elemento, id, funcao){
    var opt = {
        types: ['(cities)'],
        componentRestrictions: {country: "br"}
    };

    autocompletes[id] = new google.maps.places.Autocomplete(elemento[0], opt);

    google.maps.event.addListener(autocompletes[id], 'place_changed', function(){
        var dados_localidade = autocompletes[id].getPlace();
        global_lat = dados_localidade.geometry.location.lat();
        global_lng = dados_localidade.geometry.location.lng();
        elemento.change();
    });
}
$(document).ready(function(){
    $(".google-maps").each(function(index, elemento) {
        setupAutocomplete($(elemento), $(elemento).attr("id"));
        googleReady($(elemento));
    });
})
$(document).on("focus", ".google-maps", function(e){
    setupAutocomplete($(this), $(this).attr("id"));
    googleReady($(this));
});

function googlemaps(){
}


$("#base_operacao").change(function(){
	$("#latitude").val(global_lat);
	$("#longitude").val(global_lng);
});



$("#ano").mask('0000');
$("#autonomia").mask('0\.0');
// $("#valor").maskMoney();
// $("#valor_pernoite").maskMoney();
// $("#velocidade").maskMoney().attr('maxlength', 4);
$("#peso").maskMoney().attr('maxlength', 6);

function openSubmenu(){
	$(".submenu-options").toggleClass('aberto');
}
$("[name=img-aeronave]").hide();
$("#btn-add-imagem").click(function(e){
	e.preventDefault();
	$("[name=img-aeronave]").click();
});


$("[name=img-aeronave]").change(function(){
	$("#btn-add-imagem").addClass('desativado');
	$("#btn-add-imagem").html('Aguarde...');
	$("#form-img").submit();
});

$("#form-img").submit(function(e){
	if($(".campo-add-img:empty").length > 0){
		$.ajax({
			url: root_url+'/processador.php?add-imagem',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false
		})
		.done(function(texto) {
			console.log(texto);
			if(texto != "falha"){
				if($("#img-1").is(":empty")){
					$("#img-1").html("<img src='"+root_url+"/../arquivo/"+texto+"'>");
					$("#img-1").addClass('com-img');
					$("input[name=img1]").val(texto);		
				}

				else if($("#img-2").is(":empty")){
					$("#img-2").html("<img src='"+root_url+"/../arquivo/"+texto+"'>");
					$("#img-2").addClass('com-img');
					$("input[name=img2]").val(texto);		
				}	


				else if($("#img-3").is(":empty")){
					$("#img-3").html("<img src='"+root_url+"/../arquivo/"+texto+"'>");
					$("#img-3").addClass('com-img');
					$("input[name=img3]").val(texto);		
				}

				else if($("#img-4").is(":empty")){
					$("#img-4").html("<img src='"+root_url+"/../arquivo/"+texto+"'>");
					$("#img-4").addClass('com-img');
					$("input[name=img4]").val(texto);		
				}
							
			}else{
				alert("Error ao enviar imagem. Tente novamente.");
			}

			$("#btn-add-imagem").removeClass('desativado')
			$("#btn-add-imagem").html('<i class="fa fa-camera"></i> Escolher Imagem');
		});
		

	}else{
		alert("Imagens já selecionadas");
		$("#btn-add-imagem").removeClass('desativado')
		$("#btn-add-imagem").html('<i class="fa fa-camera"></i> Escolher Imagem');
	}
	e.preventDefault();
});

// $(document).on("click", ".com-img", function(e){
// 	id_div = $(this).attr("id");
// 	name_input = id_div.replace("-", "");

// 	$("input[name="+name_input+"]").val();
// 	$(this).removeClass('com-img');
// 	$(this).find('img').remove();
// });
$(document).on("click", ".thub-img-small", function(e){
	id = $(this).attr("id");
	// alert(id);
	nome_div = id.replace("-","");
    var item = $("#"+nome_div).val("");
    // alert(nome_div);

    $(this).removeClass('com-img');
    $(this).find('img').remove();

	
});


