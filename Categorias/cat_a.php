<!-- BANNER -->
<div class="section subbanner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="caption">EQUIPO</div>
			</div>
		</div>
	</div>
</div>
<!-- TEAM SECTION -->

<div class="section player" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="page-title">
					<h2 class="lead">CATEGORÍA A</h2>
					<div class="border-style"></div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade active in" id="list">
			<div id="page-wrapper">
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="panel1 panel-default1">
	                      
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
	                        	<a href="?p=equipo" class="btn btn-danger">Volver</a><br><br>
	                            <table width="100%" class="table1 table-striped table-bordered table-hover" class=""id="dataTables-example">
						        <thead>
						            <tr>
										<th class="text-center">Foto</th>
										<th class="text-center">Nombres</th>
										<th class="text-center">Apellidos</th>
										<th class="text-center">Posición</th>
						            </tr>
						        </thead>
						         <?php
									$categoriaa = $conn->prepare('SELECT imagen, nombres, apellidos, posicion FROM tbljugador WHERE categoria_idcategoria = 7');
								    $categoriaa->execute();
									while($datoscategoria = $categoriaa->fetch(PDO::FETCH_ASSOC)) {
									?>
					              <tr class="gradeA">
					                  <td class="text-center"><img src="img/<?php echo $datoscategoria['imagen']; ?>" width="50" height="50" style="border-radius: 50%!important;"></td>
					                  <td class="text-center"><?php echo $datoscategoria['nombres']; ?></td>
									  <td class="text-center"> <?php echo $datoscategoria['apellidos']; ?> </td>
						              <td class="text-center"><?php echo $datoscategoria['posicion']; ?> </td>
					              </tr>
						          <?php } ?>    
						        </table>
						    </div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
