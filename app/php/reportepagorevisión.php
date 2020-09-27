<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM administrador WHERE usuario=:usuario');
    $records->bindParam(':usuario', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    } 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sparta City - Admin</title>
	<link rel="shortcut icon" href="../../img/logo.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
	<!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
	<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script type="text/javascript" src="../js/hora.js"></script>
	<script type="text/javascript">
		function mascara(o,f){  
		v_obj=o;  
		v_fun=f;  
		setTimeout("execmascara()",1);  
	}  
	function execmascara(){   
		v_obj.value=v_fun(v_obj.value);
	}  
	function cpf(v){     
		v=v.replace(/([^0-9\.]+)/g,''); 
		v=v.replace(/^[\.]/,''); 
		v=v.replace(/[\.][\.]/g,''); 
		v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2'); 
		v=v.replace(/\.(\d{1,2})\./g,'.$1'); 
		v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');    
		v = v.split('').reverse().join('').replace(/^[\,]/,''); 
		return v;  
	}  
	</script>
</head>
<body onload="startTime()">
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<img src="../assets/img/logo160x160.png" width="65" height="45" align="left">
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				SPARTA CITY <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<?php print '<img src="'.$user["imagen"].'" alt="UserIcon">'; ?>
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
						<a href="perfiladm.php?id=<?php echo $results['idadmin']; ?>">
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
					<a href="../homea.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i>Sparta City<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="../../index.php" target="_blank"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Web </a>
						</li>
						<li>
							<a href="vermsn.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Noticias </a>
						</li>
						<li>
							<a href="vergaleria.php"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Galeria</a>
						</li>
						<li>
							<a href="verhisto.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Historia</a>
						</li>
						<li>
							<a href="verpartido.php"><i class="zmdi zmdi-run zmdi-hc-fw"></i> Partidos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="veradm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
						</li>
						<li>
							<a href="vertec.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Técnicos</a>
						</li>
						<li>
							<a href="verjuga.php"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Jugadores</a>
						</li>
						<li>
							<a href="verpadre.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Padres de Familia</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i>Mensualidades<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="verpago.php"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Registrar Pagos</a>
						</li>
						<li>
							<a href="reportepago.php"><i class="zmdi zmdi-case zmdi-hc-fw"></i> Reportes de Pagos</a>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Reportes Pagos</small></h1>
			</div>
			<p class="lead">Mensualidad! 
				<?php if(!empty($message)): ?>
			    <p> <?= $message ?></p>
			    <?php endif; ?>
			</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#list" data-toggle="tab">Listado</a></li>
					  	<li><a href="#new" data-toggle="tab">Nuevo Pago</a></li>
					</ul>
					<?php 
						if (!empty($_POST['valor'])) {
						$sql = "INSERT INTO mensualidad (fechapago,valor,imagen,mensual,estado,jugador_idjugador) VALUES (:fechapago,:valor,:imagen,:mensual,:estado,:jugador_idjugador)";
					    $stmt = $conn->prepare($sql);
					    $stmt->bindParam(':fechapago', $_POST['fechapago']);
					    $stmt->bindParam(':valor', $_POST['valor']);
					    $stmt->bindParam(':mensual', $_POST['mensual']);
					    $stmt->bindParam(':estado', $_POST['estado']);
					    $stmt->bindParam(':jugador_idjugador', $_POST['jugador_idjugador']);
					    /*insertar una imagen al servidor*/
					    $stmt->bindParam(':imagen', $ruta);
					    $nombreimg=$_FILES['imagen']['name'];
					    $archivo=$_FILES['imagen']['tmp_name'];
					    $ruta='pagos/'.$nombreimg;
					    move_uploaded_file($archivo, $ruta);
					    /*------------------------------*/
						   
					    if ($stmt->execute()) {
					      $message = 'Registro Creado';
					    } else {
					      $message = 'No se pudo crear el Registro';
					    }
						}
					    ?>

				<?php if(!empty($message)): ?>
			    <p> <?= $message ?></p>
			    <?php endif; ?>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form action="verpago.php" method="post" enctype="multipart/form-data">
											<div class="form-group label-floating">
											  <label class="control-label">Jugador</label>
											  <?php 
									           $records1 = $conn->prepare('SELECT * FROM jugador');
									           $records1->execute();
									          ?>
									        <select name="jugador_idjugador" class="form-control" required="">
									          <?php
									          foreach ($records1 as $r) {
									            echo "<option value=".$r[0].">".$r[nombres]." ".$r[apellidos]."</option>";
									          } 
									        ?>
									        </select>	
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Valor $</label>
												<input class="form-control" type="text" name="valor" size="21" maxlength="21" onkeypress="mascara(this,cpf)" onpaste="return false">
											</div>
											<div class="form-group">
										        <label class="control-label">Mensualidad (Dia/Mes/Año)</label>
										        <input name="mensual" class="form-control" type="date">
										    </div>
										    <div class="form-group">
											  <label class="control-label">Fecha de Pago</label>
											  <input name="fechapago" class="form-control" type="date">
											</div>
											<div class="form-group">
										      <label class="control-label">Estado</label>
										        <select name="estado" class="form-control">
										          <option>No Pagado</option>
										          <option>Pagado</option>
										        </select>
										    </div>
										    <div class="form-group">
										      <label class="control-label">Soporte de Pago</label>
										      <div>
										        <input type="text" readonly="" class="form-control" placeholder="Selecciona una imagen...">
										        <input type="file" name="imagen" >
										      </div>
										    </div>
										    <p class="text-center">
										    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i>Guardar</button>
										    </p>
									    </form>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade active in" id="list">
			<div id="page-wrapper"> 
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            EN CONSTRUCCIÓN
      </div>
    </div>
  </div>
</div>
</div>			
</div>
					</div>
				</div>
			</div>
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
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/sweetalert2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/material.min.js"></script>
	<script src="../js/ripples.min.js"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		$.material.init();
	</script>
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.js"></script>
    <!-- DataTables JavaScript Traducir-->
    <script src="../vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>
</html>
<?php
else: header('Location: ../ingresar.php');
endif; 
}else{
  header('location: error.html');
}
?>