<?php //guardar mensajes
if (isset($_POST['titulo'])) {
	if($_FILES['imagen']['type']=="image/jpeg" or $_FILES['imagen']['type']=="image/png" or $_FILES['imagen']['type']=="image/jpg"){
		/*Cambiar el nombre del archivo*/
		$nombrefoto = $conn->prepare("SELECT idhistoria FROM tblhistoria ORDER BY idhistoria DESC LIMIT 1");
		$nombrefoto->execute();
		if ($nombrefoto->rowCount() > 0){
			foreach ($nombrefoto as $nuevonombre) {
				$nombreimg = $nuevonombre['idhistoria'] + 1;
			}
		}else{
			$nombreimg = 1;
		}

		if ($_FILES['imagen']['type']=="image/jpeg") {
			$nombreimg = $nombreimg.".jpeg";
		}elseif ($_FILES['imagen']['type']=="image/png") {
			$nombreimg = $nombreimg.".png";
		}elseif ($_FILES['imagen']['type']=="image/jpg") {
			$nombreimg = $nombreimg.".jpg";
		}else{
			$message = "Error al cambiar el nombre.";
		}
		$sql = "INSERT INTO tblhistoria (titulo,ano,fecha,comentario,imagen) VALUES (:titulo,:ano,:fecha,:comentario,:imagen)";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':titulo', $_POST['titulo']);
	    $stmt->bindParam(':ano', $_POST['ano']);
	    $stmt->bindParam(':fecha', $_POST['fecha']);
	    $stmt->bindParam(':comentario', $_POST['comentario']);
	     /*insertar una imagen al servidor*/
	    $stmt->bindParam(':imagen', $ruta);
	    $archivo=$_FILES['imagen']['tmp_name'];
	    $ruta='historia/'.$nombreimg;
	    move_uploaded_file($archivo, '../../img/'.$ruta);
	    /*------------------------------*/
	    if ($stmt->execute()) {
	      $message = 'Mensaje Creado';
	    } else {
	      $message = 'No se pudo crear el mensaje';
	    }
    }else{
		$message = " <br> Archivos no permitidos. <br> Solo se permite JPG, JPEG Y PNG.";
	}
}
?>
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Publicar La historia</small></h1>
	</div>
	<p class="lead">Historia! 
		<?php if(!empty($message)): ?>
	    <p> <?= $message ?></p>
	    <?php endif; ?>
	</p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#list" data-toggle="tab">Historia</a></li>
			  	<li><a href="#new" data-toggle="tab">Nueva historia</a></li>
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
						  <label class="control-label">Titulo</label>
						  <input name="titulo" class="form-control" type="text">
						</div>
				    	<div class="form-group label-floating">
						  <label class="control-label">Año</label>
						  <input name="ano" class="form-control" type="text">
						</div>
						<div class="form-group">
						  <label class="control-label">Fecha</label>
						  <input name="fecha" class="form-control" type="date">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Comentario</label>
						  <input name="comentario" class="form-control" type="text">
						</div>
						<div class="form-group">
					      <label class="control-label">Imagen</label>
					      <div>
					        <input type="text" readonly="" class="form-control" placeholder="Selecciona una imagen...">
					        <input type="file" name="imagen" >
					      </div>
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
							      	<th class="text-center">Titulo</th>
									<th class="text-center">Año</th>
									<th class="text-center">Fecha</th>
									<th class="text-center">Comentario</th>
									<th class="text-center">Imagen</th>
									<th class="text-center">Actualizar</th>
									<th class="text-center">Eliminar</th>
							    </tr>
							  </thead>
							      <?php 
							      $records1 = $conn->prepare('SELECT * FROM tblhistoria');
							      $records1->execute();
							      while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) { 
							        ?>
							      <tr class="gradeA">
							          <td class="text-center"><?php echo $results1['titulo']; ?></td>
									  <td class="text-center"><?php echo $results1['ano']; ?></td>
							          <td class="text-center"><?php echo $results1['fecha']; ?></td>
							          <td class="text-center"><?php echo $results1['comentario']; ?></td>
							          <td class="text-center dashboard-sideBar-UserInfo"><figure><img src="../../img/<?php echo $results1['imagen']; ?>" width="100" height="100"></figure></td>
									  <td class="text-center"><a href='?p=actualizarhis?id=<?php echo $results1['idhistoria']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
									  <td class="text-center"><a href='../php/eliminar/eliminarHistoria.php?id=<?php echo $results1['idhistoria']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar la historia?\n <?php echo $results1['titulo']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
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