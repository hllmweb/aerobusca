<?php
include "lib/autoload.php";
@session_start();

// print_r($dados_logado);

if($auth->loginValido()){
	if($dados_logado['tipo_usuario'] != "taxiaereo" && $dados_logado['tipo_usuario'] != "privado"){
		header("Location: $root_site");
		exit;
	}else{
		if(!isset($_GET['nivel_cadastro'])){
			switch($dados_logado['nivel_cadastro']){
				case 1:
					header("Location: $root_site/cadastro/taxiaereo/informacoes-adicionais");
					break;
				case 2:
					header("Location: $root_site/cadastro/taxiaereo/adicionar-aeronaves");
					break;
				case 3:
					header("Location: $root_site/cadastro/taxiaereo/completo");

				default:
					header("Location: $root_site/cadastro/taxiaereo");
					break;
			}
		}
	}
}

if(isset($_GET['nivel_cadastro'])){
	$nivel_cadastro = str_replace(".php", "", $_GET['nivel_cadastro']);

	if($nivel_cadastro != ("informacoes-adicionais" || "adicionar-aeronaves")){
		header("Location: $root_site/cadastro/taxiaereo");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cadastro</title>
	<link rel="stylesheet" href="<?= $root_site; ?>/css/site.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/jquery.bxslider.css">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/multiple-select.css" />
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<!-- <script src="<?= $root_site; ?>/js/multiple-select.js?v=<?= time(); ?>"></script> -->
	<script src="<?= $root_site; ?>/js/multiple-select.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.maskMoney.min.js"></script>
	<script>
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

<div id="wrapper">
	<div class="header-espaco-sem-busca">
		<div class="header-nao-fixo">
			<header class="menu-header">
				<div class="limite">
					<div class="logo">
						<a href="<?= $root_site; ?>"><img src="<?= $root_site; ?>/img/logo.png" alt="Aerobusca"></a>
					</div>
					<ul>
						<li><a href="<?= $root_site; ?>/index">Início</a></li>
						<li><a href="#">Serviços</a></li>
						<li><a href="#">Contato</a></li>
						<li><a href="<?= $root_site; ?>/cadastro">Cadastro</a></li>
						<div class="menu-conta">
							<div id="submenu-cotacoes" class="submenu">
								<div class="submenu-titulo">Minhas cotações</div>

								<div class="submenu-cotacao"><!-- uma cotacao -->
									<a href="#" class="submenu-aeronave-link fade"> <!-- link para aeronave -->
									<span class="submenu-excluir-cotacao fa fa-times" title="Excluir cotação"></span>
									<div class="submenu-cotacao-img">
										<img src="<?= $root_site; ?>/img/aeronave2.jpg">
									</div>
									<div class="submenu-cotacao-infos">
										<div class="submenu-cotacao-titulo-aeronave">Pheno 500</div>
										<div class="submenu-cotacao-velocidade-cruzeiro">Manaus <i class="fa fa-angle-right"></i> São Paulo <i class="fa fa-angle-right"></i> Manaus</div>
										<table>
											<tr>
												<td>Jato Leve</td>
												<td>9 pax</td>
												<td>4H 30min</td>
											</tr>
											<tr>
												<td><img src="<?= $root_site; ?>/img/aeronave.png"></td>
												<td><img src="<?= $root_site; ?>/img/passageiros.png"></td>
												<td><img src="<?= $root_site; ?>/img/autonomia.png"></td>
											</tr>
										</table>
									</div>
									</a>
								</div> <!-- fim uma cotacao -->

								<div class="submenu-cotacao"><!-- uma cotacao -->
									<a href="#" class="submenu-aeronave-link fade"> <!-- link para aeronave -->
									<span class="submenu-excluir-cotacao fa fa-times" title="Excluir cotação"></span>
									<div class="submenu-cotacao-img">
										<img src="<?= $root_site; ?>/img/aeronave1.jpg">
									</div>
									<div class="submenu-cotacao-infos">
										<div class="submenu-cotacao-titulo-aeronave">AirBus</div>
										<div class="submenu-cotacao-velocidade-cruzeiro">Manaus <i class="fa fa-angle-right"></i> Belém <i class="fa fa-angle-right"></i> Manaus</div>
										<table>
											<tr>
												<td>Jato Leve</td>
												<td>9 pax</td>
												<td>4H 30min</td>
											</tr>
											<tr>
												<td><img src="<?= $root_site; ?>/img/aeronave.png"></td>
												<td><img src="<?= $root_site; ?>/img/passageiros.png"></td>
												<td><img src="<?= $root_site; ?>/img/autonomia.png"></td>
											</tr>
										</table>
									</div>
									</a>
								</div> <!-- fim uma cotacao -->

								<div class="submenu-cotacoes-opcoes">
									<div class="submenu-cotacoes-opcao-esquerda">
										<a href="#">Fazer mais cotações</a>
									</div>
									<div class="submenu-cotacoes-opcao-direita">
										<a href="#">Finalizar cotações</a>
									</div>
								</div>
							</div>

							<?php if($auth->loginValido()): ?>
							<li>
								<a href="#" data-abrir-submenu="submenu-cotacoes"><span class="menu-conta-icon full"><i class="fa fa-plane"></i></span> Minhas Cotações (2) <i class="fa fa-caret-down"></i></a>
							</li>
							<li>
								<a href="<?= $root_site; ?>/sair"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Sair</a>
							</li>
							<?php else: ?>
							<li>
								<a href="javascript:abrirModal('#login_modal');"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Entrar</a>
							</li>
							<?php endif; ?>	
							
						</div>
					</ul>
				</div>
			</header>
		</div>
	</div>

	<div class="breadcrumbs">
		<div class="limite">
			<ul>
				<li><a href="<?= $root_site; ?>">Início</a></li>
				<li><a href="<?= $root_site; ?>/cadastro">Cadastro</a></li>
				<?php if($auth->loginValido()):
					if($nivel_cadastro == "informacoes-adicionais"): ?>
						<li><a href="<?= $root_site; ?>/cadastro/taxiaereo/informacoes-adicionais">Informações Adicionais</a></li>
					<?php elseif($nivel_cadastro == "adicionar-aeronaves"): ?>
						<li><a href="<?= $root_site; ?>/cadastro/taxiaereo/adicionar-aeronaves">Adicionar Aeronaves</a></li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<section class="cadastro-div">
		<div class="cadastro-tabs">
			<?php if(!$auth->loginValido()): ?>
			<ul>
				<li><a href="#cadastro-taxiaereo" class="ativo"><i class="fa fa-plane"></i>Táxi Aéreo</a></li>
				<li><a href="#privado"><i><img src="<?= $root_site; ?>/img/icone-privado.png" alt="Icone Privado"></i>Privado</a></li>
			</ul>

			<div class="cadastro-form cadastro-taxiareo">
				<h1>PREENCHA COM SEUS DADOS <span>Todos os campos são obrigatórios</span></h1>
				<form id="cadastro-taxiaereo" class="ativo">
					<label for="nome_empresa_taxiaereo" data-placeholder="Nome da empresa">
						<input type="text" name="nome_empresa_taxiaereo" id="nome_empresa_taxiaereo" class="fade">
					</label>
					<label for="gestor_taxiaereo" data-placeholder="Gestor comercial">
						<input type="text" name="gestor_taxiaereo" id="gestor_taxiaereo" class="fade">
					</label>

					<label for="cnpj_taxiaereo" data-placeholder="CNPJ">
						<input type="text" name="cnpj_taxiaereo" id="cnpj_taxiaereo" class="fade cnpj-input" placeholder="__.___.___/___-__">
					</label>

					<label for="telefone_taxiaereo" data-placeholder="Telefone">
						<input type="text" name="telefone_taxiaereo" id="telefone_taxiaereo" class="fade telefone-input" placeholder="(__) _____-____">
					</label>

					<label for="email_taxiaereo" data-placeholder="Email">
						<input type="text" name="email_taxiaereo" id="email_taxiaereo" class="fade">
					</label>
					<label for="c_email_taxiaereo" data-placeholder="Confirme seu email" data-erro="Os emails não estão de acordo.">
						<input type="text" name="c_email_taxiaereo" id="c_email_taxiaereo" class="fade">
					</label>
					<label for="senha_taxiaereo" data-placeholder="Senha">
						<input type="text" name="senha_taxiaereo" id="senha_taxiaereo" class="fade">
					</label>
					<label for="c_senha_taxiaereo" data-placeholder="Confirme sua senha" data-erro="A senhas não estão de acordo.">
						<input type="text" name="c_senha_taxiaereo" id="c_senha_taxiaereo" class="fade">
					</label>
					<div class="rodape-form-cadastro">
						<div class="rodape-form-cadastro-esquerda">
							<input type="checkbox" id="termos" name="termos">
							<label for="termos">Li e aceito os termos de adesão.</label>
						</div>
						<div class="rodape-form-cadastro-direita">
							<button type="submit">Cadastrar</button>
						</div>
					</div>

				</form>

				<form id="privado">
					<label for="nome_completo_privado" data-placeholder="Nome da completo" class="total">
						<input type="text" name="nome_completo_privado" id="nome_completo_privado" class="fade">
					</label>

					<label for="cpf_privado" data-placeholder="CPF">
						<input type="text" name="cpf_privado" id="cpf_privado" class="fade cpf-input" placeholder="___.___.___-__">
					</label>

					<label for="telefone_privado" data-placeholder="Telefone">
						<input type="text" name="telefone_privado" id="telefone_privado" class="fade telefone-input" placeholder="(__) _____-____">
					</label>

					<label for="nome_empresa_privado" data-placeholder="Nome da Empresa (opcional)">
						<input type="text" name="nome_empresa_privado" id="nome_empresa_privado" class="fade opcional">
					</label>

					<label for="cnpj_privado" data-placeholder="CNPJ (opcional)">
						<input type="text" name="cnpj_privado" id="cnpj_privado" class="fade opcional cnpj-input" placeholder="__.___.___/___-__">
					</label>

					<label for="email_privado" data-placeholder="Email">
						<input type="text" name="email_privado" id="email_privado" class="fade">
					</label>

					<label for="c_email_privado" data-placeholder="Confirme seu email" data-erro="Os emails não estão de acordo.">
						<input type="text" name="c_email_privado" id="c_email_privado" class="fade">
					</label>

					<label for="senha_privado" data-placeholder="Senha">
						<input type="text" name="senha_privado" id="senha_privado" class="fade">
					</label>

					<label for="c_senha_privado" data-placeholder="Confirme sua senha" data-erro="A senhas não estão de acordo.">
						<input type="text" name="c_senha_privado" id="c_senha_privado" class="fade">
					</label>
					<div class="rodape-form-cadastro">
						<div class="rodape-form-cadastro-esquerda">
							<input type="checkbox" id="termos_privado" name="termos_privado">
							<label for="termos_privado">Li e aceito os termos de adesão.</label>
						</div>
						<div class="rodape-form-cadastro-direita">
							<button type="submit">Cadastrar</button>
						</div>
					</div>

				</form>
				<div class="progresso-taxiaereo">
					<ul>
						<li><span class="ativo">1</span></li>
						<li><span>2</span></li>
						<li><span>3</span></li>
					</ul>
				</div>
			</div>
			<?php else: ?>
				<?php include "niveis-cadastros/$nivel_cadastro.php"; ?>
			<?php endif; ?>
		</div>
	</section>

</div>

<div class="loading">
	<img src="<?= $root_site; ?>/img/loading.gif" alt="Carregando..." />
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

<script src="<?= $root_site; ?>/js/site.js?v=<?php echo time(); ?>"></script>
<script src="<?= $root_site; ?>/js/cadastros.js?v=<?= time(); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSuXH0sCB7bgQYBa9hAo4rWbySPoelNQ&libraries=places&callback=googlemaps"></script>
</body>
</html>