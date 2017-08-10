<?php
	require_once('../lib/handler.php');
	require_once('../lib/auth.class.php');
	require_once('../lib/produto.class.php');


	$tabela_db = array('usuarios','produtos');
	define('INICIO_SITE', '../index');


	$autenticando = new Usuarios($conexao, $tabela_db[0]);
	$produtos = new Produto($conexao, $tabela_db[1]);

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
	$todas_pag = $autenticando->totalPagina(12);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuários | Cintas Nety</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="js/jquery.maskMoney.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!-- 	<link rel="stylesheet" href="js/TinyEditor/style.css" type="text/css" />
	<script src="js/TinyEditor/tiny.editor.packed.js"></script>
 -->
	<script src="js/tinymce/tinymce.min.js"></script>
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
			<li class="fade atual">
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
			 <li class="fade">
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
						<div class="widget_body widget_center"><a href="criar-usuario" class="btn_widget fade">ADICIONAR USUÁRIO</a></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Lista de usuário</div>
						<div class="widget_body padding-bottom-50">

							<table>
								<tr>
									<th>ID</th>
									<th>Nome</th>
									<th>Email</th>
									<th>Permissão</th>
									<th>Ações</th>
								</tr>
								<?php
									$lista_usuarios = $autenticando->listaUsuarios($pagina);
									foreach($lista_usuarios as $usuario_info): ?>
									<tr>
										<td><?php echo$usuario_info['id']; ?></td>
										<td><?php echo utf8_encode($usuario_info['nome']); ?></td>
										<td><?php echo$usuario_info['email']; ?></td>
										<?php #if($usuario_info['']): ?>
										<td class="usuario-nivel-<?php echo $usuario_info['id'];?>"><?php echo ($usuario_info['nivel'] == 'admin') ? "Administrador" : "Usuário"; ?></td>
										<td class="td_acoes">
										<a href="ver-usuario.php?id=<?php echo$usuario_info['id']?>" class="azul">Ver Perfil</a>
										<?php if($usuario_info['nivel'] == 'usuario'): ?>
										<a href="#" data-status-usuario="admin" data-id="<?php echo$usuario_info['id']; ?>" class="sem-ajax">Tornar administrador</a> 
										<?php else: ?>
										<a href="#" data-status-usuario="usuario" data-id="<?php echo$usuario_info['id']; ?>" class="vermelho sem-ajax">Tornar usuário</a>
										<?php endif; ?>
										</td>
									</tr>

									<?php endforeach; ?>
							</table>

							<div class="paginacao">
							<?php for($i=0; $i < $todas_pag; $i++):
								if(!isset($_GET['p'])){
									if($i+1 == 1): ?>
										<a href="usuarios.php?p=<?php echo$i+1; ?>" class="ativo"><?php echo$i+1; ?></a>
									<?php else: ?>
										<a href="usuarios.php?p=<?php echo$i+1; ?>"><?php echo$i+1; ?></a>
									<?php endif; 
									}elseif($i+1 == $_GET['p']){ ?>
										<a href="usuarios.php?p=<?php echo$i+1; ?>"  class="ativo"><?php echo$i+1; ?></a>
									<?php }else{ ?>
										<a href="usuarios.php?p=<?php echo$i+1; ?>"><?php echo$i+1; ?></a>
									<?php }
							endfor; ?>
							</div>
							
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