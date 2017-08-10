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
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Adicionar Produto | AGM Distribuidora</title>
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
				<div class="column-3x4">
					<div class="erro">Erro</div>
					<div class="sucesso">Sucesso</div>
				</div>
			</div>

			<div class="row">
				<div class="column-3x4">
					<div class="widget">
						<div class="widget_title">Novo Produto</div>
						<div class="widget_body padding-bottom-50">
							<form class="widget_form" id="add_produto" enctype="multipart/form-data">
								
								<label for="codigo">Codigo</label>
								<input type="number" name="codigo" id="codigo" class="grande" required="">

								

<!-- 								<label for="fabricante">Fabricante</label>
								<select name="fabricante" id="fabricante" class="grande">
									<option value="" disabled="" selected="selected">Selecione o fabricante</option>
									<option value="agm industria  com e rep">AGM Industria Com e Rep</option>
									<option value="alva da amazonia ind quim">Alva da Amazonia Ind Quim</option>
									<option value="atb ind com adesivos">ATB Ind com Adesivos</option>
									<option value="bia amazonia s/a">Bic amazonia s/a</option>
									<option value="cigel industrial ltda">CIGEL INDUSTRIAL LTDA</option>
									<option value="darco dist. de cosm.">DARCO DIST. DE COSM.</option>
									<option value="exceed costmeticos">EXCEED COSMETICOS</option>
									<option value="globo da amazonia">GLOBO DA AMAZONIA</option>
									<option value="higie plus chemical">HIGIE PLUS CHEMICAL</option>
									<option value="ki aroma ind e com ltda">KI AROMA IND E COM LTDA</option>
									<option value="limppano s/a">LIMPPANO S/A</option>
									<option value="lupus desenv. em alim">LUPUS DESENV EM ALIM</option>
									<option value="medevice do brasil">MEDEVICE DO BRASIL</option>
									<option value="s/a pharmacos e cosmetico">S/A PHARMACOS E COSMETICO</option>
									<option value="saponoleo santo anto">SAPONOLEO SANTO ANTO</option>
									<option value="superfine steel">SUPERFINE STEEL</option>
									<option value="theoto s/a">THEOTO S/A</option>
									<option value="three bond do brasil ind">THREE BOND DO BRASIL IND</option>
									<option value="vb alimentos ind">VB ALIMENTOS IND</option>
								</select> -->
								
								<label for="categoria">Categoria do Produto</label>
								<select name="categoria" id="categoria" class="grande">
									<option value="" disabled="" selected="">Selecione a categoria do produto</option>
									<option value="velas">Velas</option>
									<option value="material de limpeza">Material de Limpeza</option>
									<option value="adesivos">Adesivos</option>
									<option value="aparelho de barbear">Aparelho de Barbear</option>
									<option value="material de expediente">Material de Expediente</option>
									<option value="costimecos">Cosmeticos</option>
									<option value="perfumaria">Perfumaria</option>
									<option value="sabão">Sabão</option>
								</select>

