<?php
 //actualizar datos personales
 if (!empty($_POST['claveN1']) and !empty($_POST['claveN2'])){
  if($_POST['claveN1']!=$_POST['claveN2']){
    $mensaje= "Error: las claves no coinciden";
    exit();
  }else{
    $actualizainfo=$conn->prepare("UPDATE tbladministrador SET nombres=:nombres,apellidos=:apellidos,usuario=:usuario,password=:password,cedula=:cedula,telefono=:telefono WHERE idadmin=:id");
    $actualizainfo->bindParam(":nombres",$_POST['nombres']);
    $actualizainfo->bindParam(":apellidos",$_POST['apellidos']);
    $actualizainfo->bindParam(":usuario",$_POST['usuario']);
    $actualizainfo->bindParam(":cedula",$_POST['cedula']);
    $actualizainfo->bindParam(":telefono",$_POST['telefono']);
    $password = password_hash($_POST['claveN1'], PASSWORD_BCRYPT);
    $actualizainfo->bindParam(":password",$password);
    $actualizainfo->bindParam(":id",$user['idadmin']);
	    if($actualizainfo->execute()){
	    	$mensaje = "Datos actualizados Correctamente.";
	    }else{
	    	$mensaje = "Error al actualizar los datos.";
	    }
    }   
 }elseif (!empty($_FILES['imagen'])) {
 	if($_FILES['imagen']['type']=="image/jpeg" or $_FILES['imagen']['type']=="image/png" or $_FILES['imagen']['type']=="image/jpg"){
	    $nombreimg=$user['cedula'];
		if ($_FILES['imagen']['type']=="image/jpeg") {
			$nombreimg = $nombreimg.".jpeg";
		}elseif ($_FILES['imagen']['type']=="image/png") {
			$nombreimg = $nombreimg.".png";
		}elseif ($_FILES['imagen']['type']=="image/jpg") {
			$nombreimg = $nombreimg.".jpg";
		}else{
			$message = "Error al cambiar el nombre.";
		}
	 	$actualizafoto=$conn->prepare("UPDATE tbladministrador SET imagen=:imagen WHERE idadmin=:id");
	    $actualizafoto->bindParam(":id",$user['idadmin']);
	    $actualizafoto->bindParam(":imagen",$ruta);
		$archivo=$_FILES['imagen']['tmp_name'];
		$ruta='fotoperfil/admin/'.$nombreimg;
		move_uploaded_file($archivo, '../../img/'.$ruta);
	    if($actualizafoto->execute()){
	    	$mensaje = "Foto actualizada Correctamente.";
	    }else{
	    	$mensaje = "Error al actualizar la foto.";
	    }
	}

}
?>
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles text-center"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Actualizar Información</h1>
	</div>
	<p class="lead">
	<?php if(!empty($mensaje)): ?>
	<p> <?= $mensaje ?></p>
	<?php endif; ?></p>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class="active"><a href="#new" data-toggle="tab">Actualizar Datos</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="new">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-md-10 col-md-offset-1">
						    <form method="post" enctype="multipart/form-data">
						    	<div class="alert alert-info" role="alert">
								  Cambiar la foto de perfil.<br>
								  Debes elegir una foto antes del cambio.
								</div>
						    	<div class="form-group dashboard-sideBar-UserInfo">
						    		<label class="control-label">Imagen Actual</label>
							      	<div>
						    		<figure>
						    			<img src='../../img/<?php echo $user['imagen']; ?>' height="100" width="150"/>
						    		</figure>
							        <input type="text" readonly class="form-control" placeholder="Selecciona una imagen...">
							        <input type="file" name="imagen" value='<?php echo $user['imagen']; ?>' required>
							      </div>
							    </div>
							    <p class="text-center">
							    	<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar </button>
							    </p>
							</form>
							    <form method="post">
							    <div class="alert alert-info" role="alert">
								  Cambiar datos personales.<br>
								  <b>Para actualizar, por favor ingrese la contraseña</b>
								</div>
						    	<div class="form-group label-floating">
								  <label class="control-label">Nombres</label>
								  <input name="nombres" value="<?php echo $user['nombres']; ?>" class="form-control" type="text" required="">
								</div>
								<div class="form-group label-floating">
								  <label class="control-label">Apellidos</label>
								  <input name="apellidos" value="<?php echo $user['apellidos']; ?>" class="form-control" type="text" required="">
								</div>
						    	<div class="form-group label-floating">
								  <label class="control-label">Usuario</label>
								  <input name="usuario" value="<?php echo $user['usuario']; ?>" class="form-control" type="text" required>
								</div>
								<div class="form-group label-floating">
								  <label class="control-label">Cédula</label>
								  <input name="cedula" value="<?php echo $user['cedula']; ?>" class="form-control" type="number" required=>
								</div>
								<div class="form-group label-floating">
								  <label class="control-label">Teléfono</label>
								  <input name="telefono" value="<?php echo $user['telefono']; ?>" class="form-control" type="number" required=>
								</div>
								<div class="form-group label-floating">
								  <label class="control-label">Contraseña</label>
								  <input name="claveN1" type="password" class="form-control">
								</div>
								<div class="form-group label-floating">
								  <label class="control-label">Repita Contraseña</label>
									  <input name="claveN2" type="password" class="form-control">
								</div>
							    <p class="text-center">
							    	<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar </button>
							    </p>
						    </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../js/tablas-Scripts/jquery.js"></script>