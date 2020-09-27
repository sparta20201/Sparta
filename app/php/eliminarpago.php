<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM mensualidad WHERE idmensualidad = :idmensualidad');
    $records->bindParam(":idmensualidad", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: verpago.php');
	}
}else{
  header('location: error.html');
}
?>
