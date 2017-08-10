<?php
	require_once("../lib/autoload.php");

# Condição para editar usuário
if(isset($_GET['edit_usuario'])):
	$id 				= $_POST['id'];
	
	$tipo_usuario		= $_POST['tipo_usuario'];

	$nome 				= utf8_encode($_POST['nome']);
	$data_nascimento 	= $_POST['data_nascimento'];
	$sexo 				= $_POST['sexo'];
	$cpf_ou_cnpj 		= $_POST['cpf_ou_cnpj'];
	$telefone 			= $_POST['telefone'];
	$pais 		    	= $_POST['pais'];
	$cep 			    = $_POST['cep'];
	$estado 			= $_POST['estado'];
	$cidade 			= $_POST['cidade'];
	$bairro 			= utf8_encode($_POST['bairro']);
	$rua 				= utf8_encode($_POST['rua']);
	$numero_endereco 	= $_POST['numero_endereco'];
	$gestor_responsavel	= utf8_encode($_POST['gestor_responsavel']);
	$banco 				= $_POST['banco'];
	$agencia	 		= $_POST['agencia'];
	$tipo_conta 		= $_POST['tipo_conta'];
	$n_conta 			= $_POST['n_conta'];
	$metodos_pagamento  = utf8_encode($_POST['metodos_pagamento']);
	$cheta 				= $_POST['cheta'];
	$email 				= $_POST['email'];
	$senha 				= $_POST['senha'];
	$descricao_empresa  = utf8_encode($_POST['descricao_empresa']);


	$editar = $auth->editarUsuario($id, $tipo_usuario, $nome, $data_nascimento, $sexo, $cpf_ou_cnpj, $telefone, $pais, $cep, $estado, $cidade, $bairro, $rua, $numero_endereco, $gestor_responsavel, $banco, $agencia, $tipo_conta, $n_conta, $metodos_pagamento,$cheta,$email,$senha,$descricao_empresa);

	if($editar === true):
		echo "ok";
		exit;
	else:
		echo $editar;
		exit;
	endif;

endif;


# Condição para adicionar um novo modelos
if(isset($_GET['add_modelo'])):
	$fabricante         = ($_POST['novofabricante'] != "") ? $_POST['novofabricante'] : $_POST['fabricante'];
	$modelos 			= ($_POST['novomodelo'] != "") ? $_POST['novomodelo'] : $_POST['modelo'];
	$categoria 			= $_POST['categoria'];

 
	# Metodo que adiciona o modelo
	$add_modelo 		= $modelo->adicionarModelos($fabricante, $modelos, $categoria);
	if($add_modelo === true):
		echo "ok";
		exit;
	else:
		$add_modelo;
	endif;
endif;


# Condição para adicionar uma nova categoria
if(isset($_GET['add_categoria'])):
	$nome_categoria 	= utf8_decode($_POST['nome_categoria']);

	# Metodo que adiciona a categoria
	$add_categoria 		= $categoria->adicionarCategorias($nome_categoria);
	if($add_categoria === true):
		echo "ok";
		exit;
	else:
		$add_categoria;
	endif;
endif;

#Lista os modelos em forma de string sepados por |
if(isset($_GET['pega_modelos'])):
	$fabricante = $_GET['fabricante'];
	$listaModelos = $modelo->listaModelos($fabricante);

	$string = "";
	foreach($listaModelos as $dado):
		$string .= $dado['modelo']."|";
	endforeach;

	echo rtrim($string, "|");
endif;


