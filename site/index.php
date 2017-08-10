<?php
include "lib/autoload.php";
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Aerobusca</title>
	<link rel="stylesheet" href="<?= $root_site; ?>/css/site.css?v=<?= versao(); ?>">
	<link rel="stylesheet" href="css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?= $root_site; ?>/js/multiple-select.js"></script>
	<link rel="stylesheet" href="<?= $root_site; ?>/css/multiple-select.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.maskMoney.min.js"></script>

	<script>
		var global_lat = 0;
		var global_lng = 0;

		var root_url = "<?= $root_site; ?>";
	</script>
</head>
<body>

<div class="side-social">
	<ul>
		<li><a href="#email"><i class="fa fa-envelope"></i></a></li>
		<li><a href="#app"><i class="fa fa-mobile"></i></a></li>
		<li><a href="#whatsapp"><i class="fa fa-whatsapp"></i></a></li>
	</ul>
</div>

	<div class="busca">
		<div class="limite">
			<header>
				<div class="logo">
					<a href="<?= $root_site; ?>/index"><img src="img/logo.png" alt="Aerobusca"></a>
				</div>
				<ul>
					<li><a href="<?= $root_site; ?>/index">Início</a></li>
					<li><a href="#">Serviços</a></li>
					<li><a href="#">Contato</a></li>
					<?php if(!$auth->loginValido()): ?>
					<li><a href="cadastro/taxiaereo">Sou Taxiaéreo</a></li>
					<?php endif; ?>
					<div class="menu-conta">
					<?php if($auth->loginValido()): ?>
						<?php if($dados_logado['tipo_usuario'] == "admin" || $dados_logado['tipo_usuario'] == "taxiaereo"): ?>
							<li><a href="<?= $root_sistema; ?>">Painel de controle</a></li>
						<?php else: ?>
							<li><a href="minha-conta">Minha Conta</a></li>
						<?php endif; ?>
						<li><a href="sair">Sair</a></li>
						<?php else: ?>
						<li><a href="javascript:abrirModal('#login_modal');">Entrar</a></li>
						<li><a href="cadastro" class="cadastro fade">Cadastrar-se</a></li>
					<?php endif; ?>
					</div>
				</ul>
			</header>
		</div>
		
			<div class="formulario-busca-inicio">
				<!-- <div class="formulario-mensagem">
					<h1>Fretamento de aeronaves</h1>
					<h2>Encontre o <span class="laranja">menor preço</span> no <span class="azul">AERObusca</span>, é simples e grátis!</h2>
				</div> -->
				<form action="busca" method="post" id="formulario-de-busca">

				<!-- validar formulario de busca -->
					<div class="menu-formulario">
						<ul>
							<li><a href="#" class="ativo">Fretamento</a></li>
						</ul>
					</div>
					<div class="formulario-inputs">
						<div class="tipo-formulario">
							<!--<span>IDA E VOLTA</span>-->
						</div>
	
						<select name="cat_voo" id="cat-voo" style="vertical-align:top" class="obrigatorio">
							<option disabled selected hidden>Categoria do voo</option>
							<option value="passageiros">Passageiros</option>
							<option value="cargas">Cargas</option>
							<option value="remocao_aerea">Remoção Aérea</option>
							<option value="uti_aerea">UTI Aérea</option>
							<option value="instrucao">Instrução de Vôo</option>
						</select>


						<select name="cat_aeronave1" id="cat-aeronave" style="vertical-align:top" class="cat_aeronave_select obrigatorio" multiple>
							<?php
								$categorias = $categoria->listaCategorias();

								foreach($categorias as $dado):
									$categoria_formatado = strtolower(str_replace(" ", "_", $utilitarios->removerAcentos($dado['nome_categoria'])));
							?>
							<option value="<?= $categoria_formatado; ?>"><?= $dado['nome_categoria']; ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="cat_aeronave" value="">
						
						<div class="outras-linhas-campos">
							<div class="linha-campos">
								<input type="hidden" name="count[]" value="ok">
								<label for="origem">
									<span class="icone-input"><i class="fa fa-plane"></i></span>
									<input type="text" name="origem[]" id="origem" placeholder="Origem" class="origens local obrigatorio">
									<input type="hidden" name="origem_local_lat[]" class="local_lat">
									<input type="hidden" name="origem_local_lng[]" class="local_lng">
								</label>
								<label for="destino">
									<span class="icone-input"><i class="fa fa-plane fa-flip-horizontal"></i></span>
									<input type="text" name="destino[]" id="destino" placeholder="Destino" class="destinos local obrigatorio">
									<input type="hidden" name="destino_local_lat[]" class="local_lat">
									<input type="hidden" name="destino_local_lng[]" class="local_lng">
								</label>
								<label for="data-ida">
									<span class="icone-input"><i class="fa fa-calendar"></i></span>
									<input type="text" name="data_ida[]" placeholder="Ida" class="menor data-input obrigatorio">
									<!-- colocar calendario -->
								</label>
								<label for="hora-ida">
									<span class="icone-input"><i class="fa fa-clock-o"></i></span>
									<input type="text" name="hora_ida[]" id="hora_ida" placeholder="HH:MM" class="hora hora_ida obrigatorio">
								</label>
								<label for="data-volta">
									<span class="icone-input desativado"><i class="fa fa-calendar"></i></span>
									<input type="text" name="data_volta[]" placeholder="Volta" class="menor data-input desativado" value="Opcional">
								</label>
								<label for="hora-volta">
									<span class="icone-input desativado"><i class="fa fa-clock-o"></i></span>
									<input type="text" name="hora_volta[]" id="hora_volta" placeholder="HH:MM" class="hora hora_volta desativado" value="Opcional">
								</label>
								<label for="passageiros">
									<span class="icone-input"><i class="fa fa-user"></i></span>
									<input type="number" id="passageiros" name="passageiros[]" class="passageiros obrigatorio" value="1" min="1">
								</label>

								<button title="Clique para adicionar outra cidade" class="add-cidade maior">Adicionar</button>
							</div>

						</div>
						
						<div class="btn-buscar">
							<button type="submit"><i class="fa fa-search"></i> Buscar</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	
