<?php

include "lib/autoload.php";
@session_start();

/*
 ██████╗██╗     ██╗███████╗███╗   ██╗████████╗███████╗
██╔════╝██║     ██║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
██║     ██║     ██║█████╗  ██╔██╗ ██║   ██║   █████╗  
██║     ██║     ██║██╔══╝  ██║╚██╗██║   ██║   ██╔══╝  
╚██████╗███████╗██║███████╗██║ ╚████║   ██║   ███████╗
 ╚═════╝╚══════╝╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
                                                                                   
*/

if(isset($_GET['registro_cliente'])){

	$nome = $_POST['nome_cliente'];
	$sobrenome = $_POST['sobrenome_cliente'];
	$nascimento = $_POST['nascimento_cliente'];
	$sexo = $_POST['sexo_cliente'];
	$cpf = $_POST['cpf_cliente'];
	$telefone = $_POST['telefone_cliente'];
	$email = $_POST['email_cliente'];
	$senha = $_POST['senha_cliente'];

	$arrayCheck = array($nome, $sobrenome, $nascimento, $sexo, $cpf, $telefone, $email, $senha);
	foreach ($arrayCheck as $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ // validacao de email
		echo "email_invalido";
		exit;
	}

	if(!$auth->validaCPF($cpf)){ // valida cpf
		echo "cpf_invalido";
		exit;
	}

	if(!$auth->checkEmail($cpf)){
		if(!$auth->checkEmail($email)){
			$cadastro = $auth->registrarCliente($nome, $sobrenome, $nascimento, $sexo, $cpf, $telefone, $email, $senha);
		}else{
			echo "email_cadastrado";
			exit;
		}
	}else{
		echo "cpf_cadastrado";
		exit;
	}

	if($cadastro === true){
		$auth->login($email, $senha);
		echo "ok";
		exit;
	}else{
		echo "Ocorreu um erro ao se cadastrar. Tente novamente mais tarde.";
		exit;
	}
}

/*
███████╗███╗   ███╗██████╗ ██████╗ ███████╗███████╗ █████╗ 
██╔════╝████╗ ████║██╔══██╗██╔══██╗██╔════╝██╔════╝██╔══██╗
█████╗  ██╔████╔██║██████╔╝██████╔╝█████╗  ███████╗███████║
██╔══╝  ██║╚██╔╝██║██╔═══╝ ██╔══██╗██╔══╝  ╚════██║██╔══██║
███████╗██║ ╚═╝ ██║██║     ██║  ██║███████╗███████║██║  ██║
╚══════╝╚═╝     ╚═╝╚═╝     ╚═╝  ╚═╝╚══════╝╚══════╝╚═╝  ╚═╝

*/

if(isset($_GET['registro_empresa'])){

	$nome = (isset($_POST['nome_empresa'])) 		? $_POST['nome_empresa'] 		: "";
	$pais = (isset($_POST['pais_empresa'])) 		? $_POST['pais_empresa'] 		: "";
	$gestor = (isset($_POST['gestor_empresa'])) 	? $_POST['gestor_empresa'] 		: "";
	$cnpj = (isset($_POST['cnpj_empresa'])) 		? $_POST['cnpj_empresa'] 		: "";
	$telefone = (isset($_POST['telefone_empresa'])) ? $_POST['telefone_empresa'] 	: "";
	$email = (isset($_POST['email_empresa'])) 		? $_POST['email_empresa'] 		: "";
	$senha = (isset($_POST['senha_empresa'])) 		? $_POST['senha_empresa'] 		: "";

	$arrayCheck = array($nome, $pais, $gestor, $cnpj, $telefone, $email, $senha);
	foreach ($arrayCheck as $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ // validacao de email
		echo "email_invalido";
		exit;
	}

	if(!$auth->validaCNPJ($cnpj)){ // valida cpf
		echo "cnpj_invalido";
		exit;
	}

	if(!$auth->checkEmail($cnpj)){
		if(!$auth->checkEmail($email)){
			$cadastro = $auth->registrarEmpresa($nome, $pais, $gestor, $cnpj, $telefone, $email, $senha);
		}else{
			echo "email_cadastrado";
			exit;
		}
	}else{
		echo "cnpj_cadastrado";
		exit;
	}

	if($cadastro === true){
		$auth->login($email, $senha);
		echo "ok";
		exit;
	}else{
		echo "Ocorreu um erro ao se cadastrar. Tente novamente mais tarde.";
		echo $cadastro;
		exit;
	}
}

