<?php 
class Permissao{
	private $dados_usuario;
	private $root_site;

	public function __construct($dados_usuario, $root_site){
		$this->dados_usuario = $dados_usuario;
		$this->root_site     = $root_site;
	}

	public function acessoAdmin(){
		if($this->dados_usuario["tipo_usuario"] != "admin"):
			
			if(isset($_SERVER['HTTP_AJAX'])):
				echo "<script>window.location.href = '$this->root_site/';</script>";
			else:
				header("HTTP/1.1 401 Unauthorized");
				header("Location: $this->root_site/");
			endif;
		endif;

	}
}

?>