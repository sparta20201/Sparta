<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM tecnico WHERE idtecnico = :idtecnico');
    $records->bindParam(":idtecnico", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: vertec.php');
	}
}else{
  header('location: error.html');
}
?>
