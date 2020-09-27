<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM partido WHERE idpartido = :idpartido');
    $records->bindParam(":idpartido", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: verpartido.php');
	}
}else{
  header('location: error.html');
}
?>