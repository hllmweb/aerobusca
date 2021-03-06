<?php

/**
* Aerobusca
*/

class Usuario{
	
	private $nexus;
	private $table;


	public function __construct($conexao, $tabela){
		$this->nexus = $conexao;
		$this->table = $tabela;
	}


	public function createToken(){
		$token = time();
		$token_times = rand(1, 9);
		for($i=0; $i < $token_times; $i++){
			$token = md5($token);
		}

		return $token;
	}

	public function validaCPF($cpf){ 
	    if(empty($cpf)) {
	        return false;
	    }
	 
	    $cpf = str_replace(".", "", $cpf);
	    $cpf = str_replace("-", "", $cpf);
	    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	     
	    if (strlen($cpf) != 11) {
	        return false;
	    }

	    else if ($cpf == '00000000000' || 
	        $cpf == '11111111111' || 
	        $cpf == '22222222222' || 
	        $cpf == '33333333333' || 
	        $cpf == '44444444444' || 
	        $cpf == '55555555555' || 
	        $cpf == '66666666666' || 
	        $cpf == '77777777777' || 
	        $cpf == '88888888888' || 
	        $cpf == '99999999999') {
	        return false;

	     } else {   
	         
	        for ($t = 9; $t < 11; $t++) {
	             
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	            $d = ((10 * $d) % 11) % 10;
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }
	 
	        return true;
	    }

	}

	function validaCNPJ($cnpj){
		$cnpj = str_replace(".", "", $cnpj);
	    $cnpj = str_replace("-", "", $cnpj);
	    $cnpj = str_replace("/", "", $cnpj);

		if(strlen($cnpj) != 14){
			return false;
		}

		for($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;

		if($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)){
			return false;
		}
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}

