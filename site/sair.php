<?php

include "lib/autoload.php";
@session_start();

if($auth->sair()){
	header("Location: $root_site");
}else{
	header("Location: $root_site");
}
?>