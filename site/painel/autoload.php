<?php

require_once "../lib/auth.class.php";
require_once "../lib/leilao.class.php";


$servidor_conexao = $_SERVER['SERVER_NAME'];

if($servidor_conexao == 'localhost'){
	$nexus = new PDO('mysql:host=localhost;dbname=leiloesfreitas', 'root', '');
}else{
	$nexus = new PDO('mysql:host=localhost;dbname=dzigni_leiloesfreitas', 'dzigni_user', 'senha!7');
}

$nexus->exec("SET CHARACTER SET utf8");

$autenticacao = new Auth($nexus, 'usuarios');
$leilao = new Leilao($nexus, 'leiloes');

if($autenticacao->estaLogado()){
	if($autenticacao->nivel($autenticacao->usuarioLogado()) != 'admin'){
		header("Location: ../index.php");
	}
}else{
	header("Location: ../index.php");
}

?>