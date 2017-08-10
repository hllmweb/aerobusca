<?php

include "lib/autoload.php";
@session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $dados_logado['nome']." ".$dados_logado['sobrenome']; ?></title>

	<link rel="stylesheet" href="<?= $root_site; ?>/css/site.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/jquery.bxslider.css">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.maskMoney.min.js"></script>

	<script>
		var root_url = "<?= $root_site; ?>";
		var token_cotacao = "<?= $token; ?>";

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
<!-- <div class="header-espaco"> -->
		<header class="menu-header">
			<div class="limite">
				<div class="logo">
					<a href="<?= $root_site; ?>"><img src="<?= $root_site; ?>/img/logo.png" alt="Aerobusca"></a>
				</div>
				<ul>
					<li><a href="index">Início</a></li>
					<li><a href="#">Serviços</a></li>
					<?php if(!$auth->loginValido()): ?>
					<li><a href="<?= $root_site; ?>/cadastro">Cadastro</a></li>
					<?php else: ?>
					<li><a href="<?= $root_site; ?>/sair">Sair</a></li>
					<?php endif; ?>
					<div class="menu-conta">
						<div id="submenu-cotacoes" class="submenu">
							<div class="submenu-titulo">Minhas cotações</div>

							<div id="loadcotacoes">
							</div>

							<div class="loading-cotacoes">
								<i class="fa fa-spinner fa-pulse"></i>
							</div>

							<div class="submenu-cotacoes-opcoes">
								<div class="submenu-cotacoes-opcao-esquerda">
									<a href="#">Fazer mais cotações</a>
								</div>
								<div class="submenu-cotacoes-opcao-direita">
									<a href="<?= $root_site; ?>/cotacao-finalizada">Finalizar cotações</a>
								</div>
							</div>
						</div>

						<?php if($auth->loginValido()): ?>
							<?php if($dados_logado['tipo_usuario'] == "admin" || $dados_logado == "taxiaereo"): ?>
								<li><a href="<?= $root_sistema; ?>">Painel de controle</a></li>
							<?php else: ?>
								<li>
									<a href="#" data-abrir-submenu="submenu-cotacoes"><span class="menu-conta-icon full"><i class="fa fa-plane"></i></span> Minhas Cotações (<span id="cont_cotacoes"><?= $cotacao->contaCarrinho($token); ?></span>) <i class="fa fa-caret-down"></i></a>
								</li>
								<li>
									<a href="<?= $root_site; ?>/minha-conta"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Minha Conta</a>
								</li>
							<?php endif; ?>
						<?php else: ?>
							<li>
								<a href="javascript:abrirModal('#login_modal');"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Entrar</a>
							</li>
						
						<?php endif; ?>
						
					</div>
				</ul>
			</div>
		</header>
	<!-- </div> -->

	<div class="limite">					

		<div id="conta-wrapper">

			<div class="menu-minha-conta">
				<ul>
					<li><a href="<?= $root_site; ?>/minha-conta">Minhas Cotações</a></li>
					<li><a href="#">Mensagens</a></li>
					<li><a href="<?= $root_site; ?>/sair">Sair</a></li>
				</ul>
			</div>

			<div class="conteudo-minha-conta">
				<div class="tabela-orcamentos">
					<table>
						<tr>
							<th>Token da cotação</th>
							<th>Data da cotação</th>
						</tr>
						<?php
							$lista = $cotacao->listarToken($id_logado, $dados_logado['tipo_usuario']);
							echo $id_logado;
							foreach($lista as $token_lista):
								$info_token = $cotacao->infoToken($token_lista['token']);

						?>
						<tr data-token="<?= $info_token['token']; ?>">
							<td><?= $info_token['token']; ?></td>
							<td><?= date("d/m/Y", $info_token['data_registro']); ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>

				<div class="conteudo-cotacoes" id="info_token">
					<div class="widget_title"></div>
					<div class="widget_body">
							<p><i class="fa fa-times"></i> Nenhuma cotação selecionada</p>
					</div>
					
				</div>

			</div>
		</div>
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
<script src="<?= $root_site; ?>/js/busca_aeronave.js?v=<?= time(); ?>"></script>
<script>
	slide_aeronave = $("#slide-cotacao").bxSlider({
    	mode: "horizontal",
    	auto: false,
    	nextText: "<i class=\"fa fa-angle-right\"></i>",
    	prevText: "<i class=\"fa fa-angle-left\"></i>"
    });
</script>
</body>
</html>