<?php
if (isset($_POST['tecnico']) and isset($_POST['categoria'])) {
$asignacionCategoria = $conn->prepare("INSERT INTO tblcategoriatecnico (tecnico_idtecnico,categoria_idcategoria) VALUES (:tecnico,:categoria)");
$asignacionCategoria->bindParam(':tecnico', $_POST['tecnico']);
$asignacionCategoria->bindParam(':categoria', $_POST['categoria']);
    if ($asignacionCategoria->execute()) {
      $message = 'Asiganción Realizada';
    } else {
      $message = 'La asiganción no se pudo realizar';
    }
}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Asignar Categorías</small></h1>
	</div>
	<p class="lead">Técnicos y Categorías! 
		<?php if(!empty($message)): ?>
	    <p> <?= $message ?></p>
	    <?php endif; ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Asignaciones</a></li>
			  	<li><a href="#new" data-toggle="tab">Nueva Asignación</a></li>
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
						<div class="form-group">
						  <label class="control-label">Técnico</label>
						  <select name="tecnico" class="form-control">
						  	<?php 
						  		$tecnicos = $conn->prepare("SELECT idtecnico, concat_ws(' ',nombres, apellidos) as 'entrenador' FROM tbltecnico");
						  		$tecnicos->execute();
						  		foreach ($tecnicos as $datostecnico) {
						  			echo '<option value="'.$datostecnico['idtecnico'].'">'.$datostecnico['entrenador'].'</option>';
						  		}
						  	?>
						  </select>
						</div>
						<div class="form-group">
						  <label class="control-label">Categoría</label>
						  <select name="categoria" class="form-control">
						  	<?php 
						  		$categorias = $conn->prepare("SELECT idcategoria, nombre FROM tblcategoria");
						  		$categorias->execute();
						  		foreach ($categorias as $datostecnico) {
						  			echo '<option value="'.$datostecnico['idcategoria'].'">'.$datostecnico['nombre'].'</option>';
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
								<th class="text-center">Técnico</th>
								<th class="text-center">Categoría</th>
								<th class="text-center">Actualizar</th>
								<th class="text-center">Eliminar</th>
								</tr>
								</thead>
								<?php 
								$records1 = $conn->prepare("SELECT ct.id, concat_ws(' ',nombres,apellidos) as 'Tecnico', nombre  FROM tblcategoriatecnico as ct inner join tblcategoria as c on ct.categoria_idcategoria=c.idcategoria inner join tbltecnico as t on ct.tecnico_idtecnico=t.idtecnico");
								$records1->execute();
								while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
								?>
								<tr class="gradeA">
								<td class="text-center"><?php echo $results1['Tecnico']; ?></td>
								<td class="text-center"><?php echo $results1['nombre']; ?></td>
								<td class="text-center"><a href='?p=actualizarhis?id=<?php echo $results1['id']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
								<td class="text-center"><a href='../php/eliminar/eliminarAsigancionCategoria.php?id=<?php echo $results1['id']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar la asiganción?\n <?php echo $results1['Tecnico'], "- " ,$results1['nombre']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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
