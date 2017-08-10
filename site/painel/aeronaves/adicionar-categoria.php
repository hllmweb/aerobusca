<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	$permissao->acessoAdmin();
?>
<div id="conteudo">
	<div class="modal-titulo">
		<b>Adicionar uma nova categoria</b>
		<a href="#" class="btn_x_modal" onclick="fecharpopup(); return false;"><i class="fa fa-times"></i></a>
	</div>
	<div class="modal-conteudo">
		<form id="add_categoria">
			<label for="categoria">Nome da Categoria:</label>
			<input type="text" id="nome_categoria" name="nome_categoria" placeholder="Digite o nome da categoria..." required="">
			<div class="modal-btn"><button>Adicionar Categoria</button></div>
		</form>	
	</div>


</div>