<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
		<h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i><?= $user['tipo']; ?><small> - Usuarios Registrados</small></h1>
	</div>
</div>
<div class="full-box text-center" style="padding: 30px 10px;">
	<a href="php/veradm.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Administradores
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-account"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">
				<?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tbladministrador');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registados</small>
		</div>
	</article></a>
	<a href="php/vertec.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Técnicos
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-male-alt"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">
				<?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tbltecnico');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registrados</small>
		</div>
	</article></a>
	<a href="php/verjuga.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Jugadores
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-face"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box"><?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tbljugador');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registrados</small>
		</div>
	</article></a>
	<a href="php/verpadre.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Padres De Familia
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-male-female"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box"><?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tblpadre_familia');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registrados</small>
		</div>
	</article></a>
	<a href="php/vermsn.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Noticias
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-comment-alt-text"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box"><?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tblmensajes');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registrados</small>
		</div>
	</article></a>
	<a href="php/verpago.php"><article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Mensualidades
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-money"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box"><?php 
					$resultstotal = $conn->prepare('SELECT COUNT(*) FROM tblmensualidad');
			    	$resultstotal->execute();
			    	$total = $resultstotal->fetchColumn();
			    	echo "$total";
				?></p>
			<small>Registrados</small>
		</div>
	</article></a>
</div>
<script src="../js/tablas-Scripts/jquery.js"></script>