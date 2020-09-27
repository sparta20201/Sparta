<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
  	$records = $conn->prepare('SELECT * FROM jugador WHERE usuario = :usuario');
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
	    
	    $nombres=$_POST['nombres'];
	    $apellidos=$_POST['apellidos'];
	    $telefono=$_POST['telefono'];
	    $fecha_nac=$_POST['fecha_nac'];
	    $direccion=$_POST['direccion'];
	    $nusuarioA=$_POST['nusuarioA'];
	    $nusuarioN=$_POST['nusuarioN'];
	    $claveN1 = $_POST['claveN1'];
	    $claveN2 = $_POST['claveN2'];
	    $posicion = $_POST['posicion'];
	    $sexo = $_POST['sexo'];
	    $edad = $_POST['edad'];
	    $tipo_doc = $_POST['tipo_doc'];
	    $documento = $_POST['documento'];
	    $peso = $_POST['peso'];
	    $altura = $_POST['altura'];
	    $acudiente = $_POST['padre_familia_id_padre'];
	    $categoria = $_POST['categoria_id_categoria'];
	    $tecnico = $_POST['tecnico_id_tecnico'];
	    
	    if($nusuarioA!=$nusuarioN){
	      $records1=$conn->prepare("SELECT * FROM jugador WHERE usuario=:usuario");
	      $records1->bindParam(":usuario",$nusuarioN);
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
	        $records2=$conn->prepare("UPDATE jugador SET nombres=:nombres,apellidos=:apellidos,usuario=:usuario,password=:claveN2,cedula=:cedula,imagen=:imagen WHERE id_tecnico=:id");
	        $records2->bindParam(":nombres",$nombres);
	        $records2->bindParam(":apellidos",$apellidos);
	        $records2->bindParam(":usuario",$nusuarioF);
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
	      $records2=$conn->prepare("UPDATE jugador SET nombres=:nombres,apellidos=:apellidos,usuario=:usuario,cedula=:cedula,telefono=:telefono,fecha_nac=:fecha_nac,direccion=:direccion WHERE id_tecnico=:id");
	      $records2->bindParam(":nombres",$nombres);
	      $records2->bindParam(":apellidos",$apellidos);
	      $records2->bindParam(":usuario",$nusuarioF);
	      $records2->bindParam(":id",$id);
	      $records2->bindParam(":cedula",$cedula);
	      $records2->bindParam(":telefono",$telefono);
	      $records2->bindParam(":fecha_nac",$fecha_nac);
	      $records2->bindParam(":direccion",$direccion);
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
						<a href="perfiljuga.php?id=<?php echo $results['idjugador']; ?>">
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
					<a href="../jugador/verpadrej.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Padre de Familia</a>
				</li>
				<li>
					<a href="../jugador/vertecj.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Técnico</a>
				</li>
				<li>
					<a href="../jugador/verpagoj.php"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Ver Pagos</a>
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
		<?php		  
		//Recuperar datos
		  if(isset($_GET['id'])){
		    $id=$_GET['id'];
		    $records = $conn->prepare("SELECT * FROM jugador WHERE idjugador=:id");
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
			<p class="lead">Espacio para actualizar datos de Jugador.
			<?php if(!empty($message1)): ?>
			<p> <?= $message1 ?></p>
			<?php endif; ?></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Actualizar Datos</a></li>
					  	<li><a href="verjuga.php">Volver</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
								    <form action="" method="post" enctype="multipart/form-data">
								    	<input name="id" type="hidden" value="<?php echo $results['idjugador']; ?>" required="">
								    	<div class="form-group label-floating">
										  <label class="control-label">Usuario</label>
										  <input name="nusuarioA" type="hidden" value="<?php echo $results['usuario']; ?>" class="form-control" type="text">
										  <input name="nusuarioN" value="<?php echo $results['usuario']; ?>" class="form-control" type="text" required="">
										</div>
										<div class="form-group">
									      <label class="control-label">Imagen Actual</label>
									      <div>
									      	<img src='<?php echo $results['imagen']; ?>' height="100" width="120"/>
									        <input type="text" class="form-control" placeholder="Selecciona una imagen...">
									        <input name="imagen" type="file" class="form-control">
									      </div>
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
										  <label class="control-label">Tipo Documento</label>
										  <input name="tipo_doc" value="<?php echo $results['tipo_doc']; ?>" class="form-control" type="text" readonly>
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Documento</label>
										  <input name="documento" value="<?php echo $results['documento']; ?>" class="form-control" type="number" required="">
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
										<div class="form-group label-floating">
										  <label class="control-label">Dirección</label>
										  <input name="direccion" value="<?php echo $results['direccion']; ?>" class="form-control" type="text" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Fecha Nacimiento</label>
										  <input name="fecha_nac" value="<?php echo $results['fecha_nac']; ?>" class="form-control" type="date" required="">
										</div>
										<div class="form-group label-floating">
											  <label class="control-label">Posición</label>
											  <select name="posicion" class="form-control">
											  	<option value="<?php echo $results['posicion']; ?>"><?php echo $results['posicion']; ?></option>
											  	<option value="Delantero">Delantero</option>
											  	<option value="Defensa">Defensa</option>
											  	<option value="Arquero">Arquero</option>
											  	<option value="Lateral Derecho">Lateral Derecho</option>
											  	<option value="Lateral Izquierdo">Lateral Izquierdo</option>
											  </select>
											</div>
										<div class="form-group label-floating">
											  <label class="control-label">Género</label>
											  <select name="sexo" class="form-control">
											  	<option value="<?php echo $results['sexo']; ?>"><?php echo $results['sexo']; ?></option>
											  	<option value="Femenino">Femenino</option>
											  	<option value="Masculino">Masculino</option>
											  </select>
											</div>
										<div class="form-group label-floating">
										  <label class="control-label">Edad</label>
										  <input name="edad" value="<?php echo $results['edad']; ?>" class="form-control" type="number" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Peso(kg)</label>
										  <input name="peso" value="<?php echo $results['peso']; ?>" class="form-control" type="number" required="">
										</div>
										<div class="form-group label-floating">
										  <label class="control-label">Altura(cms)</label>
										  <input name="altura" value="<?php echo $results['altura']; ?>" class="form-control" type="number" required="">
										</div>
										<div class="form-group label-floating">
											  <label class="control-label">Acudiente</label>
											  <?php 
									 		  $records1 = $conn->prepare('SELECT * FROM jugador INNER JOIN padre_familia ON jugador.padre_familia_id_padre=padre_familia.id_padre');
									 		  $records1->execute();
									        ?>
									        <select name="padre_familia_id_padre" class="form-control" required="">
									          <?php
									          foreach ($records1 as $r) {
									            echo "<option value=".$r[0].">".$r[nombres]." ".$r[apellidos]."</option>";
									          } 
									        ?>
									        </select><br> 
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Categoría</label>
											  <?php 
									            $records2 = $conn->prepare('SELECT * FROM jugador LEFT JOIN categoria ON jugador.categoria_id_categoria=categoria.id_categoria');
	 		                                    $records2->execute();
									        ?>
									  
									        <select name="categoria_id_categoria" class="form-control" required="">
									          <?php
									          foreach ($records2 as $r) {
									            echo "<option value=".$r[0].">".$r[nombre]."</option>";
									          } 
									        ?>
									        </select><br> 
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Técnico</label>
											  <?php 
									           $records3 = $conn->prepare('SELECT * FROM jugador LEFT JOIN tecnico ON jugador.tecnico_id_tecnico=tecnico.id_tecnico');
	 		  								   $records3->execute();
									        ?>
									  
									        <select name="tecnico_id_tecnico" class="form-control" required="">
									          <?php
									          foreach ($records3 as $r) {
									            echo "<option value=".$r[0].">".$r[nombres]." ".$r[apellidos]."</option>";
									          } 
									        ?>
									        </select><br> 
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

</body>
</html>
<?php
else: header('Location: ../ingresar.php');endif;
}else{
  header('location: error.html');
}
?>