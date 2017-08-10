<?php

include "lib/autoload.php";
@session_start();

// salva busca
if(!isset($_POST['origem'])){
	$busca = $_SESSION['busca'];
}else{
	$_SESSION['busca'] = json_encode($_POST, JSON_PRETTY_PRINT);
}

if(!isset($_SESSION['busca'])){
	header("Location: $root_site");
}

$dados_busca = json_decode($_SESSION['busca']);

$lat1 = $dados_busca->origem_local_lat[0];
$lng1 = $dados_busca->origem_local_lng[0];
$lat2 = $dados_busca->destino_local_lat[0];
$lng2 = $dados_busca->destino_local_lng[0];


$distancia = $aeronave->haversine($lat1, $lng1, $lat2, $lng2);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Busca</title>
	<link rel="stylesheet" href="<?= $root_site; ?>/css/site.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/jquery.bxslider.css">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?= $root_site; ?>/js/multiple-select.js"></script>
	<link rel="stylesheet" href="<?= $root_site; ?>/css/multiple-select.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.maskMoney.min.js"></script>
	<script src="<?= $root_site; ?>/js/json2.js"></script>

	<script>
		var global_lat = 0;
		var global_lng = 0;

		var root_url = "<?= $root_site; ?>";

		global_lat = "<?= $dados_busca->origem_local_lat[0]; ?>";
		global_lng = "<?= $dados_busca->origem_local_lng[0]; ?>";
	
		global_lat_destino = "<?= $dados_busca->destino_local_lat[0]; ?>";
		global_lng_destino = "<?= $dados_busca->destino_local_lng[0]; ?>";
		
		//alteração, foi inserido uma condicional se existir o token
		var token_cotacao = "<?= (isset($token)) ? $token : ''; ?>";

		var cidade = "<?= $dados_busca->origem[0]; ?>";
		var passageiros = "<?= $dados_busca->passageiros[0]; ?>";
	</script>
</head>
<body>

<div class="side-social">
	<ul>
		<li><a href="#email"><i class="fa fa-envelope"></i></a></li>
		<li><a href="#app"><i class="fa fa-mobile"></i></a></li>
		<li><a href="#whatsapp"><i class="fa fa-whatsapp"></i></a></li>
	</ul>
</div>

