<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM padre_familia WHERE idpadre = :idpadre');
    $records->bindParam(":idpadre", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: verpadre.php');
	}
}else{
  header('location: error.html');
}
?>
