<!-- BANNER -->
<div class="section subbanner">
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="caption">GALERÍA</div>
		</div>
	</div>
</div>
</div>


<!-- GALLERY SECTION -->
<div class="section singlepage" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="page-title">
					<h2 class="lead">GALERÍA</h2>
					<div class="border-style"></div>
				</div>
			</div>
		</div>
		<div class="row popup-gallery">
			<?php
				$galeria = $conn->prepare("SELECT foto FROM tblgaleria");
				$galeria->execute();
				$i=1;
				while($fotos = $galeria->fetch(PDO::FETCH_ASSOC)) {

			?>
			<div class="col-xs-4 col-sm-3 col-md-3">
				<div class="w-item">
					<?php echo '<a href="img/'. $fotos['foto'].'" title="Galeria '.$i.'">';?>
						<?php echo '<img src="img/'.$fotos['foto'].'" class="" alt="hola" width="400" height="200"/>';?>
						<div class="project-info">
							<div class="project-icon">
								<span class="fa fa-search"></span>
							</div>
						</div>
					</a>
				</div>
			</div>
			<?php $i=$i+1; } ?>	
		</div>
	</div>
</div>