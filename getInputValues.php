<?php
	
	include 'connection.php';

	$id = $_POST['id'];
	
	$sql = "SELECT feature_details FROM csvdata WHERE id = '".$id."'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	$fd = json_decode($row['feature_details'], true);
	echo json_encode($fd);

?>