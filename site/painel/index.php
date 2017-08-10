<?php
	require_once("../lib/autoload.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $titulo_sistema; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/site.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/responsive.css">
	<link rel="stylesheet" href="<?php echo $root_sistema; ?>/css/font-awesome-4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/jquery-2.2.3.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="<?php echo $root_sistema; ?>/js/jquery.maskMoney.min.js"></script>
	<script src="<?php echo $root_sistema; ?>/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo">
			<label class="logo-circle" for="img-perfil">
				<?php if($dados_logado['imagem'] != ""): ?>
				<img src="<?= $root_site;?>/arquivo/<?=$dados_logado['imagem'];?>" alt="">
				<?php else: ?>
				<img src="<?= $root_site;?>/arquivo/persona.png" alt="">
				<?php endif; ?>
			</label>
			<form id="form-img-perfil">
				<input type="hidden" value="<?= $id_logado;?>" id="id_usuario" name="id_usuario">
				<input type="file" id="img-perfil" name="img-perfil">
			</form>
			<div class="painel-nome-perfil">
				<h2><?php echo $dados_logado['nome']." ".$dados_logado['sobrenome']; ?></h2>
				<a href="#" class="editar-perfil">Editar Perfil</a>
			</div>
		</div>
		<ul>
			<li class="fade">
				<a href="<?php echo $root_sistema; ?>" data-color-link="#A1A1A1">
					<span class="menu_icon"><i class="fa fa-home"></i></span>
					<span class="menu_text">Início</span>
				</a>
			</li> 			
			<li class="fade">
				<a href="<?php echo $root_sistema; ?>" data-color-link="#A1A1A1">
					<span class="menu_icon fade"><i class="fa fa-list-alt"></i></span>
					<span class="menu_text">Minhas Cotações</span>
				</a>
			</li>
			<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
			<li class="fade">
				<a href="<?php echo $root_sistema; ?>/usuarios/index" data-color-link="#A1A1A1">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<?php endif; ?>
			<li class="fade">
				<a href="<?php echo $root_sistema; ?>/aeronaves/index" data-color-link="#A1A1A1">
					<span class="menu_icon fade"><i class="fa fa-plane"></i></span>
					<span class="menu_text">Aeronaves</span>
				</a>
			</li>
			 <li class="fade">
				<a href="<?php echo $root_sistema; ?>/site/index" data-color-link="#A1A1A1">
					<span class="menu_icon fade"><i class="fa fa-globe"></i></span>
					<span class="menu_text">Site</span>
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
				<li><a href="#"><?php echo $dados_logado['nome']." ".$dados_logado['sobrenome']; ?></a></li>
				<li>
					<a href="javascript:openSubmenu()" class="sem-ajax"><i class="fa fa-caret-down"></i></a>
					<div class="submenu-options fade">
						<a href="../index.php" class="sem-ajax fade" target="_blank">Ver Site</a>
						<a href="#" class="sem-ajax fade">Meu Perfil</a>
						<a href="<?= $root_site; ?>/sair" class="sem-ajax fade">Sair</a>
					</div>
				</li>
			</ul>
		</div>


		<div class="container">		
			<div class="row">
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Minhas Cotações</div>
						<div class="widget_body main_counts positive">
							<!-- <div class="main_counts_icon"><i class="fa fa-shopping-basket"></i></div> -->
							<div class="widget-number-count"><a href="<?php echo $root_sistema; ?>/cotacoes/index"><?= $cotacao->qtdCotacaoToken($id_logado,$dados_logado['tipo_usuario'],'ok'); ?> cotações</a></div>
						</div>
					</div>
				</div>
				<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Usuários</div>
						<div class="widget_body main_counts positive">
							<!-- <div class="main_counts_icon"><i class="fa fa-shopping-basket"></i></div> -->
							<div class="widget-number-count"><a href="<?php echo $root_sistema; ?>/usuarios/index"><?= $auth->qtdUsuarios(); ?> usuários</a></div>
						</div>
					</div>
				</div>
				<?php endif;?>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Aeronaves</div>
						<div class="widget_body main_counts positive">
							<!-- <div class="main_counts_icon"><i class="fa fa-shopping-basket"></i></div> -->
							<div class="widget-number-count"><a href="<?php echo $root_sistema; ?>/aeronaves/index"><?= $aeronave->qtdAeronaves($id_logado,$dados_logado['tipo_usuario']); ?> aeronaves</a></div>
						</div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Relatório</div>
						<div class="widget_body">
							<!-- <div class="main_counts_icon"><i class="fa fa-shopping-basket"></i></div> -->
							<div class="widget_body widget_center"><a href="<?php echo $root_sistema; ?>/relatorio/index" class="btn_widget azul fade">VER RELATÓRIO</a></div>
						</div>
					</div>
				</div>								


			</div>
		
			<div class="row">
				<div class="column-2x4">
					<div class="widget">
						<div class="widget_title">Lista de cotações</div>
						<div class="widget_body widget_cotacoes">
							<table class="tabela1-painel">
								<tr>
									<th>Nome</th>
									<th>Token</th>
									<th>Data</th>
								</tr>
								<?php 
								//Listagem de cotações do administrador (CORRIGIR)
									if($dados_logado['tipo_usuario'] == "admin"):
										foreach($cotacao->listarToken($id_logado=false, $dados_logado['tipo_usuario']) as $dadosCotacao): 
											$info_token = $cotacao->infoToken($dadosCotacao['token']);
											$usuario_token = $auth->dadosUsuario($info_token['id_cliente']);
									
								?>
								<tr data-token="<?= $info_token['token']; ?>">
									<td><?= $usuario_token['nome']." ".$usuario_token['sobrenome']; ?></td>
									<td><?= $info_token['token']; ?></td>
									<td><?= date('d/m/Y H:i', $info_token['data_registro']); ?></td>
								</tr>
								<?php 
										endforeach; 
									endif;
								?>

								<?php
 									if($cotacao->qtdCotacaoToken($id_logado,$dados_logado['tipo_usuario'],'ok') != 0):									
										foreach($cotacao->listarToken($id_logado, $dados_logado['tipo_usuario'],'ok') as $dadosCotacao): 
											$info_token = $cotacao->infoToken($dadosCotacao['token']);
											$usuario_token = $auth->dadosUsuario($info_token['id_cliente']);
								?>
								<tr data-token="<?= $info_token['token']; ?>">
									<td><?= $usuario_token['nome']." ".$usuario_token['sobrenome']; ?></td>
									<td><?= $info_token['token']; ?></td>
									<td><?= date('d/m/Y H:i', $info_token['data_registro']); ?></td>
								</tr>
								<?php	
										endforeach;
 								else:
								?>
							 	<tr>
									<td colspan="3">Caixa de cotações vazia</td>
								</tr> 
								<?php 
 								endif;
								?>

							</table>
						</div>
					</div>
				</div>

				<div class="column-2x4">
					<div class="widget" id="info_token">
						<div class="widget_title"></div>
						<div class="widget_body">
							
						</div>
					</div>
				</div>
			</div>







		</div>
	</div>

</div>


<div class="loading">
	<img src="<?php echo $root_site; ?>/img/loading.gif" alt="Carregando..." />
</div>
<script>
	var root_url = "<?php echo $root_sistema; ?>";
</script>
<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/site.js?v=<?php echo time(); ?>"></script>
</body>
</html>