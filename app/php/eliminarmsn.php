<?php
	session_start();
	require '../../php/database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM tblmensajes WHERE idmsn = :idmsn');
    $records->bindParam(":idmsn", $_GET['id']);
	$records->execute();

	if($records) { 
		header('location: ../secciones/homea.php?p=vermsn');
	}
}else{
  header('location: ../secciones/homea.php?p=vermsn');
}
?>
