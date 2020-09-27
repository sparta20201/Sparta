<?php
	session_start();
	require '../database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM jugador WHERE idjugador = :idjugador');
    $records->bindParam(":idjugador", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: verjuga.php');
	}
}else{
  header('location: error.html');
}
?>
