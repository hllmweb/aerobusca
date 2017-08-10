<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel Teqnologik</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-awesome-4.6.1/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#143249">
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo"></div>
		<ul>
			<li class="fade atual">
				<a href="index.php" data-color-link="#f1c40f">
					<span class="menu_icon"><i class="fa fa-line-chart"></i></span>
					<span class="menu_text">Principal</span>
				</a>
			</li>
			<li class="fade">
				<a href="#" data-color-link="#e74c3c">
					<span class="menu_icon"><i class="fa fa-support"></i></span>
					<span class="menu_text">Suporte</span>
				</a>
			</li>
			<li class="fade">
				<a href="usuarios.php" data-color-link="#92F22A">
					<span class="menu_icon"><i class="fa fa-users"></i></span>
					<span class="menu_text">Usuários</span>
				</a>
			</li>
			<li class="fade">
				<a href="#" data-color-link="#9b59b6">
					<span class="menu_icon"><i class="fa fa-google"></i></span>
					<span class="menu_text">SEO</span>
				</a>
			</li>
			<li class="fade">
				<a href="#" data-color-link="#e67e22">
					<span class="menu_icon"><i class="fa fa-code"></i></span>
					<span class="menu_text">Código Fonte</span>
				</a>
			</li>
			<li class="fade">
				<a href="configuracoes.php" data-color-link="#34495e">
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
					<a href="javascript:void(0)" class="open_notifications fade"><i class="fa fa-bell fade"></i><span class="notifications_counter"></span></a>
				</li>
			</ul>
			<ul style="float:right" class="not_responsive">
				<li><a href="#">[nome de usuario]</a></li>
				<li><a href="#"><i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>


		<div class="container">
			<!-- Colunas Simples -->
			<div class="row">
				<div class="column-2x4">
					<div class="column-1x4">
						<div class="widget">
							<div class="widget_title">Total Usuários</div>
							<div class="widget_body main_counts">
								<div class="main_counts_icon"><i class="fa fa-users"></i></div>
								<span class="main_counts_name">5 Usuários</span>
							</div>
						</div>
					</div>
					<div class="column-1x4">
						<div class="widget">
							<div class="widget_title">Total Lucros</div>
							<div class="widget_body main_counts positive">
								<div class="main_counts_icon"><i class="fa fa-dollar"></i></div>
								<span class="main_counts_name">+ R$ 55.80</span>
							</div>
						</div>
					</div>

					<div class="widget">
						<div class="widget_title">Metas Mensais</div>
						<div class="widget_body quota">
							<table>
								<tr>
									<td><i class="fa fa-user-plus"></i> Usuários</td>
									<td>
										<span class="quota_desc">80/100</span>
										<div class="quota_bar"><span class="quota_bar_fill" id="users_quota"></span></div>
									</td>
								</tr>
								<tr>
									<td><i class="fa fa-dollar"></i> Renda</td>
									<td>
										<span class="quota_desc">R$ 180/600</span>
										<div class="quota_bar">
											<span class="quota_bar_fill" id="cash_quota"></span>
										</div>
									</td>
								</tr>
								<tr>
									<td><i class="fa fa-line-chart"></i> Visitas</td>
									<td>
										<span class="quota_desc">4560/10000</span>
										<div class="quota_bar"><span class="quota_bar_fill" id="visits_quota"></span></div>
									</td>
								</tr>
							</table>
						</div>
					</div>

					<div class="widget">
						<div class="widget_title">Programa de Afiliados</div>
					</div>
				</div>
				<div class="column-2x4">
					<div class="widget">
						<div class="widget_title">Estatísticas dos últimos 3 meses</div>
						<div class="widget_body statistics">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<th colspan="3">Total de Visitantes: 1000</th>
								</tr>
								<tr>
									<th colspan="3">Total de Cadastrados: 1000</th>
								</tr>
								<tr>
									<th colspan="3">Total de Vendas: 1000</th>
								</tr>
								<tr>
									<td>
										<div class="statistics_bar">
											<div class="visitors_bar"><div class="number_bar">300</div></div>
											<div class="subscribers_bar"><div class="number_bar">120</div></div>
											<div class="sales_bar"><div class="number_bar">30</div></div>
										</div>
									</td>
									<td>
										<div class="statistics_bar">
											<div class="visitors_bar"></div>
											<div class="subscribers_bar"></div>
											<div class="sales_bar"></div>
										</div>
										<div class="number_bar"></div>
									</td>
									<td>
										<div class="statistics_bar">
											<div class="visitors_bar"></div>
											<div class="subscribers_bar"></div>
											<div class="sales_bar"></div>
										</div>
										<div class="number_bar"></div>
									</td>
								</tr>
								<tr>
									<td><div class="month_bar">Fevereiro</div></td>
									<td><div class="month_bar">Março</div></td>
									<td><div class="month_bar">Abril</div></td>
								</tr>
							</table>
							<div class="statistics_subtitles">
								<span>Em relação às estatísticas globais:</span>
								<div style="color:#FD5B03;"><i class="fa fa-square"></i> Visitantes</div>
								<div style="color:#1DABB8;"><i class="fa fa-square"></i> Usuários Cadastrados</div>
								<div style="color:#92F22A;"><i class="fa fa-square"></i> Número de Vendas</div>
							</div>
						</div>
					</div>

					<div class="widget">
						<div class="widget_title">Notificações</div>
						<div class="widget_body notifications">
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
						</div>
					</div>
				</div>
			</div>

			<!-- Colunas Triplas e Simples -->
			<div class="row">
				<div class="column-3x4">
					<div class="widget">
						<div class="widget_title">Coluna 3x4</div>
					</div>
				</div>
				<div class="column-1x4">
					<div class="widget">
						<div class="widget_title">Coluna 1x4</div>
					</div>
				</div>
			</div>

			<!-- Colunas Inteiras (4x) -->
			<div class="row">
				<div class="column-4x4">
					<div class="widget">
						<div class="widget_title">Coluna 4x4</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript" src="js/site.js"></script>
<script type="text/javascript">
window.onload = function(){
	$("#visits_quota").css("width", "45.6%");
	$("#users_quota").css("width", "80%");
	$("#cash_quota").css("width", "30%");
}
</script>
</body>
</html>