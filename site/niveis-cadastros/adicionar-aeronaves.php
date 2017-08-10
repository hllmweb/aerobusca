

<div class="cadastro-form cadastro-taxiareo add-aeronaves">
	<h1>Preencha com seus dados <span>Todos os campos são obrigatórios*</span></h1>

	<?php if($dados_logado['tipo_usuario'] == "taxiaereo"): ?>

	<?php
	/*
	              _ _      _                                                                     
	     /\      | (_)    (_)                                                                    
	    /  \   __| |_  ___ _  ___  _ __   __ _ _ __    __ _  ___ _ __ ___  _ __   __ ___   _____ 
	   / /\ \ / _` | |/ __| |/ _ \| '_ \ / _` | '__|  / _` |/ _ \ '__/ _ \| '_ \ / _` \ \ / / _ \
	  / ____ \ (_| | | (__| | (_) | | | | (_| | |    | (_| |  __/ | | (_) | | | | (_| |\ V /  __/
	 /_/    \_\__,_|_|\___|_|\___/|_| |_|\__,_|_|     \__,_|\___|_|  \___/|_| |_|\__,_| \_/ \___|
	                                                                                             
	                                                                                                                                                                             
	*/
	?>
	<div class="form-add-aeronaves-anexos">
		<div class="add-aeronave-loading">
			<img src="<?= $root_site; ?>/img/loading.gif" alt="Carregando..." />
		</div>
		<div class="titulo-add-imagens">Carregar imagens</div>
		<div class="top-imagens campo-add-img" id="img-1"></div>
		<div class="top-imagens campo-add-img" id="img-2"></div>
		<div class="top-imagens campo-add-img ultimo" id="img-3"></div>
		<div class="imagem campo-add-img" id="img-4"></div>
		<input type="hidden" id="imgs-ok" value="">

		<div class="acoes">
			<form action="" id="formulario-img" style="display:block;">
				<input type="file" id="add-img-aeronave" name="add-img-aeronave">
				<label for="add-img-aeronave"><i class="fa fa-camera"></i> Escolher imagem</label>
			</form>
		</div>
	</div>

	<form id="cadastro-add-aeronave" class="ativo">
		<label for="aeronave_fabricante">
			<select name="aeronave_fabricante" id="aeronave_fabricante">
				<option disabled="disabled" selected="selected">Selecione o Fabricante</option>
				<?php
					$listaFabricantes = $modelo->listaFabricantes();

					foreach($listaFabricantes as $dado):
				?>
				<option value="<?= $dado['fabricante']; ?>"><?= $dado['fabricante']; ?></option>
				<?php endforeach; ?>
			</select>
		</label>

		<label for="aeronave_modelo">
			<select name="aeronave_modelo" id="aeronave_modelo">
				<option disabled="disabled" selected="selected">Selecione o Modelo</option>
				<option disabled="" id="msg-selecione-fabricante">Selecione um fabricante</option>
			</select>
		</label>

		<label for="aeronave_categoria" data-placeholder="Categoria da Aeronave" class="multiple-select select-padding">
			<select class="form-cadastro-select multiple" name="aeronave_categoria" id="aeronave_categoria" multiple="">
				<?php
					$categorias = $categoria->listaCategorias();

					foreach($categorias as $dado):
				?>
				<option value="<?= utf8_encode($dado['nome_categoria']); ?>"><?= $dado['nome_categoria']; ?></option>
				<?php endforeach; ?>
			</select>
		</label>

		<label for="aeronave_tipo_servicos" data-placeholder="Tipo de serviço" class="multiple-select">
			<select class="form-cadastro-select multiple" name="aeronave_tipo_servicos" id="aeronave_tipo_servicos" multiple="">
				<option value="Passageiros">Passageiros</option>
				<option value="Carga">Carga (peso)</option>
				<option value="Remoção Aérea">Remoção Aérea</option>
				<option value="medico">Aéreo Médico</option>
				<option value="Agrícola">Agrícola</option>
				<option value="Instrução">Instrução</option>
			</select>
		</label>

		<label for="aeronave_ano" data-placeholder="Ano">
			<input type="text" name="aeronave_ano" id="aeronave_ano" class="fade ano-input">
		</label>

		<label for="aeronave_prefixo" data-placeholder="Prefixo da aeronave">
			<input type="text" name="aeronave_prefixo" id="aeronave_prefixo" class="fade">
		</label>

		<label for="aeronave_passageiros" data-placeholder="Limite de Passageiros">
			<input type="text" name="aeronave_passageiros" id="aeronave_passageiros" class="fade">
		</label>

		<label for="aeronave_peso_bagagem" data-placeholder="Peso (bagagem)">
			<input type="text" name="aeronave_peso_bagagem" id="aeronave_peso_bagagem" class="fade peso-input" data-affixes-stay="false" data-suffix=" kg" data-thousands="" data-decimal="">
		</label>

		<label for="aeronave_velocidade" data-placeholder="Velocidade">
			<input type="text" name="aeronave_velocidade" id="aeronave_velocidade" class="fade velocidade-input" data-affixes-stay="false" data-suffix=" km/h" data-thousands="" data-decimal="">
		</label>

		<label for="aeronave_autonomia" data-placeholder="Autonomia (t/h)">
			<input type="text" name="aeronave_autonomia" id="aeronave_autonomia" class="fade autonomia-input">
		</label>

		<label for="aeronave_operacao" data-placeholder="Operação" class="multiple-select select-padding">
			<select class="form-cadastro-select multiple" name="aeronave_operacao" id="aeronave_operacao" multiple="">
				<option value="VFR">VFR</option>
				<option value="IFR">IFR</option>
			</select>
		</label>

		<label for="aeronave_base_operacao" data-placeholder="Base de operação">
			<input type="text" name="aeronave_base_operacao" id="aeronave_base_operacao" class="fade google-maps" placeholder="Aguarde...">
		</label>

		<label for="aeronave_valor" data-placeholder="Valor por hora">
			<input type="text" name="aeronave_valor" id="aeronave_valor" class="fade valor-input">
		</label>

		<label for="aeronave_valor_pernoite" data-placeholder="Valor do pernoite">
			<input type="text" name="aeronave_valor_pernoite" id="aeronave_valor_pernoite" class="fade valor-input">
		</label>

		<label for="aeronave_banheiro">
			<select name="aeronave_banheiro" id="aeronave_banheiro">
				<option disabled="disabled" selected="">Tipo do banheiro</option>
				<option value="Parcial">Sem banheiro</option>
				<option value="Parcial">Parcial</option>
				<option value="Completo">Completo</option>
			</select>
		</label>

		<label for="aeronave_servico_bordo">
			<select name="aeronave_servico_bordo" id="aeronave_servico_bordo">
				<option disabled="disabled" selected="">Serviço de bordo</option>
				<option value="Simples">Simples</option>
				<option value="Completo">Completo</option>
				<option value="Especial">Especial</option>
				<option value="VIP">VIP</option>
				<option value="Diamante">Diamante</option>
			</select>
		</label>

		<label for="aeronave_visao_geral" data-placeholder="Visão geral" class="for-textarea">
			<textarea name="aeronave_visao_geral" id="aeronave_visao_geral"></textarea>
		</label>

		<div class="rodape-form-cadastro">
			<div class="rodape-form-cadastro-esquerda">
				<button id="add-mais-aeronaves">Adicionar mais aeronaves</button>
			</div>
			<div class="rodape-form-cadastro-direita">

				<input type="hidden" name="aeronave_base_operacao_lat" id="aeronave_base_operacao_lat" value="0">
				<input type="hidden" name="aeronave_base_operacao_lng" id="aeronave_base_operacao_lng" value="0">

				<input type="hidden" name="img1" value="">
				<input type="hidden" name="img2" value="">
				<input type="hidden" name="img3" value="">
				<input type="hidden" name="img4" value="">
				
				<button type="submit">Concluir</button>
			</div>
		</div>
	</form>

	<?php else: ?>

	<?php 
		/*
		______          _                        _                _       
		|  _  \        | |                      (_)              | |      
		| | | |__ _  __| | ___  ___   _ __  _ __ ___   ____ _  __| | ___  
		| | | / _` |/ _` |/ _ \/ __| | '_ \| '__| \ \ / / _` |/ _` |/ _ \ 
		| |/ / (_| | (_| | (_) \__ \ | |_) | |  | |\ V / (_| | (_| | (_) |
		|___/ \__,_|\__,_|\___/|___/ | .__/|_|  |_| \_/ \__,_|\__,_|\___/ 
		                             | |                                  
		                             |_|                                  
		*/
	?>

	<?php endif; ?>

	<div class="progresso-taxiaereo">
		<ul>
			<li><span class="ativo">1</span></li>
			<li><span class="ativo">2</span></li>
			<li><span class="ativo">3</span></li>
		</ul>
	</div>
