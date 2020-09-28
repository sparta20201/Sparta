<?php
	session_start();
	require '../../../php/database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM tbladministrador WHERE idadmin = :idadmin');
    $records->bindParam(":idadmin", $_GET['id']);

	if($records->execute()) {
		header('location: ../../secciones/homea.php?p=veradm');
	}
}else{
  header('location: ../error.html');
}
?>
