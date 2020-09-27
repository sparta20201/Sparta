<?php 
require '../../database.php';
foreach ($_POST['id'] as $id) {
	$tomarasistencia = $conn->prepare("INSERT INTO tblasistencia (asistencia, tbljugador_idjugador) VALUES (1, :id)");
	$tomarasistencia->bindParam(':id', $id);
	if ($tomarasistencia->execute()){
		echo json_encode($results);

	}
}

?>