# Condição para adicionar uma nova aeronave
if(isset($_GET['add_aeronave'])):

	$id 				= $_POST['id'];
	$id_usuario			= $_POST['id_usuario'];

	$fabricante	= ($_POST['novofabricante'] != "")	? $_POST['novofabricante']	 : $_POST['fabricante'];
	$fabricante	= utf8_encode($fabricante);

	$modelo = ($_POST['novomodelo']  != "") ? $_POST['novomodelo']  : $_POST['modelo'];
	$modelo	= utf8_encode($modelo);

	$categoria 			= $_POST['categoria'];
	$ano 				= $_POST['ano'];
	$prefixo 			= $_POST['prefixo'];
	$passageiros 		= $_POST['passageiros'];
	$peso_bagagem 		= $_POST['peso'];
	$velocidade 		= $_POST['velocidade'];
	$autonomia 			= $_POST['autonomia'];
	$operacao 			= $_POST['operacao'];
	$valor 				= $_POST['valor'];
	$valor_pernoite 	= $_POST['valor_pernoite'];
	$banheiro 			= $_POST['banheiro'];
	$servico_bordo 		= $_POST['servico_bordo'];
	$base_operacao 		= $_POST['base_operacao'];
	$base_operacao_lat 	= $_POST['latitude'];
	$base_operacao_lng 	= $_POST['longitude'];
	$tipo_servico 		= $_POST['tipo_servico'];
	$visao_geral	 	= $_POST['visao_geral'];

	$img1 				= $_POST['img1'];
	$img2 				= $_POST['img2'];
	$img3 				= $_POST['img3'];
	$img4 				= $_POST['img4'];

	$arrayCheck = array($fabricante, $modelo, $categoria, $ano, $prefixo, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $valor, $valor_pernoite, $banheiro, $servico_bordo, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servico, $img1, $img2, $img3, $img4);

	foreach ($arrayCheck as $campo): // verifica campos obrigatorios
		if($campo == ""):
			echo "campo_faltando";
			exit;
		endif;
	endforeach;

	$json_array = array(
		'imagem1' => $img1,
		'imagem2' => $img2,
		'imagem3' => $img3,
		'imagem4' => $img4 
	);

	$imagens = json_encode($json_array, JSON_PRETTY_PRINT);

	$add = $aeronave->editarAeronave($id, $id_usuario, $fabricante, $modelo, $categoria, $prefixo, $ano, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servico, $valor, $valor_pernoite, $imagens, $servico_bordo, $banheiro, $visao_geral);

	if($add === true):
		echo "ok";
		exit;
	else:
		echo $add;
		exit;
	endif;

endif;

if(isset($_GET['edit_aeronave'])):
	$id 				= $_POST['id'];
	$id_usuario			= $_POST['id_usuario'];

	$fabricante			= ($_POST['novofabricante'] != "")	? $_POST['novofabricante']	 : $_POST['fabricante'];
	$fabricante			= utf8_encode($fabricante);

	$modelo 			= ($_POST['novomodelo']  != "") ? $_POST['novomodelo']  : $_POST['modelo'];
	$modelo				= utf8_encode($modelo);

	$categoria 			= utf8_encode($_POST['categoria']);
	$ano 				= $_POST['ano'];
	$prefixo 			= $_POST['prefixo'];
	$passageiros 		= $_POST['passageiros'];
	$peso_bagagem 		= $_POST['peso'];
	$velocidade 		= $_POST['velocidade'];
	$autonomia 			= $_POST['autonomia'];
	$operacao 			= $_POST['operacao'];
	$valor 				= $utilitarios->vfloat($_POST['valor']);
	$valor_pernoite 	= $_POST['valor_pernoite'];
	$banheiro 			= $_POST['banheiro'];
	$servico_bordo 		= utf8_encode($_POST['servico_bordo']);
	$base_operacao 		= $_POST['base_operacao'];
	$base_operacao_lat 	= $_POST['latitude'];
	$base_operacao_lng 	= $_POST['longitude'];
	$tipo_servicos 		= utf8_encode($_POST['tipo_servicos']);
	$visao_geral	 	= utf8_encode($_POST['visao_geral']);
	
	$img1 				= $_POST['img1'];
	$img2 				= $_POST['img2'];
	$img3 				= $_POST['img3'];
	$img4 				= $_POST['img4'];

	// $arrayCheck = array($fabricante, $modelo, $categoria, $ano, $prefixo, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $valor, $valor_pernoite, $banheiro, $servico_bordo, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servico, $img1, $img2, $img3, $img4);

	// foreach ($arrayCheck as $campo): // verifica campos obrigatorios
	// 	if($campo == ""):
	// 		echo "campo_faltando";
	// 		exit;
	// 	endif;
	// endforeach;

	$json_array = array(
		'imagem1' => $img1,
		'imagem2' => $img2,
		'imagem3' => $img3,
		'imagem4' => $img4 
	);

	$imagens = json_encode($json_array, JSON_PRETTY_PRINT);

	$editar = $aeronave->editarAeronave($id, $id_usuario, $fabricante, $modelo, $categoria, $prefixo, $ano, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servicos, $valor, $valor_pernoite, $imagens, $servico_bordo, $banheiro, $visao_geral);

	if($editar === true):
		echo "ok";
		exit;
	else:
		echo $editar;
		exit;
	endif;

endif;


if(isset($_GET['apagar_aeronave'])):
	$id_aeronave 	= intval($_GET['id']);
	$apagar = $aeronave->apagarAeronave($id_aeronave);

	if($apagar == true){
		echo "ok";
		exit;
	}else{
		echo "Erro ao deletar aeronave";
		exit;
	}