<div id="wrapper">
<div class="header-espaco-n">
	<!-- <div class="header-fixo"> -->
		<header class="menu-header">
			<div class="limite">
				<div class="logo">
					<a href="<?= $root_site; ?>"><img src="<?= $root_site; ?>/img/logo.png" alt="Aerobusca"></a>
				</div>
				<ul>
					<li><a href="index">Início</a></li>
					<li><a href="#">Serviços</a></li>
					<?php if(!$auth->loginValido()): ?>
					<li><a href="cadastro">Cadastro</a></li>
					<?php else: ?>
					<li><a href="sair">Sair</a></li>
					<?php endif; ?>
					<div class="menu-conta">
						<div id="submenu-cotacoes" class="submenu">
							<div class="submenu-titulo">Minhas cotações</div>

							<div id="loadcotacoes">
							</div>

							<div class="loading-cotacoes">
								<i class="fa fa-spinner fa-pulse"></i>
							</div>

							<div class="submenu-cotacoes-opcoes">
								<div class="submenu-cotacoes-opcao-esquerda">
									<a href="#">Fazer mais cotações</a>
								</div>
								<div class="submenu-cotacoes-opcao-direita">
									<a href="<?= $root_site; ?>/cotacao-finalizada">Finalizar cotações</a>
								</div>
							</div>
						</div>

						<?php if($auth->loginValido()): ?>
							<?php if($dados_logado['tipo_usuario'] == "admin" || $dados_logado == "taxiaereo"): ?>
								<li><a href="<?= $root_sistema; ?>">Painel de controle</a></li>
							<?php else: ?>
								<li>
									<a href="#" data-abrir-submenu="submenu-cotacoes"><span class="menu-conta-icon full"><i class="fa fa-plane"></i></span> Minhas Cotações (<span id="cont_cotacoes"><?= $cotacao->contaCarrinho($token); ?></span>) <i class="fa fa-caret-down"></i></a>
								</li>
								<li>
									<a href="<?= $root_site; ?>/minha-conta"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Minha Conta</a>
								</li>
							<?php endif; ?>
						<?php else: ?>
							<li>
								<a href="javascript:abrirModal('#login_modal');"><span class="menu-conta-icon"><i class="fa fa-user"></i></span> Entrar</a>
							</li>
						
						<?php endif; ?>
						
					</div>
				</ul>
			</div>
		</header>
		<div class="formulario-busca">
			
			<form action="busca" method="post" id="formulario-de-busca">

					<div class="formulario-inputs">
	
						<?php

						function selectedCatVoo($cat_atual, $cat_voo){
							if($cat_atual == $cat_voo){
								return "selected";
							}
						}
						?>
						<select name="cat_voo" id="cat-voo" style="vertical-align:top">
							<option <?= selectedCatVoo("passageiros", $dados_busca->cat_voo); ?> value="passageiros">Passageiros</option>
							<option <?= selectedCatVoo("cargas", $dados_busca->cat_voo); ?> value="cargas">Cargas</option>
							<option <?= selectedCatVoo("remocao_aerea", $dados_busca->cat_voo); ?> value="remocao_aerea">Remoção Aérea</option>
							<option <?= selectedCatVoo("uti_aerea", $dados_busca->cat_voo); ?> value="uti_aerea">UTI Aérea</option>
							<option <?= selectedCatVoo("instrucao", $dados_busca->cat_voo); ?> value="instrucao">Instrução de Vôo</option>
						</select>


						<select name="cat_aeronave1" id="cat-aeronave" style="vertical-align:top" class="cat_aeronave_select" multiple>
							<?php
								$categorias = $categoria->listaCategorias();

								foreach($categorias as $dado):
									$categoria_formatado = strtolower(str_replace(" ", "_", $utilitarios->removerAcentos($dado['nome_categoria'])));

									$categorias_aeronave = explode(",", $dados_busca->cat_aeronave);

									if(in_array($categoria_formatado, $categorias_aeronave)){
										$selected = "selected";
									}else{
										$selected = "";
									}
							?>
							<option value="<?= $categoria_formatado; ?>" <?= $selected; ?>><?= $dado['nome_categoria']; ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="cat_aeronave" value="<?= $dados_busca->cat_aeronave; ?>">
						
						<div class="outras-linhas-campos">
							<div class="linha-campos">
								<input type="hidden" name="count[]" value="ok">
								<label for="origem">
									<span class="icone-input"><i class="fa fa-plane"></i></span>
									<input type="text" name="origem[]" id="origem" placeholder="Origem" class="origens local" value="<?= $dados_busca->origem[0]; ?>">
									<input type="hidden" name="origem_local_lat[]" class="local_lat" value="<?= $dados_busca->origem_local_lat[0]; ?>"> 
									<input type="hidden" name="origem_local_lng[]" class="local_lng" value="<?= $dados_busca->origem_local_lng[0]; ?>">
								</label>
								<label 
								for="destino">
									<span class="icone-input"><i class="fa fa-plane fa-flip-horizontal"></i></span>
									<input type="text" name="destino[]" id="destino" placeholder="Destino" class="destinos local" value="<?= $dados_busca->destino[0]; ?>">
									<input type="hidden" name="destino_local_lat[]" class="local_lat" value="<?= $dados_busca->destino_local_lat[0]; ?>">
									<input type="hidden" name="destino_local_lng[]" class="local_lng" value="<?= $dados_busca->destino_local_lng[0]; ?>">
								</label>
								<label for="data-ida">
									<span class="icone-input"><i class="fa fa-calendar"></i></span>
									<input type="text" name="data_ida[]" placeholder="Ida" class="menor data-input" value="<?= $dados_busca->data_ida[0]; ?>">
									<!-- colocar calendario -->
								</label>
								<label for="hora-ida">
									<span class="icone-input"><i class="fa fa-clock-o"></i></span>
									<input type="text" name="hora_ida[]" id="hora_ida" placeholder="HH:MM" class="hora hora_ida" value="<?= $dados_busca->hora_ida[0]; ?>">
								</label>
								<?php 
									if($dados_busca->data_volta[0] == ""){
										$desabilitado = "";
									}else{
										$desabilitado = "desativado";
									}
								?>
								<label for="data-volta">
									<span class="icone-input <?= $desabilitado; ?>"><i class="fa fa-calendar"></i></span>
									<input type="text" name="data_volta[]" id="data_volta" placeholder="Volta" class="menor data-input <?= $desabilitado; ?>" value="<?= $dados_busca->data_volta[0]; ?>">
								</label>
								<label for="hora-volta">
									<span class="icone-input <?= $desabilitado; ?>"><i class="fa fa-clock-o"></i></span>
									<input type="text" name="hora_volta[]" id="hora_volta" placeholder="HH:MM" class="hora hora_volta <?= $desabilitado; ?>" value="<?= $dados_busca->hora_volta[0]; ?>">
								</label>
								<label for="passageiros">
									<span class="icone-input"><i class="fa fa-user"></i></span>
									<input type="number" id="passageiros" name="passageiros[]" class="passageiros" value="<?= $dados_busca->passageiros[0]; ?>" min="1">
								</label>

								<button title="Clique para adicionar outra cidade" class="add-cidade maior">Adicionar</button>
							</div>

						</div>
						
						<div class="btn-buscar">
							<button type="submit"><i class="fa fa-search"></i> Buscar</button>
						</div>
					</div>

					
				</form>
	</div>
