<?php

if(isset($_GET['up_anexos'])){

	$pasta = "../arquivo/";
	$nome_arquivo    = $_FILES['add_anexo']['name'];
	        
	$ext = strtolower(strrchr($nome_arquivo,"."));

	$nome_atual = 'p'.$_POST['cod_produto'].$ext;
	$tmp = $_FILES['add_anexo']['tmp_name'];
	                
	if(move_uploaded_file($tmp, $pasta.$nome_atual)){
	    echo $nome_atual;
	    exit();
	}else{
	    echo "erro";
	    exit();
	}

}

if(isset($_GET['up_slides'])){

	$pasta = "../img/slide/";
	$nome_arquivo    = $_FILES['add_slide']['name'];
	        
	$ext = strtolower(strrchr($nome_arquivo,"."));

	$nome_atual = rand(0, 99).time().rand(0, 9999).$ext;
	$tmp = $_FILES['add_slide']['tmp_name'];
	                
	if(move_uploaded_file($tmp, $pasta.$nome_atual)){
	    echo $nome_atual;
	    exit();
	}else{
	    echo "erro";
	    exit();
	}

}

if(isset($_GET['up_parceiros'])){

	$pasta = "../img/parceiro/";
	$nome_arquivo    = $_FILES['add_parceiro']['name'];
	        
	$ext = strtolower(strrchr($nome_arquivo,"."));

	$nome_atual = rand(0, 99).time().rand(0, 9999).$ext;
	$tmp = $_FILES['add_parceiro']['tmp_name'];
	                
	if(move_uploaded_file($tmp, $pasta.$nome_atual)){
	    echo $nome_atual;
	    exit();
	}else{
	    echo "erro";
	    exit();
	}

}