<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Publicar Noticias</small></h1>
	</div>
	<p class="lead">Publicar Noticias! 
	<?php if(!empty($message)): ?>
	<p> <?= $message ?></p>
	<?php endif; ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Lista de noticias</a></li>
			  	<li><a href="#new" data-toggle="tab">Nueva noticia</a></li>
			</ul>
			<?php //guardar mensajes
				$sql = "INSERT INTO tblmensajes (fecha,mensaje,estado) VALUES (:fecha,:mensaje,:estado)";
			    $stmt = $conn->prepare($sql);
			    $stmt->bindParam(':fecha', $_POST['fecha']);
			    $stmt->bindParam(':mensaje', $_POST['mensaje']);
			    $stmt->bindParam(':estado', $_POST['estado']);

			    if ($stmt->execute()) {
			      $message = 'Mensaje Creado';
			    } else {
			      $message = 'No se pudo crear el mensaje';
			    }
			    ?>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade" id="new">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
							    <form method="post">
							    	<div class="form-group">
									  <label class="control-label">Fecha</label>
									  <input name="fecha" class="form-control" type="date">
									</div>
							    	<div class="form-group label-floating">
									  <label class="control-label">Mensaje</label>
									  <input name="mensaje" class="form-control" type="text">
									</div>
									<div class="form-group">
								      <label class="control-label">Estado</label>
								        <select name="estado" class="form-control">
								          <option>Activo</option>
								          <option>Inactivo</option>
								        </select>
								    </div>
								    <p class="text-center">
								    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Publicar </button>
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
									    <table width="100%" class="table table-striped table-bordered table-hover" class="" id="dataTables-example">
											<!--<table id="customers">-->
											<thead>
											<tr>
											<th class="text-center">Fecha</th>
											<th class="text-center">Mensaje</th>
											<th class="text-center">Estado</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Eliminar</th>
											</tr>
											</thead>
											<?php 
											$records1 = $conn->prepare('SELECT * FROM tblmensajes');
											$records1->execute();
												while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
												?>
												<tr class="gradeA">
												<td class="text-center"><?php echo $results1['fecha']; ?></td>
												<td class="text-center"><?php echo $results1['mensaje']; ?></td>
													<td class="text-center"><?php echo $results1['estado']; ?></td>

													<td class="text-center"><a href='actualizarmsn.php?id=<?php echo $results1['idmsn']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
													<td class="text-center"><a href='../php/eliminar/eliminarNoticia.php?id=<?php echo $results1['idmsn']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el registro con Mensaje?\n <?php echo $results1['mensaje']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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