<!-- </div> -->
	</div>

	<div class="limite">
		<div id="busca-wrapper">
			<div class="sidebar">
				<div class="sidebar-fixed">
				<div class="titulo-master">Filtrar cotação</div>
				<form class="form-filtro" id="parametros">
					<!--<div class="widget aberto">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Preço</div>
						<div class="widget-corpo">
							<div class="div-range">
								<div class="preco-minimo">R$ 400</div>
								<div class="preco-maximo">R$ 10.000</div>
								<input type="range" min="400" max="10000" step="100" id="range-valor">

								<div class="preco-minimo">
									<label for="preco-minimo">Min.</label>
									<input type="text" id="preco-minimo" name="preco-minimo" value="400">
								</div>
								<div class="preco-maximo">
									<label for="preco-maximo">Max.</label>
									<input type="text" id="preco-maximo" name="preco-maximo">
								</div>

								<div class="preco-minimo"></div>
								<div class="preco-maximo">
									<button type="submit">Aplicar</button>
								</div>								
							</div>
						</div>
							
						
					</div>-->
					
					<div class="widget aberto">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Categoria de voo</div>
						<div class="widget-corpo">
							<!-- <div class="input-checkbox">
								<input type="checkbox" id="todos-categoria-voo" name="todos-categoria-voo" class="selecionar-todos" data-parametro="todos"  data-tipo-parametro="categoria_voo">
								<label for="todos-categoria-voo">Selecionar todos</label>
							</div> -->
							<?php
								function checkedCatVoo($cat_atual, $cat_voo){
									if($cat_atual == $cat_voo){
										return "checked";
									}
								}
							?>

							<div class="input-checkbox">
								<input type="checkbox" id="passageiros" name="passageiros" data-parametro="passageiros" data-tipo-parametro="categoria_voo" <?= checkedCatVoo("passageiros", $dados_busca->cat_voo); ?>>
								<label for="passageiros">Passageiros</label>
							</div>
							

							<div class="input-checkbox">
								<input type="checkbox" id="cargas" name="cargas" data-parametro="cargas"  data-tipo-parametro="categoria_voo" <?= checkedCatVoo("cargas", $dados_busca->cat_voo); ?>>
								<label for="cargas">Cargas</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="remocao-aerea" name="remocao-aerea" data-parametro="remocao_aerea"  data-tipo-parametro="categoria_voo" <?= checkedCatVoo("remocao_aerea", $dados_busca->cat_voo); ?>>
								<label for="remocao-aerea">Remoção Aérea</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="uti-aerea" name="uti_aerea" data-parametro="uti_aerea" data-tipo-parametro="categoria_voo" <?= checkedCatVoo("uti_aerea", $dados_busca->cat_voo); ?>>
								<label for="uti-aerea">UTI Aérea</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="instrucao" name="instrucao" data-parametro="instrucao" data-tipo-parametro="categoria_voo" <?= checkedCatVoo("instrucao", $dados_busca->cat_voo); ?>>
								<label for="instrucao">Instrução</label>
							</div>
						</div>
					</div>


					<div class="widget">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Categoria da aeronave</div>
						<div class="widget-corpo">
							<div class="input-checkbox">
								<input type="checkbox" id="todos-categoria-aeronave" name="todos-categoria-aeronave" class="selecionar-todos" data-parametro="todos" data-tipo-parametro="categoria_aeronave">
								<label for="todos-categoria-aeronave">Selecionar todos</label>
							</div>

							<?php
								$categorias = $categoria->listaCategorias();

								foreach($categorias as $dado):
									$categoria_formatado = strtolower(str_replace(" ", "_", $utilitarios->removerAcentos($dado['nome_categoria'])));

									$categorias_aeronave = explode(",", $dados_busca->cat_aeronave);

									if(in_array($categoria_formatado, $categorias_aeronave)){
										$checked = "checked";
									}else{
										$checked = "";
									}

							?>
							<div class="input-checkbox">
								<input type="checkbox" id="<?= $categoria_formatado; ?>" name="<?= $categoria_formatado; ?>" value="<?= $dado['nome_categoria']; ?>" data-parametro="<?= $categoria_formatado; ?>" data-tipo-parametro="categoria_aeronave" <?= $checked; ?>>
								<label for="<?= $categoria_formatado; ?>"><?= $dado['nome_categoria']; ?></label>
							</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="widget">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Fabricante</div>
						<div class="widget-corpo">
							<div class="input-checkbox">
								<input type="checkbox" id="todos-fabricante" name="todos-fabricante" class="selecionar-todos">
								<label for="todos-fabricante">Selecionar todos</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="aero-commander" name="aero-commander">
								<label for="aero-commander">Aero Commander</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="aa" name="aa">
								<label for="aa"> Resto dos fabricantes existentes...</label>
							</div>
						</div>
					</div>

					<div class="widget">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Serviço de bordo</div>
						<div class="widget-corpo">
							<div class="input-checkbox">
								<input type="checkbox" id="todos-servicos-bordo" name="todos-servicos-bordo" class="selecionar-todos">
								<label for="todos-servicos-bordo">Selecionar todos</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="simples" name="simples">
								<label for="simples">Simples</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="completo" name="completo">
								<label for="completo">Completo</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="especial" name="especial">
								<label for="especial">Especial</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="vip" name="vip">
								<label for="vip">VIP</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="diamante" name="diamante">
								<label for="diamante">Diamante</label>
							</div>
						</div>
					</div>

					<div class="widget">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Banheiro</div>
						<div class="widget-corpo">
							<div class="input-checkbox">
								<input type="checkbox" id="todos-servicos-bordo" name="todos-servicos-bordo" class="selecionar-todos">
								<label for="todos-servicos-bordo">Selecionar todos</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="parciao" name="parciao">
								<label for="parciao">Parcial</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="completo-banheiro" name="completo-banheiro">
								<label for="completo-banheiro">Completo</label>
							</div>
						</div>
					</div>

					<div class="widget">
						<div class="titulo-widget"><i class="fa fa-angle-down"></i> Classificação por estrelas</div>
						<div class="widget-corpo">
							<div class="input-checkbox">
								<input type="checkbox" id="5-estrelas" name="5-estrelas">
								<label for="5-estrelas" class="estrelas">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="4-estrelas" name="4-estrelas">
								<label for="4-estrelas" class="estrelas">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="3-estrelas" name="3-estrelas">
								<label for="3-estrelas" class="estrelas">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="2-estrelas" name="2-estrelas">
								<label for="2-estrelas" class="estrelas">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</label>
							</div>

							<div class="input-checkbox">
								<input type="checkbox" id="1-estrelas" name="1-estrelas">
								<label for="1-estrelas" class="estrelas">
									<i class="fa fa-star"></i>
								</label>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
			<div class="busca-conteudo">
				
				<div class="ordenar-resultado">
					<div class="ordenar-resultado-esquerda">
						Foram encontradas <b id="qtd_resultados"></b> aeronaves em <b id="base_operacao_qtd"><?= $dados_busca->origem[0]; ?></b>
					</div>
					<div class="ordenar-resultado-direita">
						Ordenar por:
						<select id="ordenar-por">
							<option value="distance">Mais próximo</option>
							<option value="custo_total" selected="">Menor Preço</option>
						</select>
					</div>
				</div>

				<div class="resultado-aeronaves">
					

				</div><!-- Fim resultado aeronaves -->
				<div class="carregando_aeronaves">
					<i class="fa fa-spinner fa-pulse"></i>
				</div>

			</div>
		</div>
		<input type="hidden" id="ultimo_resultado" value="2">

	</div>
