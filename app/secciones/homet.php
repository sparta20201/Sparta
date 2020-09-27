<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM tecnico WHERE tipo = :tipo');
    $records->bindParam(':tipo', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }							
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sparta City</title>
	<link rel="shortcut icon" href="../img/logo.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<script type="text/javascript" src="js/hora.js"></script>
</head>
<body onload="startTime()">
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<img src="assets/img/logo160x160.png" width="65" height="45" align="left">
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				SPARTA CITY <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<?php print '<img src="php/'.$user["imagen"].'" alt="UserIcon">'; ?>
					<?php if(!empty($user)): ?> 
					<figcaption class="text-center text-titles"><?= $user['nombres']," ",$user['apellidos']; ?></figcaption>
					<div class="app-body">
                            <div class="app-sidebar sidebar-dark sidebar-slide-left">
                                <div class="sidebar-header" align="center">
                                <p class="username">
                                <small>Usuario: <?= $user['usuario']; ?></small><br>
                                <small>Tipo: <?= $user['tipo']; ?></small>
                                <small>
									<div id="clockdate">
									  <div class="clockdate-wrapper">
									    <div id="clock"></div><div id="date"></div>
									  </div>
									</div>
								</small>
                                </p>
                                </div>
                            </div>
                        </div>   
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="php/perfiltec.php?id=<?php echo $results['idtecnico']; ?>">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="homet.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i>Sparta City<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../index.php" target="_blank"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Web </a>
						</li>
						<li>
							<a href="php/vermsn.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Noticias </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i>Mensualidades<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="php/vermensu.php"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Pagos</a>
						</li>
						<li>
							<a href="registration.html"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registrar</a>
						</li>
						<li>
							<a href="#"><i class="zmdi zmdi-case zmdi-hc-fw"></i>Reportes</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">

			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="zmdi zmdi-notifications-none"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
				<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Usuarios Registrados</small></h1>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">
			<a href="#"><article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Técnicos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-alt"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box">
						<?php 
							$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tecnico');
					    	$resultstotal->execute();
					    	$total = $resultstotal->fetchColumn();
					    	echo "$total";
						?></p>
					<small>Registrados</small>
				</div>
			</article></a>
			<a href="php/verjuga.php"><article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Jugadores
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-face"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php 
							$resultstotal = $conn->prepare('SELECT COUNT(*) FROM jugador');
					    	$resultstotal->execute();
					    	$total = $resultstotal->fetchColumn();
					    	echo "$total";
						?></p>
					<small>Registrados</small>
				</div>
			</article></a>
			<a href="php/verpadre.php"><article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Padres De Familia
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-female"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php 
							$resultstotal = $conn->prepare('SELECT COUNT(*) FROM padre_familia');
					    	$resultstotal->execute();
					    	$total = $resultstotal->fetchColumn();
					    	echo "$total";
						?></p>
					<small>Registrados</small>
				</div>
			</article></a>
			<a href="php/vermsn.php"><article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Mensajes
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-comment-alt-text"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php 
							$resultstotal = $conn->prepare('SELECT COUNT(*) FROM mensajes');
					    	$resultstotal->execute();
					    	$total = $resultstotal->fetchColumn();
					    	echo "$total";
						?></p>
					<small>Registrados</small>
				</div>
			</article></a>
			<a href="php/vermensu.php"><article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Mensualidades
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-money"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?php 
							$resultstotal = $conn->prepare('SELECT COUNT(*) FROM mensualidad');
					    	$resultstotal->execute();
					    	$total = $resultstotal->fetchColumn();
					    	echo "$total";
						?></p>
					<small>Registrados</small>
				</div>
			</article></a>
		</div>
	</section>

	<!-- Notifications area -->
	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notifications <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
			<div class="list-group">
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-triangle"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">17m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-octagon"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">15m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
				<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-help"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">10m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
				</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-info"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">8m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
			  	</div>
			</div>

		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title">Help</h4>
			    </div>
			    <div class="modal-body">
			        <p>
			        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
			        </p>
			    </div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
		      	</div>
		    </div>
	  	</div>
	</div>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
<?php else: header('Location: ../php/error.html'); ?>
<?php endif; ?>
</body>
</html>