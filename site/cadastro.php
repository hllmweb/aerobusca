<?php

require_once "lib/autoload.php";
@session_start();

if($auth->loginValido()){
	header("Location: index.php");
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
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
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
<div class="header-espaco">
	<div class="header-fixo">
		<header class="menu-header">
			<div class="limite">
				<div class="logo">
					<a href="index.php"><img src="img/logo.png" alt="Aerobusca"></a>
				</div>
				<ul>
					<li><a href="<?= $root_site; ?>/index">Início</a></li>
					<li><a href="#">Serviços</a></li>
					<li><a href="#">Contato</a></li>
					<?php if(!$auth->loginValido()): ?>
					<li><a href="cadastro">Cadastro</a></li>
					<?php endif; ?>
					<div class="menu-conta">
						<div id="submenu-cotacoes" class="submenu">
							<div class="submenu-titulo">Minhas cotações</div>

							<div class="submenu-cotacao"><!-- uma cotacao -->
								<a href="#" class="submenu-aeronave-link fade"> <!-- link para aeronave -->
								<span class="submenu-excluir-cotacao fa fa-times" title="Excluir cotação"></span>
								<div class="submenu-cotacao-img">
									<img src="img/aeronave2.jpg">
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
											<td><img src="img/aeronave.png"></td>
											<td><img src="img/passageiros.png"></td>
											<td><img src="img/autonomia.png"></td>
										</tr>
									</table>
								</div>
								</a>
							</div> <!-- fim uma cotacao -->

							<div class="submenu-cotacao"><!-- uma cotacao -->
								<a href="#" class="submenu-aeronave-link fade"> <!-- link para aeronave -->
								<span class="submenu-excluir-cotacao fa fa-times" title="Excluir cotação"></span>
								<div class="submenu-cotacao-img">
									<img src="img/aeronave1.jpg">
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
											<td><img src="img/aeronave.png"></td>
											<td><img src="img/passageiros.png"></td>
											<td><img src="img/autonomia.png"></td>
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
							<a href="sair"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Sair</a>
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

		<div class="breadcrumbs">
			<div class="limite">
				<ul>
					<li><a href="<?= $root_site; ?>">Início</a></li>
					<li><a href="<?= $root_site; ?>/cadastro">Cadastro</a></li>
				</ul>
			</div>
		</div>

		<section class="cadastro-div">
			<div class="cadastro-tabs">
				<ul>
					<li><a href="#cadastro_cliente" class="ativo"><i class="fa fa-user"></i>Cliente</a></li>
					<li><a href="#cadastro_empresa"><i class="fa fa-id-badge"></i>Empresa</a></li>
					<li><a href="#cadastro_agente"><i class="fa fa-address-card-o"></i>Agente</a></li>
				</ul>

				<div class="cadastro-form">
					<h1>PREENCHA SEUS DADOS <span>Todos os campos são obrigatórios</span></h1>

					<!-- Formulário de cadastro para clientes -->
					<form id="cadastro_cliente" class="ativo">
						<input type="hidden" name="tipo_cadastro" value="cliente">

						<label for="nome_cliente" data-placeholder="Nome">
							<input type="text" name="nome_cliente" id="nome_cliente" autocomplete="off">
						</label>
						<label for="sobrenome_cliente" data-placeholder="Sobrenome">
							<input type="text" name="sobrenome_cliente" id="sobrenome_cliente" autocomplete="off">
						</label>

						<label for="nascimento_cliente" data-placeholder="Data de Nascimento">
							<input type="text" name="nascimento_cliente" id="nascimento_cliente" class="data-input" placeholder="__/__/__" autocomplete="off">
						</label>
						<label data-placeholder="Sexo">
							<input type="radio" name="sexo_cliente" value="mas" id="masculino" checked>
							<label for="masculino">Masculino</label>
							<input type="radio" name="sexo_cliente" value="fem" id="feminino">
							<label for="feminino">Feminino</label>
						</label>

						<label for="cpf_cliente" data-placeholder="CPF">
							<input type="text" name="cpf_cliente" id="cpf_cliente" placeholder="___.___.___-__" class="cpf-input" autocomplete="off">
						</label>

						<label for="telefone_cliente" data-placeholder="Telefone">
							<input type="text" name="telefone_cliente" id="telefone_cliente" placeholder="(__) _____-____" class="telefone-input" autocomplete="off">
						</label>

						<label for="email_cliente" data-placeholder="Email">
							<input type="text" name="email_cliente" id="email_cliente" autocomplete="off">
						</label>

						<label for="c_email_cliente" data-placeholder="Confirme seu email" data-erro="Os emails não estão de acordo.">
							<input type="text" name="c_email_cliente" id="c_email_cliente" autocomplete="off">
						</label>

						<label for="senha_cliente" data-placeholder="Senha">
							<input type="text" name="senha_cliente" id="senha_cliente" autocomplete="off">
						</label>

						<label for="c_senha_cliente" data-placeholder="Confirme sua senha" data-erro="A senhas não estão de acordo.">
							<input type="text" name="c_senha_cliente" id="c_senha_cliente" autocomplete="off">
						</label>
						
						<div class="rodape-form-cadastro">
							<div class="rodape-form-cadastro-esquerda">
								<input type="checkbox" id="receber_emails_cliente" name="receber_emails_cliente">
								<label for="receber_emails_cliente">Ao preencher os campos, você receberá as promoções e descontos do Aerobusca.</label>
							</div>
							<div class="rodape-form-cadastro-direita">
								<button type="submit">Cadastrar</button>
							</div>
						</div>

					</form>

					<!-- Formulário de cadastro para empresas -->
					<form id="cadastro_empresa">
						<input type="hidden" name="tipo_cadastro" value="empresa">

						<label for="nome_empresa" data-placeholder="Nome da empresa" class="total">
							<input type="text" name="nome_empresa" id="nome_empresa">
						</label>
						<label for="pais_empresa">
							<select name="pais_empresa" id="pais_empresa">
								<option selected="" disabled="">País</option>
								<option value="BR">Brasil</option>
							</select>
						</label>
						<label for="cnpj_empresa" data-placeholder="CNPJ">
							<input type="text" name="cnpj_empresa" id="cnpj_empresa" class="cnpj-input" placeholder="__.___.___/___-__">
						</label>
						<label for="gestor_empresa" data-placeholder="Gestor Responsável">
							<input type="text" name="gestor_empresa" id="gestor_empresa">
						</label>

						<label for="telefone_empresa" data-placeholder="Telefone">
							<input type="text" name="telefone_empresa" id="telefone_empresa" class="telefone-input" placeholder="(__) _____-____">
						</label>

						<label for="email_empresa" data-placeholder="Email">
							<input type="text" name="email_empresa" id="email_empresa">
						</label>

						<label for="c_email_empresa" data-placeholder="Confirme seu email" data-erro="Os emails não estão de acordo.">
							<input type="text" name="c_email_empresa" id="c_email_empresa">
						</label>

						<label for="senha_empresa" data-placeholder="Senha">
							<input type="text" name="senha_empresa" id="senha_empresa">
						</label>

						<label for="c_senha_empresa" data-placeholder="Confirme sua senha" data-erro="A senhas não estão de acordo.">
							<input type="text" name="c_senha_empresa" id="c_senha_empresa">
						</label>
						
						<div class="rodape-form-cadastro">
							<div class="rodape-form-cadastro-esquerda">
								<input type="checkbox" id="receber_emails" name="receber_emails">
								<label for="receber_emails">Ao preencher os campos, você receberá as promoções e descontos do Aerobusca.</label>
							</div>
							<div class="rodape-form-cadastro-direita">
								<button type="submit">Cadastrar</button>
							</div>
						</div>

					</form>

					<!-- Formulário de cadastro para agente -->
					<form id="cadastro_agente">
						<input type="hidden" name="tipo_cadastro" value="agente">

						<label for="nome_agente" data-placeholder="Nome">
							<input type="text" name="nome_agente" id="nome_agente">
						</label>
						<label for="sobrenome_agente" data-placeholder="Sobrenome">
							<input type="text" name="sobrenome_agente" id="sobrenome_agente">
						</label>
						<label for="cpf_agente" data-placeholder="CPF">
							<input type="text" name="cpf_agente" id="cpf_agente" class="cpf-input" placeholder="___.___.___-__">
						</label>

						<label for="telefone_agente" data-placeholder="Telefone">
							<input type="text" name="telefone_agente" id="telefone_agente" class="telefone-input" placeholder="(__) _____-____">
						</label>

						<label for="banco_agente">
							<select name="banco_agente" id="banco_agente">
								<option selected="" disabled="">Banco</option>
								<option value="Bradesco S/A">Bradesco S/A</option>
								<option value="Banco do Brasil">Banco do Brasil</option>
								<option value="Caixa Econômica">Caixa Econômica</option>
								<option value="Santander">Santander</option>
							</select>
						</label>

						<label for="agencia_agente" data-placeholder="Agência">
							<input type="text" name="agencia_agente" id="agencia_agente">
						</label>

						<label for="n_conta_agente" data-placeholder="Número da Conta">
							<input type="text" name="n_conta_agente" id="n_conta_agente">
						</label>

						<label for="tipo_conta_agente">
							<select name="tipo_conta_agente" id="tipo_conta_agente">
								<option selected="" disabled="">Tipo da conta</option>
								<option value="c">Conta Corrente</option>
								<option value="p">Conta Poupança</option>
							</select>
						</label>

						<label for="email_agente" data-placeholder="Email">
							<input type="text" name="email_agente" id="email_agente">
						</label>

						<label for="c_email_agente" data-placeholder="Confirme seu email" data-erro="Os emails não estão de acordo.">
							<input type="text" name="c_email_agente" id="c_email_agente">
						</label>

						<label for="senha_agente" data-placeholder="Senha">
							<input type="text" name="senha_agente" id="senha_agente">
						</label>

						<label for="c_senha_agente" data-placeholder="Confirme sua senha" data-erro="A senhas não estão de acordo.">
							<input type="text" name="c_senha_agente" id="c_senha_agente">
						</label>
						
						<div class="rodape-form-cadastro">
							<div class="rodape-form-cadastro-esquerda">
								<input type="checkbox" id="receber_emails" name="receber_emails">
								<label for="receber_emails">Ao preencher os campos, você receberá as promoções e descontos do Aerobusca.</label>
							</div>
							<div class="rodape-form-cadastro-direita">
								<button type="submit">Cadastrar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</section>

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

<script src="<?= $root_site; ?>/js/site.js?v=<?= time(); ?>"></script>
<script src="<?= $root_site; ?>/js/cadastros.js?v=<?= time(); ?>"></script>
</body>
</html>