/*
 █████╗  ██████╗ ███████╗███╗   ██╗████████╗███████╗
██╔══██╗██╔════╝ ██╔════╝████╗  ██║╚══██╔══╝██╔════╝
███████║██║  ███╗█████╗  ██╔██╗ ██║   ██║   █████╗  
██╔══██║██║   ██║██╔══╝  ██║╚██╗██║   ██║   ██╔══╝  
██║  ██║╚██████╔╝███████╗██║ ╚████║   ██║   ███████╗
╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
                                                                
*/

if(isset($_GET['registro_agente'])){

	$nome 		= (isset($_POST['nome_agente'])) 		? $_POST['nome_agente'] 		: "";
	$sobrenome 	= (isset($_POST['sobrenome_agente'])) 	? $_POST['sobrenome_agente'] 	: "";
	$telefone 	= (isset($_POST['telefone_agente'])) 	? $_POST['telefone_agente'] 	: "";
	$cpf 		= (isset($_POST['cpf_agente'])) 		? $_POST['cpf_agente'] 			: "";

	$banco 				= (isset($_POST['banco_agente'])) 		? $_POST['banco_agente'] 		: "";
	$agencia 			= (isset($_POST['agencia_agente'])) 	? $_POST['agencia_agente'] 		: "";
	$n_conta_agente 	= (isset($_POST['n_conta_agente'])) 	? $_POST['n_conta_agente'] 		: "";
	$tipo_conta_agente 	= (isset($_POST['tipo_conta_agente'])) 	? $_POST['tipo_conta_agente'] 	: "";

	$email = (isset($_POST['email_agente'])) ? $_POST['email_agente'] : "";
	$senha = (isset($_POST['senha_agente'])) ? $_POST['senha_agente'] : "";

	$arrayCheck = array($nome, $sobrenome, $cpf, $banco, $agencia, $n_conta_agente, $tipo_conta_agente, $email, $senha);
	foreach ($arrayCheck as $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ // validacao de email
		echo "email_invalido";
		exit;
	}

	if(!$auth->validaCPF($cpf)){ // valida cpf
		echo "cpf_invalido";
		exit;
	}

	if(!$auth->checkEmail($cpf)){
		if(!$auth->checkEmail($email)){
			$cadastro = $auth->registrarAgente($nome, $sobrenome, $cpf, $agencia, $banco, $tipo_conta_agente, $n_conta_agente, $telefone, $email, $senha);
		}else{
			echo "email_cadastrado";
			exit;
		}
	}else{
		echo "cpf_cadastrado";
		exit;
	}

	if($cadastro === true){
		$auth->login($email, $senha);
		echo "ok";
		exit;
	}else{
		echo "Ocorreu um erro ao se cadastrar. Tente novamente mais tarde.";
		exit;
	}
}

/*
████████╗ █████╗ ██╗  ██╗██╗ █████╗ ███████╗██████╗ ███████╗ ██████╗ 
╚══██╔══╝██╔══██╗╚██╗██╔╝██║██╔══██╗██╔════╝██╔══██╗██╔════╝██╔═══██╗
   ██║   ███████║ ╚███╔╝ ██║███████║█████╗  ██████╔╝█████╗  ██║   ██║
   ██║   ██╔══██║ ██╔██╗ ██║██╔══██║██╔══╝  ██╔══██╗██╔══╝  ██║   ██║
   ██║   ██║  ██║██╔╝ ██╗██║██║  ██║███████╗██║  ██║███████╗╚██████╔╝
   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝ ╚═════╝ 
                                                                                                             
*/
if(isset($_GET['registro_taxiaereo'])){

	$nome 		= (isset($_POST['nome_empresa_taxiaereo'])) 		? $_POST['nome_empresa_taxiaereo'] 		: "";

	$gestor 	= (isset($_POST['gestor_taxiaereo'])) 		? $_POST['gestor_taxiaereo'] 	: "";
	$telefone 	= (isset($_POST['telefone_taxiaereo'])) 	? $_POST['telefone_taxiaereo'] 	: "";
	$cnpj 		= (isset($_POST['cnpj_taxiaereo'])) 		? $_POST['cnpj_taxiaereo'] 		: "";

	$email = (isset($_POST['email_taxiaereo'])) ? $_POST['email_taxiaereo'] : "";
	$senha = (isset($_POST['senha_taxiaereo'])) ? $_POST['senha_taxiaereo'] : "";

	$arrayCheck = array($nome, $gestor, $telefone, $cnpj, $email, $senha);
	foreach ($arrayCheck as $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ // validacao de email
		echo "email_invalido";
		exit;
	}

	if(!$auth->validaCNPJ($cnpj)){ // valida cnpj
		echo "cnpj_invalido";
		exit;
	}

	if(!$auth->checkEmail($cnpj)){
		if(!$auth->checkEmail($email)){
			$cadastro = $auth->registrarTaxiaereo($nome, $gestor, $cnpj, $telefone, $email, $senha);
		}else{
			echo "email_cadastrado";
			exit;
		}
	}else{
		echo "cnpj_cadastrado";
		exit;
	}

	if($cadastro === true){
		$auth->login($email, $senha);
		echo "ok";
		exit;
	}else{
		echo "Ocorreu um erro ao se cadastrar. Tente novamente mais tarde.";
		exit;
	}
}

