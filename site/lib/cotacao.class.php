<?php
class Cotacao extends Aeronave{

	private	$conexao;
	private $tabela_cotacao;
	private $tabela_carrinho;


	public function __construct($conexao, $tabela_cotacao, $tabela_carrinho){
		$this->conexao = $conexao;
		$this->tabela_cotacao = $tabela_cotacao;
		$this->tabela_carrinho = $tabela_carrinho;
	}

	public function verificaToken($token){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_carrinho WHERE token = '$token'");
		$select->execute();

		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function verificaTokenStatus($token){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_carrinho WHERE token = '$token' AND status = 'fechado'");
		$select->execute();

		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function verificaTokenUsuario($id_usuario, $token){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_carrinho WHERE token = '$token' AND id_usuario = '$id_usuario'");
		$select->execute();

		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Pega um token que está ativo na tabela carrinho, caso não exista nenhum ativo um novo token é gerado 
	 */
	public function pegaTokenUsuario($id_usuario){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_carrinho WHERE id_usuario = '$id_usuario' AND status = 'aberto'");
		$select->execute();

		if($select->rowCount() > 0){

			$dados = $select->fetchAll();

			return $dados[0]['token'];
		}else{

			$length = 6;
    		$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    		$string = "";

		    for ($p = 0; $p < $length; $p++) {
		        @$string .= $characters[mt_rand(0, strlen($characters))];
		    }

			return strtoupper($string);
		}
	}

	// adiciona produto no carrinho
	public function addAeronaveCarrinho($id_usuario, $id_aeronave, $id_taxiaereo, $token, $localizacoes, $valor, $valor_pernoite, $tempo_estimado_ida, $tempo_estimado_total, $distancia_total){

		$dados_localizacoes = json_decode($localizacoes);

		$categoria_voo = $dados_localizacoes->cat_voo;

		$total_locais = count($dados_localizacoes->origem_local_lat);

		$primeira_data = $dados_localizacoes->data_ida[0];
		$ultima_data = $dados_localizacoes->data_volta[count($dados_localizacoes->data_volta) - 1];

		$p_data = explode("/", $primeira_data);
		$u_data = explode("/", $ultima_data);

		$data1 = $p_data[2]."-".$p_data[1]."-".$p_data[0];
		@$data2 = $u_data[2]."-".$u_data[1]."-".$u_data[0];

		$diff = abs(strtotime($data2) - strtotime($data1));

		$anos = floor($diff / (365*60*60*24));
		$meses = floor(($diff - $anos * 365*60*60*24) / (30*60*60*24));
		$dias_pernoite = floor(($diff - $anos * 365*60*60*24 - $meses*30*60*60*24)/ (60*60*24));

		if($dias_pernoite <= 3){
			$valor_pernoite = $valor_pernoite * $dias_pernoite;
			$valor_pernoite = number_format($valor_pernoite, 2, ".", "");
		}else{
			$dias_pernoite = 0;
			$valor_pernoite = 0;
		}


		$timestamp = time();
	



		$insert = $this->conexao->prepare("
		INSERT INTO $this->tabela_carrinho(
			id_usuario,
			id_aeronave,
			id_taxiaereo,
			token,
			localizacoes,
			dias_pernoite,
			valor_pernoite,
			distancia_total,
			tempo_estimado_ida,
			tempo_estimado_total,
			categoria_voo,
			valor,
			data
		) VALUES (
			:id_usuario,
			:id_aeronave,
			:id_taxiaereo,
			:token,
			:localizacoes,
			:dias_pernoite,
			:valor_pernoite,
			:distancia_total,
			:tempo_estimado_ida,
			:tempo_estimado_total,
			:categoria_voo,
			:valor,
			:data
		)");
		$insert->bindValue(':id_usuario', 	$id_usuario);
		$insert->bindValue(':id_aeronave', 	$id_aeronave);
		$insert->bindValue(':id_taxiaereo', $id_taxiaereo);
		$insert->bindValue(':token', 		$token);
		$insert->bindValue(':localizacoes', $localizacoes);
		$insert->bindValue('dias_pernoite', 		$dias_pernoite);
		$insert->bindValue('valor_pernoite', 		$valor_pernoite);
		$insert->bindValue('distancia_total', 		$distancia_total);
		$insert->bindValue('tempo_estimado_ida', 	$tempo_estimado_ida);
		$insert->bindValue('tempo_estimado_total', 	$tempo_estimado_total);
		$insert->bindValue('categoria_voo', 	$categoria_voo);
		$insert->bindValue(':valor', 			$valor);
		$insert->bindValue(':data', 			$timestamp);

		if($insert->execute()){

			if($insert->rowCount() > 0){
				return true;
			}else{
				return $insert->errorInfo()[2];
			}

		}else{
			return $insert->errorInfo()[2];
		}

	}

	public function listaCarrinho($token){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_carrinho WHERE token = '$token'");
		$select->execute();

		if($select->rowCount() > 0){
			return $select->fetchAll();
		}else{
			return false;
		}
	}

	public function contaCarrinho($token){
		$qtd = $this->listaCarrinho($token);
		if($qtd != false){
			return count($qtd);
		}else{
			return 0;
		}
	}

	public function fechaItemCarrinho($id){
		$update = $this->conexao->prepare("UPDATE $this->tabela_carrinho SET status='fechado' WHERE id = $id");
		if($update->execute()){
			return true;
		}
	}

	public function criarCotacao($token){
		$cotacoes = $this->listaCarrinho($token);

		foreach($cotacoes as $cotacao){
			
			$id_carrinho = $cotacao['id'];
			$id_usuario = $cotacao['id_usuario'];
			$id_aeronave = $cotacao['id_aeronave'];
			$id_taxiaereo = $cotacao['id_taxiaereo'];
			$token = $cotacao['token'];
			$localizacoes = $cotacao['localizacoes'];
			$dias_pernoite = $cotacao['dias_pernoite'];
			$valor_pernoite = $cotacao['valor_pernoite'];
			$tempo_estimado_ida = $cotacao['tempo_estimado_ida'];
			$tempo_estimado_total = $cotacao['tempo_estimado_total'];
			$categoria_voo = $cotacao['categoria_voo'];
			$valor = $cotacao['valor'];
			$distancia_total = $cotacao['distancia_total'];

			$descricao = ""; //nao decidido ainda
			$meio_pagamento = ""; //sera escolhido depois

			$status_cotacao = "pendente";
			$status_envio = "pendente";

			$timestamp = time();


			$insert = $this->conexao->prepare("
			INSERT INTO $this->tabela_cotacao(
				token,
				id_cliente,
				id_taxiaereo,
				id_aeronave,
				localizacoes,
				categoria_voo,
				dias_pernoite,
				valor_pernoite,
				tempo_estimado_ida,
				tempo_estimado_total,
				custo_estimado,
				distancia_total,
				descricao,
				meio_pagamento,
				status_cotacao,
				status_envio,
				valor,
				data_registro
			) VALUES (
				:token,
				:id_cliente,
				:id_taxiaereo,
				:id_aeronave,
				:localizacoes,
				:categoria_voo,
				:dias_pernoite,
				:valor_pernoite,
				:tempo_estimado_ida,
				:tempo_estimado_total,
				:custo_estimado,
				:distancia_total,
				:descricao,
				:meio_pagamento,
				:status_cotacao,
				:status_envio,
				:valor,
				:data_registro
			)");
				$insert->bindValue(':token', $token);
				$insert->bindValue(':id_cliente', $id_usuario);
				$insert->bindValue(':id_taxiaereo', $id_taxiaereo);
				$insert->bindValue(':id_aeronave', $id_aeronave);
				$insert->bindValue(':localizacoes', $localizacoes);
				$insert->bindValue(':categoria_voo', $categoria_voo);
				$insert->bindValue(':dias_pernoite', $dias_pernoite);
				$insert->bindValue(':valor_pernoite', $valor_pernoite);
				$insert->bindValue(':tempo_estimado_ida', $tempo_estimado_ida);
				$insert->bindValue(':tempo_estimado_total', $tempo_estimado_total);
				$insert->bindValue(':custo_estimado', $valor);
				$insert->bindValue(':distancia_total', $distancia_total);
				$insert->bindValue(':descricao', $descricao);
				$insert->bindValue(':meio_pagamento', $meio_pagamento);
				$insert->bindValue(':status_cotacao', $status_cotacao);
				$insert->bindValue(':status_envio', $status_envio);
				$insert->bindValue(':valor', $valor);
				$insert->bindValue(':data_registro', $timestamp);
				$insert->execute();
				if($insert->rowCount() > 0){
					$this->fechaItemCarrinho($id_carrinho);
				}else{
					echo $insert->errorInfo()[2];
				}

		}
			return true;
	}
	public function listarToken($id=false, $tipo_usuario, $status_envio){
		$id = intval($id);

		if($id == false){
			$select = $this->conexao->prepare("SELECT DISTINCT token FROM $this->tabela_cotacao ORDER BY data_registro DESC");
			$select->execute();
		}else{
			if($tipo_usuario == "taxiaereo"):
				$select = $this->conexao->prepare("SELECT DISTINCT token FROM $this->tabela_cotacao WHERE ((id_taxiaereo=$id) AND (status_envio='$status_envio')) ORDER BY data_registro DESC");
				$select->execute();
			elseif($tipo_usuario == "cliente"):
				$select = $this->conexao->prepare("SELECT DISTINCT token FROM $this->tabela_cotacao WHERE (id_cliente=$id) AND (status_envio='ok') AND (status_cotacao='enviado') ORDER BY data_registro DESC");
				$select->execute();
			endif;
		}
		
		if($select->rowCount() > 0){
			return $select->fetchAll();
		}else{
			return false;
		}
	}

	public function listaTokenCotacao($id_cotacao){
		$lista = $this->conexao->prepare("SELECT * FROM $this->tabela_cotacao WHERE id=$id_cotacao");
		$lista->execute();

		return $lista->fetch();
	}

	public function qtdCotacaoToken($id,$tipo_usuario,$status_envio){
		$id = intval($id);
		if($tipo_usuario == "admin"):
			$select = $this->conexao->prepare("SELECT DISTINCT token FROM $this->tabela_cotacao ORDER BY data_registro DESC");
			$select->execute();
		elseif($tipo_usuario == "taxiaereo"):
			$select = $this->conexao->prepare("SELECT DISTINCT token FROM $this->tabela_cotacao WHERE ((id_taxiaereo=$id) AND (status_envio='$status_envio')) ORDER BY data_registro DESC");
			$select->execute();
		endif;

		return $select->rowCount();

	}

	public function listaCotacao($token,$id,$tipo_usuario){
		$id = intval($id);

		if($tipo_usuario == "admin"){
			$select = $this->conexao->prepare("SELECT * FROM $this->tabela_cotacao WHERE token = '$token'");
			$select->execute();
		}elseif($tipo_usuario == "taxiaereo"){
			$select = $this->conexao->prepare("SELECT * FROM $this->tabela_cotacao WHERE token = '$token' AND id_taxiaereo = $id");
			$select->execute();
		}


		if($select->rowCount() > 0){
			return $select->fetchAll();
		}else{
			return false;
		}
	}

	public function infoToken($token){
		$select = $this->conexao->prepare("SELECT * FROM $this->tabela_cotacao WHERE token = '$token' LIMIT 1");

		$select->execute();
		if($select->rowCount() > 0){
			return $select->fetch();
		}else{
			return false;
		}
	}

	public function atualizaStatusCotacao($status, $id){
		$update = $this->conexao->prepare("UPDATE $this->tabela_cotacao SET status_cotacao = '$status' WHERE id=$id");
		if($update->execute()):
			return true;
		else:
			return false;
		endif;
	}

	public function atualizaStatusEnvio($status, $id){
		$update = $this->conexao->prepare("UPDATE $this->tabela_cotacao SET status_envio = '$status' WHERE id=$id");
		if($update->execute()):
			return true;
		else:
			return false;
		endif;
	}


}

?>