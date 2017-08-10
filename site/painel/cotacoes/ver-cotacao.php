<?php
	#Inicializando as configurações
	require_once("../../lib/autoload.php");
	$dadosCotacao 		= $cotacao->listaTokenCotacao($_GET["id"]);
	$dadosAeronaveID    = $aeronave->listaDadosAeronave($id_logado);
 	$dadosAeronave 		= $aeronave->listaAeronaves($id_logado,$dados_logado['tipo_usuario']);
 	$dadosUsuario       = $auth->dadosUsuario($dadosCotacao['id_cliente']);
 	$dadosMensagem		= $mensagens->listarMensagem($dadosCotacao['id']);


	$info_localizacoes = json_decode($dadosCotacao['localizacoes']);

	$string_cidades = "";

	$total_locais = count($info_localizacoes->origem);
	for ($i=0; $i<$total_locais; $i++){
		if($i == $total_locais-1){
			$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil");
		}else{
			$string_cidades .= rtrim($info_localizacoes->origem[$i], ", Brasil")." > ".rtrim($info_localizacoes->destino[$i], ", Brasil")." > ";
		}
		$data_ida = $info_localizacoes->data_ida[$i];
		$hora_ida = $info_localizacoes->hora_ida[$i];

		$data_volta = $info_localizacoes->data_ida[$i];
		$hora_volta = $info_localizacoes->hora_volta[$i];

		$passageiros = $info_localizacoes->passageiros[$i];
	}
	// require_once("../../lib/aeronave.class.php");



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

	<!--PLUGINS ADICIONADOS-->
	<script src="<?= $root_sistema; ?>/js/jquery.print.js"></script>
	<script src="<?= $root_sistema; ?>/js/jquery.maskMoney.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="<?= $root_sistema; ?>/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!-- 	<link rel="stylesheet" href="<?php echo $root; ?>/js/TinyEditor/style.css" type="text/css" />
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
			<li class="fade atual">
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
			<?php endif;?>
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
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Informações Completa do Orçamento - Token (<?= $_GET['token']; ?>)</div>
						<div class="widget_body padding-bottom-50" id="imprimirArea">

							<table class="tabela1-painel">
								<tr>
									<th colspan="2"><?= $dadosUsuario['nome']." ".$dadosUsuario['sobrenome'];?></th>
								</tr>
								<tr>
									<td class="right">Trecho</td>
									<td class="left"><?= $string_cidades; ?></td>
								</tr>
								<tr>
									<td class="right">Data e Hora (ida)</td>
									<td class="left"><?= $data_ida." - ".$hora_ida; ?> Hrs</td>
								</tr>
								<tr>
									<td class="right">Data e Hora (volta)</td>
									<td class="left"><?= $data_volta." - ".$hora_volta; ?> Hrs</td>
								</tr>
								<tr>
									<td class="right">Distância Total</td>
									<td class="left">
									<?= $dadosCotacao['distancia_total']; ?> Km</td>
								</tr>	
								<tr>
									<td class="right">Tempo Estimado Total</td>
									<td class="left">
									<input type="text" id="tempo_estimado_total" value="<?= $dadosCotacao['tempo_estimado_total']; ?>"/> Hrs</td>
									<!-- <span id="campo_tempo_voo"> </span> Hrs-->
								</tr>	
								<!-- <tr>
									<td class="right">Deslocamento</td>
									<td class="left">02:00 Hrs</td>
								</tr> -->																											
								<tr>
									<td class="right">Pernoite</td>
									<td class="left"><?= ($dadosCotacao['dias_pernoite'] <= 3) ? "SIM" : "NÃO" ?></td>
								</tr>												
								<tr>
									<th colspan="2">Informações da Aeronave</th>
								</tr>
								<tr>
									<td class="right">Aeronave</td>
									<td class="left"><input type="text" id="aeronave" value="<?php echo $dadosAeronaveID['modelo']; ?>" disabled></td>
								</tr>	
								<tr>
									<td class="right">Prefixo</td>
									<td class="left">
										<input type="text" id="prefixo" name="prefixo" value="<?= $dadosAeronaveID['prefixo']; ?>">
										<input type="hidden" id="id-prefixo" value="">
										
									<?php foreach($dadosAeronave as $info_aeronave): ?>
									<input type="hidden" id="aeronave_<?= $info_aeronave['id']; ?>" value="<?= $info_aeronave['modelo']; ?>">
									<input type="hidden" id="velocidade_<?= $info_aeronave['id']; ?>" value="<?= $info_aeronave['velocidade']; ?>">
									<input type="hidden" id="valor_<?= $info_aeronave['id']; ?>" value="<?= number_format($info_aeronave['valor'],2,",","."); ?>">
									<input type="hidden" id="valor_pernoite_<?= $info_aeronave['id']; ?>" value="<?= number_format($info_aeronave['valor_pernoite'],2,",","."); ?>">
									<input type="hidden" id="tempo_estimado_total_<?= $info_aeronave['id']; ?>" value="<?= $dadosCotacao['tempo_estimado_total']; ?>">
									<input type="hidden" id="distancia_total_<?= $info_aeronave['id']; ?>" value="<?= $dadosCotacao['distancia_total']; ?>">

									<?php endforeach; ?>

										<select name="select-prefixo" id="select-prefixo">
											<option value="" selected="">TROCA DE AERONAVE</option>
											<?php foreach($dadosAeronave as $info_aeronave): ?>

												<option value="<?= $info_aeronave['prefixo']; ?>" data-id="<?= $info_aeronave['id']; ?>"><?= $info_aeronave['prefixo']; ?></option>

											<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="right">Quantidade de Passageiros</td>
									<td class="left"><?= $passageiros; ?></td>
								</tr>	
								<tr>
									<td class="right">Velocidade da Aeronave</td>
									<td class="left"><input type="text" id="velocidade" value="<?= $dadosAeronaveID['velocidade']; ?>"> Km/h</td>
								</tr>	
								<tr>
									<td class="right">Valor/Hora (R$)</td>
									<td class="left">R$ <input type="text" id="valor" value="<?= number_format($dadosAeronaveID['valor'],2,",","."); ?>"></td>
								</tr>																										
								<tr>
									<td class="right">Valor do Pernoite (R$)</td>
									<td class="left">R$ <input type="text" id="valor_pernoite" value="<?= number_format($dadosCotacao['valor_pernoite'],2,",","."); ?>"> </td>
								</tr>																										
								<tr>
									<td class="right">Valor Total (R$)</td>
									<td class="left">R$ <input type="text" id="custo_estimado" value="<?= number_format($dadosCotacao['custo_estimado'],2,",","."); ?>"></td>
								</tr>																										
								<tr>
									<td class="right">Formas de Pagamento</td>
									<td class="left"><?= $dadosCotacao['meio_pagamento']; ?></td>
								</tr>																		
							</table>

					
							<div class="btn-bloco">
								<a href="<?=$root_sistema; ?>/index" class="btn cinza">Voltar</a>
								<a href="#" class="btn azul sem-ajax" id="imprimir-btn">Imprimir</a>
								<a href="#" data-status-dados="enviado" data-id-cotacao="<?= $dadosCotacao['id']; ?>" class="btn verde">Enviar Orçamento</a>	
								<a href="#" class="btn vermelho sem-ajax" data-exibir="msg-texto">Escrever Mensagem</a>
							</div>

							<div class="column-fundo-cinza" id="msg-texto">
								<div class="column-4x4 form-column">
								<h2>SUAS OBSERVAÇÕES</h2>
									<?php 
										foreach($dadosMensagem as $info_mensagem): 
											$tipo_usuario = ($info_mensagem['tipo_usuario'] == "cliente") ? "msg-cliente left" : "msg-taxiaereo right";
									?>
									<div class="<?= $tipo_usuario; ?>"><strong><i class="fa fa-user"></i> <?= strtoupper($info_mensagem['tipo_usuario']); ?> - <?= date("d/m/Y",$info_mensagem['data']); ?></strong> 
									<?= $info_mensagem['texto']; ?>
									</div>
									<?php endforeach; ?>
								</div>
								<br><br>

								<form class="widget_form" id="add_mensagem">
								<div class="column-4x4 form-column">
									<label for="Mensagem">Mensagem</label>
									<input type="hidden" name="id_cotacao" id="id_cotacao" value="<?= $dadosCotacao['id']; ?>">
									<input type="hidden" name="id_cliente" id="id_cliente" value="<?= $dadosUsuario['id'];?>">
									<input type="hidden" name="id_taxiaereo" id="id_taxiaereo" value="<?= $id_logado; ?>">
									<input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?= $dados_logado['tipo_usuario']; ?>">
									<textarea name="texto" id="texto" cols="30" rows="10"></textarea>
								</div>
								<div class="btn-bloco">
									<button type="submit" class="on_bottom">Enviar Mensagem</button>
								</div>
								</form>
							</div>

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
<script>
	$("#imprimir-btn").click(function(e){
		e.preventDefault();	
		$("#imprimirArea").print({
			globalStyles: true,
			mediaPrint : true
			// stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
		});

	});
