<?php
if (isset($_POST['nombres']) and isset($_POST['documento'])) {
	if($_FILES['imagen']['type']=="image/jpeg" or $_FILES['imagen']['type']=="image/png" or $_FILES['imagen']['type']=="image/jpg"){
	    $nombreimg=$_POST['documento'];
		if ($_FILES['imagen']['type']=="image/jpeg") {
			$nombreimg = $nombreimg.".jpeg";
		}elseif ($_FILES['imagen']['type']=="image/png") {
			$nombreimg = $nombreimg.".png";
		}elseif ($_FILES['imagen']['type']=="image/jpg") {
			$nombreimg = $nombreimg.".jpg";
		}else{
			$message = "Error al cambiar el nombre.";
		}
		$sql = "INSERT INTO tbljugador (nombres,apellidos,usuario,password,direccion,telefono,fecha_nac,posicion,sexo,edad,tipo_doc,documento,peso,altura,imagen,categoria_idcategoria) VALUES (:nombres, :apellidos, :usuario, :password, :direccion, :telefono, :fecha_nac, :posicion, :sexo, :edad, :tipo_doc, :documento, :peso, :altura, :imagen, :categoria)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':nombres', $_POST['nombres']);
		$stmt->bindParam(':apellidos', $_POST['apellidos']);
		$stmt->bindParam(':usuario', $_POST['usuario']);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':direccion', $_POST['direccion']);
		$stmt->bindParam(':telefono', $_POST['telefono']);
		$stmt->bindParam(':fecha_nac', $_POST['fecha_nac']);
		$stmt->bindParam(':posicion', $_POST['posicion']);
		$stmt->bindParam(':sexo', $_POST['sexo']);
		$stmt->bindParam(':edad', $_POST['edad']);
		$stmt->bindParam(':documento', $_POST['documento']);
		$stmt->bindParam(':tipo_doc', $_POST['tipo_doc']);
		$stmt->bindParam(':peso', $_POST['peso']);
		$stmt->bindParam(':altura', $_POST['altura']);
		$stmt->bindParam(':categoria', $_POST['categoria']);

		/*insertar una imagen al servidor*/
		$stmt->bindParam(':imagen', $ruta);
		$archivo=$_FILES['imagen']['tmp_name'];
		$ruta='fotoperfil/jugador/'.$nombreimg;
		move_uploaded_file($archivo, '../../img/'.$ruta);
		/*------------------------------*/

		if ($stmt->execute()) {
			$consultaidjugador = $conn->prepare("SELECT idjugador FROM tbljugador WHERE documento = :documento");
			$consultaidjugador->bindParam(':documento', $_POST['documento']);
			$consultaidjugador->execute();
			$Dataresultado = $consultaidjugador->fetch(PDO::FETCH_ASSOC);
			if (count($Dataresultado) > 0) {
				$asociarpadre = $conn->prepare("INSERT INTO tbljugador_padre (padre_familia_idpadre, jugador_idjugador) VALUES (:padre, :jugador)");
				$asociarpadre->bindParam(':padre', $_POST['acudiente']);
				$asociarpadre->bindParam(':jugador', $Dataresultado['idjugador']);
				if ($asociarpadre->execute()){
					$message = 'Jugador Creado Satisfactoriamente Y su acudiente fue asigando.';
				}else{
					$message = 'Jugador Creado Satisfactoriamente';
				}
			}

		} else {
			$message = 'Error, no se ha podido crear el jugador';
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
	  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Jugadores Registrados</small></h1>
	</div>
	<p class="lead">Jugradores
	<?php if(!empty($message)){
		echo $message;
	}?>
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
						<div class="form-group">
						  <label class="control-label">Tipo Documento</label>
						  <select name="tipo_doc" class="form-control">
						  	<option value="">Seleccione</option>
						  	<option value="TI">Tarjeta de Identidad</option>
						  	<option value="CC">Cédula de Ciudadania</option>
						  </select>
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Documento</label>
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
						<div class="form-group">
						  <label class="control-label">Fecha Nacimiento</label>
						  <input name="fecha_nac" class="form-control" type="date" required="">
						</div>
						<div class="form-group">
					      <label class="control-label">Imagen</label>
					      <div>
					        <input name="imagen" type="text" readonly="" class="form-control" placeholder="Selecciona una imagen...">
					        <input type="file" name="imagen" >
					      </div>
					    </div>	
					    <div class="form-group">
						  <label class="control-label">Posición</label>
						  <select name="posicion" class="form-control">
						  	<option value="">Seleccione</option>
						  	<option value="Delantero">Delantero</option>
						  	<option value="Defensa">Defensa</option>
						  	<option value="Arquero">Arquero</option>
						  	<option value="Lateral Derecho">Lateral Derecho</option>
						  	<option value="Lateral Izquierdo">Lateral Izquierdo</option>
						  </select>
						</div>
						<div class="form-group">
						  <label class="control-label">Género</label>
						  <select name="sexo" class="form-control">
						  	<option value="">Seleccione</option>
						  	<option value="Femenino">Femenino</option>
						  	<option value="Masculino">Masculino</option>
						  </select>
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Edad</label>
						  <input name="edad" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Peso(kg)</label>
						  <input name="peso" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Altura(cms)</label>
						  <input name="altura" class="form-control" type="text" required="">
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Categoría</label>
						  <?php 
				          $records5 = $conn->prepare('SELECT * FROM tblcategoria');
				          $records5->execute();
				        ?>
				  
				        <select name="categoria" class="form-control" required="">
				          <?php
				          foreach ($records5 as $r) {
				            echo "<option value=".$r[0].">".$r[nombre]."</option>";
				          } 
				        ?>
				        </select><br> 
						</div>
						<div class="form-group label-floating">
						  <label class="control-label">Acudiente</label>
						  <?php 
				          $acudiente = $conn->prepare('SELECT * FROM tblpadre_familia');
				          $acudiente->execute();
				        ?>
				  
				        <select name="acudiente" class="form-control" required="">
				          <?php
				          foreach ($acudiente as $a) {
				            echo "<option value=".$a['idpadre'].">".$a['nombres']," ",$a['apellidos']."</option>";
				          } 
				        ?>
				        </select><br> 
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
			<?php
			$c=0;
			if (isset($_POST['categ'])){
				$cat = $conn->prepare("SELECT nombre FROM tblcategoria WHERE idcategoria = :id");
				$cat->bindParam(":id", $_POST['categ']);
				$cat->execute();
				foreach ($cat as $nombre) {
					$nombreCategoria = $nombre['nombre'];
				}
				$listaInfo = $conn->prepare("SELECT nombres, apellidos, fecha_nac, direccion, telefono, posicion, sexo, edad, peso, altura, imagen, tipo_doc, documento FROM tbljugador WHERE categoria_idcategoria = :categoria");
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
			                <a href="?p=verjuga" class="btn btn-info btn-raised">Volver a Filtrar</a>
			                <hr class="bg-success">

			                <div class="panel panel-default">
			                    <div class="panel-body">
			                        <table width="100%" class="table table-striped table-bordered table-hover" class=""id="Categoria">
								      <thead>
								        <tr>
											<th class="text-center">Foto</th>
											<th class="text-center">Nombres</th>
											<th class="text-center">Apellidos</th>
											<th class="text-center">Fecha Nacimiento</th>
											<th class="text-center">Dirección</th>
											<th class="text-center">Teléfono</th>
											<th class="text-center">Posición</th>
											<th class="text-center">Sexo</th>
											<th class="text-center">Edad</th>
											<th class="text-center">Tipo Documento</th>
											<th class="text-center">Peso(kg)</th>
											<th class="text-center">Altura(cms)</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Eliminar</th>
								        </tr>
								      </thead>
								          <?php 
								          while($results1 = $listaInfo->fetch(PDO::FETCH_ASSOC)) {
								            ?>
								          <tr class="gradeA">
								              <td class="text-center dashboard-sideBar-UserInfo"><figure><img src='../../img/<?php print $results1['imagen']; ?>' height="80" width="120"></figure></td>
								              <td class="text-center"><?php echo $results1['nombres']; ?></td>
											  <td class="text-center"><?php echo $results1['apellidos']; ?></td>
								              <td class="text-center"><?php echo $results1['fecha_nac']; ?></td>
								              <td class="text-center"><?php echo $results1['direccion']; ?></td>
								              <td class="text-center"><?php echo $results1['telefono']; ?></td>
								              <td class="text-center"><?php echo $results1['posicion']; ?></td>
								              <td class="text-center"><?php echo $results1['sexo']; ?></td>
								              <td class="text-center"><?php echo $results1['edad']; ?></td>
								              <td class="text-center"><?php echo $results1['tipo_doc']," ",$results1['documento']; ?></td>
								              <td class="text-center"><?php echo $results1['peso']; ?></td>
								              <td class="text-center"><?php echo $results1['altura']; ?></td>      
											 
											  <td class="text-center"><a href='actualizarjuga.php?id=<?php echo $results1['idjugador']; ?>' class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											  <td class="text-center"><a href='eliminarjuga.php?id=<?php echo $results1['idjugador']; ?>' class="btn btn-danger btn-raised btn-xs" onclick="return confirm('¿Estas seguro que desea eliminar el registro con Documento?\n <?php echo $results1['tipo_doc']," ",$results1['documento']; ?>');"><i class="zmdi zmdi-delete"></i></a></td>
								          </tr>
								           <?php 
								           } 
								           ?>
								    </table>
			 					 </div>
							</div>
						</div>
					</div>
					<?php
					break;
				
				default:
					# code...
					break;
			}

			?>
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
		$('#Categoria').DataTable({
		responsive: true
		});
	});
</script>