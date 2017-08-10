<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	// $permissao->acessoAdmin();

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
	$dadosUsuarioID = $auth->dadosUsuario($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $titulo_sistema ; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/site.css?v=<?php echo time();?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $root_sistema; ?>/css/responsive.css">
	<link rel="stylesheet" href="<?php echo $root_sistema; ?>/css/font-awesome-4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $root_sistema; ?>/css/multiple-select.css" />
	<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/jquery-2.2.3.min.js"></script>

	<script src="<?php echo $root_sistema; ?>/js/multiple-select.js?v=<?php echo time(); ?>"></script>
	<script src="<?php echo $root_sistema; ?>/js/jquery.maskMoney.min.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="<?php echo $root_sistema; ?>/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!--<link rel="stylesheet" href="<?php echo $root; ?>/js/TinyEditor/style.css" type="text/css" />
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
						<div class="widget_title">Editar Usuário</div>
						<div class="widget_body padding-bottom-50">
							<form class="widget_form" id="edit_usuario">
								<input type="text" name="id" id="id" value="<?= $dadosUsuarioID['id']; ?>">
								<div class="column-1x4 form-column">
									<label for="tipo_usuario">Tipo do Usuário</label>
									<select name="tipo_usuario" id="tipo_usuario" class="grande">
										<option value="<?= $dadosUsuarioID['tipo_usuario']; ?>"><?= strtoupper($dadosUsuarioID['tipo_usuario']); ?></option>
										<option>------</option>
										<option value="cliente">CLIENTE</option>
										<option value="taxiaereo">TAXIAEREO</option>
									</select>
								</div>
								<div class="column-1x4 form-column">
									<label for="tipo_usuario">Status da Conta</label>
									<select name="status" id="status" class="grande">
									<?php if($dadosUsuarioID['status'] == 1): ?>
									<option value="1">ATIVO</option>
									<?php elseif($dadosUsuarioID['status'] == 2): ?>
									<option value="2">DESATIVADO</option>
									<?php endif; ?>
									<option>----</option>
									<option value="1">ATIVO</option>
									<option value="2">DESATIVADO</option>
									</select>
								</div>

								<div class="column-2x4 form-column">
									<label for="nome">Usuário:</label>
									<input type="text" name="nome" id="nome" class="grande" value="<?= $dadosUsuarioID['nome']." ".$dadosUsuarioID['sobrenome']; ?>">
								</div>
								
								<div class="column-01x4 form-column">
									<label for="data_nascimento">Data do Nascimento</label>
									<input type="text" name="data_nascimento" id="data_nascimento" value="<?= $dadosUsuarioID['data_nascimento']; ?>" class="pequeno inline">
								</div>
								
								<div class="column-01x4 form-column">
									<label for="telefone">Telefone</label>
									<input type="text" name="telefone" id="telefone" class="grande" value="<?= $dadosUsuarioID['telefone']; ?>">
								</div>
								<div class="column-01x4 form-column">
									<label for="sexo">Sexo</label>
									<select name="sexo" id="sexo" class="grande inline">
										<?php if($dadosUsuarioID['sexo'] == "m"): ?>	
										<option value="m">Masculino</option>
										<?php elseif($dadosUsuarioID['sexo'] == "f"): ?>
										<option value="f">Femenino</option>
										<?php endif; ?>
										<option>----</option>
										<option value="m">Masculino</option>
										<option value="f">Femenino</option>
									</select>
								</div>

								<div class="column-01x4 form-column">
									<label for="cpf_ou_cnpj">CPF/CNPJ</label>
									<input type="text" name="cpf_ou_cnpj" id="cpf_ou_cnpj" class="grande inline" value="<?= $dadosUsuarioID['cpf_ou_cnpj']; ?>">
								</div>
								
								<div class="column-01x4 form-column">
									<label for="pais">País</label>
									<select name="pais" id="pais" class="grande inline">
										<option value="Brasil" selected>Brasil</option>
									</select>
								</div>
								
								<div class="column-001x4 form-column">
									<label for="estado">Estado</label>
									<input type="text" name="estado" id="estado" value="<?= $dadosUsuarioID['estado']; ?>" class="grande inline">
								</div>
								
								<div class="column-01x4 form-column">
									<label for="cidade">Cidade</label>
									<input type="text" name="cidade" id="cidade" value="<?= $dadosUsuarioID['cidade']; ?>" class="grande inline">
								</div>

								<div class="column-01x4 form-column">
									<label for="cep">CEP</label>
									<input type="text" name="cep" id="cep" value="<?= $dadosUsuarioID['cep']; ?>" class="grande inline">
								</div>

								<div class="column-01x4 form-column">
									<label for="bairro">Bairro</label>
									<input type="text" name="bairro" id="bairro" value="<?= $dadosUsuarioID['bairro']; ?>" class="grande inline">			
								</div>

								<div class="column-1x4 form-column">
									<label for="rua">Rua</label>
									<input type="text" name="rua" id="rua" value="<?= $dadosUsuarioID['rua']; ?>" class="grande inline">			
								</div>
								
								<div class="column-001x4 form-column">
									<label for="numero_endereco">Nº</label>
									<input type="text" name="numero_endereco" id="numero_endereco" value="<?= $dadosUsuarioID['numero_endereco']; ?>" class="grande inline">
								</div>
								
								<div class="column-11x4 form-column">
									<label for="gestor_responsavel">Gestor Responsável</label>
									<input type="text" name="gestor_responsavel" id="gestor_responsavel" value="<?= $dadosUsuarioID['gestor_responsavel']; ?>" class="grande inline">
								</div>

								<div class="column-01x4 form-column">
									<label for="banco">Banco</label>
									<input type="text" name="banco" id="banco" class="grande inline" value="<?= $dadosUsuarioID['banco']; ?>">
								</div>

								<div class="column-01x4 form-column">
									<label for="agencia">Agência</label>
									<input type="text" name="agencia" id="agencia" class="grande inline" value="<?= $dadosUsuarioID['agencia']; ?>">
								</div>

								<div class="column-01x4 form-column">
									<label for="n_conta">Nº da Conta</label>
									<input type="text" name="n_conta" id="n_conta" class="grande inline" value="<?= $dadosUsuarioID['n_conta']; ?>">
								</div>

								<div class="column-01x4 form-column">
									<label for="tipo_conta">Tipo de Conta</label>
									<select name="tipo_conta" id="tipo_conta" class="grande inline">
										<option selected>Selecione o tipo de conta</option>
										<option value="Corrente">Corrente</option>
										<option value="Poupança">Poupança</option>
									</select>
								</div>
								
								<div class="column-01x4 form-column">
									<label for="metodos_pagamento">Met. de Pagamento</label>
									<select name="metodos_pagamento" id="metodos_pagamento" class="grande inline" multiple>
									<?php 
										$metodos_pagamento = explode(",",$dadosUsuarioID['metodos_pagamento']); 
											if(in_array("Dinheiro", $metodos_pagamento)){
												echo '<option value="Dinheiro" selected>Dinheiro</option>';
											}else{
												echo '<option value="Dinheiro">Dinheiro</option>';
											}

											if(in_array("Boleto", $metodos_pagamento)){
												echo '<option value="Boleto" selected>Boleto</option>';
											}else{
												echo '<option value="Boleto">Boleto</option>';
											}			

									?>
									</select>
								</div>

								<div class="column-1x4 form-column">
									<label for="cheta">Cheta</label>
									<input type="text" name="cheta" id="cheta" class="grande inline">
								</div>
								
								<div class="column-4x4 form-column">
									<label for="email">E-Mail</label>
									<input type="text" name="email" id="email" class="grande inline" value="<?= $dadosUsuarioID['email']; ?>">
									<input type="hidden" name="senha" id="senha" class="grande" value="<?= $dadosUsuarioID['senha']; ?>">
								</div>
								
								<div class="column-4x4 form-column">
									<label for="descricao_empresa">Mensagem</label>
									<textarea name="descricao_empresa" id="descricao_empresa" cols="30" rows="10"><?= $dadosUsuarioID['descricao_empresa']; ?></textarea>
								</div>


						
								<div class="btn-form-submit">
									<div class="column-2x4 submit-left">
										
									</div>
									<div class="column-2x4 submit-right">
										<button type="submit">SALVAR</button>
									</div>
								</div>

								
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
<script>
	var root_url = "<?php echo $root_sistema; ?>";
</script>
<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/site.js?v=<?php echo time();?>"></script>
<script type="text/javascript">
	$('#metodos_pagamento').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    }); 


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