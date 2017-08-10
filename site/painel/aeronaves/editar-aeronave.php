<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	// require_once("../../lib/aeronave.class.php");
	// require_once("../../lib/modelo.class.php");
	// require_once("../../lib/categoria.class.php");

	#Verificando o tipo de usuário: admin ou taxiaereo, deve ser feito para adicionar dados no formulário.
	// $form = ($dados_logado['tipo_usuario'] == "admin") ? "modelo" : "aeronave";

	#Verificando o tipo de usuário: admin ou taxiaereo, deve adicionar uma classe medio ou grande.
	$tamanho_campo = ($dados_logado['tipo_usuario'] == "admin") ? "medio" : "grande";

	$dadosAeronaveID = $aeronave->listaDadosAeronave($_GET['id']);
	// echo $_GET['id'];
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
							<form class="widget_form" id="edit_aeronave">
								<input type="hidden" name="id" id="id" value="<?= $dadosAeronaveID['id']; ?>">
								<input type="hidden" name="id_usuario" id="id_usuario" value="<?= $dadosAeronaveID['id_usuario']; ?>">
								<div class="column-1x3 form-column">
									<label for="fabricante">Fabricante:</label>
									<select name="fabricante" id="fabricante" class="<?=$tamanho_campo; ?> inline fabricante">
										<option value="<?= $dadosAeronaveID['fabricante']; ?>" selected="selected"><?= $dadosAeronaveID['fabricante']; ?></option>
										<option>-----</option>
										<?php 
											$dadosFabricantes = $modelo->listaFabricantes();
											foreach($dadosFabricantes as $listaFabricantes):
										?>
										<option value="<?php echo utf8_encode($listaFabricantes['fabricante']); ?>"><?php echo utf8_encode($listaFabricantes['fabricante']); ?></option>
										<?php endforeach; ?>
									</select>
									<input type="text" name="novofabricante" id="novofabricante" placeholder="Digite um novo fabricante" class="grande inline">
									<?php #if($dados_logado['tipo_usuario'] == "admin"): ?>
									<!-- <a href="#" data-novo-campo="novofabricante" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a> -->
									<?php #endif; ?>			
								</div>

								
								<div class="column-1x3 form-column">
									<label for="modelo">Modelo:</label>
									<select name="modelo" id="modelo" class="<?=$tamanho_campo;?> inline modelo">
										<option value="<?= $dadosAeronaveID['modelo']; ?>" selected="selected"><?= $dadosAeronaveID['modelo']; ?></option>
										<!--<option  disabled="" id="msg-selecione-fabricante">Selecione um fabricante</option>-->
									</select>
									<input type="text" name="novomodelo" id="novomodelo" placeholder="Digite um novo modelo" class="grande inline">
									<?php #if($dados_logado['tipo_usuario'] == "admin"): ?>
									<!-- <a href="#" data-novo-campo="novomodelo" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a> -->
									<?php #endif; ?>
								</div>	
								<!-- 
									Criar uma nova tabela para listar as categorias e relacionar ao modelo,
									ao clicar no mais abrir um popup com o campo text para adicionar uma nova categoria na tabela categoria
								--> 
								<div class="column-1x3 form-column">
									<label for="categoria">Categoria:</label>
									<select name="categoria" id="categoria" class="<?=$tamanho_campo;?> inline categoria" multiple>
										<?php 
											$categoria = explode(",", $dadosAeronaveID['categoria']);
											if(in_array("Mono Motor", $categoria)){
												echo '<option value="Mono Motor" selected>Mono Motor</option>';
											}else{
												echo '<option value="Mono Motor">Mono Motor</option>';
											}

											if(in_array("Mono Motor Pistão", $categoria)){
												echo '<option value="Mono Motor Pistão" selected>Mono Motor Pistão</option>';
											}else{
												echo '<option value="Mono Motor Pistão">Mono Motor Pistão</option>';
											}

											if(in_array("Bimotor Pistão", $categoria)){
												echo '<option value="Bimotor Pistão" selected>Bimotor Pistão</option>';
											}else{
												echo '<option value="Bimotor Pistão">Bimotor Pistão</option>';
											}											

											if(in_array("Turboélice", $categoria)){
												echo '<option value="Turboélice" selected>Turboélice</option>';
											}else{
												echo '<option value="Turboélice">Turboélice</option>';
											}

											if(in_array("Bimotor", $categoria)){
												echo '<option value="Bimotor" selected>Bimotor</option>';
											}else{
												echo '<option value="Bimotor">Bimotor</option>';
											}
											if(in_array("Jato", $categoria)){
												echo '<option value="Jato" selected>Jato</option>';
											}else{
												echo '<option value="Jato">Jato</option>';
											}
										?>										
									</select>
									<?php #if($dados_logado['tipo_usuario'] == "admin"): ?>
									<!-- <a href="#" onclick="abrirpopup('adicionar-categoria.php','modal_corpo_pequeno'); return false;" class="sem-ajax btn-plus"><i class="fa fa-plus"></i></a> -->
									<?php #endif; ?>
								</div>
								
								<div class="column-1x3 form-column">
									<label for="tipo_servicos">Tipo serviço:</label>
									<select name="tipo_servicos" id="tipo_servicos" class="<?=$tamanho_campo;?> inline tipo_servico" multiple>
									<?php 
										$tipo_servico = explode(",", $dadosAeronaveID['tipo_servicos']); 
											if(in_array("Passageiros", $tipo_servico)){
												echo '<option value="Passageiros" selected>Passageiros</option>';
											}else{
												echo '<option value="Passageiros">Passageiros</option>';
											}
									
											if(in_array("Carga", $tipo_servico)){
												echo '<option value="Carga" selected>Carga</option>';
											}else{
												echo '<option value="Carga">Carga</option>';
											}

											if(in_array("Remoção Aérea", $tipo_servico)){
												echo '<option value="Remoção Aérea" selected>Remoção Aérea</option>';
											}else{
												echo '<option value="Remoção Aérea">Remoção Aérea</option>';
											}

											if(in_array("Aérea Médico", $tipo_servico)){
												echo '<option value="Aérea Médico" selected>Aérea Médico</option>';
											}else{
												echo '<option value="Aérea Médico">Aérea Médico</option>';
											}
											
											if(in_array("Agricola", $tipo_servico)){
												echo '<option value="Agricola" selected>Agricola</option>';
											}else{
												echo '<option value="Agricola">Agricola</option>';
											}

											if(in_array("Instrução", $tipo_servico)){
												echo '<option value="Instrução" selected>Instrução</option>';
											}else{
												echo '<option value="Instrução">Instrução</option>';
											}
									?>
									</select>
								</div>			


								<div class="column-1x3 form-column">
									<label for="ano">Ano:</label>
									<input type="text" id="ano" name="ano" placeholder="0000" class="<?=$tamanho_campo;?> inline" value="<?= $dadosAeronaveID['ano'];?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="prefixo">Prefixo da aeronave:</label>
									<input type="text" id="prefixo" name="prefixo" class="<?=$tamanho_campo;?> inline" value="<?=  $dadosAeronaveID['prefixo']; ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="limite_passageiros">Limite de Passageiros</label>
									<input type="number" min="1" id="passageiros" name="passageiros" class="<?=$tamanho_campo;?> inline" value="<?= $dadosAeronaveID['passageiros']; ?>">
								</div>
							
								<div class="column-1x3 form-column">
									<label for="peso">Peso(bagagem):</label>
									<input type="text" id="peso" name="peso" class="<?=$tamanho_campo;?> inline" value="<?= $dadosAeronaveID['peso_bagagem']; ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="velocidade">Velocidade:</label>
									<input type="text" id="velocidade" name="velocidade" class="<?=$tamanho_campo;?> inline" value="<?= $dadosAeronaveID['velocidade']; ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="autonomia">Autonomia:</label>
									<input type="text" id="autonomia" name="autonomia" class="<?=$tamanho_campo;?> inline" value="<?=  $dadosAeronaveID['autonomia']; ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="operacao">Operação:</label>
									<select name="operacao" id="operacao" class="<?=$tamanho_campo;?> inline operacao" multiple>
									<?php 
										$operacao = explode(",", $dadosAeronaveID['operacao']);
											if(in_array("VFR", $operacao)){
												echo '<option value="VFR" selected>VFR</option>';
											}else{
												echo '<option value="VFR">VFR</option>';
											}

											if(in_array("IFR", $operacao)){
												echo '<option value="IFR" selected>IFR</option>';
											}else{
												echo '<option value="IFR">IFR</option>';
											}											
									?>
									</select>
								</div>

								<div class="column-1x3 form-column">
									<label for="base_operacao">Base de Operação:</label>
									<input type="text" id="base_operacao" name="base_operacao" class="<?=$tamanho_campo;?> inline google-maps" value="<?= $dadosAeronaveID['base_operacao']; ?>">
									<input type="hidden" id="latitude" name="latitude" value="<?= $dadosAeronaveID['latitude']; ?>">
									<input type="hidden" id="longitude" name="longitude" value="<?= $dadosAeronaveID['longitude']; ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="valor">Valor por Hora:</label>
									<input type="text" id="valor" name="valor" class="<?=$tamanho_campo;?> inline" value="<?= number_format($dadosAeronaveID['valor'],2,",","."); ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="valor_pernoite">Valor do Pernoite:</label>
									<input type="text" id="valor_pernoite" name="valor_pernoite" class="<?=$tamanho_campo;?> inline" value="<?= number_format($dadosAeronaveID['valor_pernoite'],2,",","."); ?>">
								</div>

								<div class="column-1x3 form-column">
									<label for="banheiro">Tipo do Banheiro:</label>
									<select name="banheiro" id="banheiro" class="<?=$tamanho_campo;?> inline">
										<option value="<?= $dadosAeronaveID['banheiro']; ?>" selected=""><?= $dadosAeronaveID['banheiro']; ?></option>
										<option>----</option>
										<option value="Sem Banheiro">Sem Banheiro</option>
										<option value="Parcial">Parcial</option>
										<option value="Completo">Completo</option>
									</select>
								</div>

								<div class="column-1x3 form-column">
									<label for="servico_bordo">Serviço de Bordo:</label>
									<select name="servico_bordo" id="servico_bordo" class="<?=$tamanho_campo;?> inline">
										<option value="<?= $dadosAeronaveID['servico_bordo']; ?>" selected=""><?= $dadosAeronaveID['servico_bordo']; ?></option>
										<option>-----</option>
										<option value="Simples">Simples</option>
										<option value="Completo">Completo</option>
										<option value="Especial">Especial</option>
										<option value="VIP">VIP</option>
										<option value="Diamante">Diamante</option>
									</select>
								</div>

								<div class="column-2x4 form-column font-zero">
									<label for="">Carregar Imagens:</label>
									<?php 
										$imagens = json_decode($dadosAeronaveID['imagens'],true);
										$img1 = ($imagens['imagem1'] != "") ? '<img src="'.$root_site.'/arquivo/'.$imagens['imagem1'].'">' : '';
										$img2 = ($imagens['imagem2'] != "") ? '<img src="'.$root_site.'/arquivo/'.$imagens['imagem2'].'">' : '';
										$img3 = ($imagens['imagem3'] != "") ? '<img src="'.$root_site.'/arquivo/'.$imagens['imagem3'].'">' : '';
										$img4 = ($imagens['imagem4'] != "") ? '<img src="'.$root_site.'/arquivo/'.$imagens['imagem4'].'">' : '';

									?>
									<div class="thub-img-small campo-add-img anexos" id="img-1"><?php echo $img1; ?></div>
									<div class="thub-img-small campo-add-img anexos" id="img-2"><?php echo $img2; ?></div>
									<div class="thub-img-small campo-add-img anexos last" id="img-3"><?php echo $img3; ?></div>
									<div class="thub-img-medium campo-add-img anexos" id="img-4"><?php echo $img4; ?></div>

									<input type="hidden" id="img1" name="img1" value="<?php echo $imagens['imagem1']; ?>">
									<input type="hidden" id="img2" name="img2" value="<?php echo $imagens['imagem2']; ?>">
									<input type="hidden" id="img3" name="img3" value="<?php echo $imagens['imagem3']; ?>">
									<input type="hidden" id="img4" name="img4" value="<?php echo $imagens['imagem4']; ?>">
								</div>
								<div class="column-2x4 form-column">
									<label for="visao_geral">Visão Geral:</label>
									<textarea name="visao_geral" id="visao_geral" cols="20" rows="10" class="<?=$tamanho_campo;?> inline"><?= $dadosAeronaveID['visao_geral']; ?></textarea>
								</div>
	
								<div class="btn-form-submit">
									<div class="column-2x4 submit-left">
										<button type="submit" id="btn-add-imagem"><i class="fa fa-camera"></i> Escolher Imagem</button>
									</div>
									<div class="column-2x4 submit-right">
										<button type="submit">SALVAR</button>
									</div>
								</div>
								
							
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
	$('#tipo_servicos').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    });  
	$('#operacao').multipleSelect({
        width: '100%',
        placeholder: "Selecione a opção",
        selectAll: false
    });      
	$("#valor").maskMoney({
		showSymbol:true,
		symbol:"", 
		decimal:",", 
		thousands:".", 
		allowZero:true, 
		precision: 2
	}); 
	$("#valor_pernoite").maskMoney({
		showSymbol:true,
		symbol:"", 
		decimal:",", 
		thousands:".", 
		allowZero:true, 
		precision: 2
	});       
</script>

</body>
</html>