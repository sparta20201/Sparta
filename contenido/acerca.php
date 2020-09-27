		<!-- BANNER -->
	<div class="section subbanner">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="caption">Acerde de Nosotros</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- ABOUT SECTION -->
	<div class="section singlepage">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">ACERCA DEL CLUB</h2>
						<div class="border-style"></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12 title-block">
					<div class="maps-wraper">
						<div>
							<iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15866.673549163896!2d-75.3407229!3d6.1751307!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x78c12634810b9fb4!2sSparta+City+Marinilla!5e0!3m2!1ses!2sco!4v1532288674375" width="1000" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>							
						</div>
					</div>

				</div>
				
				<div class="col-sm-12 col-md-6">
					
					<div class="welcome">
						<div class="title-block">¡BIENVENIDOS!</div>
						<p><strong>MISIÓN:</strong> Somos una entidad deportiva encargada de representar en las prácticas la competencia del fútbol, así como formar a sus jóvenes integrantes; Con la visión integral y humanista propia,respetando a las demás. Como también tenemos la misión de Promover el gusto por la práctica de la actividad física y el fútbol en niños y jóvenes,ofreciendo entrenamientos de calidad que le ayuden en su desarrollo integral, respaldados en los Conocimientos y experiencia de sus profesores y cuerpo técnico. </p>
						<p><strong>VISIÓN:</strong> Ser una Asociación Deportiva modelo en la organización y administración de la práctica deportiva; Reconocida como una escuela de fútbol a nivel nacional e internacional a partir de un equipo conformado por jugadores-jóvenes, que se destaquen dentro del equipo, además preocupada por la formación integral de sus integrantes fomentando la disciplina, principios y valores de la sociedad.</p>
					</div>
					
				</div>
				
				<div class="col-sm-12 col-md-6">
					
					<div id="about-caro" class="owl-carousel owl-theme">
						<?php 
							$g_inicial = $conn->prepare("SELECT foto FROM tblintroduccion");
							$g_inicial->execute();
							foreach ($g_inicial as $data_foto) {
						?>
						<div class="item">
							<img src="img/<?php echo $data_foto['foto']; ?>" alt="" class="img-responsive" />
						</div>
					<?php }?>
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
	
	
	<!-- COACH SECTION -->
	<div class="section coach bg-coach">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">CONOZCA NUESTRO EQUIPO DE TRABAJO</h2>
						<div class="border-style"></div>
					</div>
				</div>
			</div>
			

			<div class="row">
				<?php 
					$equipo_trabajo= $conn->prepare("SELECT nombres,apellidos,imagen,tipo FROM tbladministrador");
					$equipo_trabajo->execute();

					foreach ($equipo_trabajo as $equipo1) {
				?>
				<div class="col-sm-12 col-md-3">
					<div class="coach-item">
						<div class="gambar">
							<img src="img/<?php echo $equipo1['imagen']; ?>" alt="" class="img-responsive">
						</div>
						<div class="item-body">
							<div class="name">
								<?php echo $equipo1['nombres']," ",$equipo1['apellidos']; ?>
							</div>
							<div class="position">
								<?php echo $equipo1['tipo']; ?>
							</div>
						</div>
					</div>
				</div>
				<?php }
					$equipo_trabajo= $conn->prepare("SELECT nombres,apellidos,imagen,tipo FROM tbltecnico");
					$equipo_trabajo->execute();

					foreach ($equipo_trabajo as $equipo1) {
				?>
				<div class="col-sm-12 col-md-3">
					<div class="coach-item">
						<div class="gambar">
							<img src="img/<?php echo $equipo1['imagen']; ?>" alt="" class="img-responsive">
						</div>
						<div class="item-body">
							<div class="name">
								<?php echo $equipo1['nombres']," ",$equipo1['apellidos']; ?>
							</div>
							<div class="position">
								<?php echo $equipo1['tipo']; ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- CLUB HISTORY SECTION -->
	<div class="section history">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">HISTORIA DEL CLUB</h2>
						<div class="border-style"></div>
					</div>
				</div>
			</div>
			
			<div class="row">
			
				<div class="col-sm-12 col-md-12">

					<div class="nav-history">
					</div>
					<div id="history-caro" class="history-caro owl-carousel owl-theme">
						<?php
						$records3 = $conn->prepare('SELECT * FROM tblhistoria');
					    $records3->execute();
						while($results3 = $records3->fetch(PDO::FETCH_ASSOC)) {
        				?>
						<div class="item history-item">
							<div class="gambar">
								<img src="img/<?php echo $results3['imagen']; ?>" alt="" class="img-responsive" width="150" height="150">
							</div>
							<div class="item-body">
								<div class="title" data-year="<?php echo $results3['ano']; ?>">
									<?php echo $results3['fecha']; ?>
								</div>
								<p><strong>SPARTA CITY</strong> <?php echo $results3['comentario']; ?></p>
							</div>
						</div>
							<?php 
                			}
                			?>				
					</div>		
				</div>
			</div>
			
		</div>
	</div>