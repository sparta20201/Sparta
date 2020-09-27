<?php //guardar mensajes
	if (isset($_POST['nombre'])) {
		$sql = "INSERT INTO tblcategoria (nombre) VALUES (:nombre)";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':nombre', $_POST['nombre']);

	    if ($stmt->execute()) {
	      $message = 'Categoria Creado';
	    } else {
	      $message = 'No se pudo crear la Categoria';
	    }
	}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Publicar Categorias</small></h1>
	</div>
	<p class="lead">Publicar Categorias! <?php if(!empty($message)){
		echo $message;
	} ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Lista de Categorias</a></li>
			  	<li><a href="#new" data-toggle="tab">Nuevo Categoria</a></li>
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
						<div class="form-group label-floating">
						  <label class="control-label">Nombre de la Categoria</label>
						  <input name="nombre" class="form-control" type="text">
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
								<th class="text-center">Categoria</th>
								<th class="text-center">Actualizar</th>
								<th class="text-center">Eliminar</th>
								</tr>
								</thead>
								<?php 
								$records1 = $conn->prepare('SELECT * FROM tblcategoria');
								$records1->execute();
								while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
								?>
								<tr class="gradeA">
								  <td class="text-center"><?php echo $results1['nombre']; ?></td>

								  <td class="text-center"><a href='actualizarpartido.php?id=<?php echo $results1['idcategoria']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
								  <td class="text-center"><a href='../php/eliminar/eliminarCategoria.php?id=<?php echo $results1['idcategoria']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar la categoria?\n<?php echo $results1['nombre']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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
