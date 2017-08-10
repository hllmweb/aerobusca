<?php


if(isset($_GET['remove_anexo'])){

	$pasta = "../arquivo/";
	$arquivo = $pasta.$_GET['remove_anexo'];

	if(file_exists($arquivo)){
		if(unlink($arquivo)){
			echo "ok";
		}
	}else{
		$sem_extensao = explode(".", $_GET['remove_anexo']);
		$files = glob("../arquivo/$sem_extensao[0].*");
		foreach ($files as $file) {
		  unlink($file);
		}
		if(file_exists($arquivo)){
			echo "Ocorreu um erro ao apagar arquivo.";
		}else{
			echo "ok";
		}
	}
}


if(isset($_GET['remove_img'])){

	if(isset($_GET['slide'])){
		$pasta = "../img/slide/";

	}elseif(isset($_GET['parceiro'])){
		$pasta = "../img/parceiro/";
	}

	$arquivo = $pasta.$_GET['remove_img'];

	if(unlink($arquivo)){
		echo "ok";
	}


}



?>