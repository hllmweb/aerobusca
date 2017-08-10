<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel Teqnologik</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="css/font-awesome-4.6.1/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#143249">
</head>
<body>

<div id="wrapper">
	
	<div id="sidebar_menu" class="oppened">
		<div class="logo"></div>
		<ul>
			<li class="fade">
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
			<li class="fade atual">
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
								<div class="notification_icon"><i class="fa fa-users"></i></div>
								<div class="notification_desc">50 novos usuários<br>a</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-users"></i></div>
								<div class="notification_desc">50 novos usuários</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-users"></i></div>
								<div class="notification_desc">50 novos usuários<br>a</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-users"></i></div>
								<div class="notification_desc">50 novos usuários</div>
							</li>
							<li data-link="#">
								<div class="notification_icon"><i class="fa fa-users"></i></div>
								<div class="notification_desc">50 novos usuários<br>a</div>
							</li>
							<span>Tudo limpo!</span>
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
			<form class="configs">
				<div class="row">
					<div class="column-4x4">
						<div class="widget">
							<div class="widget_title"><i class="fa fa-wrench"></i> Principal</div>
							<div class="widget_body configs">
								<label for="site_name">Nome do site</label>
								<input type="text" name="site_name" id="site_name">
								<br><br>
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td>Ativação de conta por email</td>
										<td><input type="checkbox" name="verify_email"></td>
										<td><span class="input_desc">O usuário não poderá acessar sua conta sem ter verificado seu email.</span></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column-4x4">
						<div class="widget">
							<div class="widget_title"><i class="fa fa-eye"></i> Aparência</div>
							<div class="widget_body configs">
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td><label for="primary_color" class="to_checkbox">Cor primária</label>
										<td><input type="color" name="primary_color" id="primary_color" value="#4EBFF4">
										<td><span class="input_desc">Detalhes mais notáveis.</span>
									</tr>
									<tr>
										<td><label for="secondary_color" class="to_checkbox">Cor secundária</label>
										<td><input type="color" name="secondary_color" id="secondary_color" value="#143249">
										<td><span class="input_desc">Detalhes mais simples.</span>
									</tr>
								</table>
								<br>
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td>Usar design responsivo?</td>
										<td><input type="checkbox" name="responsive_design"></td>
										<td><span class="input_desc">Habilita o site para funcionar em todos os dispositivos.</span></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column-4x4">
						<div class="widget">
							<div class="widget_title"><i class="fa fa-eye"></i> Segurança</div>
							<div class="widget_body configs">
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td>Usar sempre HTTPS?</td>
										<td><input type="checkbox" name="always_ssl"></td>
										<td><span class="input_desc">Deixa SSL sempre ligado com https://.</span></td>
									</tr>

									<tr>
										<td>Limitar visitas por IP</td>
										<td><input type="number" name="limit_ip" id="limit_ip" placeholder="0"> <label for="limit_ip" min="0" class="to_checkbox">visitas</label></td>
										<td><label for="limit_ip_expires" class="to_checkbox">A cada </label><input type="number" min="0" name="limit_ip_expires" id="limit_ip_expires" placeholder="0"> minutos</td>
									</tr>
									<tr>
										<td>Bloquear países <i class="fa fa-question-circle" title="O acesso a partir destes países serão bloqueados."></i></td>
										<td><input type="text" name="block_country" placeholder="Use virgula para adicionar mais de um país" style="width:100%;"></td>
										<td><span class="input_desc">Use a sigla de 2 dígitos de um país para bloquea-lo.</span></td>
									</tr>
									<tr>
										<td>Login mal sucedido</i></td>
										<td>Bloquear conta após <input type="number" min="0" name="login_attempts" placeholder="0"> tentativas.</td>
										<td><span class="input_desc">A conta poderá ser recuperada via email.</span></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>

<script type="text/javascript" src="js/site.js"></script>
<script type="text/javascript">
	$("#primary_color").change(function(){
		$("#top_menu").css("background", $("#primary_color").val());
	});
	$("#secondary_color").change(function(){
		$("#sidebar_menu").css("background", $("#secondary_color").val());
	});
</script>
</body>
</html>