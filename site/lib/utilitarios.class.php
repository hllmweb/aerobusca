<?php

class Utilitarios{


	public function removerAcentos($string){
		$sequencia_normal = array("a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "n", "N");

	    return preg_replace(array(
	    	"/(á|à|ã|â|ä)/",
	    	"/(Á|À|Ã|Â|Ä)/",
	    	"/(é|è|ê|ë)/",
	    	"/(É|È|Ê|Ë)/",
	    	"/(í|ì|î|ï)/",
	    	"/(Í|Ì|Î|Ï)/",
	    	"/(ó|ò|õ|ô|ö)/",
	    	"/(Ó|Ò|Õ|Ô|Ö)/",
	    	"/(ú|ù|û|ü)/",
	    	"/(Ú|Ù|Û|Ü)/",
	    	"/(ñ)/",
	    	"/(Ñ)/"
	    ), $sequencia_normal, $string);
	}

	public function mesextenco($mes){
		switch($mes) {
			case"01": $mes = "Janeiro";	  break;
	                case"02": $mes = "Fevereiro";     break;
			case"03": $mes = "Março";	  break;
			case"04": $mes = "Abril";	  break;
			case"05": $mes = "Maio";	  break;
			case"06": $mes = "Junho";	  break;
			case"07": $mes = "Julho";	  break;
			case"08": $mes = "Agosto";	  break;
	                case"09": $mes = "Setembro";      break;
			case"10": $mes = "Outubro";	  break;
	                case"11": $mes = "Novembro";      break;
	                case"12": $mes = "Dezembro";      break;
		}
		return $mes;
	}
	
	public function vfloat($valor){
		$array = explode(",",$valor);
		
		$um 	= str_replace(".","",$array[0]);
		
		$novo = $um.'.'.$array[1];
		
		return $novo;
	}

}