<?php
if (!empty($_POST['cedula'])) {
	if($_FILES['imagen']['type']=="image/jpeg" or $_FILES['imagen']['type']=="image/png" or $_FILES['imagen']['type']=="image/jpg"){
	    $nombreimg=$_POST['cedula'];
		if ($_FILES['imagen']['type']=="image/jpeg") {
			$nombreimg = $nombreimg.".jpeg";
		}elseif ($_FILES['imagen']['type']=="image/png") {
			$nombreimg = $nombreimg.".png";
		}elseif ($_FILES['imagen']['type']=="image/jpg") {
			$nombreimg = $nombreimg.".jpg";
		}else{
			$message = "Error al cambiar el nombre.";
		}

		$sql = "INSERT INTO tbltecnico (nombres, apellidos, usuario, password, imagen, telefono, fecha_nac, direccion, cedula) VALUES (:nombres, :apellidos, :usuario, :password, :imagen, :telefono, :fecha_nac, :direccion, :cedula)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':usuario', $_POST['usuario']);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':cedula', $_POST['cedula']);
		$stmt->bindParam(':nombres', $_POST['nombres']);
		$stmt->bindParam(':apellidos', $_POST['apellidos']);
		$stmt->bindParam(':telefono', $_POST['telefono']);
		$stmt->bindParam(':fecha_nac', $_POST['fecha_nac']);
		$stmt->bindParam(':direccion', $_POST['direccion']);
		 /*insertar una imagen al servidor*/
		$stmt->bindParam(':imagen', $ruta);
		$archivo=$_FILES['imagen']['tmp_name'];
		$ruta='fotoperfil/entrenador/'.$nombreimg;
		move_uploaded_file($archivo, '../../img/'.$ruta);
		/*------------------------------*/

		if ($stmt->execute()) {
		  $message = 'Usuario Creado Satisfactoriamente';
		} else {
		  $message = 'Error, no se ha podido crear tu cuenta';
		}
	}else{
		$message = " <br> Archivos no permitidos. <br> Solo se permite JPG, JPEG Y PNG.";
	}
}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>Técnicos Registrados</h1>
	</div>
	<p class="lead">Técnicos
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
			  	<li><a href="#new" data-toggle="tab">Nuevo</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade" id="new">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
				    <form method="post" enctype="multipart/form-data">
				    	<div class="form-group label-floating">
						  <label class="control-label">Usuario</label>
						  <input name="usuario" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Contraseña</label>
						  <input name="password" class="form-control" type="password" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Cédula</label>
						  <input name="cedula" class="form-control" type="number" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Nombres</label>
						  <input name="nombres" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Apellidos</label>
						  <input name="apellidos" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Teléfono</label>
						  <input name="telefono" class="form-control" type="number" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Dirección</label>
						  <input name="direccion" class="form-control" type="text" required="">
						</div>
						<div class="form-group">
						  <label class="control-label">Fecha Nacimiento</label>
						  <input name="fecha_nac" class="form-control" type="date" required="">
						</div>
						<div class="form-group">
					      <label class="control-label">Imagen</label>
					      <div>
					        <input type="text" readonly="" class="form-control" placeholder="Selecciona una imagen...">
					        <input type="file" name="imagen" >
					      </div>
					    </div>	
					    <p class="text-center">
					    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar </button>
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
	                   		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	          				<thead>
	            				<tr>
									<th class="text-center">Foto</th>
									<th class="text-center">Nombres</th>
									<th class="text-center">Apellidos</th>
									<th class="text-center">Usuario</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Tipo Usuario</th>
									<th class="text-center">Fecha Nacimiento</th>
									<th class="text-center">Dirección</th>
									<th class="text-center">Cédula</th>
									<th class="text-center">Actualizar</th>
									<th class="text-center">Eliminar</th>
	            				</tr>
	          				</thead>
					              <?php 
					              $records1 = $conn->prepare('SELECT * FROM tbltecnico');
					              $records1->execute();

					              while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
					                ?>
					              <tr class="gradeA">
						              <td class="text-center dashboard-sideBar-UserInfo">
						              	<figure><img src='../../img/<?php print $results1['imagen']; ?>' height="80" width="150"></figure></td>
					                  <td class="text-center"><?php echo $results1['nombres']; ?></td>
									  <td class="text-center"><?php echo $results1['apellidos']; ?></td>
						              <td class="text-center"><?php echo $results1['usuario']; ?></td>
						              <td class="text-center"><?php echo $results1['telefono']; ?></td>
						              <td class="text-center"><?php echo $results1['tipo']; ?></td>
						              <td class="text-center"><?php echo $results1['fecha_nac']; ?></td>
									  <td class="text-center"><?php echo $results1['direccion']; ?></td>
									  <td class="text-center"><?php echo $results1['cedula']; ?></td>

									  <td class="text-center"><a href='actualizartec.php?id=<?php echo $results1['idtecnico']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
									  <td class="text-center"><a href='eliminartec.php?id=<?php echo $results1['idtecnico']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el registro con Cédula?\n <?php echo $results1['cedula']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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
<!-- DataTables JavaScript Traducir-->
<script src="../js/tablas-Scripts/jquery.js"></script>
<script src="../js/tablas-Scripts/jquery.dataTables.js"></script>
<script src="../js/tablas-Scripts/dataTables.bootstrap.js"></script>
<script src="../js/tablas-Scripts/dataTables.responsive.js"></script>
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
		responsive: true
		});
	});
</script>