<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	$permissao->acessoAdmin();
	// require_once('../lib/handler.php');
	// require_once('../lib/auth.class.php');
	// require_once('../lib/produto.class.php');


	// $tabela_db = array('usuarios','produtos');
	// define('INICIO_SITE', '../index');


	// $autenticando = new Usuarios($conexao, $tabela_db[0]);
	// $produtos = new Produto($conexao, $tabela_db[1]);

	// session_start();

	// if($autenticando->checarLogin()):
	// 	$dados = $autenticando->dados($_SESSION['email']);
	// 	if($dados['nivel'] != 'admin'):
	// 		header("Location:".INICIO_SITE);
	// 	endif;
	// 	$nome = $dados['nome'];
	// else:
	// 		header("Location:".INICIO_SITE);
	// endif;	

	// $pagina = (isset($_GET['p'])) ? $_GET['p'] : 1;
	// $todas_pag = $autenticando->totalPagina(12);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $titulo_sistema ; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/site.css?v=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/responsive.css">
	<link rel="stylesheet" href="<?php echo $root_sistema; ?>/css/font-awesome-4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/jquery-2.2.3.min.js"></script>
	<script src="<?php echo $root_sistema; ?>/js/jquery.maskMoney.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="<?php echo $root_sistema; ?>/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!-- 	<link rel="stylesheet" href="<?php echo $root; ?>/js/TinyEditor/style.css" type="text/css" />
	<script src="<?php echo $root; ?>/js/TinyEditor/tiny.editor.packed.js"></script>
 -->
	<script src="<?php echo $root_sistema; ?>/js/tinymce/tinymce.min.js"></script>
  	<script>
  		tinymce.init({
			selector: 'textarea',  // change this value according to your HTML
			menubar: false
		});
  	</script>
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo">
			<label class="logo-circle" for="img-perfil"><img src="<?= $root_site;?>/arquivo/<?=$dados_logado['imagem'];?>" alt=""></label>
			<form id="form-img-perfil">
				<input type="hidden" value="<?= $id_logado;?>" id="id_usuario" name="id_usuario">
				<input type="file" id="img-perfil" name="img-perfil">
			</form>
			<h2><?php echo $dados_logado['nome']." ".$dados_logado['sobrenome']; ?></h2>
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
					<span class="menu_text">Cotação</span>
				</a>
			</li> 
			<li class="fade atual">
				<a href="<?php echo $root_sistema; ?>/usuarios/index" data-color-link="#A1A1A1">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
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
			</li> 
			<li class="fade">
				<a href="configuracoes.php" data-color-link="#476dab">
					<span class="menu_icon"><i class="fa fa-cogs"></i></span>
					<span class="menu_text">Configurações</span>
				</a>
			</li>-->
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
				<div class="column-4x4">
					<div class="erro">Erro</div>
					<div class="sucesso">Sucesso</div>
				</div>
			</div>

			<div class="row">
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Novo Usuário</div>
						<div class="widget_body widget_center"><a href="adicionar-usuario" class="btn_widget verde fade">ADICIONAR USUÁRIO</a></div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Quantidade de Usuários</div>
						<div class="widget_body main_counts positive">
							<div class="widget-number-count"><a href="">150 usuários</a></div>
						</div>
					</div>
				</div>					
			</div>

			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Novo Usuário</div>
						<div class="widget_body padding-bottom-50">
							<form class="widget_form" id="add_usuario" enctype="multipart/form-data">
								
								<label for="nome">Usuário:</label>
								<input type="text" name="nome" id="nome" class="grande" required="">

								<label for="telefone">Telefone:</label>
								<input type="text" name="telefone" id="telefone" class="grande" required="">

								<label for="email">E-Mail:</label>
								<input type="text" name="email" id="email" class="grande" required="">

								<label for="senha">Senha</label>
								<input type="text" name="senha" id="senha" class="grande" required="">

								<label for="nivel">Nível</label>
								<select name="nivel" id="nivel" class="pequeno">
									<option value="" disabled="" selected="selected">Selecione o nível de permissão</option>
									<option value="admin">Administrador</option>
									<option value="usuario">Usuário</option>
								</select>
								<br><br>

								<button type="submit" class="absolute on_bottom">SALVAR</button>
							</form>
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
<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/site.js?v=<?php echo time();?>"></script>
<script type="text/javascript">


	// var editor = new TINY.editor.edit('editor', {
	// 	id: 'descricao_leilao',
	// 	width: 600,
	// 	height: 175,
	// 	cssclass: 'tinyeditor',
	// 	controlclass: 'tinyeditor-control',
	// 	rowclass: 'tinyeditor-header',
	// 	dividerclass: 'tinyeditor-divider',
	// 	controls: ['bold', 'italic', 'underline', 'strikethrough', '|',
	// 		'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
	// 		'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
	// 		'image', 'hr', 'link', 'unlink', '|'],
	// 	footer: false,
	// 	xhtml: true,
	// 	bodyid: 'editor',
	// 	footerclass: 'tinyeditor-footer',
	// 	toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
	// 	resize: {cssclass: 'resize'}
	// });
	
</script>
</body>
</html>