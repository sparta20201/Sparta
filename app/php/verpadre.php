<?php
if (!empty($_POST['nombres']) and !empty($_POST['apellidos']) and !empty($_POST['telefono']) and !empty($_POST['direccion']) and !empty($_POST['documento'])) {

	$sql = "INSERT INTO tblpadre_familia (nombres, apellidos, telefono, direccion, documento) VALUES (:nombres,:apellidos,:telefono,:direccion,:documento)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':nombres', $_POST['nombres']);
	$stmt->bindParam(':apellidos', $_POST['apellidos']);
	$stmt->bindParam(':telefono', $_POST['telefono']);
	$stmt->bindParam(':direccion', $_POST['direccion']);
	$stmt->bindParam(':documento', $_POST['documento']);

	if ($stmt->execute()) {
	  $message = 'Acudiente Creado Satisfactoriamente';
	} else {
	  $message = 'Error, no se ha podido registrar el Acudiente';
	}
}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Padres Registrados</small></h1>
	</div>
	<p class="lead">Acudiente
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
				    <form method="post">

						<div class="form-group label-floating">
						  <label class="control-label">Cédula</label>
						  <input name="documento" class="form-control" type="number" required="">
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
        					<table width="100%" class="table table-striped table-bordered table-hover" class=""id="dataTables-example">
					        <!--<table id="customers">-->
					          <thead>
					            <tr>
									<th class="text-center">Cédula</th>
									<th class="text-center">Nombres</th>
									<th class="text-center">Apellidos</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Dirección</th>
									<th class="text-center">Actualizar</th>
									<th class="text-center">Eliminar</th>
					            </tr>
					          </thead>
					              <?php 
					              $records1 = $conn->prepare('SELECT * FROM tblpadre_familia');
					              $records1->execute();

					              while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
					                ?>
					              <tr class="gradeA">
									  <td class="text-center"><?php echo $results1['documento']; ?></td>
					                  <td class="text-center"><?php echo $results1['nombres']; ?></td>
									  <td class="text-center"><?php echo $results1['apellidos']; ?></td>
						              <td class="text-center"><?php echo $results1['telefono']; ?></td>
									  <td class="text-center"><?php echo $results1['direccion']; ?></td>

									  <td class="text-center"><a href='actualizarpadre.php?id=<?php echo $results1['idpadre']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
									  <td class="text-center"><a href='eliminarpadre.php?id=<?php echo $results1['idpadre']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el registro con Cédula?\n <?php echo $results1['documento']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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