 	<?php 
 		$galeriapresentacion = $conn->prepare("SELECT * FROM tblgaleriainicio");
 		$galeriapresentacion->execute();
 		$cantidad = $galeriapresentacion->rowCount();
 	?>
	<!-- BANNER -->
	<div class="section banner" >
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php 
					for ($i=0; $i < $cantidad; $i++) {
						if ($i==0){
							echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>';
						}else{
							echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
						}
					}
				?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
					$j=1;
					while($galeria = $galeriapresentacion->fetch(PDO::FETCH_ASSOC)) {
						if ($j==1){
							echo '<div class="item active">';
						}else{
							echo '<div class="item">';
						}
				 echo '<img src="img/',$galeria['foto'],'" width="1384" height="768">';?>
					<div class="carousel-caption">
						<div class="container">
							<div class="wrap-caption">
								<div class="caption-heading"><?php echo $galeria['titulo'];?></div>
								<div class="caption-desc"><?php echo $galeria['parrafo'];?></div>
							</div>
						</div>
					</div>
				</div>
			<?php $j=$j+1; } ?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="fa fa-chevron-left" ></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="fa fa-chevron-right" ></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<!-- END CAROUSEL -->
	</div>
	
	<!-- ABOUT SECTION -->
	<div class="section about">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">ACERCA DE SPARTA CITY</h2>
						<div class="border-style"></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-sm-12 col-md-4">
					<div id="shop-caro" class="owl-carousel owl-theme">
						<?php 
							$g_inicial = $conn->prepare("SELECT foto FROM tblintroduccion");
							$g_inicial->execute();
							foreach ($g_inicial as $data_foto) {
						?>
						<div class="item shop-item">
							<div class="img">
								<img src="img/<?php echo $data_foto['foto']; ?>" class="img-responsive"/>
							</div>
							<div class="description">
								<div class="collection-name">
									Chicos y chicas, preparándose con esfuerzo, dedicación y pasión
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
				
				<div class="col-sm-12 col-md-8">
					
					  <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
						<ul id="myTabs" class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#league" role="tab" id="league-tab" data-toggle="tab" aria-controls="league">NOTICIAS</a></li>
							<li><a href="#match" id="match-tab" role="tab" data-toggle="tab" aria-controls="match" aria-expanded="true">PRÓXIMOS PARTIDOS</a></li>
							<li><a href="#training" role="tab" id="training-tab" data-toggle="tab" aria-controls="training">ENTRENAMIENTOS</a></li>
							
						</ul>
						<div id="myTabContent" class="tab-content tab-content-bg">
							<div role="tabpanel" class="tab-pane fade in" id="match" aria-labelledBy="match-tab">
								<div class="table-responsive">
									<?php
									$records1 = $conn->prepare('SELECT * FROM tblpartido');
									    $records1->execute();
									    $partidos = $records1->rowCount();
									    if ($partidos == 0){
									    	echo "<h4 class='text-center bg-danger'>No hay partidos en el calendario.</h4>";
									    }else{
									?>
									<table class="table table-striped text-center">
										<thead>
											<tr>
												<td class="tw20">Fecha</td>
												<td class="tw20">Hora</td>
												<td class="tw20">Lugar</td>
												<td class="tw50" colspan="3">Partido</td>
											</tr>
										</thead>
										<tbody>
											<?php
												while($results1 = $records1->fetch(PDO::FETCH_ASSOC)) {
											?>
											<tr>
												<td class="tw20"><div class="match-date"><?php echo $results1['fecha']; ?></div></td>
												<td class="tw20"><div class="match-date"><?php echo $results1['hora']; ?></div></td>
												<td class="tw20"><div class="match-date"><?php echo $results1['lugar']; ?></div></td>
												<td><div class="match-title"><?php echo $results1['equipo1']; ?></div></td>
												<td><div class="match-title color-red">VS</div></td>
												<td><div class="match-title"><?php echo $results1['equipo2']; ?></div></td>
											</tr>
										<?php } ?>
										</tbody>	
									</table>
									<?php }  ?>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="training" aria-labelledBy="training-tab">
								<div class="table-responsive">
									<?php
									$records3 = $conn->prepare('SELECT e.dia_semana, e.hora_inicio, e.hora_salida, c.nombre as "categoria" FROM tblentrenamientos as e inner join tblcategoria as c on e.categoria_idcategoria=c.idcategoria');
								    $records3->execute();
								    $entrenamientos = $records3->rowCount();
								    if ($entrenamientos == 0){
								    	echo "<h4 class='text-center bg-danger'>No hay entrenamientos.</h4>";
								    }else{
									?>
									<table class="table table-striped">
										<thead>
											<tr>
												<th class="text-center">Fecha y Hora Inicio - Hora Final</th>
												<th class="text-center">Categoria</th>
											</tr>
										</thead>
										<tbody>
											<?php
												while($results3 = $records3->fetch(PDO::FETCH_ASSOC)) {
											?>
											<tr>
												<td class="tw40 text-center">
													<div class="match-date text-center"><?php echo "<b>",$results3['dia_semana'],"</b> ",$results3['hora_inicio']," - ",$results3['hora_salida']; ?></div>
												</td>
												<td class="text-center">
													<div class="match-title"><?php echo $results3['categoria']; ?></div>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
									<?php } ?>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade in active" id="league" aria-labelledBy="league-tab">
								<div class="table-responsive">
									<?php
									$records2 = $conn->prepare('SELECT * FROM tblmensajes');
									$records2->execute();
								    $mensaje = $records2->rowCount();
								    if ($mensaje == 0){
								    	echo "<h4 class='text-center bg-danger'>No hay Noticias.</h4>";
								    }else{
									?>

									<table class="table table-striped text-center">
										<thead>
											<tr>
												<td class="tw10">Fecha</td>
												<td class="tw50">Noticia</td>
											</tr>
										</thead>
										<?php
										
										while($results2 = $records2->fetch(PDO::FETCH_ASSOC)) {
											if ($results2['estado']=='Activo') {
										?>
											<tr>
												<td><div class="match-title"><?php echo $results2['fecha']; ?></div></td>
												<td><div class="match-title"><?php echo $results2['mensaje']; ?></div></td>
											</tr>
										<?php } ?>	
									</table>
								<?php } } ?>
								</div>
							</div>
						  
						</div>
					  </div>
				</div>
			</div>
		</div>
	</div>