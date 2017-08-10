<?php

include "lib/autoload.php";
@session_start();

if(!isset($_SESSION['busca'])){
	header("Location: $root_site");
}else{
	if(!isset($_GET['id'])){
		header("Location: $root_site/busca");
	}else{
		$aeronave_id = $_GET['id'];
		$busca = $_SESSION['busca'];
	}
}

$dados_busca = json_decode($busca);

$dados_aeronave = $aeronave->dadosAeronave($aeronave_id);

$imagens = json_decode($dados_aeronave['imagens']);

// $tempo = $distancia_formatado/$aeronave['velocidade'];
// $tempo_voo = $tempo*2;

// $tempo_voo 	= calculaTempo($tempo_voo);
// $tempo 		= calculaTempo($tempo);

$total_locais = count($dados_busca->origem_local_lat);
$distancia = 0;
for ($i=0; $i<$total_locais; $i++){
 	$atual = $i;
	$distancia += $aeronave->haversine(
		$dados_busca->origem_local_lat[$atual],
		$dados_busca->origem_local_lng[$atual],
		$dados_busca->destino_local_lat[$atual],
		$dados_busca->destino_local_lng[$atual]
	);
}

$distancia_total = ($distancia * 2) / $dados_aeronave['velocidade'];

$preco = $distancia_total * $dados_aeronave['valor'];
$preco = number_format($preco, 2 ,",", ".");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $dados_aeronave['fabricante']; ?> - <?= $dados_aeronave['modelo']; ?> | <?= substr($dados_busca->origem[0], 0, strpos($dados_busca->origem[0], ",")); ?> > <?= substr($dados_busca->destino[0], 0, strpos($dados_busca->destino[0], ",")); ?></title>

	<link rel="stylesheet" href="<?= $root_site; ?>/css/site.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/jquery.bxslider.css">
	<link rel="stylesheet" href="<?= $root_site; ?>/css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="<?= $root_site; ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.bxslider.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.appear.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.mask.min.js"></script>
	<script src="<?= $root_site; ?>/js/jquery.maskMoney.min.js"></script>

	<script>
		var global_lat = 0;
		var global_lng = 0;

		var root_url = "<?= $root_site; ?>";

		global_lat = "<?= $dados_busca->origem_local_lat[0]; ?>";
		global_lng = "<?= $dados_busca->origem_local_lng[0]; ?>";

		var token_cotacao = "<?= $token; ?>";

		var cidade = "<?= $dados_busca->origem[0]; ?>";

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
<!-- <div class="header-espaco"> -->
		<header class="menu-header">
			<div class="limite">
				<div class="logo">
					<a href="<?= $root_site; ?>"><img src="<?= $root_site; ?>/img/logo.png" alt="Aerobusca"></a>
				</div>
				<ul>
					<li><a href="#">Início</a></li>
					<li><a href="#">Serviços</a></li>
					<?php if(!$auth->loginValido()): ?>
					<li><a href="cadastro">Cadastro</a></li>
					<?php else: ?>
					<li><a href="<?= $root_site; ?>/sair">Sair</a></li>
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
	<!-- </div> -->

	<div class="limite">					

		<div id="cotacao-wrapper">
			<div class="cotacao-topo">
				<div class="aeronave-infos-cotacao">
					<div class="aeronave-infos-cotacao-esquerdo">
						<div class="aeronave-nome" id="cotacao-aeronave-nome"></div>
						<div class="cidade" id="cotacao-cidade"></div>
					</div>
					<div class="aeronave-infos-cotacao-direito">
						<div class="aeronave-estrelas">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<a href="#" class="ver-mapa"><i class="fa fa-map-marker"></i> Ver o mapa</a>
					</div>
				</div>

				<div class="fazer-cotacao">
					<div class="preco" id="cotacao-preco"><?= $preco; ?></div>
					<a href="javascript:voltarbusca();" class="voltar">VOLTAR</a>
					<a href="javascript:addCotacao(<?= $aeronave_id; ?>);">ADICIONAR COTAÇÃO</a>
				</div>
			</div>

			<div class="cotacao-lado-esquerdo">
				<div class="cotacao-slide">
					<ul id="slide-cotacao">
						<li><img src="<?= $root_site; ?>/arquivo/<?= $imagens->imagem1; ?>" width="100%" height="400px"></li>
						<li><img src="<?= $root_site; ?>/arquivo/<?= $imagens->imagem2; ?>" width="100%" height="400px"></li>
						<li><img src="<?= $root_site; ?>/arquivo/<?= $imagens->imagem3; ?>" width="100%" height="400px"></li>
						<li><img src="<?= $root_site; ?>/arquivo/<?= $imagens->imagem4; ?>" width="100%" height="400px"></li>
					</ul>
				</div>	
			</div>

			<div class="cotacao-lado-direito">

				<table>
					<tr>
						<th>Origem</th>
						<th>Destino</th>
						<th>Ida</th>
						<th>Volta</th>
					</tr>

					<tr>
						<td><?= substr($dados_busca->origem[0], 0, strpos($dados_busca->origem[0], ",")); ?></td>
						<td><?= substr($dados_busca->destino[0], 0, strpos($dados_busca->destino[0], ",")); ?></td>
						<td><?= $dados_busca->data_ida[0]; ?> às <?= $dados_busca->hora_ida[0]; ?></td>
						<td><?= $dados_busca->data_volta[0]; ?> às <?= $dados_busca->hora_volta[0]; ?></td>
					</tr>
				</table>

				<div class="div-abas-cotacao">
					<ul class="menu-abas">
						<li><a href="#" class="ativo fade" data-abrir="aba-informacoes">Informações Técnicas</a></li>
						<li><a href="#" class="fade" data-abrir="aba-visao">Visão Geral</a></li>
					</ul>
					<div id="aba-informacoes" class="menu-aba">
						<table class="info-tabela">
							<tr>
								<td data-tooltip="Aeronave"><img src="<?= $root_site; ?>/img/aeronave.png"></td>
								<td><?= $dados_aeronave['fabricante']; ?> <?= $dados_aeronave['modelo']; ?></td>
							</tr>

							<tr>
								<td data-tooltip="Passageiros"><img src="<?= $root_site; ?>/img/passageiros.png"></td>
								<td>Até <?= $dados_aeronave['passageiros']; ?> pax</td>
							</tr>

							<tr>
								<td data-tooltip="Autonomia"><img src="<?= $root_site; ?>/img/autonomia.png"></td>
								<td><?= $aeronave->tempoAutonomia($dados_aeronave['autonomia']); ?> hrs</td>
							</tr>

							<tr>
								<td data-tooltip="Tempo de ida"><img src="<?= $root_site; ?>/img/autonomia.png"></td>
								<td>Tempo de ida: <?= $aeronave->tempoAutonomia($distancia / $dados_aeronave['velocidade']); ?> hrs</td>
							</tr>

							<tr>
								<td data-tooltip="Tempo de ida e volta"><img src="<?= $root_site; ?>/img/autonomia.png"></td>
								<td>Tempo de ida e volta: <?= $aeronave->tempoAutonomia(($distancia * 2) / $dados_aeronave['velocidade']); ?> hrs</td>
							</tr>
						</table>

						
					</div>
					<div id="aba-visao" class="menu-aba">
						<p><?= $dados_aeronave['visao_geral']; ?></p>
					</div>
				</div>
			</div>
		</div>
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