</script>
<script>
	function mascaraValor(valor) {
	  valor = valor.toString().replace(/\D/g,"");
	  valor = valor.toString().replace(/(\d)(\d{14})$/,"$1.$2");
	  valor = valor.toString().replace(/(\d)(\d{11})$/,"$1.$2");
	  valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
	  valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
	  valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
	  return valor                    
	}
	var totalGeral = 0;
	$(document).ready(function(){
	  var tempo_voo = $('#tempo_estimado_total').val();

	 //calculando o tempo estimado
	  var format_tempo = tempo_voo.split(":");
	  var hora = parseInt(format_tempo[0]);
	  var minuto = parseInt(format_tempo[1]);
	  
	  var totalMinutos = hora*60;
	  totalGeral = totalMinutos + minuto;
	});


	function pad(str, max){
	  str = str.toString();
	  return str.length < max ? pad("0" + str, max) : str;
	}

	$("#select-prefixo").change(function(){
		// var id_prefixo = $("[data-id]").data("id");
		var id_prefixo = $(this).find(":selected").data("id");
		var valor_prefixo = $(this).val();
		$("#id-prefixo").val(id_prefixo);
		$("#prefixo").val(valor_prefixo);


		var aeronave = $("#aeronave_"+id_prefixo).val();
		var velocidade = $("#velocidade_"+id_prefixo).val();
		var valor = $("#valor_"+id_prefixo).val();
		var valor_pernoite = $("#valor_pernoite_"+id_prefixo).val();

		var tempo_estimado = $("#tempo_estimado_total_"+id_prefixo).val();
		var distancia_trecho = $("#distancia_total_"+id_prefixo).val();

		//refazendo o tempo estimado com base na distancia do trecho
        var tempo_custo = (distancia_trecho/velocidade)*60;
		var hora = Math.floor(tempo_custo/60);
		var minuto = Math.floor(tempo_custo%60);
		minuto = pad(minuto, 2);
		tempo_estimado = hora+":"+minuto;


		//calculando o tempo estimado
		var format_tempo = tempo_estimado.split(":");
		var hora = parseInt(format_tempo[0]);
		var minuto = parseInt(format_tempo[1]);
		  
		var totalMinutos = hora*60;
		totalGeral = totalMinutos + minuto;

		var valorRemoveDecimal = valor.split(",");
		var valorReformatado = parseInt(valorRemoveDecimal[0].replace(".",""));

		var x = (100 * totalGeral) / 60;
		var custo_estimado = ((valorReformatado*x)/100).toFixed(2);


		$("#aeronave").val(aeronave);
		$("#velocidade").val(velocidade);
		$("#valor").val(valor);
		$("#valor_pernoite").val(valor_pernoite);

	  	$('#custo_estimado').val(mascaraValor(custo_estimado));
  		$('#campo_tempo_voo').html(tempo_estimado);	
	});
	$('#valor').keyup(function(e) {
	  e.preventDefault();

	  var valorFormatado = $(this).val().split(",");
	  var valorFormatado2 = parseInt(valorFormatado[0].replace(".",""));
	  var y = (100 * totalGeral) / 60;
	  var custo_estimado = ((valorFormatado2*y)/100).toFixed(2);

	  $('#custo_estimado').val(mascaraValor(custo_estimado));

	});
	$("#valor").maskMoney({showSymbol:true,symbol:"", decimal:",", thousands:".", allowZero:true, precision: 2});
	// $("#msg-texto").hide();
	$("[data-exibir]").click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var valor_msg = $(this).data("exibir");
		$("#"+valor_msg).slideDown();
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