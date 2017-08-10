<?php
require_once "instancia.php";

$pagina = (isset($_GET['p'])) ? $_GET['p'] : 1;

$categoria = (isset($_GET['categoria'])) ? $_GET['categoria'] : false;
$empresa = (isset($_GET['empresa'])) ? $_GET['empresa'] : '';

$todas_pag = $leilao->totalPaginasGanhadores(12);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ganhadores | Painel Leilões Freitas</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0A710A">
	<script src="js/jquery.maskMoney.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo"></div>
		<ul>
			<li class="fade">
				<a href="#" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-newspaper-o"></i></span>
					<span class="menu_text">Notícias</span>
				</a>
			</li>
			<li class="fade">
				<a href="index.php" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-legal"></i></span>
					<span class="menu_text">Leilões</span>
				</a>
			</li>
			<li class="fade">
				<a href="usuarios" data-color-link="#0A710A">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<li class="fade">
				<a href="#" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-user-secret"></i></span>
					<span class="menu_text">Leiloeiros</span>
				</a>
			</li>
			<li class="fade">
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
			<li class="fade atual">
				<a href="ganhadores" data-color-link="#0A710A">
					<span class="menu_icon fade"><i class="fa fa-star"></i></span>
					<span class="menu_text">Ganhadores</span>
				</a>
			</li>
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
				<li><a href="#"><?php echo $autenticacao->pegaNome($autenticacao->usuarioLogado()); ?></a></li>
				<li><a href="../index.php" class="sem-ajax"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>


		<div class="container">

			<!-- Colunas Triplas e Simples -->
			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Lista de ganhadores dos leilões</div>
						<div class="widget_body">
							<table>
								<tr>
									<th>ID</th>
									<th>Empresa</th>
									<th>Lote</th>
									<th>Descrição</th>
									<th>Ganhador</th>
									<th>Maior lance</th>
									<th>Ações</th>
								</tr>
							<?php
								$lista_leiloes = $leilao->ganhadoresLeiloes(false, false, $pagina);


								foreach ($lista_leiloes as $leilao_info): ?>
								<tr>
									<td><?php echo$leilao_info['id']; ?></td>
									<td><?php echo$leilao_info['empresa']; ?></td>
									<td><?php echo str_pad($leilao_info['lote'], 2, '0', STR_PAD_LEFT); ?></td>
									<td><span class="descricao_leilao_td"><?php echo$leilao_info['nome']; ?></span></td>
									<td><b><?php echo $leilao->nomeGanhador($leilao_info['id']); ?></b></td>
									<td>R$ <?php echo number_format($leilao->ultimoLance($leilao_info['id']), 2, ",", "."); ?></td>
									<td class="td_acoes">
										<a href="#" class="azul">VER PERFIL</a>
										<a href="#">VER LEILÃO</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</table>
							<?php if($leilao->totalGanhadores() == 0): ?>
								<div class="nenhum_ganhador"><i class="fa fa-times"></i> Ainda não há ganhadores.</div>
							<?php endif; ?>
								<div class="paginacao">
									<?php if($pagina > 1): ?>
									<a href="ganhadores?p=<?php echo$pagina-1; ?>">Anterior</a>
									<?php endif; ?>


									<?php for($i=0; $i < $todas_pag; $i++):
										if(!isset($_GET['p'])){
											if($i+1 == 1): ?>
												<a href="ganhadores?empresa=<?php echo$empresa; ?>&p=<?php echo$i+1; ?>" class="ativo fade"><?php echo$i+1; ?></a>
											<?php else: ?>
												<a href="ganhadores?empresa=<?php echo$empresa; ?>&p=<?php echo$i+1; ?>" class="fade"><?php echo$i+1; ?></a>
											<?php endif; 
										}elseif($i+1 == $_GET['p']){ ?>
												<a href="ganhadores?empresa=<?php echo$empresa; ?>&p=<?php echo$i+1; ?>" class="ativo fade"><?php echo$i+1; ?></a>
										<?php }else{ ?>
												<a href="ganhadores?empresa=<?php echo$empresa; ?>&p=<?php echo$i+1; ?>" class="fade"><?php echo$i+1; ?></a>
										<?php }
									endfor; ?>

									
									<?php if($pagina < $todas_pag): ?>
									<a href="ganhadores?p=<?php echo$pagina+1; ?>">Próxima</a>
									<?php endif; ?>
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
</body>
</html>