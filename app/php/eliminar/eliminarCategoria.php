<?php
	session_start();
	require '../../../php/database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM tblcategoria WHERE idcategoria = :id');
    $records->bindParam(":id", $_GET['id']);

	if($records->execute()) {
		header('location: ../../secciones/homea.php?p=vercategorias');
	}
}else{
  header('location: ../error.html');
}
?>
