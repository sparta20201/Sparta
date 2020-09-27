<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Tarifas</small></h1>
	</div>
	<p class="lead">Tarifas! 
		<?php if(!empty($message)): ?>
	    <p> <?= $message ?></p>
	    <?php endif; ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Tarifas</a></li>
			  	<li><a href="#new" data-toggle="tab">Nueva Tarifa</a></li>
			</ul>
			<?php //guardar tarifas
			if (isset($_POST['descripcion'])) {
				$sql = "INSERT INTO tbltarifas (descripcion,valor,comentario) VALUES (:descripcion,:valor,:comentario)";
			    $stmt = $conn->prepare($sql);
			    $stmt->bindParam(':descripcion', $_POST['descripcion']);
			    $stmt->bindParam(':valor', $_POST['valor']);
			    $stmt->bindParam(':comentario', $_POST['comentario']);
			    if ($stmt->execute()) {
			      $message = 'Tarifa Creado';
			    } else {
			      $message = 'No se pudo crear la Tarifa';
			    }
			}
			?>
		</div>
	</div>
</div>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade" id="new">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1">
				    <form method="post">
				    	<div class="form-group label-floating">
						  <label class="control-label">Descripción</label>
						  <input name="descripcion" class="form-control" type="text">
						</div>
				    	<div class="form-group label-floating">
						  <label class="control-label">Valor</label>
						  <input name="valor" class="form-control" type="number">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Comentario</label>
						  <input name="comentario" class="form-control" type="text">
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
	                        <table width="100%" class="table table-striped table-bordered table-hover" class=""id="dataTables-example">
						      <thead>
						        <tr>
						          	<th class="text-center">Descripción</th>
									<th class="text-center">Valor</th>
									<th class="text-center">Comentario</th>
									<th class="text-center">Actualizar</th>
									<th class="text-center">Eliminar</th>
						        </tr>
						      </thead>
						          <?php 
						          $records1 = $conn->prepare('SELECT * FROM tbltarifas');
						          $records1->execute();
						          while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
						            ?>
						          <tr class="gradeA">
						              <td class="text-center"><?php echo $results1['descripcion']; ?></td>
									  <td class="text-center">$ <?php echo number_format($results1['valor'], 1); ?></td>
						              <td class="text-center"><?php echo $results1['comentario']; ?></td>

									  <td class="text-center"><a href='?p=actualizarhis?id=<?php echo $results1['id']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
									  <td class="text-center"><a href='../php/eliminar/eliminarTarifa.php?id=<?php echo $results1['id']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar la tarifa?\n <?php echo $results1['descripcion']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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