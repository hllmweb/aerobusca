<ul>
	<?php if($dados_logado['tipo_usuario'] == "taxiaereo"): ?>
	<li><a href="#cadastro-taxiaereo-infos-adicionais" class="ativo"><i class="fa fa-plane"></i>Táxi Aéreo</a></li>
	<?php else: ?>
	<li><a href="#privado"><i><img src="<?= $root; ?>/img/icone-privado.png" alt="Icone Privado"></i>Privado</a></li>
	<?php endif; ?>
</ul>

<div class="cadastro-form cadastro-taxiareo">
	<h1>PREENCHA COM SEUS DADOS <span>Todos os campos são obrigatórios</span></h1>

	<?php if($dados_logado['tipo_usuario'] == "taxiaereo"): ?>

	<?php
	/*
		______          _             _             _                           
		|  _  \        | |           | |           (_)                          
		| | | |__ _  __| | ___  ___  | |_ __ ___  ___  __ _  ___ _ __ ___  ___  
		| | | / _` |/ _` |/ _ \/ __| | __/ _` \ \/ / |/ _` |/ _ \ '__/ _ \/ _ \ 
		| |/ / (_| | (_| | (_) \__ \ | || (_| |>  <| | (_| |  __/ | |  __/ (_) |
		|___/ \__,_|\__,_|\___/|___/  \__\__,_/_/\_\_|\__,_|\___|_|  \___|\___/                                                                
                                                                        
	 */
	?>
	<form id="cadastro-taxiaereo-infos-adicionais" class="ativo">
		<label for="taxiareo_cheta" data-placeholder="Cheta">
			<input type="text" name="taxiareo_cheta" id="taxiaereo_cheta" class="fade">
		</label>

		<label for="taxiaereo_cep" data-placeholder="CEP">
			<input type="text" name="taxiaereo_cep" id="taxiaereo_cep" class="fade cep-input" placeholder="______-___">
		</label>

		<label for="taxiaereo_bairro" data-placeholder="Bairro">
			<input type="text" name="taxiaereo_bairro" id="taxiaereo_bairro" class="fade">
		</label>

		<label for="taxiaereo_rua" data-placeholder="Rua">
			<input type="text" name="taxiaereo_rua" id="taxiaereo_rua" class="fade">
		</label>

		<label for="taxiaereo_numero" data-placeholder="Número">
			<input type="text" name="taxiaereo_numero" id="taxiaereo_numero" class="fade">
		</label>

		<label for="taxiaereo_cidade" data-placeholder="Cidade">
			<input type="text" name="taxiaereo_cidade" id="taxiaereo_cidade" class="fade">
		</label>

		<label for="taxiaereo_estado">
			<select name="taxiaereo_estado" id="taxiaereo_estado">
				<option disabled="disabled" selected="selected">Selecione o estado</option>
				<option value="AC">Acre</option>					 
				<option value="AL">Alagoas</option>				 
				<option value="AP">Amapá</option>					 
				<option value="AM">Amazonas</option>				 
				<option value="BA">Bahia</option>					 
				<option value="CE">Ceará</option>					 
				<option value="DF">Distrito Federal</option>		 
				<option value="ES">Espírito Santo</option>		 
				<option value="GO">Goiás</option>					 
				<option value="MA">Maranhão</option>				 
				<option value="MT">Mato Grosso</option>			 
				<option value="MS">Mato Grosso do Sul</option>	 
				<option value="MG">Minas Gerais</option>			 
				<option value="PA">Pará</option>					 
				<option value="PB">Paraíba</option>				 
				<option value="PR">Paraná</option>				 
				<option value="PE">Pernambuco</option>			 
				<option value="PI">Piauí</option>					 
				<option value="RJ">Rio de Janeiro</option>		 
				<option value="RN">Rio Grande do Norte</option>	 
				<option value="RS">Rio Grande do Sul</option>		 
				<option value="RO">Rondônia</option>
				<option value="RR">Roraima</option>
				<option value="SC">Santa Catarina</option>		 
				<option value="SP">São Paulo</option>				 
				<option value="SE">Sergipe</option>				 
				<option value="TO">Tocantins</option>
			</select>
		</label>
		<label for="taxiaereo_metodo_pagamento" data-placeholder="Metodo de pagamento" class="multiple-select select-padding">
			<select class="form-cadastro-select multiple" name="taxiaereo_metodo_pagamento" id="taxiaereo_metodo_pagamento" multiple="">
				<option value="Cartão">Cartão</option>
				<option value="Dinheiro">Dinheiro</option>
				<option value="Boleto">Boleto</option>
			</select>
		</label>
		<label for="taxiaereo_descricao" data-placeholder="Descreva sua empresa" data-erro="A senhas não estão de acordo." class="total textarea-label">
			<textarea  name="taxiaereo_descricao" id="taxiaereo_descricao" class="fade"></textarea>
		</label>
		<div class="rodape-form-cadastro">
			<div class="rodape-form-cadastro-esquerda">
				<input type="checkbox" id="termos" name="termos">
				<label for="termos">Li e aceito os termos de adesão.</label>
			</div>
			<div class="rodape-form-cadastro-direita">
				<button type="submit">Salvar</button>
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
			<li><span>3</span></li>
		</ul>
	</div>
</div>