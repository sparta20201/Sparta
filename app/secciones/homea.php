<?php
  session_start();

  require '../../php/database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM tbladministrador WHERE idadmin = :idadmin');
    $records->bindParam(':idadmin', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }							
?>
<?php if(!empty($user)): ?> 
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sparta City</title>
	<link rel="shortcut icon" href="../../img/club-fc-1.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
	<script type="text/javascript" src="../js/hora.js"></script>
</head>
<body onload="startTime()">
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<img src="../../img/logo160x160.png" width="65" height="45" align="left">
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				SPARTA CITY <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<?php print '<img src="../../img/'.$user["imagen"].'" class="bg-primary">'; ?>
					<figcaption class="text-center text-titles"><?= $user['nombres']," ",$user['apellidos']; ?></figcaption>
					<div class="app-body">
                            <div class="app-sidebar sidebar-dark sidebar-slide-left">
                                <div class="sidebar-header" align="center">
                                <p class="username">
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
						<a href="?p=perfiladm">
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
					<a href="?p=inicioAdmin">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i>Sparta City<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../../" target="_blank"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Web </a>
						</li>
						<li>
							<a href="?p=verpresentacion"><i class="zmdi zmdi-image zmdi-hc-fw"></i> Presentación</a>
						</li>
						
						<li>
							<a href="?p=vergaleria"><i class="zmdi zmdi-image zmdi-hc-fw"></i> Galeria</a>
						</li>
						<li>
							<a href="?p=verintro"><i class="zmdi zmdi-image zmdi-hc-fw"></i> Introducción</a>
						</li>
						<li>
							<a href="?p=vermsn"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Noticias </a>
						</li>
						<li>
							<a href="?p=verhisto"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Historia</a>
						</li>
						<li>
							<a href="?p=vertarifas"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Tarifas</a>
						</li>
						<li>
							<a href="?p=verentrenamientos"><i class="zmdi zmdi-run zmdi-hc-fw"></i> Entrenamientos</a>
						</li>
						<li>
							<a href="?p=verpartido"><i class="zmdi zmdi-run zmdi-hc-fw"></i> Partidos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="?p=veradm"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
						</li>
						<li>
							<a href="?p=vertec"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Técnicos</a>
						</li>
						<li>
							<a href="?p=verjuga"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Jugadores</a>
						</li>
						<li>
							<a href="?p=verpadre"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Padres de Familia</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Categoria <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="?p=vercategorias"><i class="zmdi zmdi-run zmdi-tune"></i> Categorías</a>
						</li>
						<li>
							<a href="?p=verasignarCategoria"><i class="zmdi zmdi-case zmdi-hc-fw"></i> Asignar Categoría</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Asistencias <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="?p=verAsistencia"><i class="zmdi zmdi-calendar-check"></i> Tomar Asistencia</a>
						</li>
						<li>
							<a href="?p=verinformeAsistencia"><i class="zmdi zmdi-view-web"></i> Informe de Asistencia</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i>Mensualidades<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="php/verpago.php"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Registrar Pagos</a>
						</li>
						<li>
							<a href="php/reportepago.php"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Reportes de Pagos</a>
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
						<span class="badge">1</span>
					</a>
				</li>
			</ul>
		</nav>

		<?php  
			if(empty($_GET['p'])){
				$hoja = "inicioAdmin";
			}else{
				$hoja = $_GET['p'];
			}
			require '../php/' . $hoja . '.php';
		?>
	</section>

	<!-- Notifications area -->
	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notificationes <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
			<div class="list-group">
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-triangle"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">17m</div>
				      	<h4 class="list-group-item-heading">En construcción</h4>
				      	<p class="list-group-item-text">En construcción</p>
				    </div>
			  	</div>
			</div>

		</div>
	</section>
	<!--====== Scripts -->
	<script src="../js/sweetalert2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/material.min.js"></script>
	<script src="../js/ripples.min.js"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>

<?php 
else: header('Location: ../php/error.html'); 
endif; 
?>