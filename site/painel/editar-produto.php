<?php
// require_once "instancia.php";
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

	$id_produto = (isset($_GET['id'])) ? $_GET['id'] : false;
	$dados_info = $produtos->infoProduto($id_produto);


// if($id_leilao == false){
// 	header("Location: index.php");
// }

// $leilao_info = $leilao->infoLeilao($id_leilao);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Produto | AGM Distribuidora</title>
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
			<li class="fade atual">
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
				<div class="column-3x4">
					<div class="widget">
						<div class="widget_title">Editar Produto</div>
						<div class="widget_body padding-bottom-50">
							<form class="widget_form" id="editar_produto">
								<input type="hidden" name="id" value="<?php echo$id_produto; ?>">
								
								<label for="codigo">Codigo</label>
								<input type="text" name="codigo" id="codigo" class="grande" value="<?php echo $dados_info['codigo']; ?>" required="">

								<label for="fabricante">Fabricante</label>
								<select name="fabricante" id="fabricante" class="grande">
									<option value="<?php echo $dados_info['fabricante']; ?>" selected="selected"><?php echo $dados_info['fabricante']; ?></option>
									<?php 
										$fabricantes = array("agm industria  com e rep", "atb ind com adesivos", "bic amazonia s/a");
										foreach($fabricantes as $fabricante):
											if($fabricante == $dados_info['fabricante']){
													$selected = "selected";
											}else{
												$selected = "";
											}	
									?>

									<option value="<?php echo$fabricante;?>" <?php echo $selected;?>><?php echo$fabricante;?></option>
									<?php 
										endforeach;
									?>
								</select>

								<label for="categoria">Categoria do Produto</label>
								<select name="categoria" id="categoria" class="grande">
									<option value="<?php echo $dados_info['categoria']; ?>" selected="selected"><?php echo $dados_info['categoria']; ?></option>
									<?php 
									 	$categorias = array("velas", "adesivos", "descartaveis", "aparelho de barbear");
									 	foreach($categorias as $categoria):
									 		if($categoria == $dados_info['categoria']){
									 			$selected = "selected";
									 		}else{
									 			$selected = "";
									 		}

									?>
									<option value="<?php echo$categoria?>" <?php echo $selected; ?>><?php echo$categoria;?></option>
									<?php 
										endforeach;
									?>									
								</select>
	
								<label for="familia">Familia</label>
								<select name="familia" id="familia" class="grande">
									<option value="<?php echo $dados_info['familia']; ?>" selected="selected"><?php echo $dados_info['familia']; ?></option>
									<?php 
										$familias = array("velas comum", "velas votivas-santos", "limpeza geral", "barbeador", "cola", "lamina");
										foreach($familias as $familia):
											if($familia == $dados_info['familia']){
												$selected = "selected";
											}else{
												$selected = "";
											}
									?>
									<option value="<?php echo$familia?>" <?php echo $selected;?>><?php echo$familia;?></option>
									<?php 
										endforeach;
									?>
								</select>

								<label for="titulo">Titulo</label>
								<input type="text" name="titulo" class="grande" id="titulo" value="<?php echo utf8_encode($dados_info['titulo']);?>">

								<div class="column-inline">
									<label for="unidade">Unidade</label>
									<input type="text" name="unidade" class="pequeno" id="unidade" value="<?php echo $dados_info['unidade']?>">
								</div>								
								<div class="column-inline">
									<label for="estoque">Estoque</label>
									<input type="text" name="estoque" class="pequeno" id="estoque" value="<?php echo $dados_info['estoque'];?>">
								</div>

								<div class="column-inline">
									<label for="tipo">Tipo</label>
									<input type="text" name="tipo" class="pequeno" id="tipo" value="<?php echo $dados_info['tipo']; ?>">
								</div>


								<div class="column-inline">
									<label for="status">Status</label>
									<select name="status" id="status" class="pequeno">
										<?php 
											if($dados_info['status'] == 'ativo'):
										?>
										<option value="ativo" selected="selected">ATIVO</option>
										<option value="inativo">INATIVO</option>
										<?php elseif($dados_info['status'] == 'inativo'):?>
										<option value="ativo">ATIVO</option>
										<option value="inativo" selected="selected">INATIVO</option>
										<?php endif;?>
									</select>
								</div>

								<hr>

								<div id="sim_cores">
								<a href="#" id="add-bloco" class="sem-ajax">Adicionar <i class="fa fa-plus-circle"></i></a>
								<?php 
									if($dados_info['cores'] != ""):
										$separarLinha = explode(", ", $dados_info['cores']);
										foreach($separarLinha as $separarCor):
											if($separarCor != ""):
											$separarDados = explode(":",$separarCor);

								?>
								<div class="column-block">
										<div class="column-inline">
											<label for="anexo">Anexo</label>
											<input type="file" name="produto[anexo][]" class="pequeno-anexo" accept="image/*">
										</div>
										<div class="column-inline">
											<label for="codigo-1">Codigo</label>
											<input type="text" name="produto[codigo][]" class="pequeno input_codigo" value="<?php echo $separarDados[0];?>">
										</div>	
										<div class="column-inline">
											<label for="cor-1">Cor</label>
											<input type="text" name="produto[cor][]" class="pequeno" value="<?php echo $separarDados[1];?>">
										</div>
										<a href="#" class="removerCor sem-ajax"><i class="fa fa-times-circle"></i></a>
										
									</div>
							   <?php endif; endforeach; endif;?>
							   </div>
				

								<!-- <label for="descricao_leilao">Descrição do leilão</label>
								<textarea name="descricao_leilao" rows="10" class="grande" id="descricao_leilao"></textarea required=""> -->
								<!-- <input type="hidden" name="descricao_leilao" value=""> -->

								<input type="hidden" name="anexos_produto" id="anexos_produto" value="<?php echo$dados_info['codigo']; ?>">

							

								<!-- 

								RETIRAR DATA DE ENCERRAMENTO - ok
								ADICIONAR MSG DE ADCIONAR MAIS ANEXOS - ok
								REMOVER VALOR DESPESAS DA PAGINA DO LEILAO NO SITE - ok
								TIRAR CONTADOR - ok


								Outros:
								TERMINAR PAGINA DE USUARIOS NO PAINEL (TORNAR ADMIN, TORNAR USUARIO, DESABILITAR USUARIO, HABILITAR USUARIO, VER LEILOES EM QUE USUARIO PARTICIPOU)
								ADICIONAR MASCARA NOS CAMPOS (CPF, TELEFONE, ETC)
								ADICIONAR CURSOR 
								-->


							<!-- 	<input type="checkbox" name="destaque_leilao" id="destaque_leilao" class="inline">
								<label for="destaque_leilao" class="inline">Destaque</label>
								<input type="checkbox" name="online_leilao" id="online_leilao" class="inline" checked="">
								<label for="online_leilao" class="inline">Leilão online</label> -->

								<button type="submit" class="absolute on_bottom">EDITAR</button>
							</form>

							<form class="widget_form" id="anexo_form">
								<label>Anexos</label>
								<div class="anexos">
									<input type="file" name="add_anexo" id="add_anexo" accept="image/*"><br>
									<!-- <span class="msg_label_anexos">Você pode inserir mais de uma imagem.</span> -->
									<input type="hidden" name="cod_produto">
									<?php
										 $anexos = $dados_info['codigo'];
										 $caminho = "../arquivo/p".$anexos.".jpg";	
									?>
									<?php if(file_exists($caminho)): ?>
									<span class="anexo-span">
										<img src="<?php echo $caminho;?>">
									</span>
									<?php else: ?>
									<span class="anexo-span">
										<img src="../img/p_semfoto.jpg">
									</span>									
									<?php endif; ?>
									
								</div>
							</form>
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
	
</script>
</body>
</html>