<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM jugador WHERE usuario=:usuario');
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
					<?php print '<img src="../php/'.$user["imagen"].'" alt="UserIcon">'; ?>
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
						<a href="../php/perfiljuga.php?id=<?php echo $results['idjugador']; ?>">
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
					<a href="../homej.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="verpadrej.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Padre de Familia</a>
				</li>
				<li>
					<a href="vertecj.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Técnico</a>
				</li>
				<li>
					<a href="verpagoj.php"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Ver Pagos</a>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Pagos Realizados</small></h1>
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
				
				<?php if(!empty($message)): ?>
			    <p> <?= $message ?></p>
			    <?php endif; ?>
					<div id="myTabContent" class="tab-content">
					  	<div class="tab-pane fade active in" id="list">
			<div id="page-wrapper"> 
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" class=""id="dataTables-example">
        <!--<table id="customers">-->
          <thead>
            <tr>
            	<th class="text-center">Jugador</th>
            	<th class="text-center">Estado</th>
            	<th class="text-center">Valor</th>
              	<th class="text-center">Fecha de Pago</th>
				<th class="text-center">Mes Pago</th>
				<th class="text-center">Soporte de Pago</th>
            </tr>
          </thead>
              <?php
               $records3 = $conn->prepare('SELECT * FROM jugador RIGHT JOIN mensualidad ON jugador.idjugador= mensualidad.jugador_idjugador WHERE jugador.usuario=:usuario'); 
		       $records3->bindParam(':usuario', $_SESSION['user_id']);
		       $records3->execute();

              while($results3 = $records3->fetch(PDO::FETCH_ASSOC)) { 
                ?>
              <tr class="gradeA">
              	  <td><?php echo $results3['nombres']," ",$results3['apellidos']; ?></td>
              	  <td><?php echo $results3['estado']; ?></td>
              	  <td>$<?php echo $results3['valor']; ?></td>
                  <td><?php echo $results3['fechapago']; ?></td>
	              <td><?php echo $results3['mensual']; ?></td>
	              <td><img src='../php/<?php echo $results3['imagen']; ?>'height="80" width="120"></td>
              </tr>
               <?php 
               } 
               ?>
        </table>
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
	
</body>
</html>
<?php
else: header('Location: ../ingresar.php');
endif; 
}else{
  header('location: error.html');
}
?>