	/*
	      _ _            _       
	  ___| (_) ___ _ __ | |_ ___ 
	 / __| | |/ _ \ '_ \| __/ _ \
	| (__| | |  __/ | | | ||  __/
	\___|_|_|\___|_| |_|\__\___|
	                             
	*/
	public function registrarCliente($nome, $sobrenome, $data_nascimento, $sexo, $cpf_ou_cnpj, $telefone, $email, $senha){

		$nome = addslashes($nome);
		$sobrenome = addslashes($sobrenome);
		$data_nascimento = addslashes($data_nascimento);
		$sexo = addslashes($sexo);
		$cpf_ou_cnpj = addslashes($cpf_ou_cnpj);
		$telefone = addslashes($telefone);
		$email = addslashes($email);
		$senha = addslashes($senha);

		$cpf_ou_cnpj = str_replace(".", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("-", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("/", "", $cpf_ou_cnpj);

		if($sexo == "mas"){
			$sexo = "m";
		}else{
			$sexo = "f";
		}

		$data_registro = time();

		$senha_encriptada = $this->encrypt($senha);
		$token = $this->createToken();
		
		$ip = $_SERVER['REMOTE_ADDR'];

		$insert = $this->nexus->prepare("INSERT INTO $this->table(
			tipo_usuario,
			nivel_cadastro,
			nome,
			sobrenome,
			data_nascimento,
			sexo,
			cpf_ou_cnpj,
			telefone,
			email,
			senha,
			token,
			data_registro,
			ip
		) VALUES (
			:tipo_usuario,
			:nivel_cadastro,
			:nome,
			:sobrenome,
			:data_nascimento,
			:sexo,
			:cpf_ou_cnpj,
			:telefone,
			:email,
			:senha,
			:token,
			:data_registro,
			:ip
		)");
		$insert->bindValue(':tipo_usuario',		'cliente', 			PDO::PARAM_STR);
		$insert->bindValue(':nivel_cadastro',	1, 					PDO::PARAM_INT);
		$insert->bindValue(':nome', 			$nome, 				PDO::PARAM_STR);
		$insert->bindValue(':sobrenome', 		$sobrenome, 		PDO::PARAM_STR);
		$insert->bindValue(':data_nascimento', 	$data_nascimento, 	PDO::PARAM_STR);
		$insert->bindValue(':sexo', 			$sexo, 				PDO::PARAM_STR);
		$insert->bindValue(':cpf_ou_cnpj', 		$cpf_ou_cnpj, 		PDO::PARAM_INT);
		$insert->bindValue(':telefone', 		$telefone, 			PDO::PARAM_STR);
		$insert->bindValue(':email', 			$email, 			PDO::PARAM_STR);
		$insert->bindValue(':senha', 			$senha_encriptada, 	PDO::PARAM_STR);
		$insert->bindValue(':token', 			$token, 			PDO::PARAM_STR);
		$insert->bindValue(':data_registro', 	$data_registro, 	PDO::PARAM_STR);
		$insert->bindValue(':ip', 				$ip, 				PDO::PARAM_STR);

		if($insert->execute()){

			if($insert->rowCount() > 0){
				return true;
			}else{
				return $insert->errorInfo()[2];
			}

		}else{
			return $insert->errorInfo()[2];
		}
		
	}

	/*
	                                          
	  ___ _ __ ___  _ __  _ __ ___  ___  __ _ 
	 / _ \ '_ ` _ \| '_ \| '__/ _ \/ __|/ _` |
	|  __/ | | | | | |_) | | |  __/\__ \ (_| |
	\___|_| |_| |_| .__/|_|  \___||___/\__,_|
	              |_|                        
	*/
	public function registrarEmpresa($nome, $pais, $gestor, $cpf_ou_cnpj, $telefone, $email, $senha){

		$nome = addslashes($nome);
		$pais = addslashes($pais);
		$gestor = addslashes($gestor);
		$cpf_ou_cnpj = addslashes($cpf_ou_cnpj);
		$telefone = addslashes($telefone);
		$email = addslashes($email);
		$senha = addslashes($senha);

		$cpf_ou_cnpj = str_replace(".", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("-", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("/", "", $cpf_ou_cnpj);

		$data_registro = time();

		$senha_encriptada = $this->encrypt($senha);
		$token = $this->createToken();
		
		$ip = $_SERVER['REMOTE_ADDR'];

		$insert = $this->nexus->prepare("INSERT INTO $this->table(
			tipo_usuario,
			nivel_cadastro,
			nome,
			cpf_ou_cnpj,
			telefone,
			pais,
			gestor_responsavel,
			email,
			senha,
			token,
			data_registro,
			ip
		) VALUES (
			:tipo_usuario,
			:nivel_cadastro,
			:nome,
			:cpf_ou_cnpj,
			:telefone,
			:pais,
			:gestor_responsavel,
			:email,
			:senha,
			:token,
			:data_registro,
			:ip
		)");
		$insert->bindValue(':tipo_usuario',			'empresa', 			PDO::PARAM_STR);
		$insert->bindValue(':nivel_cadastro',		1, 					PDO::PARAM_INT);
		$insert->bindValue(':nome', 				$nome, 				PDO::PARAM_STR);
		$insert->bindValue(':cpf_ou_cnpj', 			$cpf_ou_cnpj, 		PDO::PARAM_INT);
		$insert->bindValue(':telefone', 			$telefone, 			PDO::PARAM_STR);
		$insert->bindValue(':gestor_responsavel',	$gestor,	 		PDO::PARAM_STR);
		$insert->bindValue(':pais', 				$pais,	 			PDO::PARAM_STR);
		$insert->bindValue(':email', 				$email, 			PDO::PARAM_STR);
		$insert->bindValue(':senha', 				$senha_encriptada, 	PDO::PARAM_STR);
		$insert->bindValue(':token', 				$token, 			PDO::PARAM_STR);
		$insert->bindValue(':data_registro', 		$data_registro, 	PDO::PARAM_STR);
		$insert->bindValue(':ip', 					$ip, 				PDO::PARAM_STR);

		if($insert->execute()){

			if($insert->rowCount() > 0){
				return true;
			}else{
				return $insert->errorInfo()[2];
			}

		}else{
			return $insert->errorInfo()[2];
		}
		
	}

	/*
	   _                    _       
	  /_\   __ _  ___ _ __ | |_ ___ 
	 //_\\ / _` |/ _ \ '_ \| __/ _ \
	/  _  \ (_| |  __/ | | | ||  __/
	\_/ \_/\__, |\___|_| |_|\__\___|
	       |___/                    
	*/

	public function registrarAgente($nome, $sobrenome, $cpf_ou_cnpj, $agencia, $banco, $tipo_conta, $numero_conta, $telefone, $email, $senha){

		$nome 			= addslashes($nome);
		$sobrenome 		= addslashes($sobrenome);
		$cpf_ou_cnpj 	= addslashes($cpf_ou_cnpj);
		$agencia 		= addslashes($agencia);
		$banco 			= addslashes($banco);
		$tipo_conta 	= addslashes($tipo_conta);
		$numero_conta 	= addslashes($numero_conta);
		$telefone 		= addslashes($telefone);
		$email 			= addslashes($email);
		$senha 			= addslashes($senha);
		

		$cpf_ou_cnpj = str_replace(".", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("-", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("/", "", $cpf_ou_cnpj);


		$data_registro = time();

		$senha_encriptada = $this->encrypt($senha);
		$token = $this->createToken();
		
		$ip = $_SERVER['REMOTE_ADDR'];

		$insert = $this->nexus->prepare("INSERT INTO $this->table(
			tipo_usuario,
			nivel_cadastro,
			nome,
			sobrenome,
			cpf_ou_cnpj,
			telefone,
			banco,
			agencia,
			tipo_conta,
			n_conta,
			email,
			senha,
			token,
			data_registro,
			ip
		) VALUES (
			:tipo_usuario,
			:nivel_cadastro,
			:nome,
			:sobrenome,
			:cpf_ou_cnpj,
			:telefone,
			:banco,
			:agencia,
			:tipo_conta,
			:n_conta,
			:email,
			:senha,
			:token,
			:data_registro,
			:ip
		)");
		$insert->bindValue(':tipo_usuario',		'agente', 			PDO::PARAM_STR);
		$insert->bindValue(':nivel_cadastro',	1, 					PDO::PARAM_INT);
		$insert->bindValue(':nome', 			$nome, 				PDO::PARAM_STR);
		$insert->bindValue(':sobrenome', 		$sobrenome, 		PDO::PARAM_STR);
		$insert->bindValue(':cpf_ou_cnpj', 		$cpf_ou_cnpj, 		PDO::PARAM_INT);
		$insert->bindValue(':telefone', 		$telefone, 			PDO::PARAM_STR);
		$insert->bindValue(':banco', 			$banco, 			PDO::PARAM_STR);
		$insert->bindValue(':agencia', 			$agencia, 			PDO::PARAM_STR);
		$insert->bindValue(':tipo_conta', 		$tipo_conta,		PDO::PARAM_STR);
		$insert->bindValue(':n_conta', 			$n_conta,			PDO::PARAM_STR);
		$insert->bindValue(':email', 			$email, 			PDO::PARAM_STR);
		$insert->bindValue(':senha', 			$senha_encriptada, 	PDO::PARAM_STR);
		$insert->bindValue(':token', 			$token, 			PDO::PARAM_STR);
		$insert->bindValue(':data_registro', 	$data_registro, 	PDO::PARAM_STR);
		$insert->bindValue(':ip', 				$ip, 				PDO::PARAM_STR);

		if($insert->execute()){

			if($insert->rowCount() > 0){
				return true;
			}else{
				return $insert->errorInfo()[2];
			}

		}else{
			return $insert->errorInfo()[2];
		}
		
	}

	/*
	 _____           _                      
	/__   \__ ___  _(_) __ _ _ __ ___  ___  
	  / /\/ _` \ \/ / |/ _` | '__/ _ \/ _ \ 
	 / / | (_| |>  <| | (_| | | |  __/ (_) |
	 \/   \__,_/_/\_\_|\__,_|_|  \___|\___/ 
	                                        
	*/
	public function registrarTaxiaereo($nome, $gestor, $cpf_ou_cnpj, $telefone, $email, $senha){

		$nome 			= addslashes($nome);
		$gestor 		= addslashes($gestor);
		$cpf_ou_cnpj 	= addslashes($cpf_ou_cnpj);
		$telefone 		= addslashes($telefone);
		$email 			= addslashes($email);
		$senha 			= addslashes($senha);

		$cpf_ou_cnpj = str_replace(".", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("-", "", $cpf_ou_cnpj);
	    $cpf_ou_cnpj = str_replace("/", "", $cpf_ou_cnpj);


		$data_registro = time();

		$senha_encriptada = $this->encrypt($senha);
		$token = $this->createToken();
		
		$ip = $_SERVER['REMOTE_ADDR'];

		$insert = $this->nexus->prepare("INSERT INTO $this->table(
			tipo_usuario,
			nivel_cadastro,
			nome,
			cpf_ou_cnpj,
			telefone,
			gestor_responsavel,
			email,
			senha,
			token,
			data_registro,
			ip
		) VALUES (
			:tipo_usuario,
			:nivel_cadastro,
			:nome,
			:cpf_ou_cnpj,
			:telefone,
			:gestor_responsavel,
			:email,
			:senha,
			:token,
			:data_registro,
			:ip
		)");
		$insert->bindValue(':tipo_usuario',			'taxiaereo',		PDO::PARAM_STR);
		$insert->bindValue(':nivel_cadastro',		1, 					PDO::PARAM_INT);
		$insert->bindValue(':nome', 				$nome, 				PDO::PARAM_STR);
		$insert->bindValue(':cpf_ou_cnpj', 			$cpf_ou_cnpj, 		PDO::PARAM_INT);
		$insert->bindValue(':telefone', 			$telefone, 			PDO::PARAM_STR);
		$insert->bindValue(':gestor_responsavel',	$gestor, 			PDO::PARAM_STR);
		$insert->bindValue(':email', 				$email, 			PDO::PARAM_STR);
		$insert->bindValue(':senha', 				$senha_encriptada, 	PDO::PARAM_STR);
		$insert->bindValue(':token', 				$token, 			PDO::PARAM_STR);
		$insert->bindValue(':data_registro', 		$data_registro, 	PDO::PARAM_STR);
		$insert->bindValue(':ip', 					$ip, 				PDO::PARAM_STR);

		if($insert->execute()){

			if($insert->rowCount() > 0){
				return true;
			}else{
				return $insert->errorInfo()[2];
			}

		}else{
			return $insert->errorInfo()[2];
		}
	}

	/*
	 _____       __                                                           _ _      _                   _     
	|_   _|     / _|                                                         | (_)    (_)                 (_)    
	  | | _ __ | |_ ___  _ __ _ __ ___   __ _  ___ ___   ___  ___    __ _  __| |_  ___ _  ___  _ __   __ _ _ ___ 
	  | || '_ \|  _/ _ \| '__| '_ ` _ \ / _` |/ __/ _ \ / _ \/ __|  / _` |/ _` | |/ __| |/ _ \| '_ \ / _` | / __|
	 _| || | | | || (_) | |  | | | | | | (_| | (_| (_) |  __/\__ \ | (_| | (_| | | (__| | (_) | | | | (_| | \__ \
	 \___/_| |_|_| \___/|_|  |_| |_| |_|\__,_|\___\___/ \___||___/  \__,_|\__,_|_|\___|_|\___/|_| |_|\__,_|_|___/
                                                                                                     
	*/

	public function atualizaInformacoesAdicionais($id, $cheta, $cep, $estado, $cidade, $bairro, $rua, $numero, $metodos, $descricao){
		$id 		= intval($id);
		$cheta 		= addslashes($cheta);
		$cep 		= addslashes($cep);
		$bairro 	= addslashes($bairro);
		$rua 		= addslashes($rua);
		$numero 	= addslashes($numero);
		$cidade 	= addslashes($cidade);
		$estado 	= addslashes($estado);
		$metodos 	= addslashes($metodos);
		$descricao 	= addslashes($descricao);

		$update = $this->nexus->prepare("UPDATE $this->table SET
			nivel_cadastro = :nivel_cadastro,
			cep = :cep,
			estado = :estado,
			cidade = :cidade,
			bairro = :bairro,
			rua = :rua,
			numero_endereco = :numero,
			metodos_pagamento = :metodos,
			cheta = :cheta,
			descricao_empresa = :descricao_empresa

			WHERE id = :id
		");
		$update->bindValue(':nivel_cadastro', 		2, 			PDO::PARAM_INT);
		$update->bindValue(':cheta', 				$cheta, 	PDO::PARAM_STR);
		$update->bindValue(':cep', 					$cep, 		PDO::PARAM_STR);
		$update->bindValue(':estado', 				$estado, 	PDO::PARAM_STR);
		$update->bindValue(':cidade', 				$cidade, 	PDO::PARAM_STR);
		$update->bindValue(':bairro', 				$bairro, 	PDO::PARAM_STR);
		$update->bindValue(':rua', 					$rua, 		PDO::PARAM_STR);
		$update->bindValue(':numero', 				$numero, 	PDO::PARAM_STR);
		$update->bindValue(':metodos', 				$metodos, 	PDO::PARAM_STR);
		$update->bindValue(':descricao_empresa', 	$descricao, PDO::PARAM_STR);
		$update->bindValue(':id', 					$id, 		PDO::PARAM_INT);

		$update->execute();
		if($update->execute()){

			return true;		

		}else{
			return $update->errorInfo()[2];
		}
	}

	public function checkEmail($email_ou_cpf){

		$email_ou_cpf = addslashes($email_ou_cpf);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE email = :email OR cpf_ou_cnpj = :cpf_ou_cnpj");
		$select->bindParam(':email', $email_ou_cpf, PDO::PARAM_STR);
		$select->bindParam(':cpf_ou_cnpj', $email_ou_cpf, PDO::PARAM_STR);

		$select->execute();

		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function encrypt($string){ // encripta senha

		for ($i=0; $i < 9; $i++) { 
			$string = md5($string); //md5 (9 vezes)
		}

		$string = md5(sha1($string)); //sha1 e md5 mais uma vez

		return $string; //md5 9 vezes + sha1 + md5

	}

	public function isVerified($email){
		$email = addslashes($email);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE EMAIL = :email AND VERIFIED = 1");
		$select->bindValue(':email', $email, PDO::PARAM_STR);
		$select->execute();
		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function verifyUser($token){
		$token = addslashes($token);

		$update = $this->nexus->prepare("UPDATE $this->table SET VERIFIED = 1 WHERE TOKEN = :token");
		$update->bindParam(':token', $token, PDO::PARAM_STR);

		$update->execute();

		if($update->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function dadosUsuario($id){
		$id = intval($id);
		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE id = $id");
		$select->execute();

		if($select->rowCount() > 0){
			return $select->fetch();
		}
	}

	public function pegaID($email){
		$email = addslashes($email);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE email = :email");
		$select->bindValue(':email', $email, PDO::PARAM_STR);	
		$select->execute();

		if($select->rowCount() > 0){
			$data = $select->fetch();

			return $data['id'];
		}else{
			return false;
		}
	}

	public function getUserName($email){
		$email = addslashes($email);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE EMAIL = :email");
		$select->bindValue(':email', $email, PDO::PARAM_STR);	
		$select->execute();

		if($select->rowCount() > 0){
			$data = $select->fetch();

			return $data['NAME'];
		}else{
			return false;
		}
	}


	
	public function getUserToken($email){
		$email = addslashes($email);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE EMAIL = :email");
		$select->bindValue(':email', $email, PDO::PARAM_STR);	
		$select->execute();

		if($select->rowCount() > 0){
			$data = $select->fetch();

			return $data['TOKEN'];
		}else{
			return false;
		}
	}

	public function getEmailByToken($token){
		$token = addslashes($token);
		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE TOKEN = :token");
		$select->bindValue(':token', $token, PDO::PARAM_STR);	
		$select->execute();

		if($select->rowCount() > 0){
			$data = $select->fetch();

			return $data['EMAIL'];
		}else{
			return false;
		}
	}

	public function login($email, $senha, $cookies=false){

		$email = addslashes($email);
		$senha = addslashes($senha);

		$senha_encriptada = $this->encrypt($senha);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE email = :email AND senha = :senha");
		$select->bindParam(':email', $email, PDO::PARAM_STR);
		$select->bindParam(':senha', $senha_encriptada, PDO::PARAM_STR);

		$select->execute();

		if($select->rowCount() > 0){
			@session_start();
			if($cookies == false){
				$_SESSION['user_email'] = $email;
				$_SESSION['user_senha'] = $senha_encriptada;
			}else{
				setcookie("user_email", $email, time()+3600*24*30, '/');
				setcookie("user_senha", $senha_encriptada, time()+3600*24*30, '/');
			}
			return true;
		}else{
			return false;
		}
	}

	public function getLoggedData(){
		if($this->isLogged()){
			if(isset($_SESSION['user_email']) && isset($_SESSION['user_password']) && isset($_SESSION['session_token'])){
				$return_array = array(
					'email' => $_SESSION['user_email'],
					'password' => $_SESSION['user_password'],
					'session_token' => $_SESSION['session_token']
				);
			}elseif(isset($_COOKIE['user_email']) && isset($_COOKIE['user_password']) && isset($_COOKIE['session_token'])){
				$return_array = array(
					'email' => $_COOKIE['user_email'],
					'password' => $_COOKIE['user_password'],
					'session_token' => $_COOKIE['session_token']
				);	
			}

			return $return_array;
		}else{
			return false;
		}
	}

	public function isValidLogin($email, $enc_password, $token){
		$email = addslashes($email);
		$enc_password = addslashes($enc_password);
		$token = addslashes($token);

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE EMAIL = :email AND PASSWORD = :password");
		$select->bindValue(':email', $email, PDO::PARAM_STR);
		$select->bindValue(':password', $enc_password, PDO::PARAM_STR);
		$select->execute();

		if($select->rowCount() > 0){
			$select_token = $this->nexus->prepare("SELECT * FROM sessions WHERE TOKEN = :token AND status = 1");
			$select_token->bindValue(':token', $token, PDO::PARAM_STR);
			$select_token->execute();

			if($select_token->rowCount() > 0){
				return true;
			}else{
				return false;
			}
			return true;
		}else{
			return false;
		}
	}

	public function loginValido(){
		@session_start();

		if(isset($_SESSION['user_email']) && isset($_SESSION['user_senha'])){
			$email 				= addslashes($_SESSION['user_email']);
			$senha_encriptada 	= addslashes($_SESSION['user_senha']);

		}elseif(isset($_COOKIE['user_email']) && isset($_COOKIE['user_senha'])){
			$email 				= addslashes($_COOKIE['user_email']);
			$senha_encriptada 	= addslashes($_COOKIE['user_senha']);
		}else{
			$email = "---";
			$senha_encriptada = "---";
		}

		$select = $this->nexus->prepare("SELECT * FROM $this->table WHERE email = :email AND senha = :senha");
		$select->bindValue(':email', $email, 			PDO::PARAM_STR);
		$select->bindValue(':senha', $senha_encriptada, PDO::PARAM_STR);
		$select->execute();

		if($select->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function sair(){
		setcookie('user_email', "", 0, '/');
		setcookie('user_senha', "", 0, '/');


		unset($_SESSION['user_email']);
		unset($_SESSION['user_senha']);
		session_destroy();

		return true;
	}

	 public function listaUsuarios(){
		$lista = $this->nexus->prepare("SELECT * FROM $this->table ORDER BY nome ASC");
		$lista->execute();

		return $lista->fetchAll();
	}
	public function insereImagemUsuario($id,$imagem){
		$atualiza = $this->nexus->prepare("UPDATE $this->table SET imagem='$imagem' WHERE id=$id");
		if($atualiza->execute()):
			return true;
		else:
			return false;
		endif;
	}

	public function qtdUsuarios(){
		$lista = $this->nexus->prepare("SELECT * FROM $this->table");
		$lista->execute();	

		return $lista->rowCount();
	}

	public function editarUsuario($id, $tipo_usuario, $nome, $data_nascimento, $sexo, $cpf_ou_cnpj, $telefone, $pais, $cep, $estado, $cidade, $bairro, $rua, $numero_endereco, $gestor_responsavel, $banco, $agencia, $tipo_conta, $n_conta, $metodos_pagamento,$cheta,$email,$senha,$descricao_empresa){

		$editar = $this->nexus->prepare("UPDATE $this->table SET tipo_usuario='$tipo_usuario',
		nome='$nome',
		data_nascimento='$data_nascimento',
		sexo='$sexo',
		cpf_ou_cnpj='$cpf_ou_cnpj',
		telefone='$telefone',
		pais='$pais',
		cep='$cep',
		estado='$estado',
		cidade='$cidade',
		bairro='$bairro',
		rua='$rua',
		numero_endereco='$numero_endereco',
		gestor_responsavel='$gestor_responsavel',
		banco='$banco',
		agencia='$agencia',
		tipo_conta='$tipo_conta',
		n_conta='$n_conta',
		metodos_pagamento='$metodos_pagamento',
		cheta='$cheta',
		email='$email',
		senha='$senha',
		descricao_empresa='$descricao_empresa' WHERE id='$id'");

		$editar->execute();
		if($editar->rowCount() > 0){
			return true;
		}else{
			return $editar->errorInfo()[2];
		}
	
	}
	
	public function apagarUsuario($id){
		$deletar = $this->nexus->prepare("DELETE FROM $this->table WHERE id=$id");
		if($deletar->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function atualizaStatusUsuarios($id, $status){
		$atualiza = $this->nexus->prepare("UPDATE $this->table SET status=$status WHERE id=$id");

		if($atualiza->execute()):
			return true;
		else:
			return false;
		endif;
	}
	

}
?>