<div class="modal-mapa">
	<div class="corpo-mapa" id="map"></div>
</div>

<script src="<?= $root_site; ?>/js/site.js?v=<?= time(); ?>"></script>
<script src="<?= $root_site; ?>/js/busca_aeronave.js?v=<?= time(); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSuXH0sCB7bgQYBa9hAo4rWbySPoelNQ&libraries=places&callback=googlemaps"></script>
<script>
	slide_aeronave = $("#slide-cotacao").bxSlider({
    	mode: "horizontal",
    	auto: false,
    	nextText: "<i class=\"fa fa-angle-right\"></i>",
    	prevText: "<i class=\"fa fa-angle-left\"></i>"
    });


	function verMapa(){
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 3,
			center: {lat: parseFloat("<?= $dados_busca->origem_local_lat[0]; ?>"), lng: parseFloat("<?= $dados_busca->origem_local_lng[0]; ?>")},
			mapTypeId: google.maps.MapTypeId.TERRAIN
		});

		var flightPlanCoordinates = [
		<?php
			$total_locais = count($dados_busca->origem_local_lat);
			$distancia = 0;
			for ($i=0; $i<$total_locais; $i++):
			 	$atual = $i;
			?>
			{lat: parseFloat("<?= $dados_busca->origem_local_lat[$atual]; ?>"), lng: parseFloat("<?= $dados_busca->origem_local_lng[$atual]; ?>")},
		    {lat: parseFloat("<?= $dados_busca->destino_local_lat[$atual]; ?>"), lng: parseFloat("<?= $dados_busca->destino_local_lng[$atual]; ?>")},

		<?php 
			endfor;
		?>

		];
		var flightPath = new google.maps.Polyline({
		    path: flightPlanCoordinates,
		    geodesic: true,
		    strokeColor: '#FF0000',
		    strokeOpacity: 1.0,
		    strokeWeight: 2
		});

		flightPath.setMap(map);

		<?php
			$lat_min_origem = min($dados_busca->origem_local_lat);
			$lat_max_origem = max($dados_busca->origem_local_lat);
			$lng_min_origem = min($dados_busca->origem_local_lng);
			$lng_max_origem = max($dados_busca->origem_local_lng);

			$lat_min_destino = min($dados_busca->destino_local_lat);
			$lat_max_destino = max($dados_busca->destino_local_lat);
			$lng_min_destino = min($dados_busca->destino_local_lng);
			$lng_max_destino = max($dados_busca->destino_local_lng);

			$lats = array($lat_min_origem, $lat_max_origem, $lat_min_destino, $lat_max_destino);
			$lngs = array($lng_min_origem, $lng_max_origem, $lng_min_destino, $lng_max_destino);

		?>

		var lat_min = parseFloat("<?= min($lats); ?>");
		var lat_max = parseFloat("<?= max($lats); ?>");
		var lng_min = parseFloat("<?= min($lngs); ?>");
		var lng_max = parseFloat("<?= max($lngs); ?>");

		map.setCenter(new google.maps.LatLng(
		  ((lat_max + lat_min) / 2.0),
		  ((lng_max + lng_min) / 2.0)
		));
		map.fitBounds(new google.maps.LatLngBounds(
		  //bottom left
		  new google.maps.LatLng(lat_min, lng_min),
		  //top right
		  new google.maps.LatLng(lat_max, lng_max)
		));

	}

$(".ver-mapa").click(function(e){
    $(".modal-mapa").fadeIn(100);
    verMapa();
});

</script>
</body>
</html>