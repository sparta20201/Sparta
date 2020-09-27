<?php
  session_start();
  
  require 'php/database.php';
  //validar administradores
  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT * FROM tbladministrador WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['idadmin'];
      header("Location: app/secciones/homea.php");
    } else {
      $message = 'Usuario o contraseña incorrecta';
    }
  }
?>
<!DOCTYPE html>
<html>
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sparta City</title>
    <meta name="description" content="spartacity">
    <meta name="keywords" content="football, club, soccer, futbol, spartacity">
    <meta name="author" content="spartacity"> 

	<link rel="shortcut icon" href="img/club-fc-1.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/modernizr.min.js"></script>	
</head>

<body>
	
	<!-- Load page -->
	<div class="animationload">
		<div class="loader"></div>
	</div>
	
	<!-- NAVBAR SECTION -->
	<div class="navbar navbar-main navbar-fixed-top">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
						<div class="info">
							<div class="info-item">
								<div>"Our Passion, Our Dream"</div>
								<div>"Nuestra Pasión, Nuestro Sueño"</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
						<div class="top-sosmed pull-right">
							<a href="https://www.facebook.com/spartacity.marinilla.1?ref=br_rs" title=""><span class="fa fa-facebook"></span></a>
							<a href="#" title=""><span class="fa fa-twitter"></span></a>
							<a href="#" title=""><span class="fa fa-instagram"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img src="img/club-fc-1.png" alt="" /></a>
			</div>
			<nav class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?p=inic">Inicio</a></li>
					<li><a href="?p=acerca">Acerca De</a></li>
					<li><a href="?p=equipo">Equipo</a></li>
					<li><a href="?p=galeria">Galería</a></li>
					<li><a href="?p=contactos">Contactos</a></li>
					<li>
					<?php 
						if (isset($_SESSION['user_id'])) {
							$Usuario = $conn->prepare('SELECT nombres,apellidos,imagen FROM tbladministrador WHERE idadmin = :idadmin');
						    $Usuario->bindParam(':idadmin', $_SESSION['user_id']);
						    $Usuario->execute();
						    $res = $Usuario->fetch(PDO::FETCH_ASSOC);
							echo'<div class="dropdown">
									  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <img src="img/'.$res['imagen'].'" style="border-radius: 50%!important;" width="60" height="60">
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="text-align: center;">
									  <h6 class="badge text-wrap">'.$res['nombres'] . ' ' . $res['apellidos'].'</h6>
									    <br><a href="app/secciones/homea.php" class="btn btn-primary" type="button">Acceder</a>
									    <br><br><a href="app/php/logout.php" class="btn btn-danger" type="button">Cerrar Sesión</a>
									  </div>
									</div>';
						}else{
							echo '<a type="button" data-toggle="modal" data-target="#iniciar">Iniciar Sesión</a>';
						}
					?>
					</li>
				</ul>
			</nav>
		</div>
    </div>
    <!-- Iniciar Sesión -->
	<div class="modal fade" id="iniciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<center>
	    		<img src="img/club-fc-1.png" class="border border-primary" style="border-radius: 50%!important;border: 2px solid #0907c0;background: radial-gradient(black, transparent);">
	    	</center>
	      <div class="modal-header">
	        <h5 class="modal-title" style="color: black;">Iniciar Sesión</h5>
	      </div>
	      <div class="modal-body">
	        	<form method="post">
					<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
					
					<div class="form-group label-floating">
					  <label class="control-label" style="color: black;">Usuario</label>
					  <input class="form-control" name="usuario" type="text" placeholder="Ingrese su Usuario" style="color: black;">
					</div>
					<div class="form-group label-floating">
					  <label class="control-label" style="color: black;">Contraseña</label>
					  <input class="form-control" name="password" type="password" placeholder="Ingrese su Contraseña" style="color: black;">
					</div>
					<div class="form-group text-center">
						<?php if(!empty($message)){
							echo "<h5 style='color: black;'>",$message,"</h5>";
						}?>
					</div>
				
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-danger">Ingresar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<?php 
		if (!empty($_GET['e'])){
			require 'Categorias/'. $_GET['e'] .'.php';
		}else{
			if (empty($_GET['p'])) {
				$pagina = "inic";
			}else{
				$pagina = $_GET['p'];
			}
			require 'contenido/'. $pagina .'.php';
		}
	?>
	
	<!-- FOOTER SECTION -->
	<div class="footer">
	
		<div class="f-desc">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="footer-item">
							<div class="footer-title">
								<h4>NUESTRO CLUB</h4>
							</div>
							<p>Nuestras instalaciones están a su servicio para cuando estén dispuestos a utilizarlas, siempre serán atendidos con la mejor atención y estarémos para resolver sus inquietudes, recibiremos sus hijos con el mayor de los gustos.</p>
							<div class="footer-sosmed">
								<a href="https://www.facebook.com/spartacity.marinilla.1?ref=br_rs" title="">
									<div class="item">
										<i class="fa fa-facebook"></i>
									</div>
								</a>
								<a href="#" title="">
									<div class="item">
										<i class="fa fa-instagram"></i>
									</div>
								</a>
								
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="footer-item">
							<div class="footer-title">
								<h4>INFORMACIÓN</h4>
							</div>
								<?php
									$tarifas = $conn->prepare("SELECT * FROM tbltarifas");
									$tarifas->execute();
									while($resultado = $tarifas->fetch(PDO::FETCH_ASSOC)){
										echo '<div class="footer-blog-item">
												<div class="footer-blog-lead">
													'.$resultado['descripcion'] , ' $' , number_format($resultado['valor']).'
												</div>
												<div class="footer-blog-date">
													'.$resultado['comentario'].'
												</div>
											</div>';
									}
								?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="footer-item">
							<div class="footer-title">
								<h4>PREGUNTA</h4>
							</div>
							<div class="footer-form">
								<form action="#">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Nombre">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Mensaje">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-default">ENVIAR</button>
									</div>
									
								</form>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
				
		</div>
		
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p class="ftex">&copy; SPARTA CITY 2019</p> 
					</div>
				</div>
			</div>
		</div>
		
	</div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&amp;ver=4.1.5'></script>
<script type='text/javascript' src='js/jqBootstrapValidation.js'></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</html>