endif;


if(isset($_GET['add_mensagem'])):
	$id_cotacao 	= $_POST['id_cotacao'];
	$id_cliente 	= $_POST['id_cliente'];
	$id_taxiaereo 	= $_POST['id_taxiaereo'];
	$tipo_usuario 	= $_POST['tipo_usuario'];
	$texto 			= $_POST['texto'];

	# Metodo que adiciona a categoria
	$add_msg 		= $mensagens->adicionarMensagem($id_cotacao, $id_cliente, $id_taxiaereo, $tipo_usuario, $texto);
	if($add_msg === true):
		echo "ok";
		exit;
	else:
		echo $add_msg;
		exit;
	endif;
endif;


if(isset($_GET['add_produto'])):

	$codigo	     		= $_POST['codigo'];
	$fabricante			= strtolower($_POST['fabricante']);
	$categoria			= strtolower($_POST['categoria']);
	$familia			= strtolower($_POST['familia']);
	$titulo				= strtolower($_POST['titulo']);
	$unidade			= $_POST['unidade'];
	$estoque 			= $_POST['estoque'];
	$tipo  				= $_POST['tipo'];
	$status				= $_POST['status'];
	$anexos_produto		= $_POST['anexos_produto'];
	// $imagens   			= $_FILES['produto']['anexo'];
	$codigos   			= $_POST['produto']['codigo'];
	// $cores 				= $_POST['produto']['cor'];

	// $anexos				= $_POST['anexos_leilao'];

	$totalCores = count($codigos);
	$campoCores = "";
	for($i=0; $i<$totalCores; $i++){
		if($_POST['produto']['codigo'][$i] != ""){

			$pasta = "../arquivo/";
			$nome_arquivo    = $_FILES['produto']['name']['anexo'][$i];
	        
			$ext = strtolower(strrchr($nome_arquivo,"."));

			$nome_atual = "p".$_POST['produto']['codigo'][$i].$ext;
			$tmp = $_FILES['produto']['tmp_name']['anexo'][$i];
	                
			move_uploaded_file($tmp, $pasta.$nome_atual);

			$campoCores .= $_POST['produto']['codigo'][$i]. ":".$_POST['produto']['cor'][$i].", ";
		}
	}
	



	$add_produto = $produtos->addProduto($codigo, $fabricante, $categoria, $familia, $titulo, $unidade, $estoque, $tipo, $status, $campoCores);

	if($add_produto == true){
		echo "ok";
	}

endif;

if(isset($_GET['editar_produto'])):

	$id 				= $_POST['id'];
	$codigo	     		= $_POST['codigo'];
	$fabricante			= $_POST['fabricante'];
	$categoria			= $_POST['categoria'];
	$familia			= $_POST['familia'];
	$titulo				= $_POST['titulo'];
	$unidade			= $_POST['unidade'];
	$estoque 			= $_POST['estoque'];
	$tipo  				= $_POST['tipo'];
	$status				= $_POST['status'];
	$anexos_produto		= $_POST['anexos_produto'];
	// $imagens   			= $_FILES['produto']['anexo'];
	$codigos   			= (isset($_POST['produto']['codigo'])) ? $_POST['produto']['codigo'] : false;


	$totalCores = count($codigos);
	$campoCores = "";
	if($codigos != false):
	for($i=0; $i<$totalCores; $i++){
		if($_POST['produto']['codigo'][$i] != ""){

			$pasta = "../arquivo/";
			$nome_arquivo    = $_FILES['produto']['name']['anexo'][$i];
	        
			$ext = strtolower(strrchr($nome_arquivo,"."));

			$nome_atual = "p".$_POST['produto']['codigo'][$i].$ext;
			$tmp = $_FILES['produto']['tmp_name']['anexo'][$i];
	                
			move_uploaded_file($tmp, $pasta.$nome_atual);

			$campoCores .= $_POST['produto']['codigo'][$i]. ":".$_POST['produto']['cor'][$i].", ";
		}
	}
	endif;
	$editar_produto = $produtos->editarProduto($codigo, $fabricante, $categoria, $familia, $titulo, $unidade, $estoque, $tipo, $status, $campoCores, $id);

	if($editar_produto == true){
		echo "ok";
	}else{
		echo "Erro, não esta retornando true";
	}

endif;

