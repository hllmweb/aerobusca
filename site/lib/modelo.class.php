<?php 

class Modelo{
	private $nexus;
	private $table;


	public function __construct($conexao, $table){
		$this->nexus = $conexao;
		$this->table = $table;
	}
	
	#Listando todos os modulos relacionados as aeronaves
	// public function listaModelos($campo){
	// 	$lista = $this->nexus->prepare("SELECT DISTINCT $campo FROM $this->table");
	// 	$lista->execute();

	// 	return $lista->fetchAll();
	// }

	#Listando todos os fabricantes
	public function listaFabricantes(){
		$lista = $this->nexus->prepare("SELECT DISTINCT fabricante FROM $this->table");
		$lista->execute();

		return $lista->fetchAll();
	}

	#Listando todos os modelos relacionados a um fabricante
	public function listaModelos($fabricante){
		$fabricante = addslashes($fabricante);
		$lista = $this->nexus->prepare("SELECT DISTINCT modelo FROM $this->table WHERE fabricante = :fabricante");
		$lista->bindValue(":fabricante", $fabricante, PDO::PARAM_STR);
		$lista->execute();

		return $lista->fetchAll();
	}

	#Adicionando os modulos das aeronaves
	public function adicionarModelos($fabricante,$modelo,$categoria){
		$adicionar = $this->nexus->prepare("INSERT into $this->table (
			fabricante,
			modelo,
			categoria) VALUES (
			:fabricante,
			:modelo,
			:categoria)");
		$adicionar->bindValue(':fabricante', $fabricante);
		$adicionar->bindValue(':modelo', $modelo);
		$adicionar->bindValue(':categoria', $categoria);

		if($adicionar->execute()):
			return true;
		else: 
			return false;
		endif;
	}


}

?>