<?php
	require_once('../lib/handler.php');
	require_once('../lib/auth.class.php');
	require_once('../lib/produto.class.php');
	require_once('../lib/reserva.class.php');

	$tabela_db = array('usuarios','produtos', 'reservas');
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
	$todas_pag = $autenticando->totalPagina(12);


	$exibeUsuario = $reservas->usuarioSelecionado($_GET['token']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ver Reserva | AGM Distribuidora</title>
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
			<li class="fade">
				<a href="usuarios.php" data-color-link="#0A710A">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<li class="fade atual">
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
				<div class="column-4x4">
					<div class="erro">Erro</div>
					<div class="sucesso">Sucesso</div>
				</div>
			</div>

			<div class="row">
				<div class="column-2x4">
					<div class="widget">
						<div class="widget_title">Usuário</div>
						<div class="widget_body">
							<div class="perfil">
								<div class="nome-perfil"><i class="fa fa-user"></i> <a href="ver-usuario.php?id=<?php echo $exibeUsuario['id_usuario']; ?>"><?php echo utf8_encode($exibeUsuario['nome']);?></a><a href="ver-usuario.php?id=<?php echo $exibeUsuario['id_usuario']; ?>" class="btn azul">Ver Perfil</a></div>
								<!-- <div class="tipo-usuario">Pessoa física</div> -->
								<div class="data-cadastro">Reserva cadastrada no dia <?php echo date("d/m/Y H:i", $exibeUsuario['registrar_data']);?> - Token: <span class="vermelho"><?php echo $_GET['token'];?></span></div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Status de Reservas</div>
						<div class="widget_body widget_center">
							<?php if($exibeUsuario['status'] == 'aberto'): ?>
							<a href="#" data-status="fechado" data-token="<?php echo $_GET['token'];?>" class="btn_widget vermelho sem-ajax">Encerrar</a>
							<?php else: ?>
							<a href="#" data-status="aberto" data-token="<?php echo $_GET['token'];?>" class="btn_widget sem-ajax">Abrir</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Total de Reservas</div>
						<div class="widget_body main_counts positive">
							<div class="main_counts_icon"><i class="fa fa-shopping-basket"></i></div>
							<span class="main_counts_name"><?php echo $reservas->totalReservaToken($_GET['token']); ?> reservas</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column-2x4">
					
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

				<div class="column-2x4">
					<div class="widget">
						<div class="widget_title">Lista de produtos	</div>
						<div class="widget_body">
							<div class="leiloes-perfil">
								<table>
									<tr>
										<th>Codigo</th>
										<th>Produto</th>
										<th>Cor</th>
										<th>Qtd.</th>
										<!-- <th>Ações</th> -->
									</tr>
									<?php
											
											$lista_reservasGeral = $reservas->listaReservaGeral($_GET['token'],false);
											foreach($lista_reservasGeral as $listaReservaDados):
									?>
									<tr>
										<td><?php echo $listaReservaDados['codigo']?></td>
										<td><?php echo $listaReservaDados['titulo_prod']; ?></td>
										<?php 
											if($listaReservaDados['cor'] != ""):
										?>
										<td><?php echo $listaReservaDados['cor']; ?></td>
										<?php else: ?>
										<td>N/</td>
										<?php endif;?>
										<td><?php echo $listaReservaDados['qtd']; ?></td>
										<!-- <td class="td_acoes">
											<a href="#">Ver</a>
										</td> -->
									</tr>
									<?php endforeach; ?>
								</table>
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