if(isset($_GET['status_produto'])):

	$id_produto	= intval($_GET['id']);
	$status 	= $_GET['status'];

	$alterar_status = $produtos->statusProdutos($id_produto, $status);

	if($alterar_status == true){
		echo "ok";
	}else{
		echo $id_produto." - ".$status;
	}

endif;

if(isset($_GET['apagar_usuario'])):
	$id_usuario 	= intval($_GET['id']);
	$apagar = $auth->apagarUsuario($id_usuario);

	if($apagar == true){
		echo "ok";
		exit;
	}else{
		echo "Erro ao deletar usuario";
		exit;
	}
endif;


if(isset($_GET['statusReserva'])):
	$token = $_GET['token'];
	$status = $_GET['status'];

	$atualiza = $reservas->atualizaReservaToken($token,$status);
	if($atualiza == true){
		echo "ok";
	}else{
		echo "Erro ao atualizar reserva";
	}
endif;


if(isset($_GET['statusUsuario'])):
	$id = $_GET['id'];
	$status = $_GET['status'];

	$atualiza = $autenticando->atualizaNivel($id,$status);
	if($atualiza == true){
		echo "ok";
	}else{
		echo "Erro ao atualizar usuario".$id.$status;
	}

endif;


if(isset($_GET['atualiza_status'])):
	$id_status = $_POST['id_status'];
	$id_aeronave = $_POST['id_aeronave'];
	
	$atualiza = $aeronave->atualizaStatusAeronaves($id_aeronave, $id_status);
	if($atualiza == true){
		echo "ok";
	}else{
		echo "Erro ao atualizar aeronave";
	}
endif;

if(isset($_GET['atualiza_status_usuario'])):
	$status_usuario = $_POST['status_usuario'];
	$id_usuario = $_POST['id_usuario'];
	
	$atualiza = $auth->atualizaStatusUsuarios($id_usuario, $status_usuario);
	if($atualiza == true){
		echo "ok";
	}else{
		echo "Erro ao atualizar usuário";
	}
endif;

if(isset($_GET['add-imagem'])){
	$pasta = "../arquivo/";
	$nome_imagem = $_FILES['img-aeronave']['name'];

	$ext = strtolower(strrchr($nome_imagem, "."));
	$nome_atual = rand(0, 99).time().rand(0, 9999).$ext;
	$tmp = $_FILES['img-aeronave']['tmp_name'];

	if(move_uploaded_file($tmp, $pasta.$nome_atual)){
		echo $nome_atual;
		exit;
	}else{
		echo "falha";
		exit;
	}
}


if(isset($_GET['add-perfil'])){
	$pasta = "../arquivo/";
	$nome_imagem = $_FILES['img-perfil']['name'];
	$id_usuario = $_POST['id_usuario'];

	$ext = strtolower(strrchr($nome_imagem, "."));
	$nome_atual = rand(0, 99).time().rand(0, 9999).$ext;
	$tmp = $_FILES['img-perfil']['tmp_name'];

	if(move_uploaded_file($tmp, $pasta.$nome_atual)){
		$updateImagem = $auth->insereImagemUsuario($id_usuario,$nome_atual);
		if($updateImagem ==  true):
			echo $nome_atual;
		else: 
			echo "falha";
		endif;
	}else{
		echo "falha";
	}
}


#ajax info_token (cotação)
if(isset($_GET['info_token'])):
	$token = $_POST['token'];
	echo $id_logado.$token.$dados_logado['tipo_usuario'];

	$listaCotacaoToken = $cotacao->listaCotacao($token,$id_logado,$dados_logado['tipo_usuario']);
	foreach($listaCotacaoToken as $dadosCotacaoToken):
	$dadosTaxiAereo = $auth->dadosUsuario($dadosCotacaoToken['id_taxiaereo']);
	$dadosAeronave = $aeronave->dadosAeronave($dadosCotacaoToken['id_aeronave']);
	

	$info_localizacoes = json_decode($dadosCotacaoToken['localizacoes']);

	$string_cidades = "";

	$total_locais = count($info_localizacoes->origem);
	for ($i=0; $i<$total_locais; $i++){
		if($i == $total_locais-1){
			$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil");
		}else{
			$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil")." > ";
		}
		$data_ida = $info_localizacoes->data_ida[$i];
		$hora_ida = $info_localizacoes->hora_ida[$i];

		$data_volta = $info_localizacoes->data_ida[$i];
		$hora_volta = $info_localizacoes->hora_volta[$i];

		$passageiros = $info_localizacoes->passageiros[$i];
	}

?>

