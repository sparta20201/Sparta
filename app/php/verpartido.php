<?php //guardar mensajes
	if (isset($_POST['fecha'])) {
		$sql = "INSERT INTO tblpartido (fecha,hora,lugar,equipo1,equipo2) VALUES (:fecha,:hora,:lugar,:equipo1,:equipo2)";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':fecha', $_POST['fecha']);
	    $stmt->bindParam(':hora', $_POST['hora']);
	    $stmt->bindParam(':lugar', $_POST['lugar']);
	    $stmt->bindParam(':equipo1', $_POST['equipo1']);
	    $stmt->bindParam(':equipo2', $_POST['equipo2']);

	    if ($stmt->execute()) {
	      $message = 'Partido Creado';
	    } else {
	      $message = 'No se pudo crear el partido';
	    }
	}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Publicar Partidos</small></h1>
	</div>
	<p class="lead">Publicar Partidos! 
		<?php if(!empty($message)){
			echo $message;
		}?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Lista de partidos</a></li>
			  	<li><a href="#new" data-toggle="tab">Nuevo partido</a></li>
			</ul>
			<?php if(!empty($message)): ?>
			<p> <?= $message ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
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
						  <label class="control-label">Hora</label>
						  <input name="hora" class="form-control" type="text">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Lugar</label>
						  <input name="lugar" class="form-control" type="text">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Equipo1</label>
						  <input name="equipo1" class="form-control" type="text">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Equipo2</label>
						  <input name="equipo2" class="form-control" type="text">
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
								<!--<table id="customers">-->
								<thead>
								<tr>
									<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>
								<th class="text-center">Lugar</th>
								<th class="text-center">Equipo1</th>
								<th class="text-center">Equipo2</th>
								<th class="text-center">Actualizar</th>
								<th class="text-center">Eliminar</th>
								</tr>
								</thead>
								<?php 
								$records1 = $conn->prepare('SELECT * FROM tblpartido');
								$records1->execute();
								while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
								?>
								<tr class="gradeA">
								  <td class="text-center"><?php echo $results1['fecha']; ?></td>
								  <td class="text-center"><?php echo $results1['hora']; ?></td>
								  <td class="text-center"><?php echo $results1['lugar']; ?></td>
								  <td class="text-center"><?php echo $results1['equipo1']; ?></td>
								  <td class="text-center"><?php echo $results1['equipo2']; ?></td>

								  <td class="text-center"><a href='actualizarpartido.php?id=<?php echo $results1['idpartido']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
								  <td class="text-center"><a href='../php/eliminar/eliminarPartido.php?id=<?php echo $results1['idpartido']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el registro con Equipos?\n<?php echo $results1['equipo1']," VS ",$results1['equipo2']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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