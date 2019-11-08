<?php
	
	include 'connection.php';

	$sql = "SELECT headings FROM heading";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	$fd = json_decode($row['headings']);
	echo json_encode($fd);

?>