<div class="info_cotacao">
	<div class="dados_cotacao">
		<ul>
			<li><?= $dadosTaxiAereo['nome']; ?></li>
			<li><?= $dadosAeronave['modelo']; ?></li>
			<li><?= $dadosCotacaoToken['status_cotacao']; ?></li>
			
			<li>
			<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
				<a href="javascript:void(0);" class="ver-detalhe-cotacao btn-dados cinza">Ver</a>
				<a href="#" data-status-dados="ok" data-id-cotacao="<?= $dadosCotacaoToken['id']; ?>" class="btn-dados verde">Ok</a>
				<a href="#" class="btn-dados azul">E-Mail</a> 
				<a href="#" data-status-dados="negado" data-id-cotacao="<?= $dadosCotacaoToken['id']; ?>" class="btn-dados vermelho">Negar</a>
				<?php elseif($dados_logado['tipo_usuario'] == "taxiaereo"):?>
				<a href="" class="btn-dados verde">Aprovar Cotação</a>
				<a href="" class="btn-dados vermelho">Rejeitar Cotação</a>
				<?php endif; ?>
			</li>
			
		</ul>
		<div class="detalhe_cotacao">
			<div class="texto_cotacao_detalhe">
				<strong>Trecho:</strong> <?= $string_cidades; ?><br>
				<strong>Data/Hora <sup>ida</sup>: </strong> <?= $data_ida; ?> as <?= $hora_ida;?>Hrs<br>
				<strong>Data/Hora <sup>volta</sup>: </strong> <?= $data_volta; ?> as <?= $hora_volta; ?>Hrs<br>
				<strong>Categoria do Vôo: </strong> <?= strtoupper($dadosCotacaoToken['categoria_voo']); ?><br>
				<strong>Quant. de Passageiros: </strong> <?= $passageiros; ?><br>
				<strong>Pernoite: </strong> <?= ($dadosCotacaoToken['dias_pernoite'] <= 3) ? "SIM, quantidade de dias ".$dadosCotacaoToken['dias_pernoite'].", com o valor do pernoite R$".number_format($dadosCotacaoToken['valor_pernoite'],2,",",".") : "NÃO"; ?><br>
			</div>
			<?php #if($dados_logado['tipo_usuario'] == "taxiaereo"): ?>
				<div class="btn-bloco">
				<a href="<?= $root_sistema; ?>/cotacoes/ver-cotacao/id/<?=$dadosCotacaoToken['id'];?>/token/<?=$dadosCotacaoToken['token'];?>" class="btn verde">ver cotação completa</a>
				</div>
			<?php #else: ?> 
		</div>
	</div>
</div>
<?php 
	endforeach;
endif;

if(isset($_GET['muda_statusCotacao'])):
	$status = $_POST['status'];
	$id_cotacao = $_POST['id_cotacao'];

	if($status == "ok"):
		$status_envio = $cotacao->atualizaStatusEnvio($status, $id_cotacao);
		$statusCotacao = $cotacao->atualizaStatusCotacao("aguardando", $id_cotacao);

		if($status_envio === true && $statusCotacao === true):
			echo "ok";
		else:
			echo $status_envio."".$statusCotacao;
		endif;

	elseif($status == "enviado"):
		$status_envio = $cotacao->atualizaStatusEnvio("ok", $id_cotacao);
		$statusCotacao = $cotacao->atualizaStatusCotacao("enviado", $id_cotacao);

		if($status_envio === true && $statusCotacao === true):
			echo "ok";
		else:
			echo $status_envio."".$statusCotacao;
		endif;
	elseif($status == "finalizado"):
		$status_envio = $cotacao->atualizaStatusEnvio("ok", $id_cotacao);
		$statusCotacao = $cotacao->atualizaStatusCotacao("finalizado", $id_cotacao);

		if($status_envio === true && $statusCotacao === true):
			echo "ok";
		else:
			echo $status_envio."".$statusCotacao;
		endif;		
	elseif($status == "negado"):
		$status_envio = $cotacao->atualizaStatusEnvio($status, $id_cotacao);
		$statusCotacao = $cotacao->atualizaStatusCotacao("rejeitado", $id_cotacao);

		if($status_envio === true && $statusCotacao === true):
			echo "ok";
		else:
			echo $status_envio."".$statusCotacao;
		endif;

	else:
		$status_envio = $cotacao->atualizaStatusEnvio($status, $id_cotacao);
		if($status_envio === true):
			echo "ok";
		else:
			echo $status_envio;
		endif;
	endif;

endif;

?>


