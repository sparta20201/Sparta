<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/tablas-Style/dataTables.responsive.css">
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Registrar Asistencia</small></h1>
	</div>
	<p class="lead">Jugadores
	<div id="mensaje"></div>
	</p>
</div>


<div id="page-wrapper">
	<?php
	$c=0;
	if (isset($_POST['categ'])){
		$cat = $conn->prepare("SELECT nombre FROM tblcategoria WHERE idcategoria = :id");
		$cat->bindParam(":id", $_POST['categ']);
		$cat->execute();
		foreach ($cat as $nombre) {
			$nombreCategoria = $nombre['nombre'];
		}
		$listaInfo = $conn->prepare("SELECT nombres, apellidos, imagen, idjugador FROM tbljugador WHERE categoria_idcategoria = :categoria");
		$listaInfo->bindParam(":categoria", $_POST['categ']);
		$listaInfo->execute();
		$c=1;
	}
	
	switch ($c) {
		case 0:
			$listaCategoria = $conn->prepare("SELECT * FROM tblcategoria");
			$listaCategoria->execute();
			echo "
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-xs-12 col-md-10 col-md-offset-1'>
						<form method='post'>
							<select name='categ' class='form-control'>";
								foreach ($listaCategoria as $lista) {
									echo "<option value='".$lista['idcategoria']."'>".$lista['nombre']."</option>";
								}
			echo "
							</select>
							<p class='text-center'>
						    	<button type='submit' class='btn btn-info btn-raised btn-sm'><i class='zmdi zmdi-accounts-list-alt'></i> Listar </button>
						    </p>
						</form>
					</div>
				</div>
			</div>";
			break;
		case 1:?>
	        <div class="row">
	            <div class="col-lg-12">
	                <h2 class="text-center"><?php echo $nombreCategoria; ?></h2>
	                <a href="?p=verAsistencia" class="btn btn-info btn-raised">Volver a Filtrar</a>
	                <hr class="bg-success">

	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <table width="100%" class="table table-striped table-bordered table-hover" class=""id="Categoria">
						      <thead>
						        <tr>
									<th class="text-center">Foto</th>
									<th class="text-center">Jugador</th>
									<th class="text-center">Asistencia</th>
						        </tr>
						      </thead>
						          <?php 
						          while($results1 = $listaInfo->fetch(PDO::FETCH_ASSOC)) {
						            ?>
						          <tr class="gradeA">
						              <td class="text-center dashboard-sideBar-UserInfo"><figure><img src='../../img/<?php print $results1['imagen']; ?>' height="80" width="120"></figure></td>
						              <td class="text-center"><?php echo $results1['nombres']," ",$results1['apellidos']; ?></td>     
									 
									  <td class="text-center"><input type="checkbox" name="asistencia" value="<?php echo $results1['idjugador']; ?>"></td>
						          </tr>
						           <?php 
						           } 
						           ?>
						    </table>
						    <button class="btn btn-success btn-raised" id="asistencia">Guardar Asistencia</button>
	 					 </div>
					</div>
				</div>
			</div>
			<?php
			break;
	}

	?>
</div>
<!-- DataTables JavaScript Traducir-->
<script src="../js/tablas-Scripts/jquery.js"></script>
<script src="../js/tablas-Scripts/jquery.dataTables.js"></script>
<script src="../js/tablas-Scripts/dataTables.bootstrap.js"></script>
<script src="../js/tablas-Scripts/dataTables.responsive.js"></script>
<script>
	$('#asistencia').click(function(){
		var asistencia = [];
		$(':checkbox:checked').each(function(i){
    		asistencia[i] = $(this).val();
   		});
   		if (asistencia.length === 0){
   			alert("Por favor, primero tome la asistencia antes de guardar.");
   		}else{
   			let mensaje = document.getElementById('mensaje');
		    fetch('../php/asistencia.php',{
				method: 'POST',
				body: {id:asistencia}
			})
			/* Es para permitir recibir el mensaje */
			.then( res => res.json())
			/* Es para tomar los mensaje  */
			.then( data => {
				if (data === 'Vacios'){
					respuesta.innerHTML = `
					<div class="alert alert-danger" role="alert">
					  Llena los Campos.
					</div>`
					document.getElementsByName('identificacion')[0].focus();
				}else{
					if (data === 'invalida'){
						respuesta.innerHTML = `
						<div class="alert alert-warning" role="alert">
						  Lo sentimos, identificación y contraseña incorrecta.
						</div>`
						formulario.reset();
						document.getElementsByName('identificacion')[0].focus();
					}else{
						var direccion = data;
						window.location='Sesiones/'+direccion;
					}
				}
			})
        }
	});
	$(document).ready(function() {
		$('#Categoria').DataTable({
		responsive: true
		});
	});
</script>