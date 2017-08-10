<?php
include "usuario.class.php";
include "aeronave.class.php";
include "modelo.class.php";
include "categoria.class.php";
include "permissao.class.php";
include "cotacao.class.php";
include "utilitarios.class.php";
include "mensagem.class.php";


$servidor = $_SERVER['SERVER_NAME'];
$path_uri = $_SERVER['REQUEST_URI'];
$titulo_sistema = "AeroBusca";

if($servidor == 'localhost'):
	$conexao = new PDO('mysql:host=localhost;dbname=aerobusca','root','');
	$root_site = "http://".$_SERVER['SERVER_NAME']."/aerobusca/site";
	$root_sistema = "http://".$_SERVER['SERVER_NAME']."/aerobusca/site/painel";
elseif($servidor == 'hugomesquita.com.br'):
	$conexao = new PDO('mysql:host=localhost;dbname=hugomesquita_aerobusca','hugomesq_user','senha!7');
	$root_site = "http://".$servidor."/aerobusca/site";
	$root_sistema = "http://".$servidor."/aerobusca/site/painel";
endif;
$conexao->exec("SET CHARACTER SET utf8");
$tabela_db 		= array("usuarios", "aeronaves", "modelos", "categorias", "cotacoes", "carrinho", "mensagens");

$auth	 		= new Usuario($conexao, $tabela_db[0]);
$aeronave 		= new Aeronave($conexao, $tabela_db[1]);
$modelo 		= new Modelo($conexao, $tabela_db[2]);
$categoria  	= new Categoria($conexao, $tabela_db[3]);
$utilitarios 	= new Utilitarios();
$cotacao 		= new Cotacao($conexao, $tabela_db[4], $tabela_db[5]);
$mensagens 		= new Mensagem($conexao, $tabela_db[6]);

if($auth->loginValido()){
	$email_logado = (isset($_SESSION['user_email'])) ? $_SESSION['user_email'] : $_COOKIE['user_email'];
	$id_logado = $auth->pegaID($email_logado);
	$dados_logado = $auth->dadosUsuario($id_logado);

	$token = $cotacao->pegaTokenUsuario($id_logado);
	$permissao = new Permissao($dados_logado, $root_site);
}else{
	if(strpos($path_uri,"painel")):
		header("Location: $root_site");
	endif;
}

// $token = "";

function versao(){
	echo time();
}



?>