/*
██╗███╗   ██╗███████╗ ██████╗ ███████╗     █████╗ ██████╗ ██╗ ██████╗██╗ ██████╗ ███╗   ██╗ █████╗ ██╗███████╗
██║████╗  ██║██╔════╝██╔═══██╗██╔════╝    ██╔══██╗██╔══██╗██║██╔════╝██║██╔═══██╗████╗  ██║██╔══██╗██║██╔════╝
██║██╔██╗ ██║█████╗  ██║   ██║███████╗    ███████║██║  ██║██║██║     ██║██║   ██║██╔██╗ ██║███████║██║███████╗
██║██║╚██╗██║██╔══╝  ██║   ██║╚════██║    ██╔══██║██║  ██║██║██║     ██║██║   ██║██║╚██╗██║██╔══██║██║╚════██║
██║██║ ╚████║██║     ╚██████╔╝███████║    ██║  ██║██████╔╝██║╚██████╗██║╚██████╔╝██║ ╚████║██║  ██║██║███████║
╚═╝╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚══════╝    ╚═╝  ╚═╝╚═════╝ ╚═╝ ╚═════╝╚═╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝╚══════╝
                                                                                                                                                                                                          
*/

if(isset($_GET['infos_adicionais_taxiaereo'])){

	$cheta		= (isset($_POST['taxiaereo_cheta'])) 	? $_POST['taxiaereo_cheta'] 	: "";
	$cep 		= (isset($_POST['taxiaereo_cep'])) 		? $_POST['taxiaereo_cep'] 		: "";
	$bairro		= (isset($_POST['taxiaereo_bairro']))	? $_POST['taxiaereo_bairro'] 	: "";
	$rua		= (isset($_POST['taxiaereo_rua'])) 		? $_POST['taxiaereo_rua'] 		: "";
	$cidade		= (isset($_POST['taxiaereo_cidade']))	? $_POST['taxiaereo_cidade'] 	: "";
	$estado		= (isset($_POST['taxiaereo_estado']))	? $_POST['taxiaereo_estado'] 	: "";
	$numero 	= (isset($_POST['taxiaereo_numero'])) 	? $_POST['taxiaereo_numero'] 	: "";

	$descricao 	= (isset($_POST['taxiaereo_descricao'])) 			? $_POST['taxiaereo_descricao'] 		: "";
	$metodos	= (isset($_POST['taxiaereo_metodo_pagamento'])) 	? $_POST['taxiaereo_metodo_pagamento'] 	: "";

	$arrayCheck = array($cheta, $cep, $estado, $cidade, $bairro, $rua, $numero, $metodos, $descricao);
	foreach ($arrayCheck as $key => $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	if($auth->loginValido()){
		$email_logado = (isset($_SESSION['user_email'])) ? $_SESSION['user_email'] : $_COOKIE['user_email'];
		$id_logado = $auth->pegaID($email_logado);
		$atualiza = $auth->atualizaInformacoesAdicionais($id_logado, $cheta, $cep, $estado, $cidade, $bairro, $rua, $numero, $metodos, $descricao);

		if($atualiza === true){
			echo "ok";
		}else{
			echo "erro: $atualiza";
		}

	}else{
		echo "nao_logado";
	}

}

/*
 █████╗ ██████╗ ██████╗      █████╗ ███████╗██████╗  ██████╗ ███╗   ██╗ █████╗ ██╗   ██╗███████╗
██╔══██╗██╔══██╗██╔══██╗    ██╔══██╗██╔════╝██╔══██╗██╔═══██╗████╗  ██║██╔══██╗██║   ██║██╔════╝
███████║██║  ██║██║  ██║    ███████║█████╗  ██████╔╝██║   ██║██╔██╗ ██║███████║██║   ██║█████╗  
██╔══██║██║  ██║██║  ██║    ██╔══██║██╔══╝  ██╔══██╗██║   ██║██║╚██╗██║██╔══██║╚██╗ ██╔╝██╔══╝  
██║  ██║██████╔╝██████╔╝    ██║  ██║███████╗██║  ██║╚██████╔╝██║ ╚████║██║  ██║ ╚████╔╝ ███████╗
╚═╝  ╚═╝╚═════╝ ╚═════╝     ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═╝  ╚═══╝  ╚══════╝
                                                                                                                                                                                                                                                                      
*/

if(isset($_GET['add-imagem'])){
	$pasta = "arquivo/";
    $nome_imagem    = $_FILES['add-img-aeronave']['name'];
    $tamanho_imagem = $_FILES['add-img-aeronave']['size'];
        
    $ext = strtolower(strrchr($nome_imagem,"."));
            
    $tamanho = round($tamanho_imagem / 1024);

    $nome_atual = rand(0, 99).time().rand(0, 9999).$ext;
    $tmp = $_FILES['add-img-aeronave']['tmp_name'];
                
    if(move_uploaded_file($tmp, $pasta.$nome_atual)){
        echo $nome_atual;
        exit();
    }else{
        echo "falha";
    }
}

if(isset($_GET['adicionar_aeronave'])){

	$id_usuario = $id_logado;

	$fabricante 		= (isset($_POST['aeronave_fabricante'])) 		? $_POST['aeronave_fabricante'] 		: "";
	$modelo 			= (isset($_POST['aeronave_modelo'])) 			? $_POST['aeronave_modelo'] 			: "";
	$categoria 			= (isset($_POST['aeronave_categoria'])) 		? $_POST['aeronave_categoria'] 			: "";
	$ano 				= (isset($_POST['aeronave_ano'])) 				? $_POST['aeronave_ano'] 				: "";
	$prefixo 			= (isset($_POST['aeronave_prefixo'])) 			? $_POST['aeronave_prefixo'] 			: "";
	$passageiros 		= (isset($_POST['aeronave_passageiros'])) 		? $_POST['aeronave_passageiros'] 		: "";
	$peso_bagagem 		= (isset($_POST['aeronave_peso_bagagem'])) 		? $_POST['aeronave_peso_bagagem'] 		: "";
	$velocidade 		= (isset($_POST['aeronave_velocidade'])) 		? $_POST['aeronave_velocidade'] 		: "";
	$autonomia 			= (isset($_POST['aeronave_autonomia'])) 		? $_POST['aeronave_autonomia'] 			: "";
	$operacao 			= (isset($_POST['aeronave_operacao'])) 			? $_POST['aeronave_operacao'] 			: "";
	$valor 				= (isset($_POST['aeronave_valor'])) 			? $utilitarios->vfloat($_POST['aeronave_valor'])				: "";
	$valor_pernoite 	= (isset($_POST['aeronave_valor_pernoite'])) 	? $utilitarios->vfloat($_POST['aeronave_valor_pernoite'])   	: "";
	$banheiro 			= (isset($_POST['aeronave_banheiro'])) 			? $_POST['aeronave_banheiro'] 			: "";
	$servico_bordo 		= (isset($_POST['aeronave_servico_bordo'])) 	? $_POST['aeronave_servico_bordo'] 		: "";
	$base_operacao 		= (isset($_POST['aeronave_base_operacao'])) 	? utf8_encode($_POST['aeronave_base_operacao']) 		: "";
	$base_operacao_lat 	= (isset($_POST['aeronave_base_operacao_lat'])) ? $_POST['aeronave_base_operacao_lat'] 	: "";
	$base_operacao_lng 	= (isset($_POST['aeronave_base_operacao_lng'])) ? $_POST['aeronave_base_operacao_lng'] 	: "";
	$tipo_servicos 		= (isset($_POST['aeronave_tipo_servicos'])) 	? utf8_encode($_POST['aeronave_tipo_servicos']) 	: "";
	$visao_geral	 	= (isset($_POST['aeronave_visao_geral'])) 		? utf8_encode($_POST['aeronave_visao_geral']) 		: "";
	$img1 				= (isset($_POST['img1'])) ? $_POST['img1'] : "";
	$img2 				= (isset($_POST['img2'])) ? $_POST['img2'] : "";
	$img3 				= (isset($_POST['img3'])) ? $_POST['img3'] : "";
	$img4 				= (isset($_POST['img4'])) ? $_POST['img4'] : "";

	$arrayCheck = array($fabricante, $modelo, $categoria, $prefixo, $passageiros, $peso_bagagem, $velocidade, $autonomia, $valor, $valor_pernoite, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servicos, $img1, $img2);

	foreach ($arrayCheck as $campo){ // verifica campos obrigatorios
		if($campo == ""){
			echo "campo_faltando";
			exit;
		}
	}

	$json_array = array(
		'imagem1' => $img1,
		'imagem2' => $img2,
		'imagem3' => $img3,
		'imagem4' => $img4 
	);

	$imagens = json_encode($json_array, JSON_PRETTY_PRINT);
	
	$adicionar = $aeronave->adicionarAeronave($id_usuario, $fabricante, $modelo, $categoria, $prefixo, $ano, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servicos, $valor, $valor_pernoite, $banheiro, $servico_bordo, $imagens, $visao_geral);

	if($adicionar === true){
		echo "ok";
		exit;
	}else{
		echo $adicionar;
		exit;
	}
}

if(isset($_GET['login'])){
	$email = (isset($_POST['email'])) ? $_POST['email'] : "";
	$senha = (isset($_POST['senha'])) ? $_POST['senha'] : "";

	$login = $auth->login($email, $senha);
	if($login === true){
		echo "ok";
	}else{
		echo $login;
	}
}

#Lista os modelos em forma de string separados por |
if(isset($_GET['pega_modelos'])){
	$fabricante = $_GET['fabricante'];
	$listaModelos = $modelo->listaModelos($fabricante);

	$string = "";
	foreach($listaModelos as $dado):
		$string .= $dado['modelo']."|";
	endforeach;

	echo rtrim($string, "|");
}

/*
██████╗ ██╗   ██╗███████╗ ██████╗ █████╗ 
██╔══██╗██║   ██║██╔════╝██╔════╝██╔══██╗
██████╔╝██║   ██║███████╗██║     ███████║
██╔══██╗██║   ██║╚════██║██║     ██╔══██║
██████╔╝╚██████╔╝███████║╚██████╗██║  ██║
╚═════╝  ╚═════╝ ╚══════╝ ╚═════╝╚═╝  ╚═╝                                       
*/

if(isset($_GET['busca_aeronaves'])){
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$lat_destino = $_POST['lat_destino'];
	$lng_destino = $_POST['lng_destino'];
	$pagina = $_POST['pagina'];
	$cidade = $_POST['cidade'];
	$parametros = $_POST['parametros'];
	$passageiros = $_POST['passageiros'];
	// $parametros = json_decode($parametros);
	// $parametros = json_encode($parametros, JSON_PRETTY_PRINT);

	//echo "<pre style='font-size:15px'>";
	// print_r($parametros);
	//echo $passageiros;
	//exit;
	
	$ordenar = ($_POST['ordenar']) ? $_POST['ordenar'] : "distance";
 	$busca = $_SESSION['busca'];

 	$dados_busca = json_decode($busca);
	
	//array que retorna a busca das aeronaves
 	$resultado = $aeronave->buscaAeronaves($lat, $lng, $lat_destino, $lng_destino, $dados_busca->cat_aeronave[0], $pagina, $ordenar, $parametros, $passageiros);
	
 	echo '<script>$(".carregando_aeronaves").hide();</script>';

 	$menor_preco_id = $aeronave->menorPrecoID($lat, $lng);
 	if($resultado === false){
 		echo "<div style='font-size:15px; color:rgba(0,0,0,0.4); padding:10px;'><center>Nenhuma aeronave encontrada :(</center></div>";
 		exit;
 	}

 	if(!is_array($resultado)){
 		echo $resultado;
 		exit;
 	}

 	$total_locais = count($dados_busca->origem_local_lat);
 	$distancia = 0;


 	for ($i=0; $i<$total_locais; $i++){
 		$atual = $i;
		$distancia += $aeronave->haversine(
			$dados_busca->origem_local_lat[$atual],
			$dados_busca->origem_local_lng[$atual],
			$dados_busca->destino_local_lat[$atual],
			$dados_busca->destino_local_lng[$atual]
		);
 	}

 	// $distancia_total = $dados_busca->destino_local_lng[0];
 	//Listagem das aeronaves na menor distância
	foreach($resultado as $info):
	
		if($cidade != $info['base_operacao']){
 			$cidade = utf8_decode($cidade);
 			$cidade = explode(" - ", $cidade);
 			$cidade = utf8_encode(strtolower($cidade[0]));
			
			$base_operacao_lat = $info['latitude'];
			$base_operacao_lng = $info['longitude'];
			
			$distancia_base_origem = $aeronave->haversine(
				$base_operacao_lat,
				$base_operacao_lng,
				$dados_busca->origem_local_lat[$atual],
				$dados_busca->origem_local_lng[$atual]
			);
 			$proxima_da_cidade = "<span style='color:red; font-size:10px;'>Próximo de $cidade</span>";
 		}else{
 			$proxima_da_cidade = "";
			$distancia_base_origem = 0;
 		}

 		$distancia_total = (($distancia + $distancia_base_origem)* 2) / $info['velocidade'];

 		$preco = $distancia_total * $info['valor'];
		$preco = number_format($preco, 2 ,",", ".");
 		$imagens = json_decode($info['imagens']);

 		$url_aeronave = $info['id'].'/';

 		$nome_cidade = explode(" - ", $info['base_operacao']);
 		$nome_cidade = utf8_encode(strtolower($nome_cidade[0]));

 		if($auth->loginValido()){
 			$link_aeronave = $root_site."/aeronave/".$url_aeronave;
 			$target = 'target="_blank"';
 			$classe_link = "abrir-pagina-cotacao";
 		}else{
 			$link_aeronave = "javascript:abrirModal('#login_modal');";
 			$target = '';
 			$classe_link = "";
 		}
		
		$img1 = (($imagens->imagem1) != "") ? '<li><img src="'.$root_site.'/arquivo/'.$imagens->imagem1.'" width="100%" height="250px"></li>' : '';
		$img2 = (($imagens->imagem2) != "") ? '<li><img src="'.$root_site.'/arquivo/'.$imagens->imagem2.'" width="100%" height="250px"></li>' : '';
		$img3 = (($imagens->imagem3) != "") ? '<li><img src="'.$root_site.'/arquivo/'.$imagens->imagem3.'" width="100%" height="250px"></li>' : '';
		$img4 = (($imagens->imagem4) != "") ? '<li><img src="'.$root_site.'/arquivo/'.$imagens->imagem4.'" width="100%" height="250px"></li>' : '';

	echo '
	<div class="aeronave">
		<form class="dados-aeronave">
			<input type="hidden" class="nome-aeronave" value="'.$info['fabricante'].' - '.$info['modelo'].'">
			<input type="hidden" class="cidade-aeronave" value="'.$info['base_operacao'].'">
			<input type="hidden" class="velocidade-cruzeiro" value="'.$info['velocidade'].'km/h">
			<input type="hidden" class="preco-aeronave" value="'.number_format($info['valor'],2,",",".").'">
		</form>
		<div class="aeronave-esquerda">
			<div class="aeronave-slide">
				<ul class="slide-resultado" id="aerobusca-slide-'.$info['id'].'">
					'.$img1.'
					'.$img2.'
					'.$img3.'
					'.$img4.'
				</ul>
			</div>
		</div>
		<div class="aeronave-direita">
			<div class="aeronave-nome-cidade" data-base="'.$nome_cidade.'">'.$info['base_operacao'].' '.$proxima_da_cidade.'</div>
			<div class="aeronave-nome">
				<h3>'.$info['fabricante'].' - '.$info['modelo'].'</h3>
				<span>Velocidade cruzeiro de '.$info['velocidade'].'km/h</span>
			</div>
			<div class="aeronave-estrelas">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</div>
			<div class="aeronave-especificacoes">
				<div class="aeronave-especificacoes-esquerda">
					<div class="aeronave-tipo">'.$info['categoria'].'</div>
					<div class="aeronave-especificacao-img">
						<img src="'.$root_site.'/img/aeronave.png" alt="Jatto Leve">
					</div>
					<span class="aeronave-especificacao">'.$aeronave->contaAeronavesPorCategoria($info['categoria']).' aeronaves</span>
				</div>
				<div class="aeronave-especificacoes-meio">
					<div class="aeronave-capacidade">Capacidade</div>
						<div class="aeronave-especificacao-img">
							<img src="'.$root_site.'/img/passageiros.png" alt="Passageiros">
						</div>
						<span class="aeronave-especificacao">Até '.$info['passageiros'].' pax</span>
					</div>
					<div class="aeronave-especificacoes-direita">
						<div class="aeronave-autonomia">Autonomia</div>
						<div class="aeronave-especificacao-img">
							<img src="'.$root_site.'/img/autonomia.png" alt="Autonomia">
						</div>
						<span class="aeronave-especificacao">'.$aeronave->tempoAutonomia($info['autonomia']).'</span>
					</div>
				</div>

				<div class="aeronave-preco">
					<div class="aeronave-preco-esquerda">
						<div class="aeronave-preco-valor-destaque"></div>
						'.number_format(($distancia + $distancia_base_origem),2,",",".").' Km<br>
						<span class="aeronave-preco-valor">'.$preco.'</span>
					</div>
					<div class="aeronave-preco-direita">
						<a href="'.$link_aeronave.'" class="'.$classe_link.'" '.$target.'>Fazer Cotação</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	slide_'.$info['id'].' = $("#aerobusca-slide-'.$info['id'].'").bxSlider({
    	mode: "horizontal",
    	auto: false,
    	nextText: "<i class=\"fa fa-angle-right\"></i>",
    	prevText: "<i class=\"fa fa-angle-left\"></i>"
    });

    // slide_'.$info['id'].'.reloadSlider();
	</script>';
endforeach;

}	


if(isset($_GET['add_cotacao'])){

	if($cotacao->contaCarrinho($token) <= 3){

		$id_aeronave = $_POST['id_aeronave'];
		$busca = $_SESSION['busca'];
		$dados_busca = json_decode($busca);
		$dados_aeronave = $aeronave->dadosAeronave($id_aeronave);

		$total_locais = count($dados_busca->origem_local_lat);
		$distancia = 0;
		for ($i=0; $i<$total_locais; $i++){
		 	$atual = $i;
			$distancia += $aeronave->haversine(
				$dados_busca->origem_local_lat[$atual],
				$dados_busca->origem_local_lng[$atual],
				$dados_busca->destino_local_lat[$atual],
				$dados_busca->destino_local_lng[$atual]
			);
		}

		$distancia_total = ($distancia * 2) / $dados_aeronave['velocidade'];

		$tempo_estimado_ida = $aeronave->tempoAutonomia($distancia / $dados_aeronave['velocidade']);
		$tempo_estimado_total = $aeronave->tempoAutonomia(($distancia * 2) / $dados_aeronave['velocidade']);

		$valor = $distancia_total * $dados_aeronave['valor'];

		$valor_pernoite = $dados_aeronave['valor_pernoite'];

		$valor = number_format($valor, 2, ".", "");
		$distancia = number_format($distancia, 2, ".", "");

		$id_taxiaereo = $dados_aeronave['id_usuario'];

		$add_carrinho = $cotacao->addAeronaveCarrinho($id_logado, $id_aeronave, $id_taxiaereo, $token, $busca, $valor, $valor_pernoite, $tempo_estimado_ida, $tempo_estimado_total, $distancia);

		if($add_carrinho === true){
			echo "ok";
		}else{
			echo $add_carrinho;
		}
	}else{
		echo "Você só pode escolher até 3 aeronaves!";
	}
}

if(isset($_GET['dropdown_cotacoes'])){
	$dropdown = $cotacao->listaCarrinho($token);

	foreach($dropdown as $info){
		
		$info_busca = json_decode($info['localizacoes']);

		$info_aeronave = $aeronave->dadosAeronave($info['id_aeronave']);

		$info_aeronave_imagens = json_decode($info_aeronave['imagens']);


		$string_cidades = "";

		$total_locais = count($info_busca->origem);
		for ($i=0; $i<$total_locais; $i++){
			if($i == $total_locais-1){
				$string_cidades .= rtrim($info_busca->origem[$i], ", Brasil")." <i class=\"fa fa-angle-right\"></i> ".rtrim($info_busca->destino[$i], ", Brasil");
			}else{
		 		$string_cidades .= rtrim($info_busca->origem[$i], ", Brasil")." <i class=\"fa fa-angle-right\"></i> ".rtrim($info_busca->destino[$i], ", Brasil")." <i class=\"fa fa-angle-right\"></i> ";
		 	}
		}

	?>
		<div class="submenu-cotacao" id="cotacao-id-<?= $info['id']; ?>"><!-- uma cotacao -->
			<a href="#" class="submenu-aeronave-link fade"> <!-- link para aeronave -->
				<span class="submenu-excluir-cotacao fa fa-times" title="Excluir cotação" onclick="removerCotacao(<?= $info['id']; ?>)"></span>
				<div class="submenu-cotacao-img">
					<img src="<?= $root_site; ?>/arquivo/<?= $info_aeronave_imagens->imagem1; ?>">
				</div>
			<div class="submenu-cotacao-infos">
				<div class="submenu-cotacao-titulo-aeronave"><?= $info_aeronave['modelo']; ?></div>
				<div class="submenu-cotacao-velocidade-cruzeiro"><?= $string_cidades; ?></div>
				<table>
					<tr>
						<td><?= $info_aeronave['categoria']; ?></td>
						<td><?= $info_aeronave['passageiros']; ?> pax</td>
						<td><?= $aeronave->tempoAutonomia($info_aeronave['autonomia']); ?></td>
					</tr>
					<tr>
						<td><img src="<?= $root_site; ?>/img/aeronave.png"></td>
						<td><img src="<?= $root_site; ?>/img/passageiros.png"></td>
						<td><img src="<?= $root_site; ?>/img/autonomia.png"></td>
					</tr>
				</table>
			</div>
		</a>
	</div> <!-- fim uma cotacao -->

<?php
	}
}

if(isset($_GET['remove_cotacao'])){
	$id = $_POST['id_cotacao'];

	$remove = $cotacao->removeItemCarrinho($id);
	if($remove === true){
		echo "ok";
	}else{
		echo "Erro ao remover esta cotação.";
	}
}


if(isset($_GET['info_token'])):
	$token = $_POST['token'];

	$listaCotacaoToken = $cotacao->listaCotacao($token);
	foreach($listaCotacaoToken as $dadosCotacaoToken):
		$dadosTaxiAereo = $auth->dadosUsuario($dadosCotacaoToken['id_taxiaereo']);
		$dadosAeronave  = $aeronave->dadosAeronave($dadosCotacaoToken['id_aeronave']);
		
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
				<a href="javascript:void(0);" class="ver-detalhe-cotacao btn-dados cinza">Ver</a>
				<a href="#" data-status-dados="negado" data-id-cotacao="<?= $dadosCotacaoToken['id']; ?>" class="btn-dados vermelho">Negar</a>
			</li>
		</ul>
		<div class="detalhe_cotacao">
			<strong>Trecho:</strong> <?= $string_cidades; ?><br>
			<strong>Data/Hora <sup>ida</sup>: </strong> <?= $data_ida; ?> as <?= $hora_ida;?>Hrs<br>
			<strong>Data/Hora <sup>volta</sup>: </strong> <?= $data_volta; ?> as <?= $hora_volta; ?>Hrs<br>
			<strong>Categoria do Vôo: </strong> <?= strtoupper($dadosCotacaoToken['categoria_voo']); ?><br>
			<strong>Quant. de Passageiros: </strong> <?= $passageiros; ?><br>
			<strong>Pernoite: </strong> <?= ($dadosCotacaoToken['dias_pernoite'] <= 3) ? "SIM, quantidade de dias ".$dadosCotacaoToken['dias_pernoite'].", com o valor do pernoite R$".number_format($dadosCotacaoToken['valor_pernoite'],2,",",".") : "NÃO"; ?><br>
			

			<div class="btn-bloco">
				<a href="<?= $root_site; ?>/ver-cotacao/id/<?=$dadosCotacaoToken['id'];?>/token/<?=$dadosCotacaoToken['token'];?>" class="btn verde">ver cotação completa</a>
			</div>
		</div>
	</div>
</div>
<?php
	endforeach;
endif;
?>
<?php

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