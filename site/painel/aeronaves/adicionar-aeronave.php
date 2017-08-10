<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	require_once("../../lib/aeronave.class.php");
	require_once("../../lib/modelo.class.php");
	require_once("../../lib/categoria.class.php");

	#Verificando o tipo de usuário: admin ou taxiaereo, deve ser feito para adicionar dados no formulário.
	$form = ($dados_logado['tipo_usuario'] == "admin") ? "modelo" : "aeronave";

	#Verificando o tipo de usuário: admin ou taxiaereo, deve adicionar uma classe medio ou grande.
	$tamanho_campo = ($dados_logado['tipo_usuario'] == "admin") ? "medio" : "grande";

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
	<!-- <script src="http://www.dzigni.com.br/aerobusca/js/multiple-select.js"></script> -->
	<script src="<?php echo $root_sistema; ?>/js/jquery.mask.min.js"></script>
	<script src="<?php echo $root_sistema; ?>/js/jquery.maskMoney.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="<?php echo $root_sistema; ?>/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!--
	<link rel="stylesheet" href="<?php echo $root; ?>/js/TinyEditor/style.css" type="text/css" />
	<script src="<?php echo $root; ?>/js/TinyEditor/tiny.editor.packed.js"></script>
 -->
	<script src="<?php echo $root_sistema; ?>/js/tinymce/tinymce.min.js"></script>
  	<script>
  		tinymce.init({
			selector: 'textarea',  // change this value according to your HTML
			menubar: false,
			width: "100%"
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
					<span class="menu_icon"><i class="fa fa-list-alt"></i></span>
					<span class="menu_text">Cotação</span>
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
			<li class="fade atual">
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
						<div class="widget_title">Nova Aeronave</div>
						<div class="widget_body widget_center"><a href="adicionar-aeronave" class="btn_widget verde fade">ADICIONAR AERONAVE</a></div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Quantidade de Aeronaves</div>
						<div class="widget_body main_counts positive">
							<div class="widget-number-count"><a href="<?php echo $root_sistema; ?>/aeronaves/index"><?= $aeronave->qtdAeronaves($id_logado,$dados_logado['tipo_usuario']); ?> aeronaves</a></div>
						</div>
					</div>
				</div>				
			</div>

			
			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Novo Aeronave</div>
						<div class="widget_body padding-bottom-50">
							<form class="widget_form" id="add_<?php echo $form; ?>">
								
								<div class="column-1x3 form-column">
									<label for="fabricante">Fabricante:</label>
									<select name="fabricante" id="fabricante" class="<?=$tamanho_campo; ?> inline fabricante">
										<option value="" selected="selected">Selecione a opção</option>
										<?php 
											$dadosFabricantes = $modelo->listaFabricantes();
											foreach($dadosFabricantes as $listaFabricantes):
										?>
										<option value="<?php echo utf8_encode($listaFabricantes['fabricante']); ?>"><?php echo utf8_encode($listaFabricantes['fabricante']); ?></option>
										<?php endforeach; ?>
									</select>
									<input type="text" name="novofabricante" id="novofabricante" placeholder="Digite um novo fabricante" class="grande inline">
									<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
									<a href="#" data-novo-campo="novofabricante" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a>
									<?php endif; ?>			
								</div>

								
								<div class="column-1x3 form-column">
									<label for="modelo">Modelo:</label>
									<select name="modelo" id="modelo" class="<?=$tamanho_campo;?> inline modelo">
										<option value="" selected="selected" disabled="">Selecione a opção</option>
										<option  disabled="" id="msg-selecione-fabricante">Selecione um fabricante</option>
									</select>
									<input type="text" name="novomodelo" id="novomodelo" placeholder="Digite um novo modelo" class="grande inline">
									<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
									<a href="#" data-novo-campo="novomodelo" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a>
									<?php endif; ?>
								</div>	
								<!-- 
									Criar uma nova tabela para listar as categorias e relacionar ao modelo,
									ao clicar no mais abrir um popup com o campo text para adicionar uma nova categoria na tabela categoria
								--> 
								<div class="column-1x3 form-column">
									<label for="categoria">Categoria:</label>
									<select name="categoria" id="categoria" class="<?=$tamanho_campo;?> inline categoria" multiple>
										<?php 
											$dadosCategorias = $categoria->listaCategorias();
											foreach($dadosCategorias as $listaCategorias):
										?>
										<option value="<?php echo utf8_encode($listaCategorias['nome_categoria']); ?>"><?php echo$listaCategorias['nome_categoria']; ?></option>
										<?php endforeach; ?>										
									</select>
									<!-- <input type="text" name="novocategoria" id="novocategoria" placeholder="Digite uma nova categoria" class="grande inline"> -->
									<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
									<a href="#" onclick="abrirpopup('adicionar-categoria.php','modal_corpo_pequeno'); return false;" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a>
									<?php endif; ?>
								</div>


								<?php if($dados_logado['tipo_usuario'] == "admin"): ?>
								<div class="column-1x3 form-column">
									<div class="btn-form-submit">
										<button type="submit">SALVAR</button>
									</div>
								</div>
								<?php endif; ?>


								
								<?php if($dados_logado['tipo_usuario'] == "taxiaereo"): ?>
								<div class="column-1x3 form-column">
									<label for="tipo_servico">Tipo serviço:</label>
									<select name="tipo_servico" id="tipo_servico" class="<?=$tamanho_campo;?> inline tipo_servico" multiple>
										<option value="Passageiros">Passageiros</option>
										<option value="Carga(peso)">Carga(peso)</option>
										<option value="Remoção Aérea">Remoção Aérea</option>
										<option value="Aérea Médico">Aérea Médico</option>
										<option value="Agricola">Agricola</option>
										<option value="Instrução">Instrução</option>
									</select>
								</div>			


								<div class="column-1x3 form-column">
									<label for="ano">Ano:</label>
									<input type="text" id="ano" name="ano" placeholder="0000" class="<?=$tamanho_campo;?> inline">
								</div>

								<div class="column-1x3 form-column">
									<label for="prefixo">Prefixo da aeronave:</label>
									<input type="text" id="prefixo" name="prefixo" class="<?=$tamanho_campo;?> inline" placeholder="__-___">
								</div>

								<div class="column-1x3 form-column">
									<label for="limite_passageiros">Limite de Passageiros</label>
									<input type="number" min="1" id="limite_passageiros" name="limite_passageiros" class="<?=$tamanho_campo;?> inline">
								</div>
							
								<div class="column-1x3 form-column">
									<label for="peso">Peso(bagagem):</label>
									<input type="text" id="peso" name="peso" class="<?=$tamanho_campo;?> inline">
								</div>

								<div class="column-1x3 form-column">
									<label for="velocidade">Velocidade:</label>
									<input type="text" id="velocidade" name="velocidade" class="<?=$tamanho_campo;?> inline" data-affixes="false" data-suffix=" km/h" data-thousands="" data-decimal="">
								</div>

								<div class="column-1x3 form-column">
									<label for="autonomia">Autonomia:</label>
									<input type="text" id="autonomia" name="autonomia" class="<?=$tamanho_campo;?> inline">
								</div>

								<div class="column-1x3 form-column">
									<label for="operacao">Operação:</label>
									<select name="operacao" id="operacao" class="<?=$tamanho_campo;?> inline operacao" multiple>
										<option value="" selected="">Selecione a opção</option>
										<option value="VFR">VFR</option>
										<option value="IFR">IFR</option>
									</select>
								</div>

								<div class="column-1x3 form-column">
									<label for="base_operacao">Base de Operação:</label>
									<input type="text" id="base_operacao" name="base_operacao" class="<?=$tamanho_campo;?> inline google-maps" placeholder="Aguarde...">
									<input type="hidden" id="latitude" name="latitude">
									<input type="hidden" id="longitude" name="longitude">
								</div>

								<div class="column-1x3 form-column">
									<label for="valor_hora">Valor por Hora:</label>
									<input type="text" id="valor_hora" name="valor_hora" class="<?=$tamanho_campo;?> inline" data-affixes="false" data-prefix="R$ " data-thousands="." data-decimal=",">
								</div>

								<div class="column-1x3 form-column">
									<label for="valor_pernoite">Valor do Pernoite:</label>
									<input type="text" id="valor_pernoite" name="valor_pernoite" class="<?=$tamanho_campo;?> inline" data-affixes="false" data-prefix="R$ " data-thousands="." data-decimal=",">
								</div>

								<div class="column-1x3 form-column">
									<label for="tipo_banheiro">Tipo do Banheiro:</label>
									<select name="tipo_banheiro" id="tipo_banheiro" class="<?=$tamanho_campo;?> inline">
										<option value="" selected="">Selecione a opção</option>
										<option value="Sem Banheiro">Sem Banheiro</option>
										<option value="Parcial">Parcial</option>
										<option value="Completo">Completo</option>
									</select>
								</div>

								<div class="column-1x3 form-column">
									<label for="servico_bordo">Serviço de Bordo:</label>
									<select name="servico_bordo" id="servico_bordo" class="<?=$tamanho_campo;?> inline">
										<option value="" selected="">Selecione a opção</option>
										<option value="Simples">Simples</option>
										<option value="Completo">Completo</option>
										<option value="Especial">Especial</option>
										<option value="VIP">VIP</option>
										<option value="Diamante">Diamante</option>
									</select>
								</div>

								<div class="column-2x4 form-column font-zero">
									<label for="">Carregar Imagens:</label>
									<div class="thub-img-small campo-add-img" id="img-1"></div>
									<div class="thub-img-small campo-add-img" id="img-2"></div>
									<div class="thub-img-small campo-add-img last" id="img-3"></div>
									<div class="thub-img-medium campo-add-img" id="img-4"></div>

									<input type="hidden" name="img1" value="">
									<input type="hidden" name="img2" value="">
									<input type="hidden" name="img3" value="">
									<input type="hidden" name="img4" value="">
								</div>
								<div class="column-2x4 form-column">
									<label for="visao_geral">Visão Geral:</label>
									<textarea name="visao_geral" id="visao_geral" cols="20" rows="10" class="<?=$tamanho_campo;?> inline"></textarea>
								</div>
	
								<div class="btn-form-submit">
									<div class="column-2x4 submit-left">
										<button type="submit" id="btn-add-imagem"><i class="fa fa-camera"></i> Escolher Imagem</button>
									</div>
									<div class="column-2x4 submit-right">
										<button type="submit">SALVAR</button>
									</div>
								</div>
								
								<?php endif; ?>	
							
							</form>

							<form id="form-img">
								<input type="file" name="img-aeronave">
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
<div id="modal" class="modal_geral">
	<div id="modal_tamanho">
   
	</div>
</div>


<script>
	var root_url = "<?php echo $root_sistema; ?>";
</script>
<script type="text/javascript" src="<?php echo $root_sistema; ?>/js/site.js?v=<?php echo time();?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSuXH0sCB7bgQYBa9hAo4rWbySPoelNQ&libraries=places&callback=googlemaps"></script>
<script>
	$('#categoria').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    });
	$('#tipo_servico').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    });  
	$('#operacao').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    });      
</script>

</body>
</html>