<?php //guardar mensajes
	if (isset($_POST['dia'])) {
		$sql = "INSERT INTO tblentrenamientos (dia_semana,hora_inicio,hora_salida,categoria_idcategoria) VALUES (:dia,:inicio,:fin,:categorias)";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':dia', $_POST['dia']);
	    $stmt->bindParam(':inicio', $_POST['inicio']);
	    $stmt->bindParam(':fin', $_POST['fin']);
	    $stmt->bindParam(':categorias', $_POST['categorias']);

	    if ($stmt->execute()) {
	      $message = 'Entrenamiento Creado';
	    } else {
	      $message = 'No se pudo crear el Entrenamiento';
	    }
	}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Publicar Entrenamientos</small></h1>
	</div>
	<p class="lead">Publicar Entrenamientos! <?php if(!empty($message)){
		echo $message;
	} ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Lista de Entrenamiento</a></li>
			  	<li><a href="#new" data-toggle="tab">Nuevo Entrenamiento</a></li>
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
						  <label class="control-label">Día</label>
						  <select name="dia" class="form-control">
						  	<option value="Lunes">Lunes</option>
						  	<option value="Martes">Martes</option>
						  	<option value="Miércoles">Miércoles</option>
						  	<option value="Jueves">Jueves</option>
						  	<option value="Viernes">Viernes</option>
						  	<option value="Sábado">Sábado</option>
						  	<option value="Domingo">Domingo</option>
						  </select>
						</div>
				    	<div class="form-group">
						  <label class="control-label">Hora de Inicio</label>
						  <input name="inicio" class="form-control" type="time">
						</div>
						<div class="form-group">
						  <label class="control-label">Hora de Salida</label>
						  <input name="fin" class="form-control" type="time">
						</div>
						<div class="form-group">
						  <label class="control-label">Categoría</label>
						  <select name="categorias" class="form-control">
						  	<?php
						  		$categoria = $conn->prepare("SELECT * FROM tblcategoria");
						  		$categoria->execute();
						  		foreach ($categoria as $respuesta) {
						  			echo '<option value="'.$respuesta['idcategoria'].'">'.$respuesta['nombre'].'</option>';
						  		}
						  	?>
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
			            	<table width="100%" class="table table-striped table-bordered table-hover" class=""id="dataTables-example">
								<!--<table id="customers">-->
								<thead>
								<tr>
								<th class="text-center">Día</th>
								<th class="text-center">Hora de Inicio</th>
								<th class="text-center">Hora de Salida</th>
								<th class="text-center">Categoria</th>
								<th class="text-center">Actualizar</th>
								<th class="text-center">Eliminar</th>
								</tr>
								</thead>
								<?php 
								$records1 = $conn->prepare('SELECT e.id, e.dia_semana, e.hora_inicio, e.hora_salida, c.nombre as "categoria" FROM tblentrenamientos as e inner join tblcategoria as c on e.categoria_idcategoria=c.idcategoria');
								$records1->execute();
								while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
								?>
								<tr class="gradeA">
								  <td class="text-center"><?php echo $results1['dia_semana']; ?></td>
								  <td class="text-center"><?php echo $results1['hora_inicio']; ?></td>
								  <td class="text-center"><?php echo $results1['hora_salida']; ?></td>
								  <td class="text-center"><?php echo $results1['categoria']; ?></td>

								  <td class="text-center"><a href='actualizarpartido.php?id=<?php echo $results1['id']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
								  <td class="text-center"><a href='../php/eliminar/eliminarEntrenamiento.php?id=<?php echo $results1['id']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el entrenamiento?\n<?php echo $results1['dia_semana']," - ",$results1['categoria']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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