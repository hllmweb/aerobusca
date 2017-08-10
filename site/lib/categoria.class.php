<?php 
class Categoria{
	private $nexus;
	private $table;


	public function __construct($conexao, $table){
		$this->nexus = $conexao;
		$this->table = $table;
	}

	#Listando categorias
	public function listaCategorias(){
		$lista = $this->nexus->prepare("SELECT * FROM $this->table");
		$lista->execute();

		return $lista->fetchAll();
	}

	#Adicionando categorias
	public function adicionarCategorias($nome_categoria){
		$adicionar = $this->nexus->prepare("INSERT into $this->table (nome_categoria) VALUES (:nome_categoria)");
		$adicionar->bindValue(':nome_categoria', $nome_categoria);
		$adicionar->execute();
		if($adicionar->rowCount() > 0):
			return true;
		else:
			return $adicionar->errorInfo()[2];
		endif;
	}


}
?>