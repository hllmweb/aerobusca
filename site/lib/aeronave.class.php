<?php 

/*
*
* Aerobusca
*
*/
class Aeronave{
	private $conexao;
	private $tabela;


	public function __construct($obj_nexus, $table){
		$this->nexus = $obj_nexus;
		$this->table = $table;
	}

	#Adicionando aeronaves 
	public function adicionarAeronave($id_usuario, $fabricante, $modelo, $categoria, $prefixo, $ano, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servicos, $valor, $valor_pernoite, $banheiro, $servico_bordo, $imagens, $visao_geral){

		$id_usuario 	= intval($id_usuario);

		$fabricante 		= addslashes($fabricante);
		$modelo 			= addslashes($modelo);
		$categoria 			= addslashes($categoria);
		$prefixo 			= addslashes($prefixo);
		$ano 				= addslashes($ano);
		$passageiros 		= addslashes($passageiros);
		$peso_bagagem 		= addslashes($peso_bagagem);
		$velocidade 		= addslashes($velocidade);
		$autonomia 			= addslashes($autonomia);
		$operacao 			= addslashes($operacao);
		$base_operacao 		= addslashes($base_operacao);
		$base_operacao_lat 	= addslashes($base_operacao_lat);
		$base_operacao_lng 	= addslashes($base_operacao_lng);
		$tipo_servicos 		= addslashes($tipo_servicos);
		$valor 				= addslashes($valor);
		$valor_pernoite 	= addslashes($valor_pernoite);
		$banheiro 			= addslashes($banheiro);
		$servico_bordo 		= addslashes($servico_bordo);
		$imagens 			= $imagens; // não precisa de addslashes pois vem em formato json
		$visao_geral		= addslashes($visao_geral);

		$insert = $this->nexus->prepare("INSERT INTO $this->table (
			id_usuario,
			fabricante,
			modelo,
			categoria,
			prefixo,
			ano,
			passageiros,
			peso_bagagem,
			velocidade,
			autonomia,
			operacao,
			base_operacao,
			latitude,
			longitude,
			tipo_servicos,
			valor,
			valor_pernoite,
			banheiro,
			servico_bordo,
			imagens,
			visao_geral
		) VALUES (
			:id_usuario,
			:fabricante,
			:modelo,
			:categoria,
			:prefixo,
			:ano,
			:passageiros,
			:peso_bagagem,
			:velocidade,
			:autonomia,
			:operacao,
			:base_operacao,
			:base_operacao_lat,
			:base_operacao_lng,
			:tipo_servicos,
			:valor,
			:valor_pernoite,
			:banheiro,
			:servico_bordo,
			:imagens,
			:visao_geral
		)");

		$insert->bindValue(":id_usuario", 			$id_usuario, 		PDO::PARAM_INT);
		$insert->bindValue(":fabricante", 			$fabricante, 		PDO::PARAM_STR);
		$insert->bindValue(":modelo", 				$modelo, 			PDO::PARAM_STR);
		$insert->bindValue(":categoria", 			$categoria, 		PDO::PARAM_STR);
		$insert->bindValue(":prefixo", 				$prefixo, 			PDO::PARAM_STR);
		$insert->bindValue(":ano", 					$ano, 				PDO::PARAM_STR);
		$insert->bindValue(":passageiros", 			$passageiros, 		PDO::PARAM_STR);
		$insert->bindValue(":peso_bagagem", 		$peso_bagagem, 		PDO::PARAM_STR);
		$insert->bindValue(":velocidade", 			$velocidade, 		PDO::PARAM_STR);
		$insert->bindValue(":autonomia", 			$autonomia, 		PDO::PARAM_STR);
		$insert->bindValue(":operacao", 			$operacao, 			PDO::PARAM_STR);
		$insert->bindValue(":base_operacao", 		$base_operacao, 	PDO::PARAM_STR);
		$insert->bindValue(":base_operacao_lat", 	$base_operacao_lat, PDO::PARAM_STR);
		$insert->bindValue(":base_operacao_lng", 	$base_operacao_lng, PDO::PARAM_STR);
		$insert->bindValue(":tipo_servicos", 		$tipo_servicos,	 	PDO::PARAM_STR);
		$insert->bindValue(":valor", 				$valor, 			PDO::PARAM_STR);
		$insert->bindValue(":valor_pernoite", 		$valor_pernoite, 	PDO::PARAM_STR);
		$insert->bindValue(":banheiro", 			$banheiro, 			PDO::PARAM_STR);
		$insert->bindValue(":servico_bordo", 		$servico_bordo, 	PDO::PARAM_STR);
		$insert->bindValue(":imagens", 				$imagens, 			PDO::PARAM_STR);
		$insert->bindValue(":visao_geral", 			$visao_geral, 		PDO::PARAM_STR);

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

	public function editarAeronave($id, $id_usuario, $fabricante, $modelo, $categoria, $prefixo, $ano, $passageiros, $peso_bagagem, $velocidade, $autonomia, $operacao, $base_operacao, $base_operacao_lat, $base_operacao_lng, $tipo_servicos, $valor, $valor_pernoite, $imagens, $servico_bordo, $banheiro, $visao_geral){

		$editar = $this->nexus->prepare("UPDATE $this->table SET 
			id_usuario='$id_usuario',
			fabricante='$fabricante',
			modelo='$modelo',
			categoria='$categoria',
			prefixo='$prefixo',
			ano='$ano',
			passageiros='$passageiros',
			peso_bagagem='$peso_bagagem',
			velocidade='$velocidade',
			autonomia='$autonomia',
			operacao='$operacao',
			base_operacao='$base_operacao',
			latitude='$base_operacao_lat',
			longitude='$base_operacao_lng',
			tipo_servicos='$tipo_servicos',
			valor='$valor',
			valor_pernoite='$valor_pernoite',
			imagens='$imagens',
			servico_bordo='$servico_bordo',
			banheiro='$banheiro',
			visao_geral='$visao_geral' WHERE id=$id");

			$editar->execute();
			if($editar->rowCount() > 0){
				return true;
			}else{
				return $editar->errorInfo()[2];
			}

	}

	#Listando todas as aeronaves
	public function listaAeronaves($id, $tipo_usuario){
		if($tipo_usuario == "admin"):
			$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_usuario > 0");
			$lista->execute();
		elseif($tipo_usuario == "taxiaereo"):
			$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_usuario = $id");
			$lista->execute();
		endif;
		if($lista->rowCount() > 0):
			return $lista->fetchAll();
		else:
			return false;
		endif;
	}

	public function listaDadosAeronave($id){
		$id = intval($id);
// 		$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_usuario = $id");
// 		$lista->execute();
		$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id = $id");
		$lista->execute();
		
		return $lista->fetch();
	}

	#Atualiza o status da aeronave
	public function atualizaStatusAeronaves($id, $status){
		$atualiza = $this->nexus->prepare("UPDATE $this->table SET status=$status WHERE id=$id");

		if($atualiza->execute()):
			return true;
		else:
			return false;
		endif;
	}

	public function buscaAeronaves($lat, $lng, $lat_destino, $lng_destino, $categoria, $pagina, $ordenar="categoria", $parametros, $passageiros){	
		$parametros = json_decode($parametros);

		$categoria_voo_sql = "";
		$tem_categoria = false;
		foreach($parametros->categoria_voo as $categoria_voo => $value){
			$categoria_voo_formatado = str_replace("_", " ", $categoria_voo);

			if($value == "ok"){
				$categoria_voo_sql .= "LCASE(tipo_servicos) LIKE '%$categoria_voo_formatado%' OR ";
				$tem_categoria = true;
			}
		}

		if($tem_categoria == false){
			$categoria_voo_sql .= "LCASE(tipo_servicos) LIKE '%%' OR ";
		}

		$categoria_aeronave_sql = "";
		$tem_categoria_aeronave = false;
		foreach($parametros->categoria_aeronave as $categoria_aeronave => $value){
			$categoria_aeronave_formatado = str_replace("_", " ", $categoria_aeronave);

			if($value == "ok"){
				$categoria_aeronave_sql .= "LCASE(categoria) LIKE '%$categoria_aeronave_formatado%' OR ";
				$tem_categoria_aeronave = true;
			}
		}

		if($tem_categoria_aeronave == false){
			$categoria_aeronave_sql .= "LCASE(categoria) LIKE '%%' OR ";
		}

		$categoria_voo_sql = rtrim($categoria_voo_sql, "OR ");
		$categoria_aeronave_sql = rtrim($categoria_aeronave_sql, "OR ");

		$sql_pesquisa = "(".$categoria_voo_sql.") AND (".$categoria_aeronave_sql.")";

		$por_pag = 10;
		$pag = $pagina-1;

		$limit1 = $pag*$por_pag;
		$limit2 = $por_pag;

// 		if($ordenar == "categoria"){
			//$select = $this->nexus->prepare("SELECT *, (3963.2 * acos(cos(radians('$lat')) * cos(radians(latitude)) * cos(radians(longitude) - radians('$lng')) + sin(radians('$lat')) * sin(radians(latitude)))) as distance FROM `$this->table` WHERE $sql_pesquisa AND passageiros >= $passageiros ORDER BY distance ASC, categoria ASC LIMIT $limit1,$limit2");
			$select = $this->nexus->prepare("SELECT *,
			@distance := ((3963.2 * acos(cos(radians('$lat')) * cos(radians(latitude)) * cos(radians(longitude) - radians('$lng')) + sin(radians('$lat')) * sin(radians(latitude)))) * 1.60934) + ((3963.2 * acos(cos(radians('$lat_destino')) * cos(radians(latitude)) * cos(radians(longitude) - radians('$lng_destino')) + sin(radians('$lat_destino')) * sin(radians(latitude)))) * 1.60934),

			@custo_total := (((@distance * 2)/velocidade) * valor) as custo_total,
			@distance as distance 
			FROM `aeronaves` WHERE $sql_pesquisa AND passageiros >= $passageiros ORDER BY `$ordenar` ASC, categoria ASC LIMIT $limit1,$limit2");
		
// 		}

		if($select->execute()){

			if($select->rowCount() > 0){
				return $select->fetchAll();
			}else{
				return false;
			}

		}else{
			return $select->errorInfo()[2];
		}
		
	}

	public function menorPrecoID($lat, $lng){
		$select = $this->nexus->prepare("SELECT *, (3963.2 * acos(cos(radians('$lat')) * cos(radians(latitude)) * cos(radians(longitude) - radians('$lng')) + sin(radians('$lat')) * sin(radians(latitude)))) as distance FROM `$this->table` ORDER BY valor ASC LIMIT 1");

		if($select->execute()){

			if($select->rowCount() > 0){

				$dados = $select->fetch();
				return $dados['id'];
			}else{
				return false;
			}

		}else{
			return $select->errorInfo()[2];
		}
	}

	public function contaAeronavesPorCategoria($categoria){
		
		$categoria = addslashes($categoria);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE categoria = '$categoria'");

		if($select->execute()){

			return $select->rowCount();

		}else{
			return $select->errorInfo()[2];
		}
	}

	public function dadosAeronave($id){

		$id = intval($id);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE id = '$id'");
		$select->execute();

		return $select->fetch();
	}

	public function calculaTempo($tempo){
		$tempo = $tempo * 60;
		$hora = floor($tempo/60);
		$resto = floor($tempo%60);
		$resto = str_pad($resto, 2, '0', STR_PAD_LEFT);
		$tempo = $hora.":".$resto;

		if($hora == 0){
			return $resto." minutos";
		}else{
			return $tempo." hrs";
		}
	}

	public function horasParaMinutos($hours){
		if(strpos($hours, ":") !== false){
			$separatedData = explode(":", $hours);
			$minutesInHours    = $separatedData[0] * 60;
			$minutesInDecimals = $separatedData[1];

			$totalMinutes = $minutesInHours + $minutesInDecimals;
		}else{
							$totalMinutes = $hours;
		}

		return $totalMinutes;
	}

	public function tempoAutonomia($autonomia){
		$total_minutos = $autonomia * 60;

		$horas  = floor($total_minutos/60);
		$minutos = $total_minutos % 60;

		$horas = str_pad($horas, 2, '0', STR_PAD_LEFT);
		$minutos = str_pad($minutos, 2, '0', STR_PAD_LEFT);

		return "$horas:$minutos";
	}

	public function haversine($latitude1, $longitude1, $latitude2, $longitude2, $raio=6378137){
		$lat1 = deg2rad($latitude1);
		$lon1 = deg2rad($longitude1);
		$lat2 = deg2rad($latitude2);
		$lon2 = deg2rad($longitude2);

		$latDelta = $lat2 - $lat1;
		$lonDelta = $lon2 - $lon1;

		$angulo = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($lonDelta / 2), 2)));
		return ($angulo * $raio)/1000;
	}

	public function qtdAeronaves($id, $tipo_usuario){
		if($tipo_usuario == "admin"):
			$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_usuario > 0");
			$lista->execute();
		elseif($tipo_usuario == "taxiaereo"):
			$lista = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_usuario = $id");
			$lista->execute();
		endif;
		
		return $lista->rowCount();
	}

	public function apagarAeronave($id){
		$deletar = $this->nexus->prepare("DELETE FROM $this->table WHERE id=$id");
		if($deletar->execute()){
			return true;
		}else{
			return false;
		}
	}
	

}
?>