</div>

<div id="login_modal" class="modal">
	<div class="modal_corpo_login">
		<div class="modal_titulo_login">
			<b><div class="modal_icon"><i class="fa fa-user"></i></div>ACESSE SUA CONTA</b>
			<a href="javascript:void(0)" class="btn_fechar_modal fechar_modal"><i class="fa fa-times"></i></a>
		</div>

		<div class="modal_conteudo_login">
			<form class="form_login2" id="form-login">
				<input type="hidden" name="login" value="ok">
				<input type="text" placeholder="Email" name="email" class="fade" required="" title="Insira seu email">
				<input type="password" placeholder="Senha" name="senha" required="" title="Insira sua senha">
				<button type="submit">ENTRAR</button>
				<a href="#">Esqueceu sua senha?</a>
				<span>Ainda não tem cadastro?</span>
				<button class="cadastro" onclick="window.location.href = 'cadastro.php';">CADASTRE-SE AQUI</button>
			</form>
			
		</div>
	</div>
</div>
<script>
	ordenar = $("#ordenar-por").val();
</script>
<script src="js/maps.js?v=<?= versao(); ?>"></script>
<script src="<?= $root_site; ?>/js/site.js?v=<?= time(); ?>"></script>
<script src="<?= $root_site; ?>/js/busca_aeronave.js?v=<?= time(); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSuXH0sCB7bgQYBa9hAo4rWbySPoelNQ&libraries=places&callback=googlemaps"></script>
<script>
$(document).on("change", ".local", function(e){
	$(this).parent().find(".local_lat").val(global_lat);
	$(this).parent().find(".local_lng").val(global_lng);
});
$("#ordenar-por").change(function(){
	ordenar = $(this).val();
	primeira_pagina = false;
	$(".resultado-aeronaves").html("");
	carregarAeronaves(cidade, global_lat, global_lng, global_lat_destino, global_lng_destino, 1, passageiros, ordenar);
	//location.href = root_url+"/busca/ordenar-por/"+ordenar;
});
primeira_pagina = false;
carregarAeronaves(cidade, global_lat, global_lng, global_lat_destino, global_lng_destino, 1, passageiros, ordenar);
$(".titulo-widget").click(function(e){
	abrirWidget($(this));
});

$(".div-select-option").click(function(e){
	var valor = $(this).text();
	$(this).parent().parent().find("input").val(valor);
});

$(".aeronave-slide ul").each(function(index, e){
	slide = $(e).attr("id");
});

$(".slide-resultado").bxSlider({
	mode: 'horizontal',
	auto: false,
	nextText: '<i class="fa fa-angle-right"></i>',
	prevText: '<i class="fa fa-angle-left"></i>'
});

$('#cat-aeronave').multipleSelect({
    width: '200px',
    placeholder: "Categoria da aeronave",
    selectAll: false,
    maxHeight: 400
});
$("[name=cat_aeronave1]").change(function(e){
	$("[name=cat_aeronave]").val($(this).val());
});
</script>
	
</body>
</html>