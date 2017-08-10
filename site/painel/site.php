<?php
	require_once('../lib/handler.php');
	require_once('../lib/auth.class.php');
	require_once('../lib/produto.class.php');
	require_once('../lib/reserva.class.php');


	$tabela_db = array('usuarios','produtos','reservas');
	define('INICIO_SITE', '../index');


	$autenticando = new Usuarios($conexao, $tabela_db[0]);
	$produtos = new Produto($conexao, $tabela_db[1]);
	$reservas = new Reserva($conexao, $tabela_db[2]);

	session_start();

	if($autenticando->checarLogin()):
		$dados = $autenticando->dados($_SESSION['email']);
		if($dados['nivel'] != 'admin'):
			header("Location:".INICIO_SITE);
		endif;
		$nome = $dados['nome'];
	else:
			header("Location:".INICIO_SITE);
	endif;	

$pagina = (isset($_GET['p'])) ? $_GET['p'] : 1;
$todas_pag = $produtos->totalPagina(false, 12);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel Cintas Nety</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="../css/jquery.bxslider.css">
	<link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="js/jquery.maskMoney.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="../js/jquery.bxslider.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo"></div>
		<ul>
<!-- 			<li class="fade">
				<a href="#" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-newspaper-o"></i></span>
					<span class="menu_text">Notícias</span>
				</a>
			</li> -->
			<li class="fade">
				<a href="index.php" data-color-link="#C73090">
					<span class="menu_icon fade"><i class="fa fa-list-alt"></i></span>
					<span class="menu_text">Produtos</span>
				</a>
			</li>
			<li class="fade">
				<a href="usuarios.php" data-color-link="#C73090">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<li class="fade">
				<a href="reserva.php" data-color-link="#C73090">
					<span class="menu_icon fade"><i class="fa fa-shopping-basket"></i></span>
					<span class="menu_text">Reservas</span>
				</a>
			</li>
			 <li class="fade atual">
				<a href="site.php" data-color-link="#C73090">
					<span class="menu_icon fade"><i class="fa fa-globe"></i></span>
					<span class="menu_text">Site</span>
				</a>
			</li>
			<!--
			<li class="fade">
				<a href="#" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-wpforms"></i></span>
					<span class="menu_text">Relatório Financeiro</span>
				</a>
			</li>
			<li class="fade">
				<a href="ganhadores" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-star"></i></span>
					<span class="menu_text">Ganhadores</span>
				</a>
			</li> -->
			<li class="fade">
				<a href="configuracoes.php" data-color-link="#C73090">
					<span class="menu_icon"><i class="fa fa-cogs"></i></span>
					<span class="menu_text">Configurações</span>
				</a>
			</li>
		</ul>
	</div>

	<div id="body_panel">
		<div id="top_menu">
			<ul>
				<li><a id="open_menu" class="fade"><i class="fa fa-bars"></i></a></li>
				<li class="last"><a href="#" class="fade"><span class="not_responsive">Preferências</span><i class="fa fa-cogs only_responsive inline"></i></a></li>
				<li>
					<form method="GET">
						<input type="text" placeholder="Pesquisar...">
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</li>
				<li class="first last">
					<div class="notifications fade">
						<div class="notification_seta"></div>
						<ul>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-cogs"></i></div>
								<div class="notification_desc">Notificação de teste<br>Será apagada imediatamente.</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-warning"></i></div>
								<div class="notification_desc">São exibidas no máximo 5 notificações.</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-warning"></i></div>
								<div class="notification_desc">Clique em "Mostrar todas as notificações" para exibir tudo.</div>
							</li>
							<li data-link="#" class="visualized">
								<div class="notification_icon"><i class="fa fa-info-circle"></i></div>
								<div class="notification_desc">Notificações lidas são mais claras.</div>
							</li>
							<li data-link="#" class="visualized">
								<div class="notification_icon"><i class="fa fa-info-circle"></i></div>
								<div class="notification_desc">Notificações lidas são mais claras.</div>
							</li>
							<li data-link="#" class="visualized">
								Apenas para contagem.
							</li>
							<!--<span>Tudo limpo!</span>-->
						</ul>
						<a href="javascript:void(0)" class="open_all_notifications">Mostrar todas as notificações <i class="fa fa-angle-double-down"></i></a>
					</div>
					<a href="javascript:void(0)" class="open_notifications fade sem-ajax"><i class="fa fa-bell fade"></i><span class="notifications_counter"></span></a>
				</li>
			</ul>
			<ul style="float:right" class="not_responsive">
				<li><a href="#"><?php echo $nome; ?></a></li>
				<li><a href="../index.php" class="sem-ajax"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>


		<div class="container">		
			<!-- Colunas Triplas e Simples -->
			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Configurações do site</div>
						<div class="widget_body padding-bottom-50">
							<!-- <form class="widget_form" id="editar_leilao">

								<label for="valor_avaliado_leilao">Descrição do site</label>
								<textarea name="descricao" rows="3" class="grande"></textarea>

								<hr>

								<input type="checkbox" name="destaque_leilao" id="destaque_leilao" class="inline">
								<label for="destaque_leilao" class="inline">Destaque</label>
								<input type="checkbox" name="online_leilao" id="online_leilao" class="inline" checked="">
								<label for="online_leilao" class="inline">Leilão online</label>

								<button type="submit" class="absolute on_bottom">EDITAR</button>
							</form>	 -->				
							
							<form class="widget_form" id="slide_form">
								<label>Slide</label>
								<div class="slides">
									<input type="file" name="add_slide" id="add_slide" accept="image/*">
									<span class="msg_label_anexos">Você pode inserir mais de uma imagem.</span>
									<br>
									<div class="divslidebx">
										<ul id="slides_bx">
											<?php
												if($handle = opendir('../img/slide/')):
												    while(false !== ($entry = readdir($handle))):
												        if ($entry != "." && $entry != ".."): ?>

														<li class="<?php echo str_replace(".", "", $entry); ?>">
															<span class="slide-span">
																<img src="../img/slide/<?php echo $entry; ?>">
															</span>
														</li>
												<?php   endif;
												    endwhile;
												    closedir($handle);
												endif;

											?>
										</ul>
									</div>
								</div>
							</form>
							

							<!--<form class="widget_form" id="parceiro_form">
								<label>Representantes</label>
								<div class="parceiros">
									<input type="file" name="add_parceiro" id="add_parceiro" accept="image/*">
									<span class="msg_label_anexos">Você pode inserir mais de uma imagem.</span>
									<br>
									<div class="divparceirobx">
										
											<?php
												/*if($handle = opendir('../img/parceiro/')):
												    while(false !== ($entry = readdir($handle))):
												        if ($entry != "." && $entry != ".."): ?>

															
															<span class="parceiro-span">
																<div class="middle"></div>
																<img src="../img/parceiro/<?php echo $entry; ?>">
															</span>
													
												<?php   endif;
												    endwhile;
												    closedir($handle);
												endif;*/

											?>
										
									</div>		
								</div>
							</form>-->
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="mascara_branca">
	<div class="loading_circle">
		<div class="loading fade"></div>
		<div class="loading2 fade"></div>
	</div>
</div>

<script type="text/javascript" src="js/site.js"></script>
<script type="text/javascript">
var slide = $('#slides_bx').bxSlider({
	auto: true,
	pager:true,
	controls:true,
	infinityloop: true
});
</script>
</body>
</html>