<div class="loading">
	<img src="img/loading.gif" alt="Carregando..." />
</div>


<div id="login_modal" class="modal">
	<div class="modal_corpo_login">
		<div class="modal_titulo_login">
			<b><div class="modal_icon"><i class="fa fa-user"></i></div>ACESSE SUA CONTA</b>
			<a href="javascript:void(0)" class="btn_fechar_modal fechar_modal"><i class="fa fa-times"></i></a>
		</div>

		<div class="modal_conteudo_login">
			<form class="form_login2" id="form-login">
				<input type="hidden" name="login" value="ok">
				<input type="text" placeholder="Email" name="email" class="fade" required="" title="Insira seu email">
				<input type="password" placeholder="Senha" name="senha" required="" title="Insira sua senha">
				<button type="submit">ENTRAR</button>
				<a href="#">Esqueceu sua senha?</a>
				<span>Ainda não tem cadastro?</span>
				<button class="cadastro" onclick="window.location.href = 'cadastro.php';">CADASTRE-SE AQUI</button>
			</form>
			
		</div>
	</div>
</div>


<script src="js/maps.js?v=<?= versao(); ?>"></script>
<script src="js/site.js?v=<?= versao(); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSuXH0sCB7bgQYBa9hAo4rWbySPoelNQ&libraries=places&callback=googlemaps"></script>
<script>
$(document).on("change", ".local", function(e){
	$(this).parent().find(".local_lat").val(global_lat);
	$(this).parent().find(".local_lng").val(global_lng);
});

$("[name=cat_aeronave1]").multipleSelect({
    width: '200px',
    placeholder: "Categoria da aeronave",
    selectAll: false,
    maxHeight: 400
});


$("[name=cat_aeronave1]").change(function(e){
	//$(this).multipleSelect("refresh");
 	$("[name=cat_aeronave]").val($(this).multipleSelect("getSelects")); //campo que é adicionado os valores clicados
});



</script>
</body>
</html>