</div>

<script>
	$("#add-img-aeronave").change(function(){
		$(".add-aeronave-loading").show();
		$("label[for=add-img-aeronave]").addClass('desativado');
    	$("label[for=add-img-aeronave]").html('Aguarde...');
    	$("#formulario-img").submit();
    });

    $("#aeronave_base_operacao").change(function(e){
    	$("#aeronave_base_operacao_lat").val(global_lat);
    	$("#aeronave_base_operacao_lng").val(global_lng);
    });

    $('#formulario-img').submit(function(e){
    	if($(".campo-add-img:empty").length > 0){

	    $.ajax({
	      	url: '<?= $root_site; ?>/processador.php?add-imagem',
	      	type: 'POST',
	      	data: new FormData(this),
	      	processData: false,
	      	contentType: false
	    }).done(function(texto){
	    	console.log(texto);
	    	if(texto != "falha"){
	    		if($('#img-1').is(':empty')){
		    		$("#img-1").html("<img src='<?= $root_site; ?>/arquivo/"+texto+"'>");
		    		$("#img-1").addClass('com-img');
		    		$("input[name=img1]").val(texto);
		    	}

		    	else if($('#img-2').is(':empty')){
		    		$("#img-2").html("<img src='<?= $root_site; ?>/arquivo/"+texto+"'>");
		    		$("#img-2").addClass('com-img');
		    		$("input[name=img2]").val(texto);
		    	}

		    	else if($('#img-3').is(':empty')){
		    		$("#img-3").html("<img src='<?= $root_site; ?>/arquivo/"+texto+"'>");
		    		$("#img-3").addClass('com-img');
		    		$("input[name=img3]").val(texto);
		    	}

		    	else if($('#img-4').is(':empty')){
		    		$("#img-4").html("<img src='<?= $root_site; ?>/arquivo/"+texto+"'>");
		    		$("#img-4").addClass('com-img');
		    		$("input[name=img4]").val(texto);
		    	}
	    	}else{
	    		alert("Erro ao enviar imagem. Tente novamente.");
	    	}

	    	$(".add-aeronave-loading").hide();
			$("label[for=add-img-aeronave]").removeClass('desativado');
	    	$("label[for=add-img-aeronave]").html('<i class="fa fa-camera"></i> ESCOLHER IMAGEM');
	    });

		}else{
			alert("Imagens já selecionadas");
			$(".add-aeronave-loading").hide();
			$("label[for=add-img-aeronave]").removeClass('desativado');
			$("label[for=add-img-aeronave]").html('<i class="fa fa-camera"></i> ESCOLHER IMAGEM');
		}
    	e.preventDefault();
	});

	$(document).on("click", ".com-img", function(e){

		id_div = $(this).attr("id");
		name_input = id_div.replace("-", "");

		$("input[name="+name_input+"]").val("");
		$(this).removeClass('com-img');
		$(this).find('img').remove();
	});
</script>