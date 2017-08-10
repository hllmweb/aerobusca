<?php 
class Mensagem{
	private $conexao;
	private $tabela;


	public function __construct($obj_nexus, $table){
		$this->nexus = $obj_nexus;
		$this->table = $table;
	}

	public function adicionarMensagem($id_cotacao, $id_cliente, $id_taxiaereo, $tipo_usuario, $texto){
		$data = time();

		$insert = $this->nexus->prepare("INSERT into $this->table (id_cotacao, id_cliente, id_taxiaereo, tipo_usuario, texto, data) VALUES (:id_cotacao, :id_cliente, :id_taxiaereo, :tipo_usuario, :texto, :data)");
		$insert->bindValue(":id_cotacao", $id_cotacao);
		$insert->bindValue(":id_cliente", $id_cliente);
		$insert->bindValue(":id_taxiaereo", $id_taxiaereo);
		$insert->bindValue(":tipo_usuario", $tipo_usuario);
		$insert->bindValue(":texto", $texto);
		$insert->bindValue(":data", $data);

		if($insert->execute()):
			return true;
		else:
			return false;
		endif;
	}

	public function listarMensagem($id_cotacao){
		$list = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_cotacao = $id_cotacao");
		$list->execute();
		if($list->rowCount() > 0):
			return $list->fetchAll();
		else:
			return false;
		endif;
	}
	public function qtdMensagem($id_cotacao){
		$list = $this->nexus->prepare("SELECT * FROM $this->table WHERE id_cotacao = $id_cotacao");
		$list->execute();
		return $list->rowCount();
	}

}

?>