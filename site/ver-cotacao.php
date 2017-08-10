<?php

include "lib/autoload.php";
@session_start();

		$dadosCotacao 		= $cotacao->listaTokenCotacao($_GET["id"]);
     	$dadosAeronaveID    = $aeronave->listaDadosAeronave($id_logado);
	 	// $dadosAeronave 		= $aeronave->listaAeronaves($id_logado,$dados_logado['tipo_usuario']);
    	$dadosUsuario       = $auth->dadosUsuario($dadosCotacao['id_cliente']);
    	$dadosMensagem		= $mensagens->listarMensagem($dadosCotacao['id']);
    
  
    	$imagens = json_decode($dadosAeronaveID['imagens'],true);
		    	

		$info_localizacoes = json_decode($dadosCotacao['localizacoes']);

		$string_cidades = "";

		$total_locais = count($info_localizacoes->origem);
		for ($i=0; $i<$total_locais; $i++){
			if($i == $total_locais-1){
				$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil");
			}else{
				$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil")." > ";
			}
			$data_ida = $info_localizacoes->data_ida[$i];
			$hora_ida = $info_localizacoes->hora_ida[$i];

			$data_volta = $info_localizacoes->data_ida[$i];
			$hora_volta = $info_localizacoes->hora_volta[$i];

			$passageiros = $info_localizacoes->passageiros[$i];
		}

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

	<script src="<?php echo $root_sistema; ?>/js/tinymce/tinymce.min.js"></script>
  	<script>
  		tinymce.init({
			selector: 'textarea',  // change this value according to your HTML
			menubar: false,
			width: "100%"
		});

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
					<li><a href="#">Início</a></li>
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
				<div class="column-4x4">
					<div class="erro">Erro</div>
					<div class="sucesso">Sucesso</div>
				</div>
				<div class="tabela-painel">
					<table>
						<tr>
							<th colspan="2">Orçamento Completo - (<?= $_GET['token']; ?>)</th>
						</tr>
						<tr class="topo">
							<td>ID Taxiaereo: <?= $dadosCotacao['id_taxiaereo']; ?> </td>
							<td>Cotação nº <?= $dadosCotacao['id']; ?> <br><?= date("d",$dadosCotacao['data_registro'])." ".$utilitarios->mesextenco(date("m",$dadosCotacao['data_registro']))." de ".date("Y",$dadosCotacao['data_registro']); ?></td>
						</tr>
						<tr>
							<td colspan="2"><?= $dadosUsuario['descricao_empresa']; ?> </td>
						</tr>	
						<tr class="corpo">
							<td class="texto-left"><div class="left">Data/Hora (ida)</div></td>
							<td><div class="right"><?= $data_ida." - ".$hora_ida." Hrs"; ?></div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Data/Hora (volta)</div></td>
							<td><div class="right"><?= $data_volta." - ".$hora_volta." Hrs"; ?></div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Trecho solicitado</div></td>
							<td><div class="right"><?= $string_cidades; ?></div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Distância Total</div></td>
							<td><div class="right"><?= $dadosCotacao['distancia_total']; ?> m</div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Tempo de vôo Total</div></td>
							<td><div class="right"><?= $dadosCotacao['tempo_estimado_total']; ?> Hrs</div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Pernoite</div></td>
							<td><div class="right"><?= ($dadosCotacao['dias_pernoite'] <= 3) ? "SIM" : "NÃO"; ?></div></td>
						</tr>
						<tr class="corpo linha">
							<td class="texto-left"><div class="left">Aeronave - Modelo</div></td>
							<td><div class="right"><?= $dadosAeronaveID['fabricante']." - ".$dadosAeronaveID['modelo']; ?></div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Prefixo</div></td>
							<td><div class="right"><?= $dadosAeronaveID['prefixo']; ?></div></td>
						</tr>						
						<tr class="corpo">
							<td class="texto-left"><div class="left">Velocidade</div></td>
							<td><div class="right"><?= $dadosAeronaveID['velocidade']; ?> Km/H</div></td>
						</tr>	
						<tr class="corpo">
							<td class="texto-left"><div class="left">Qtd. de Passageiros</div></td>
							<td><div class="right"><?= $passageiros; ?></div></td>
						</tr>
						<tr class="corpo">
							<td class="texto-left"><div class="left">Forma de Pagamento</div></td>
							<td><div class="right"><?= $dadosCotacao['meio_pagamento']; ?></div></td>
						</tr>
						<tr class="corpo linha center">
							<td colspan="2"><span style="font-size:10px;">Para sua melhor avaliação, segue as fotos externas e internas das aeronaves</span></td>
						</tr>
						<tr class="corpo center">
							<td><img src="<?= $root_site; ?>/arquivo/<?= $imagens['imagem1']; ?>" width="379" height="177" alt=""></td>
							<td><img src="<?= $root_site; ?>/arquivo/<?= $imagens['imagem3']; ?>" width="379" height="177" alt=""></td>
						</tr>												
						<tr class="corpo center">
							<td>O valor da hora de vôo é: </td>
							<td>R$ <?= number_format($dadosAeronaveID['valor'],2,",","."); ?></td>
						</tr>
						<tr class="corpo center">
							<td>O orçamento total do vôo é: </td>
							<td>R$ <?= number_format($dadosCotacao['valor'],2,",","."); ?></td>
						</tr>							
					</table>
							<div class="btn-bloco">
								<a href="<?=$root_site; ?>/index" class="btn cinza">Voltar</a>
								<a href="#" class="btn azul sem-ajax" id="imprimir-btn">Imprimir</a>
								<a href="#"  data-status-dados="finalizado" data-id-cotacao="<?= $dadosCotacao['id']; ?>" class="btn verde">Finalizar Orçamento</a>	
								<a href="#" class="btn vermelho sem-ajax" data-exibir="msg-texto">Escrever Mensagem</a>
							</div>

							<div class="column-fundo-cinza" id="msg-texto">
								<div class="column-4x4 form-column">
								<h2>SUAS OBSERVAÇÕES</h2>
									<?php 
									if($mensagens->qtdMensagem($dadosCotacao['id']) > 0):
										foreach($dadosMensagem as $info_mensagem): 
											$tipo_usuario = ($info_mensagem['tipo_usuario'] == "cliente") ? "msg-cliente left" : "msg-taxiaereo right";
									?>
									<div class="<?= $tipo_usuario; ?>"><strong><i class="fa fa-user"></i> <?= strtoupper($info_mensagem['tipo_usuario']); ?> - <?= date("d/m/Y",$info_mensagem['data']); ?></strong> 
									<?= $info_mensagem['texto']; ?>
									</div>
									<?php 
										endforeach; 
										else:
									?>
									<p>Nenhuma mensagem enviada!</p>
									<?php endif; ?>
								</div>
								<br><br>

								<form class="widget_form" id="add_mensagem">
								<div class="form-column">
									<label for="Mensagem">Mensagem</label>
									<input type="hidden" name="id_cotacao" id="id_cotacao" value="<?= $dadosCotacao['id']; ?>">
									<input type="hidden" name="id_cliente" id="id_cliente" value="<?= $dadosUsuario['id'];?>">
									<input type="hidden" name="id_taxiaereo" id="id_taxiaereo" value="<?= $id_logado; ?>">
									<input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?= $dados_logado['tipo_usuario']; ?>">
									<textarea name="texto" id="texto" cols="30" rows="10"></textarea>
								</div>
								<div class="btn-bloco">
									<button type="submit" class="on_bottom sem-ajax">Enviar Mensagem</button>
								</div>
								</form>
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

<div class="loading">
	<img src="<?php echo $root_site; ?>/img/loading.gif" alt="Carregando..." />
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
 //    $("[data-exibir]").click(function(e){
	// 	e.preventDefault();
	// 	e.stopPropagation();
	// 	var valor_msg = $(this).data("exibir");
	// 	$("#"+valor_msg).slideDown();
	// });
</script>
</body>
</html>