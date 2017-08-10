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

	$usuarioDados = $autenticando->listaUsuario($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ver Usuário | AGM Distribuidora</title>
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
				<a href="index.php" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-list-alt"></i></span>
					<span class="menu_text">Produtos</span>
				</a>
			</li>
			<li class="fade atual">
				<a href="usuarios.php" data-color-link="#0A710A">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<li class="fade">
				<a href="reserva.php" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-shopping-basket"></i></span>
					<span class="menu_text">Reservas</span>
				</a>
			</li>
			 <li class="fade">
				<a href="site.php" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-globe"></i></span>
					<span class="menu_text">Site</span>
				</a>
			</li>				
			<!-- <li class="fade">
				<a href="#" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-dollar"></i></span>
					<span class="menu_text">Prestação de Contas</span>
				</a>
			</li>
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
				<a href="configuracoes.php" data-color-link="#0A710A">
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
				<div class="column-3x4">
					<div class="erro">Erro</div>
					<div class="sucesso">Sucesso</div>
				</div>
			</div>

			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Ver Usuário</div>
						<div class="widget_body">

							<div class="perfil">
								<div class="nome-perfil"><i class="fa fa-user"></i> <?php echo utf8_encode($usuarioDados['nome']);?><a href="editar-usuario.php?id=<?php echo $usuarioDados['id']; ?>" class="btn azul">Editar Perfil</a></div>
								<!-- <div class="tipo-usuario">Pessoa física</div> -->
								<div class="data-cadastro">
								<p>Telefone: <?php echo $usuarioDados['telefone']; ?></p>
								<p>E-Mail: <?php echo $usuarioDados['email']; ?></p>
								<p>Nível: <?php echo ($usuarioDados['nivel'] == 'admin') ? "Administrador" : "Usuário"; ?></p>
								<p>Cadastrado no dia <?php echo date("d/m/Y h:i", $usuarioDados['data_registro']); ?></p>


								</div>
							</div>
							
						</div>
					</div>
				</div>

<!-- 				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Participações</div>
						<div class="widget_body main_counts positive">
							<div class="main_counts_icon"><i class="fa fa-legal"></i></div>
							<span class="main_counts_name">4 leilões</span>
						</div>
					</div>
				</div> -->
			</div>

			<div class="row">
				<div class="column-4x4">
<!-- 					<div class="widget">
						<div class="widget_title">Ações</div>
						<div class="widget_body">
							<div class="acoes-perfil">
								<a href="#" class="btn_widget fade">DESABILITAR</a>
								<a href="#" class="btn_widget vermelho fade">EXCLUIR DEFINITIVAMENTE</a>
							</div>
						</div>
					</div> -->

					<div class="widget">
						<div class="widget_title">Enviar email</div>
						<div class="widget_body">
							<form class="widget_form email_para_usuario" id="email_usuario">
								<label for="email-assunto">Assunto</label>
								<input name="email-assunto" id="email-assunto" class="grande">

								<label for="email-mensagem">Mensagem</label>
								<textarea name="email-mensagem" id="email-mensagem" class="grande" rows="10"></textarea>
								<button type="submit">Enviar</button>
							</form>
						</div>
					</div>
				</div>

				<!-- <div class="column-2x4">
					<div class="widget">
						<div class="widget_title">Leilões</div>
						<div class="widget_body">
							<div class="leiloes-perfil">
								<table>
									<tr>
										<th>ID</th>
										<th>Lote</th>
										<th>Nome</th>
										<th>Maior lance</th>
										<th>Ações</th>
									</tr>
									<tr>
										<td>50</td>
										<td>300</td>
										<td><span class="descricao_leilao_td">LEILAO SIJBDAS KHBDHKASBJ</span></td>
										<td>R$ 10.000,00</td>
										<td class="td_acoes">
											<a href="#">Ver</a>
										</td>
									</tr>
									<tr>
										<td>52</td>
										<td>305</td>
										<td><span class="descricao_leilao_td">LEILAO dois</span></td>
										<td>R$ 10.200,00</td>
										<td class="td_acoes">
											<a href="#">Ver</a>
										</td>
									</tr>
									<tr>
										<td>53</td>
										<td>100</td>
										<td><span class="descricao_leilao_td">LEILAO 3</span></td>
										<td>R$ 600,00</td>
										<td class="td_acoes">
											<a href="#">Ver</a>
										</td>
									</tr>
									<tr>
										<td>74</td>
										<td>365</td>
										<td><span class="descricao_leilao_td">LEILAO four</span></td>
										<td>R$ 5.000,00</td>
										<td class="td_acoes">
											<a href="#">Ver</a>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div> -->
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