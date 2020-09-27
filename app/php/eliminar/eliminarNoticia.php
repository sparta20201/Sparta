<?php
	session_start();
	require '../../../php/database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM tblmensajes WHERE idmsn = :id');
    $records->bindParam(":id", $_GET['id']);

	if($records->execute()) {
		header('location: ../../secciones/homea.php?p=vermsn');
	}
}else{
  header('location: ../error.html');
}
?>
