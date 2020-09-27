<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM administrador WHERE idadmin = :idadmin');
    $records->bindParam(":idadmin", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: veradm.php');
	}
}else{
  header('location: error.html');
}
?>