<!-- 								<label for="familia">Familia</label>
								<select name="familia" id="familia" class="grande">
									<option value="" disabled="" selected="">Selecione a familia do produto</option>
									<option value="velas comum">Velas Comum</option>
									<option value="velas votivas-santos">Velas Votivas-Santos</option>
									<option value="cola">Cola</option>
									<option value="barbeador">Barbeador</option>
									<option value="material de escritorio">Material de Escritório</option>
									<option value="oleo recondicionador">Oleo Recondicionador</option>
									<option value="agua oxigenada">Agua Oxigenada</option>
									<option value="amoniaco">Amoniaco</option>
									<option value="creme de tratamento">Creme de Tratamento</option>
									<option value="creme de pentear">Creme de Pentear</option>
									<option value="acetona">Acetona</option>
									<option value="reparador de pontas">Reparador de Pontas</option>
									<option value="shampoo">Shampoo</option>
									<option value="Condicionador">Condicionador</option>
									<option value="agua oxigenada">Agua Oxigenada</option>
									<option value="bronzeador">Bronzeador</option>
									<option value="reparador de pontas">Reparador de Pontas</option>
									<option value="sabonetes">Sabonetes</option>
									<option value="gel">Gel</option>
									<option value="descolorantes">Descolorantes</option>
									<option value="desodorantes">Desodorantes</option>
									<option value="oleo recondicionador">Oleo Recondicionador</option>
									<option value="sabonetes">Sabonetes</option>
									<option value="higienico">Higienico</option>
									<option value="amaciante">Amaciante</option>
									<option value="limpeza geral">Limpeza Geral</option>
								</select>
 -->
								<label for="titulo">Titulo</label>
								<input type="text" name="titulo" class="grande" id="titulo" required="">
								
								<div class="column-inline">
									<label for="unidade">Unidade</label>
									<input type="text" name="unidade" class="pequeno" id="unidade" required="">
								</div>
								<div class="column-inline">
									<label for="estoque">Estoque</label>
									<input type="text" name="estoque" class="pequeno" id="estoque" required="">
								</div>

								<div class="column-inline">
									<label for="tipo">Tipo</label>
									<input type="text" name="tipo" class="pequeno" id="tipo" required="">
								</div>

								<div class="column-inline">
									<label for="status">Status</label>
									<select name="status" id="status" class="pequeno">
										<option value="" disabled="" selected="">Selecione</option>
										<option value="ativo">ATIVO</option>
										<option value="inativo">DESATIVAR</option>
									</select>
								</div>



								<!-- <label for="localizacao_leilao">Localização</label> -->
								<!-- <input type="hidden" name="localizacao_leilao" class="grande" id="localizacao_leilao" placeholder="Cidade - UF, País" value="Manaus - AM, Brasil">
 -->
								

								<!-- <label for="valor_avaliado_leilao">Avaliação</label>
								<input type="text" name="valor_avaliado_leilao" class="grande input_money" id="valor_avaliado_leilao" placeholder="R$ 0,00" required="">

								<label for="despesas_leilao">Valor das despesas</label>
								<input type="text" name="despesas_leilao" class="grande input_money" id="despesas_leilao" placeholder="R$ 0,00" value="0,00">

								<hr> -->

								<!-- <label for="descricao_leilao">Descrição do leilão</label>
								<textarea name="descricao_leilao" rows="10" class="grande" id="descricao_leilao"></textarea required=""> -->
								<!-- <input type="hidden" name="descricao_leilao" value="">
-->
								<input type="hidden" name="anexos_produto" id="anexos_produto" value="">
<!--
								<label for="data_inicio_leilao">Data de início do leilão</label>
								<input type="text" name="data_inicio_leilao" class="pequeno inline center input_data" id="data_inicio_leilao" required="" placeholder="DD/MM/YYYY" value="14/10/2016">
								às <input type="time" name="hora_inicio_leilao" class="pequeno inline center" id="hora_inicio_leilao" required="" placeholder="HH:MM" value="09:00">
 -->
								<!-- <label for="data_fim_leilao">Data de encerramento para este leilão</label> -->
								<!-- <input type="hidden" name="data_fim_leilao" class="pequeno inline center input_data" id="data_fim_leilao" required="" placeholder="DD/MM/YYYY" value="01/01/2017">
								<!-- às<input type="hidden" name="hora_fim_leilao" class="pequeno inline center" id="hora_fim_leilao" required="" placeholder="HH:MM" value="01:00"> -->

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

								<hr>
								<label>Produto possui cor?</label>
								<input type="checkbox" name="sim_cor" id="sim_cor" class="inline">
								<label for="sim_cor" class="inline">Sim</label>
								<!-- <input type="radio" name="online_leilao" id="online_leilao" class="inline" checked="">
								<label for="online_leilao" class="inline">Não</label> -->
								
								<div id="sim_cores">
								<a href="#" id="add-bloco" class="sem-ajax">Adicionar <i class="fa fa-plus-circle"></i></a>
									<div class="column-block">
										<div class="column-inline">
											<label for="anexo">Anexo</label>
											<input type="file" name="produto[anexo][]" class="pequeno-anexo" accept="image/*">
										</div>
										<div class="column-inline">
											<label for="codigo-1">Codigo</label>
											<input type="text" name="produto[codigo][]" class="pequeno">
										</div>	
										<div class="column-inline">
											<label for="cor-1">Cor</label>
											<input type="text" name="produto[cor][]" class="pequeno">
										</div>

									</div>

					
									
								</div>



								<button type="submit" class="absolute on_bottom">SALVAR</button>
							</form>

							<form class="widget_form" id="anexo_form">
								<label>Anexo</label>
								<div class="anexos">
									<input type="file" name="add_anexo" id="add_anexo" accept="image/*"><br>
									<input type="hidden" name="cod_produto">
									<!-- <span class="msg_label_anexos">Você pode inserir mais de uma imagem.</span> -->
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