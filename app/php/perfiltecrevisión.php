<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
  	$records = $conn->prepare('SELECT * FROM tecnico WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
 //actualizar datos
	if(isset($_POST['id'])){
	    $id=$_POST['id'];
	    $cedula=$_POST['cedula'];
	    $nombres=$_POST['nombres'];
	    $telefono=$_POST['telefono'];
	    $apellidos=$_POST['apellidos'];
	    $nusuarioA=$_POST['nusuarioA'];
	    $nusuarioN=$_POST['nusuarioN'];
	    $claveN1 = $_POST['claveN1'];
	    $claveN2 = $_POST['claveN2'];
	    
	    if($nusuarioA!=$nusuarioN){
	      $records1=$conn->prepare("SELECT * FROM administrador WHERE usuario=:nusuario");
	      $records1->bindParam(":nusuario",$nusuarioN);
	      $records1->execute();
	      if($records1->rowCount()>=1){
	        echo "Error: el usuario ya esta registrado";
	        exit();
	      }else{
	        $nusuarioF=$nusuarioN;
	      }
	    }else{
	      $nusuarioF=$nusuarioA;
	    }

	    if($claveN1!="" && $claveN2!=""){
	      if($claveN1!=$claveN2){
	        echo "Error: las claves no coinciden";
	        exit();
	      }else{
	        $records2=$conn->prepare("UPDATE administrador SET nombres=:nombres,apellidos=:apellidos,usuario=:nusuario,password=:claveN2,cedula=:cedula,imagen=:imagen WHERE idusuario=:id");
	        $records2->bindParam(":nombres",$nombres);
	        $records2->bindParam(":apellidos",$apellidos);
	        $records2->bindParam(":nusuario",$nusuarioF);
	        $claveN2 = password_hash($_POST['claveN2'], PASSWORD_BCRYPT);
	        $records2->bindParam(":claveN2",$claveN2);
	        $records2->bindParam(":cedula",$cedula);
	        $records2->bindParam(":id",$id);
	        /*insertar una imagen al servidor*/
	        $records2->bindParam(':imagen', $ruta);
	        $nombreimg=$_FILES['imagen']['name'];
	        $archivo=$_FILES['imagen']['tmp_name'];
	        $ruta='images/'.$nombreimg;
	        move_uploaded_file($archivo, $ruta);
		    
	      }
	    }else{
	      $records2=$conn->prepare("UPDATE administrador SET nombres=:nombres,apellidos=:apellidos,usuario=:nusuario,cedula=:cedula,telefono=:telefono WHERE idusuario=:id");
	      $records2->bindParam(":nombres",$nombres);
	      $records2->bindParam(":apellidos",$apellidos);
	      $records2->bindParam(":nusuario",$nusuarioF);
	      $records2->bindParam(":id",$id);
	      $records2->bindParam(":cedula",$cedula);
	      $records2->bindParam(":telefono",$telefono);
	    }
	    if($records2->execute()){
	      $message1 = 'Datos actualizados';
	    }else{
	     $message1 = 'Error: no se pudo actualizar los datos';
	    }
	}			
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sparta City - Admin</title>
	<link rel="shortcut icon" href="../img/logo.png">
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
			<img src="../assets/img/logo160x160.png" width="65" height="45" align="left">
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				SPARTA CITY <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src='<?php echo $results['imagen']; ?>' alt="UserImagen">
					<?php if(!empty($user)): ?> 
					<figcaption class="text-center text-titles"><?= $user['nombres']," ",$user['apellidos']; ?></figcaption>
					<div class="app-body">
                            <div class="app-sidebar sidebar-dark sidebar-slide-left">
                                <div class="sidebar-header" align="center">
                                <p class="username">
                                <small>Usuario: <?php echo $results['usuario']; ?></small><br>
                                <small>Tipo: <?php echo $results['tipo']; ?></small><br>
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
						<a href="perfiltec.php?id=<?php echo $results['idtecnico']; ?>">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
				<?php else: header('Location: ingresar.php'); ?>
				<?php endif; ?>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="../../home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Usuarios del Sistema
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administradores <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="php/adm/veradm.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i>Administradores</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="teacher.html"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>Técnicos</a>
						</li>
						<li>
							<a href="student.html"><i class="zmdi zmdi-face zmdi-hc-fw"></i>Jugadores</a>
						</li>
						<li>
							<a href="representative.html"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Padres de Familia</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i>Mensualidades<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="registration.html"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registrar</a>
						</li>
						<li>
							<a href="payments.html"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Pagos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Información  <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="school.html"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Sparta City</a>
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
		<?php		  
		//Recuperar datos
		  if(isset($_GET['id'])){
		    $id=$_GET['id'];
		    $records = $conn->prepare("SELECT * FROM tecnico WHERE idtecnico=:id");
		    $records->bindParam(":id",$id);
		    $records->execute();
		    if($records->rowCount()>=1){
		      $results = $records->fetch(PDO::FETCH_ASSOC);
		  ?>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Actualizar <small><?php echo $results['nombres']." ".$results['apellidos'] ; ?></small></h1>
			</div>
			<p class="lead">Espacio para actualizar datos de usuario.
			<?php if(!empty($message1)): ?>
			<p> <?= $message1 ?></p>
			<?php endif; ?></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Actualizar Datos</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
								    <form action="" method="post" enctype="multipart/form-data">
								    	<input name="id" type="hidden" value="<?php echo $results['idusuario']; ?>" required="">
								    	<div class="form-group label-floating">
										  <label class="control-label">Usuario</label>
										  <input name="nusuarioA" type="hidden" value="<?php echo $results['usuario']; ?>" class="form-control" type="text">
										  <input name="nusuarioN" value="<?php echo $results['usuario']; ?>" class="form-control" type="text" required="">
										</div>
										<p>Para actualizar, por favor ingrese la nueva clave y repitala</p>
										<div class="form-group label-floating">
										  <label class="control-label">Contraseña</label>
										  <input name="claveN1" type="password" class="form-control">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Repita Contraseña</label>
  										  <input name="claveN2" type="password" class="form-control">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Cédula</label>
										  <input name="cedula" value="<?php echo $results['cedula']; ?>" class="form-control" type="number" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Nombres</label>
										  <input name="nombres" value="<?php echo $results['nombres']; ?>" class="form-control" type="text" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Apellidos</label>
										  <input name="apellidos" value="<?php echo $results['apellidos']; ?>" class="form-control" type="text" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Teléfono</label>
										  <input name="telefono" value="<?php echo $results['telefono']; ?>" class="form-control" type="number" required="">
										</div>
										<div class="form-group">
									      <label class="control-label">Imagen Actual</label>
									      <div>
									      	<img src='<?php echo $results['imagen']; ?>' height="100" width="150"/>
									        <input type="text" readonly="" class="form-control" placeholder="Selecciona una imagen...">
									        <input type="file" name="imagen" >
									      </div>
									    </div>	
									    <p class="text-center">
									    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar </button>
									    </p>
								    </form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}else{
      echo "Ocurrio un error";
    }
 }//recuperar datos
 ?>
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
<?php
}else{
  header('location: error.html');
}
?>
</body>
</html>