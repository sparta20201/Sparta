<?php
  session_start();
  
  require '../database.php';
  //validar administradores
  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT * FROM administrador WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['tipo'];
      header("Location: ../homea.php");
    } else {
      $message = 'Usuario o contraseña incorrecta';
    }
  }//Validar los técnicos
  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT * FROM tecnico WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['tipo'];
      header("Location: ../homet.php");
    } else {
      $message = 'Usuario o contraseña incorrecta';
    }
  }//Validar los jugadores
  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT * FROM jugador WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['tipo'];
      header("Location: ../homej.php");
    } else {
      $message = 'Usuario o contraseña incorrecta';
    }
  }


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sparta City</title>
  <link rel="shortcut icon" href="../../img/logo.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
</head>
<body class="cover" style="background-image: url(../assets/img/loginFont.jpg);">
	<form action="ingresar.php" method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión</p>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserEmail">Usuario</label>
		  <input class="form-control" name="usuario" type="text">
		  <p class="help-block">Escribe tú Usuario</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input class="form-control" name="password" type="password">
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
			<?php if(!empty($message)): ?>
	      	<p><?= $message ?></p>
	    	<?php endif; ?>
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">
			<br><a href="../../index.php"><input value="Volver" type="button" class="btn btn-raised btn-danger"></a>
		</div>
	</form>
	<!--====== Scripts -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/material.min.js"></script>
	<script src="../js/ripples.min.js"></script>
	<script src="../js/sweetalert2.min.js"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>